<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;



class EventFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $factory = new Faker\Factory();
        $faker = $factory::create('fr_FR');
        
        for ($i = 0; $i < 100; $i++) {
        $event = new Event();
        $event->setName($faker->company);
        $event->setIdUser($faker->biasedNumberBetween($min = 10, $max = 100));
        $event->setPlace($faker->city);
        $event->setOpeningDate($faker->dateTimeThisDecade);
        $event->setClosingDate($faker->dateTimeThisDecade);
        $event->setPhone('0699999999');
        $event->setTheme($faker->colorName);
        $event->setWebsite($faker->url);
        
        $manager->persist($event);
    }
        $manager->flush();
    }

    public function getDependencies(): array {

    }
}
