<?php

namespace Domain\Interfaces;

interface NotificationServiceInterface
{
    public function log(array $data): void;
}