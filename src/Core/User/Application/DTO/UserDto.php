<?php

namespace App\Core\User\Application\DTO;

class UserDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $email,
        public readonly bool $isActive
    ) {}
}