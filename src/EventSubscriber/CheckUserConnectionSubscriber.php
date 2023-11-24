<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Entity\Utilisateur;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;

class CheckUserConnectionSubscriber implements EventSubscriberInterface
{
    public function __construct(private LoggerInterface $logger) {}

    public function onSecurityAuthentificationSuccess(AuthenticationSuccessEvent $event): void
    {
        $this->logger->info('test de connection = OK');
        $token = $event->getAuthenticationToken();
        /** @var Utilisateur $user */
        $user = $token->getUser();
        $email = $user->getEmail();
        if (!$user->isVerified()) {
            // give him 24 hours to validate the account
        }
        // wait for the account to be validated

        dump($token, $user, $email);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            //            LoginSuccessEvent::class => 'onCheckUserConnection',
            'security.authentication.success' => 'onSecurityAuthentificationSuccess',
        ];
    }

    public function onCheckUserConnection(LoginSuccessEvent $event): void
    {
        dd($event);
    }
}
