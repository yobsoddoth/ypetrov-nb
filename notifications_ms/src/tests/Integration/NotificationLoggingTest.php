<?php

namespace Tests\Integration;

use Tests\TestCase;
use Domain\Interfaces\NotificationServiceInterface;

class NotificationLoggingTest extends TestCase
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

    public function test_notification_service_logs_notification(): void
    {
        $data = [
            'email' => 'john.doe@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe',
        ];

        $service = $this->app->make(NotificationServiceInterface::class);
        $service->log($data);

        $expected = <<<LOG
        {"email":"john.doe@example.com","firstName":"John","lastName":"Doe"}\n
        LOG;
        $this->assertStringContainsString($expected, file_get_contents($this->logfile));
    }
}
