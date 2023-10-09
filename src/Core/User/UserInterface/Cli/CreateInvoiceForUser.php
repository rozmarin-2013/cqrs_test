<?php

namespace App\Core\User\UserInterface\Cli;

use App\Core\Invoice\Application\Command\CreateInvoice\CreateInvoiceCommand;
use App\Core\User\Query\GetUserByActive\GetUserByActiveQuery;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'app:user:create:invoice',
    description: 'Tworzenie invoiców dla użytkowników'
)]
class CreateInvoiceForUser extends Command
{
    use HandleTrait;

    public function __construct(
        private MessageBusInterface $messageBus
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $users = $this->handle(new GetUserByActiveQuery());

        foreach ($users as $user) {
            $this->messageBus->dispatch(new CreateInvoiceCommand(
                $user->email,
                1000
            ));
        }

        return Command::SUCCESS;
    }
}
