<?php

namespace Domain\Interfaces;

interface NotificationDataDriverInterface
{
    public function save(NotificationInterface $notification): void;
}
