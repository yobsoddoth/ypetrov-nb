<?php

namespace Tests\Unit\Domain;

use Domain\Interfaces\NotificationInterface;
use Domain\Notification;
use PHPUnit\Framework\TestCase;

class NotificationTest extends TestCase
{
    private Notification $notification;

    protected function setUp(): void
    {
        $this->notification = new Notification([
            'email' => 'john.doe@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe'
        ]);
    }

    public function test_implements_notification_interface(): void
    {
        $this->assertInstanceOf(NotificationInterface::class, $this->notification);
    }

    public function test_notification_is_json_serializable(): void
    {
        $expected = json_encode([
            'email' => 'john.doe@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe'
        ]);
        $this->assertJsonStringEqualsJsonString($expected, json_encode($this->notification));
    }
}
