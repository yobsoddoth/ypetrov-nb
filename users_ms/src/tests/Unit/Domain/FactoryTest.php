<?php

namespace Tests\Unit\Domain;

use Domain\User;
use Domain\Factory;
use PHPUnit\Framework\TestCase;
use Domain\Interfaces\UserInterface;
use DataDrivers\MariaDB\UserDataDriver;
use Domain\Interfaces\UserDataDriverInterface;

require env('DOMAIN_CLASSES_DIR') . '/_bootstrap.php';

class FactoryTest extends TestCase
{
    public function test_makes_user_instance_when_prompted_interface(): void
    {
        $userData = [
            'email' => 'john.doe@exmple.com',
            'firstName' => 'John',
            'lastName' => 'Doe',
        ];
        $user = Factory::make(UserInterface::class, $userData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($userData, (array) $user);
    }

    public function test_makes_user_data_driver_instance_when_prompted_interface(): void
    {
        $driver = Factory::make(UserDataDriverInterface::class);
        $this->assertInstanceOf(UserDataDriver::class, $driver);
    }

    public function test_can_register_binding_closure(): void
    {
        Factory::register('DummyBind', fn (array $data) => 'dummy with ' . $data['prop']);
        $this->assertEquals(
            'dummy with value',
            Factory::make('DummyBind', ['prop' => 'value'])
        );
    }
}