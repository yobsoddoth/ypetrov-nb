<?php

namespace Domain\Interfaces;

interface UserServiceInterface
{
    public function storeUser(array $userData): void;
}