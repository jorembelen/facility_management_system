<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TenantClosedAppointmentNotification extends Notification
{
    use Queueable;

    private $closedDetails;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($closedDetails)
    {
        $this->closedDetails = $closedDetails;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['database'];
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                            ->greeting($this->closedDetails['greeting'])
                            ->line($this->closedDetails['user_body'])
                            ->action($this->closedDetails['actionText'], $this->closedDetails['rate_url']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'data' => $this->closedDetails['body'],
            'url' => $this->closedDetails['url'],
            'sender' => $this->closedDetails['sender'],
        ];
    }
}
