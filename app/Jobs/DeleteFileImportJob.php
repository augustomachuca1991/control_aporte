<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\DeclaracionJurada;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class DeleteFileImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $declaracionJurada;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(DeclaracionJurada $declaracionJurada)
    {
        $this->declaracionJurada = $declaracionJurada;
        $this->onConnection('redis');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::channel('daily')->info($this->declaracionJurada);
        //Storage::delete($this->declaracionJurada->path);
        $this->declaracionJurada->status = false;
        $this->declaracionJurada->save();
    }
}
