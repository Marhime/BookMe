<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EventFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 100; $i++) {
        $event = new Event();
        $event->setName('name'.$i);
        $event->setIdUser($i);
        $event->setPlace('place'.$i);
        $event->setOpeningDate(new \DateTime);
        $event->setClosingDate(new \DateTime);
        $event->setPhone($i);
        $event->setTheme('theme'.$i);
        $event->setWebsite('coucou.'.$i.'com');
        
        $manager->persist($event);
    }
        $manager->flush();
    }
}
