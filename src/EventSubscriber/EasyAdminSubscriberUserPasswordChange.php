<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EasyAdminSubscriberUserPasswordChange implements EventSubscriberInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {}

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['addUtilisateur'],
            BeforeEntityUpdatedEvent::class => ['updateUtilisateur'],
        ];
    }

    public function addUtilisateur(BeforeEntityPersistedEvent $event): void
    {
        $utilisateur = $event->getEntityInstance();
        if (!($utilisateur instanceof Utilisateur)) {
            return;
        }
        $this->setPassword($utilisateur);
    }

    public function updateUtilisateur(BeforeEntityUpdatedEvent $event): void
    {
        $utilisateur = $event->getEntityInstance();
        if (!($utilisateur instanceof Utilisateur)) {
            return;
        }
        $this->setPassword($utilisateur);
    }

    private function setPassword(Utilisateur $utilisateur): void
    {
        $password = $utilisateur->getPassword();

        $utilisateur->setPassword(
            $this->passwordHasher->hashPassword($utilisateur, $password)
        );
        $this->entityManager->persist($utilisateur);
        $this->entityManager->flush();
    }
}
