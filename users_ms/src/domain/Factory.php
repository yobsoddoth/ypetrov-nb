<?php

namespace Domain;

class Factory
{
    private static array $bindmap = [];

    public static function register(string $interface, \Closure $callback): void
    {
        self::$bindmap[$interface] = $callback;
    }

    public static function make(string $interface, array $data = []): mixed
    {
        return self::$bindmap[$interface]($data);
    }
}
