<?php

namespace Domain;

use Domain\Interfaces\NotificationServiceInterface;
use Domain\Interfaces\NotificationInterface;
use Domain\Interfaces\NotificationDataDriverInterface;

class Service implements NotificationServiceInterface
{
    public function log(array $data): void
    {
        $notification = Factory::make(NotificationInterface::class, $data);
        $dataDriver = Factory::make(NotificationDataDriverInterface::class);

        $dataDriver->save($notification);
    }
}
