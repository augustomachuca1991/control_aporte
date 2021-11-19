<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Maatwebsite\Excel\Validators\Failure;

class FailedRowNotification extends Notification implements ShouldQueue
{
    use Queueable;


    protected $failure;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Failure $failure)
    {
        $this->failure = $failure;
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
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
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
            'message' => $this->failure->toArray()[0],
            'row' => $this->failure->row(),
            'attribute' => $this->failure->attribute(),
            'errors' => $this->failure->errors(),
            'values' => $this->failure->values()[$this->failure->attribute()]
        ];
    }
}
