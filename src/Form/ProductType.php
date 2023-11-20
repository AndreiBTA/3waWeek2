<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Distributeur;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Product name',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Product price',
            ])
            ->add('reference', ReferenceType::class, [
                'label' => 'Product reference',
            ])
            ->add('category', EntityType::class, [
                'label' => 'Product category',
                'placeholder' => 'Select a category',
                'class' => Category::class,
                'choice_label' => 'name',
            ])
            ->add('distributeurs', EntityType::class, [
                'label' => 'Product distributers',
                'class' => Distributeur::class,
                'multiple' => true,
                'choice_label' => 'name',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit form',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
