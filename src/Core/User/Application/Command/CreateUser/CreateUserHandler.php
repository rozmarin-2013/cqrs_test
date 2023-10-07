<?php

namespace App\Core\User\Application\Command\CreateUser;

use App\Core\Invoice\Application\Command\CreateInvoice\CreateUserCommand;
use App\Core\Invoice\Domain\Repository\InvoiceRepositoryInterface;
use App\Core\User\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateInvoiceHandler
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function __invoke(CreateUserCommand $command): void
    {
        $this->invoiceRepository->save(new Invoice(
            $this->userRepository->getByEmail($command->email),
            $command->amount
        ));

        $this->invoiceRepository->flush();
    }
}
