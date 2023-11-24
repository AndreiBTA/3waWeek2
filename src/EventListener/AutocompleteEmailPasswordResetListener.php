<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

#[AsEventListener(event: FormEvents::PRE_SET_DATA, method: 'onPreSetData')]
class AutocompleteEmailPasswordResetListener
{
    public function onPreSetData(FormEvent $event): void
    {
        $form = $event->getForm();
        $data = $event->getData();
        dump($form, $data);
    }
}
