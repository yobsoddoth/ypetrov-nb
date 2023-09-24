<?php

namespace Tests\Unit\DataDrivers;

use Domain\Notification;
use PHPUnit\Framework\TestCase;
use DataDrivers\NotificationDataDriver;
use Domain\Interfaces\NotificationInterface;
use Domain\Interfaces\NotificationDataFormatterInterface;

class NotificationDataDriverTest extends TestCase
{
    private NotificationDataDriver $driver;
    private string $logfile;

    protected function setUp(): void
    {
        $this->logfile = dirname(dirname(__DIR__)) . '/_output/notifications_utest.log';

        $formatter = new class implements NotificationDataFormatterInterface {
            public function format(NotificationInterface $notification): mixed
            {
                return json_encode($notification) . PHP_EOL;
            }
        };

        $this->driver = new NotificationDataDriver($this->logfile, $formatter);
    }

    protected function tearDown(): void
    {
        if (file_exists($this->logfile)) {
            unlink($this->logfile);
        }
    }

    public function test_saves_notification_to_logfile(): void
    {
        $notification = new Notification(['a', 'b', 'c']);
        $this->driver->save($notification);

        $expected = <<<LOG
        ["a","b","c"]\n
        LOG;
        $this->assertEquals($expected, file_get_contents($this->logfile));
    }

    public function test_appends_new_entries_to_exising_logfile(): void
    {
        $notification1 = new Notification(['a', 'b', 'c']);
        $notification2 = new Notification(['e', 'f', 'g']);
        $this->driver->save($notification1);
        $this->driver->save($notification2);

        $expected = <<<LOG
        ["a","b","c"]
        ["e","f","g"]\n
        LOG;
        $this->assertEquals($expected, file_get_contents($this->logfile));
    }
}
