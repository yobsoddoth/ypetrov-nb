<?php

namespace Domain;

use Domain\Interfaces\UserInterface;
use DataDrivers\MariaDB\UserDataDriver;
use Domain\Interfaces\UserDataDriverInterface;

/**
 * Binding abstractions to specific implementations.
 * ./domain/_bootstrap.php must be called before making calls to
 * any other domain functionality.
 */

Factory::register(
    UserInterface::class,
    fn (array $data) => new User(
        email: $data['email'],
        firstName: $data['firstName'],
        lastName: $data['lastName'],
    )
);

Factory::register(
    UserDataDriverInterface::class,
    fn () => new UserDataDriver()
);
