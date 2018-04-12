<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 0; $i < 20; $i++){
            $user = new User();
            $user->setName('name'.$i);
            $user->setLastname('lastname'.$i);
            $user->setCompany('company'.$i);
            $user->setPassword(password_hash('user'.$i, PASSWORD_DEFAULT));
            $user->setEmail(($user->getName()).'@yahoo.fr');
            $user->setPhone('118218');
            $user->setRole('ROLE_EXPO');
            $manager->persist($user);
        }
        $admin = new User();
        $admin->setName('admin');
        $admin->setLastname('admin');
        $admin->setCompany('admincompany');
        $admin->setPassword(password_hash('admin', PASSWORD_DEFAULT));
        $admin->setEmail('admin@email.com');
        $admin->setPhone('118218');
        $admin->setRole('ROLE_EXPO');
        $manager->persist($admin);


        $manager->flush();
    }
}
