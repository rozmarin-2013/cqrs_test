<?php

namespace App\Core\User\Domain\Repository;

use App\Core\User\Domain\Exception\UserNotFoundException;
use App\Core\User\Domain\User;


interface UserRepositoryInterface
{
    /**
     * @throws UserNotFoundException
     */
    public function getByEmail(string $email): User;

    public function getUserByActive(int $isActive): array;

    public function flush(): void;
}
