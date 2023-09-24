<?php

namespace Tests\Unit\Domain;

use Domain\User;
use PHPUnit\Framework\TestCase;
use Domain\Interfaces\UserInterface;

class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        $this->user = new User(
            email: 'john.doe@example.com',
            firstName: 'John',
            lastName: 'Doe'
        );
    }

    public function test_implements_user_interface(): void
    {
        $this->assertInstanceOf(UserInterface::class, $this->user);
    }

    public function test_user_is_json_serializable(): void
    {
        $expected = json_encode([
            'email' => 'john.doe@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe'
        ]);
        $this->assertJsonStringEqualsJsonString($expected, json_encode($this->user));
    }

    public function test_user_is_array_serializeble(): void
    {
        $expected = [
            'email' => 'john.doe@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe'
        ];
        $this->assertEquals($expected, (array) $this->user);
    }
}
