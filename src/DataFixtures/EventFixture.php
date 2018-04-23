<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;


class EventFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $factory = new Factory();
        $faker = $factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            $event = new Event();
            $event->setName('Festival' . $i);
            $event->setOwner($this->getReference('user' . rand(0, 99)));
            $event->setPlace($faker->city);
            $event->setOpeningDate($faker->dateTimeThisDecade);
            $event->setClosingDate($faker->dateTimeThisDecade);
            $event->setPhone('0699999999');
            $event->setTheme($faker->colorName);
            $event->setDescription($faker->text($maxNbChars = 120));
            $event->setImage('img/festival_' . rand(1, 4) . '.jpg');
            $event->setWebsite($faker->url);
//        $event->setDescription($faker->paragraph);

            for ($j = 0; $j < 3; $j++) {
                echo 'product' . rand((100 * $j), (100 * ($j + 1)) - 1);
                $product = $this->getReference('product' . rand((100 * $j), (100 * ($j + 1)) - 1));
                $event->getProducts()->add($product);
                $product->setEvent($event);
            }

            $manager->persist($event);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixture::class,
            ProductFixtures::class
        ];
    }
}
