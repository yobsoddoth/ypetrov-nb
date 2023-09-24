<?php

namespace Domain\Interfaces;

interface UserDataDriverInterface
{
    public function save(UserInterface $user): void;
}