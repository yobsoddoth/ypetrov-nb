<?php

namespace App\Jobs;

use Domain\Interfaces\NotificationServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UserStoredNotificationJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private array $data
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(NotificationServiceInterface $service): void
    {
        $service->log($this->data);
    }
}
