<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $factory = new Faker\Factory();
        $faker = $factory::create('fr_FR');

        // $product = new Product();
        // $manager->persist($product);
        for ($i = 0; $i < 20; $i++){
            $product = new Product();
            $product->setEvent($this->getReference('event' . rand(0, 99)));
            $product->setDescription($faker->paragraph);
            $product->setPrice($faker->numberBetween(1000, 15000));

            $product->setType($faker->randomElement(array('Emplacement Standard','Emplacement premium','Popup','Stand entrée event')));
            
            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            EventFixture::class
        ];
    }
}
