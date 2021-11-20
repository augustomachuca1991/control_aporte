<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FinishJob extends Notification implements ShouldQueue
{
    use Queueable;


    protected $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
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
            ->greeting('Exito!')
            ->line($this->message)
            ->action('Instituto de Previsión Social', url('/import'))
            ->line('Gracias por Utilizar nuestra aplicación!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // public function toDatabase($notifiable)
    // {
    //     return ['message' => 'se procesaron 900/1000 registro',
    //             'image' => 'logo-ips.png',
    //             'date' => now(),
    //     ];
    // }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
            'icon' => 'far fa-envelope-open',
            'date' => now()->diffForhumans(),
        ];
    }
}
