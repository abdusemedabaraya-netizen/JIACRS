<?php

namespace App\Notifications;

use App\Models\Report;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportStatusChanged extends Notification
{
    public function __construct(public Report $report, public string $from, public string $to) {}

    public function via(object $notifiable): array
    {
        return config('jiacrs.mail_notifications') ? ['database', 'mail'] : ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title'   => 'Report ' . $this->report->tracking_number . ' is now ' . str_replace('_', ' ', $this->to),
            'message' => 'The status of your report changed.',
            'url'     => route('my.reports.show', $this->report),
        ];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('JIACRS: update on report ' . $this->report->tracking_number)
            ->line('The status of your report is now: ' . str_replace('_', ' ', $this->to) . '.')
            ->action('View report', route('my.reports.show', $this->report));
    }
}
