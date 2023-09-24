<?php

namespace Domain\Interfaces;

interface NotificationDataFormatterInterface
{
    public function format(NotificationInterface $notification): mixed;
}