<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetPasswordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->onConnection('redis');
    }


    public function handle()
    {
        $token = Str::random(64);
        $email = $this->user->email;
        DB::table('password_resets')->insert([

            'email' => $this->user->email,
            'token' => bcrypt($token),
            'created_at' => now()
        ]);

        Mail::send('emails.resetPassword', ['token' => $token, 'email' => $this->user->email], function ($message) use ($email) {

            $message->to($email);
            $message->from('noreply@ipscorrientes.com', 'IPS Corrientes');
            $message->subject('Notificación de cambio de contraseña');
        });
    }
}
