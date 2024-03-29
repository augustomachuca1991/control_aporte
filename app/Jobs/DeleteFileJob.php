<?php

namespace App\Jobs;

use App\DeclaracionJurada;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DeleteFileJob implements ShouldQueue
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
        Storage::delete($this->declaracionJurada->path);
        $this->declaracionjurada->update(['status' => false]);
    }
}
