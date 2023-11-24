<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Entity\Utilisateur;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Event\CheckPassportEvent;

class CheckVerifiedUserSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            CheckPassportEvent::class => ['onCheckPassport', -10],
        ];
    }

    /**
     * @throws \Exception
     */
    public function onCheckPassport(CheckPassportEvent $event): void
    {
        $passport = $event->getPassport();
        /** @var Utilisateur $utilisateur */
        $utilisateur = $passport->getUser();
        dump($utilisateur);
        if (!$utilisateur instanceof Utilisateur) {
            throw new \Exception('User not found');
        }

        //        if (!$utilisateur->isVerified()) {
        //            throw new AuthenticationException();
        //        }
    }
}
