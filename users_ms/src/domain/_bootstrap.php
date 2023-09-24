<?php

namespace Domain;

use Domain\Interfaces\UserInterface;
use DataDrivers\MariaDB\UserDataDriver;
use Domain\Interfaces\UserDataDriverInterface;

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