<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminAssignedNotification extends Notification
{
    use Queueable;

    private $adminDetails;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($adminDetails)
    {
        $this->adminDetails = $adminDetails;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
        // return ['mail'];
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
            ->line($this->adminDetails['notify']);
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
            'data' => $this->adminDetails['notifyAdmin'],
            'url' => $this->adminDetails['url'],
            'sender' => $this->adminDetails['sender'],
        ];
    }
}
