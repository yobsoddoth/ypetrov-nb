<?php

namespace Tests\Feature;

use App\Jobs\UserStoredNotificationJob;
use Domain\Interfaces\NotificationServiceInterface;
use Tests\TestCase;

class UserStoredNotificationJobTest extends TestCase
{
    private string $logfile;

    protected function setUp(): void
    {
        parent::setUp();
        $this->logfile = dirname(__DIR__) . '/_output/notifications.log';
    }

    protected function tearDown(): void
    {
        if (file_exists($this->logfile)) {
            unlink($this->logfile);
        }

        parent::tearDown();
    }

    public function test_job_logs_received_data_via_notification_service(): void
    {
        $data = [
            'email' => 'john.doe@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe',
        ];

        $service = $this->app->make(NotificationServiceInterface::class);
        $this->app->make(UserStoredNotificationJob::class, ['data' => $data])->handle($service);

        $expected = <<<LOG
        {"email":"john.doe@example.com","firstName":"John","lastName":"Doe"}\n
        LOG;
        $this->assertStringContainsString($expected, file_get_contents($this->logfile));
    }
}
