<?php

namespace Domain;

use Domain\Notification;
use Domain\LogEntryFormatter;
use DataDrivers\NotificationDataDriver;
use Domain\Interfaces\NotificationInterface;
use Domain\Interfaces\NotificationDataDriverInterface;

/**
 * Binding abstractions to specific implementations.
 * ./domain/_bootstrap.php must be called before making calls to
 * any other domain functionality.
 */

Factory::register(
    NotificationInterface::class,
    fn (array $data) => new Notification($data)
);

Factory::register(
    NotificationDataDriverInterface::class,
    function () {
        if (env('APP_ENV', 'local') == 'production') {
            $logfile = dirname(__DIR__) . '/storage/logs/notifications.log';
        } else {
            $logfile = dirname(__DIR__) . '/tests/_output/notifications.log';
        }

        return new NotificationDataDriver($logfile, new LogEntryFormatter());
    }
);
