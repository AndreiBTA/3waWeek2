<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Utilisateur;
use App\EventListener\AutocompleteEmailPasswordResetListener;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResetPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, [
                new AutocompleteEmailPasswordResetListener(), 'onPreSetData',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Your email',
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Your password',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
