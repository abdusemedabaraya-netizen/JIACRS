<?php

namespace App\Notifications;

use App\Models\Report;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportAssigned extends Notification
{
    public function __construct(public Report $report) {}

    public function via(object $notifiable): array
    {
        return config('jiacrs.mail_notifications') ? ['database', 'mail'] : ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title'   => 'New case assigned: ' . $this->report->tracking_number,
            'message' => 'You have been assigned to investigate this report.',
            'url'     => route('reports.show', $this->report),
        ];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('JIACRS: case assigned ' . $this->report->tracking_number)
            ->line('A report has been assigned to you.')
            ->action('Open case', route('reports.show', $this->report));
    }
}
