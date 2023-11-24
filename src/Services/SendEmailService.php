<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Utilisateur;
use App\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

class SendEmailService
{
    public function __construct(
        private readonly MailerInterface $mailerInterface,
        private readonly EmailVerifier $emailVerifier
    ) {}

    public function sendEmail(
        string $emailVerifier,
        Utilisateur $user,
        string $from,
        string $to,
        string $subject,
        string $template,
        array $context = []): void
    {
        $email = (new TemplatedEmail())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->htmlTemplate("registration/$template.html.twig")
            ->context($context);
        try {
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user, $email);
        } catch (TransportExceptionInterface $exception) {
            // Log or handle the exception
            dump($exception);
        }
    }
}
