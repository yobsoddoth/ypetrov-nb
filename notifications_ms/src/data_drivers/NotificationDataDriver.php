<?php

namespace DataDrivers;

use Domain\Interfaces\NotificationInterface;
use Domain\Interfaces\NotificationDataDriverInterface;
use Domain\Interfaces\NotificationDataFormatterInterface;

class NotificationDataDriver implements NotificationDataDriverInterface
{
    public function __construct(
        private string $filepath,
        private NotificationDataFormatterInterface $formatter
    ) {
    }

    public function save(NotificationInterface $notification): void
    {
        file_put_contents(
            $this->filepath,
            $this->formatter->format($notification),
            FILE_APPEND
        );
    }
}
