<?php

namespace App\Jobs;

use App\Notifications\FailedRowNotification;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Validators\Failure;

class FailedRowJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $failure;
    protected $fileName;

    public function __construct(User $user, Failure $failure, $fileName)
    {
        $this->user = $user;
        $this->failure = $failure;
        $this->fileName = $fileName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->notify(new FailedRowNotification($this->failure, $this->fileName));
    }
}
