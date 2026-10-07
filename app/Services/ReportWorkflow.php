<?php

namespace App\Services;

use App\Models\Investigation;
use App\Models\Report;
use App\Models\ReportStatusHistory;
use App\Models\User;
use App\Notifications\NewReportSubmitted;
use App\Notifications\ReportAssigned;
use App\Notifications\ReportStatusChanged;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;

class ReportWorkflow
{
    /** Manual status changes an Admin may make. Assignment is done through assign(). */
    public const TRANSITIONS = [
        'submitted'     => ['under_review', 'rejected'],
        'under_review'  => ['rejected'],
        'assigned'      => ['investigating'],
        'investigating' => ['resolved'],
        'resolved'      => ['closed', 'investigating'],
        'closed'        => [],
        'rejected'      => [],
    ];

    /** The only moves an investigator may make on their own case. */
    private const INVESTIGATOR = [
        'assigned'      => ['investigating'],
        'investigating' => ['resolved'],
    ];

    public static function allowedNext(Report $report, ?User $user): array
    {
        if (! $user) {
            return [];
        }

        if ($user->hasAnyRole(['Admin', 'Super Admin'])) {
            return self::TRANSITIONS[$report->status] ?? [];
        }

        if ($user->hasRole('Investigator') && $report->investigation?->investigator_id === $user->id) {
            return self::INVESTIGATOR[$report->status] ?? [];
        }

        return [];
    }

    public function changeStatus(Report $report, string $to, User $actor, ?string $note = null): void
    {
        if (! in_array($to, self::allowedNext($report, $actor), true)) {
            throw ValidationException::withMessages([
                'status' => 'That status change is not allowed from the current status.',
            ]);
        }

        $from = $report->status;

        DB::transaction(function () use ($report, $from, $to, $actor, $note) {
            $report->update(['status' => $to]);
            $this->record($report, $from, $to, $actor->id, $note);
            AuditLogger::log('report.status_changed', $report, "{$from} -> {$to}");
        });

        // Only registered, non-anonymous reporters have a user_id to notify.
        $this->safeNotify($report->user, new ReportStatusChanged($report, $from, $to));
    }

    public function changePriority(Report $report, string $priority, User $actor): void
    {
        $old = $report->priority;
        if ($old === $priority) {
            return;
        }

        $report->update(['priority' => $priority]);
        AuditLogger::log('report.priority_changed', $report, "{$old} -> {$priority}");
    }

    public function assign(Report $report, User $investigator, User $actor): Investigation
    {
        $investigation = DB::transaction(function () use ($report, $investigator, $actor) {
            $investigation = Investigation::create([
                'report_id'       => $report->id,
                'investigator_id' => $investigator->id,
            ]);

            if (in_array($report->status, ['submitted', 'under_review'], true)) {
                $from = $report->status;
                $report->update(['status' => 'assigned']);
                $this->record($report, $from, 'assigned', $actor->id, "Assigned to {$investigator->name}");
            }

            AuditLogger::log('investigation.assigned', $report, "Investigator user #{$investigator->id}");

            return $investigation;
        });

        $this->safeNotify($investigator, new ReportAssigned($report));

        return $investigation;
    }

    public function unassign(Investigation $investigation, User $actor): void
    {
        $report = $investigation->report;

        DB::transaction(function () use ($investigation, $report, $actor) {
            if (in_array($report->status, ['assigned', 'investigating'], true)) {
                $from = $report->status;
                $report->update(['status' => 'under_review']);
                $this->record($report, $from, 'under_review', $actor->id, 'Assignment removed');
            }

            AuditLogger::log('investigation.unassigned', $report, "Investigator user #{$investigation->investigator_id}");
            $investigation->delete();
        });
    }

    /** First history row + audit entry. No IP, and no user id for anonymous reports. */
    public function recordSubmission(Report $report): void
    {
        $this->record($report, null, 'submitted', null, null);
        AuditLogger::record('report.submitted', $report->user_id, $report, null, false);
    }

    public function notifyNewReport(Report $report): void
    {
        $admins = User::role(['Admin', 'Super Admin'])->get();
        $this->safeNotify($admins, new NewReportSubmitted($report));
    }

    private function record(Report $report, ?string $from, string $to, ?int $by, ?string $note): void
    {
        ReportStatusHistory::create([
            'report_id'   => $report->id,
            'from_status' => $from,
            'to_status'   => $to,
            'changed_by'  => $by,
            'note'        => $note,
        ]);
    }

    private function safeNotify($notifiable, $notification): void
    {
        if (! $notifiable || (is_countable($notifiable) && count($notifiable) === 0)) {
            return;
        }

        try {
            Notification::send($notifiable, $notification);
        } catch (\Throwable $e) {
            report($e); // e.g. SMTP down: do not fail the whole request
        }
    }
}
