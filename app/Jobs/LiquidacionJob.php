<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
//use Illuminate\Bus\Batchable;
// use App\{DeclaracionJurada,Liquidacion};

class LiquidacionJob implements ShouldQueue
{
    use  Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    //public $declaracionjurada_id;
    // protected $declaracionjurada;
    // public $tries = 3;

    public function __construct(DeclaracionJurada $declaracionjurada)
    {
        // $this->declaracionjurada = $declaracionjurada;
        // $this->onConnection('redis');
        // $this->onQueue('processing liquidacion');
        //$this->declaracionjurada_id = $declaracionjurada_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
