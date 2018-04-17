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
        $event->setName($faker->company);
        $event->setOwner($this->getReference('user' . rand(0, 99)));
        $event->setPlace($faker->city);
        $event->setOpeningDate($faker->dateTimeThisDecade);
        $event->setClosingDate($faker->dateTimeThisDecade);
        $event->setPhone('0699999999');
        $event->setTheme($faker->colorName);
        $event->setWebsite($faker->url);
        $event->setDescription($faker->text($maxNbChars = 120));
        
        $manager->persist($event);
    }
        $manager->flush();
    }

    
    public function getDependencies(): array{
    return[
    UserFixture::class,
    ];}

}
