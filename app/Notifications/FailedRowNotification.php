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
    protected $fileName;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Failure $failure, $fileName)
    {
        $this->failure = $failure;
        $this->fileName = $fileName;
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
            ->greeting('Se importó el archivo ' . $this->fileName)
            ->line('Hubo fallós en la fila ' . $this->failure->row() . ' con el siguente error: ' . $this->failure->errors()[0])
            ->action('Notification Action', url('/import'))
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
            'fileName' => $this->fileName,
            'message' => $this->failure->toArray()[0],
            'row' => $this->failure->row(),
            'attribute' => $this->failure->attribute(),
            'errors' => $this->failure->errors(),
            'values' => $this->failure->values()[$this->failure->attribute()]
        ];
    }
}
