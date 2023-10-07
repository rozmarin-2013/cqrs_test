<?php

namespace App\Core\User\Application\EventListener;

use App\Core\Invoice\Domain\Event\InvoiceCreatedEvent;
use App\Core\Invoice\Domain\Notification\NotificationInterface;
use App\Core\User\Domain\Event\UserCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SendEmailUserCreatedSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly NotificationInterface $mailer)
    {
    }

    public function send(InvoiceCreatedEvent $event): void
    {
        $this->mailer->sendEmail(
            $event->invoice->getUser()->getEmail(),
            'Utworzono konto',
            'Zarejestrowano konto w systemie. Aktywacja konta trwa do 24h"'
        );
    }

    public static function getSubscribedEvents(): array
    {
        return [
            UserCreatedEvent::class => 'send'
        ];
    }
}
