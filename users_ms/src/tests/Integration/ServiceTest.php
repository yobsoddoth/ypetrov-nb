<?php

namespace Tests\Integration;

use Tests\TestCase;
use Domain\Interfaces\UserServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_stores_given_data_into_db(): void
    {
        $service = app()->make(UserServiceInterface::class);
        $service->storeUser([
            'email' => 'jane.doe@example.com',
            'firstName' => 'Jane',
            'lastName' => 'Doe',
        ]);

        $this->assertDatabaseHas(
            'users',
            [
                'email' => 'jane.doe@example.com',
                'first_name' => 'Jane',
                'last_name' => 'Doe',
            ]
        );
    }
}