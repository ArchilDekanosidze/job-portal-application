<?php

namespace App\Jobs\Notification;

use App\Services\Notification\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSmsToMultipleUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $multipleUser;
    private $data;

    /**
     * Create a new job instance.
     */
    public function __construct($multipleUser, array $data)
    {
        $this->multipleUser = $multipleUser;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(Notification $notification)
    {
        return $notification->sendSmsToMultipleUser($this->multipleUser, $this->data);
    }
}
