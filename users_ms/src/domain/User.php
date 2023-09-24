<?php

namespace Domain;

use Domain\Interfaces\UserInterface;

class User implements UserInterface
{
    public function __construct(
        public readonly string $email,
        public readonly string $firstName,
        public readonly string $lastName
    ) {}
}