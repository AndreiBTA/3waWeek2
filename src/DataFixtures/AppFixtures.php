<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Category;
use App\Entity\Distributeur;
use App\Entity\Product;
use App\Entity\Reference;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //composer require --dev orm-fixtures

        //composer require fakerphp/faker
        //symfony console doctrine:fixtures:load --no-interaction
        //Les erreurs de Faker => Lorem.php => vendor/fzaninotto/faker/src/Faker/Provider/Lorem.php
        $faker = Faker\Factory::create('fr_FR');
        //4 tableaux de données

        $products = [];
        $categories = [];
        $distributeurs = [];
        $references = [];


        for($i = 0; $i < 30; $i++){
            $reference = new Reference();
            $reference->setName('REF_' . mt_rand(1,9999));
            $references[] = $reference;
            $manager->persist($reference);
        }

        for($i = 0; $i < 30; $i++){
            $category = new Category();
            $category->setName($faker->word);
            $categories[] = $category;
            $manager->persist($category);
        }

        for($i = 0; $i < 30; $i++){
            $distributeur = new Distributeur();
            $distributeur->setName($faker->word);
            $distributeurs[] = $distributeur;
            $manager->persist($distributeur);
        }

        for($i = 0; $i < 30; $i++){

            $product = new Product();
            $product->setName($faker->word);
            $product->setDescription($faker->text($maxNbChars = 200));
//            $produit->setImage('https://picsum.photos/200');
            $product->setPrice(mt_rand(1, 2000));
//            $product->setSlug($product->getName());



            for($c = 0; $c < count($categories); $c++){
                $product->setCategory($faker->randomElement($categories));
            }

            for($d = 0; $d < count($distributeurs); $d++){
                $product->addDistributeur($faker->randomElement($distributeurs));
            }

            for($r = 0; $r < count($references); $r++){
                $product->setReference($references[$i]);
            }

            $products[] = $product;
            $manager->persist($product);

        }

        $manager->flush();
    }
}
