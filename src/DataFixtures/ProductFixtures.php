<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $factory = new Faker\Factory();
        $faker = $factory::create('fr_FR');

        // $product = new Product();
        // $manager->persist($product);
        for ($i = 0; $i < 20; $i++){
            $product = new Product();
            $product->setDescription($faker->paragraph);
            $product->setPrice($faker->numberBetween(1000, 15000));
            $product->setQuantity($faker->numberBetween(1, 20));
            $product->setType($faker->randomElement(array('Emplacement Standard','Emplacement premium','Popup','Stand entrée event')));
            $product->setIdEvent($i);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
