<?php

namespace Domain;

use Domain\Interfaces\UserInterface;
use Domain\Interfaces\UserServiceInterface;
use Domain\Interfaces\UserDataDriverInterface;

class Service implements UserServiceInterface
{
    public function storeUser(array $userData): void
    {
        $user = Factory::make(UserInterface::class, $userData);
        $dataDriver = Factory::make(UserDataDriverInterface::class);

        $dataDriver->save($user);
    }
}