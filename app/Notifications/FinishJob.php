<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FinishJob extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
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
                    ->line('La carga de archivo finalizo de forma exitosa.')
                    ->action('Instituto de Previsión Social', url('/dashboard'))
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
    //     return [
    //         'data' => [
    //             'message' => 'Tarea Completada',
    //             'time' => now()->diffForHumans(),
    //             'image' => 'image\ips.png',
    //         ]
    //     ];
    // }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Tarea Completa',
            'image' => 'image\ips.png',
        ];
    }
}
