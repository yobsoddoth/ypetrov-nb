<?php

namespace Domain\Interfaces;

interface NotificationInterface extends \JsonSerializable
{
    public function getCreatedTs(): float;
}
