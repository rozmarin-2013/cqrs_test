<?php

namespace App\Core\User\Query\GetUserByActive;

use App\Core\User\Application\DTO\UserDto;
use App\Core\User\Domain\Repository\UserRepositoryInterface;
use App\Core\User\Domain\User;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetUsersByActiveHandler
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function __invoke(GetUserByActiveQuery $query): array
    {
        $users =  $this->userRepository->getUserByActive(1);

        return array_map(function (User $user) {
            return new UserDto(
                $user->getId(),
                $user->getEmail(),
                $user->isActive()
            );
        }, $users);
    }
}
