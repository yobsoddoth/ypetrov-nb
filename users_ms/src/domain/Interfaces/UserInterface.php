<?php

namespace Domain\Interfaces;

/**
 * The \Domain\User class is only a data class and doesn't have additional
 * functionality. The interface is needed as part of the Dependency Inversion pattern,
 * implemented by \Domain\Factory.
 */
interface UserInterface
{
}
