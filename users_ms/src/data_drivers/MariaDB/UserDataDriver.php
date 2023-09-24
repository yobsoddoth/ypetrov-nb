<?php

namespace DataDrivers\MariaDB;

use DB;
use Domain\Interfaces\UserDataDriverInterface;
use Domain\Interfaces\UserInterface;

class UserDataDriver implements UserDataDriverInterface
{
    public function save(UserInterface $user): void
    {
        $userData = $this->serialize($user);
        DB::table('users')->insert($userData);
    }

    /**
     * Format the data in User class into db-friendly format,
     * i.e. underscore, instead of cammelCase
     */
    private function serialize(UserInterface $user): array
    {
        return [
            'email' => $user->email,
            'first_name' => $user->firstName,
            'last_name' => $user->lastName,
        ];
    }
}
