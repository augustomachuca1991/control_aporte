<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Events\{NotificationImport,FailedImport};
use Exception;

class CompletedExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        try {
            
            event(new NotificationImport('Descarga exitosa'));
        
        } catch (Exception $e) {
            
            $this->failed($e);
        
        }
        
    }

    public function failed($exception)
    {
        event(new FailedImport($exception->getMessage()));
        // etc...
    }
}
