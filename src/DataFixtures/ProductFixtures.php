<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
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
        for ($i = 0; $i < 300; $i++){
            $product = new Product();
            $product->setDescription($faker->paragraph(2));
            $product->setPrice($faker->numberBetween(200, 1000));
            $product->setType($faker->randomElement(array('Emplacement Standard','Emplacement Premium','Emplacement Popup')));
            $manager->persist($product);
            $this->addReference("product". $i, $product);
        }

        $manager->flush();
    }


}
