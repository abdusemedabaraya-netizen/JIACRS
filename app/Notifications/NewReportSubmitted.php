<?php

namespace App\Notifications;

use App\Models\Report;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReportSubmitted extends Notification
{
    public function __construct(public Report $report) {}

    public function via(object $notifiable): array
    {
        return config('jiacrs.mail_notifications') ? ['database', 'mail'] : ['database'];
    }

    // Deliberately contains no reporter information.
    public function toArray(object $notifiable): array
    {
        return [
            'title'   => 'New report: ' . $this->report->tracking_number,
            'message' => ucwords(str_replace('_', ' ', $this->report->category)),
            'url'     => route('reports.show', $this->report),
        ];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('JIACRS: new report ' . $this->report->tracking_number)
            ->line('A new report was submitted.')
            ->action('Review report', route('reports.show', $this->report));
    }
}
