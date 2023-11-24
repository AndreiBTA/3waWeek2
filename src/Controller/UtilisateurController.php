<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\ResetPasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function changePassword(Request $request): Response
    {
        $utilisateur = $this->getUser();

        $form = $this->createForm(ResetPasswordType::class, $utilisateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dump($form, $utilisateur);
        }

        return $this->render('utilisateur/change_password.html.twig', [
            'form' => $form,
        ]);
    }
}
