<?php

namespace App\Jobs;

use App\DeclaracionJurada;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Events\NotificationImport;


class CompletedImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->onConnection('redis');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Log::channel('daily')->info($this->declaracionJurada);
        //Storage::delete($this->declaracionJurada->path);
        
        event(new NotificationImport('Se envio una notificacion a su correo'));
    }
}
