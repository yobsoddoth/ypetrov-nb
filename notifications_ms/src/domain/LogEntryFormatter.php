<?php

namespace Domain;

use Domain\Interfaces\NotificationInterface;
use Domain\Interfaces\NotificationDataFormatterInterface;

class LogEntryFormatter implements NotificationDataFormatterInterface
{
    public function format(NotificationInterface $notification): mixed
    {
        $lines[] = 'ENTRY: ' . date('Y-m-d H:i:s');
        $lines[] = 'json: ' . json_encode($notification);
        $lines[] = 'created_ts: ' . $notification->getCreatedTs();
        $lines[] = 'END ENTRY';

        return implode(PHP_EOL, $lines) . PHP_EOL;
    }
}