<?php

namespace Tests\Integration\DataDrivers\MariaDB;

use DataDrivers\MariaDB\UserDataDriver;
use Domain\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserDataDriverTest extends TestCase
{
    use RefreshDatabase;

    public function test_inserts_new_user_into_MariaDB(): void
    {
        $driver = new UserDataDriver();
        $user = new User('john.doe@example.com', 'John', 'Doe');

        $driver->save($user);

        $this->assertDatabaseHas(
            'users',
            [
                'email' => 'john.doe@example.com',
                'first_name' => 'John',
                'last_name' => 'Doe',
            ]
        );
    }
}