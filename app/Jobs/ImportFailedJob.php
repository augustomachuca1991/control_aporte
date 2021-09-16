<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\DeclaracionJurada;

class ImportFailedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $declaracionjurada;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(DeclaracionJurada $declaracionjurada)
    {
        //
        $this->declaracionjurada = $declaracionjurada;
        $this->onConnection('redis');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        foreach($this->declaracionjurada->ddjj_lines as $ddjj_line)
        {
            $ddjj_line->delete();
        }
        $this->declaracionjurada->forceDelete();
    }
}
