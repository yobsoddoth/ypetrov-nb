<?php

namespace Domain;

use Domain\Interfaces\NotificationInterface;

class Notification implements NotificationInterface
{
    private float $createdTs;

    public function __construct(
        public readonly array $data
    ) {
        $this->createdTs = microtime(true);
    }

    public function jsonSerialize(): mixed
    {
        return $this->data;
    }

    public function getCreatedTs(): float
    {
        return $this->createdTs;
    }
}
