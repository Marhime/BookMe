<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $factory = new Faker\Factory();
        $faker = $factory::create('fr_FR');

        // $product = new Product();
        // $manager->persist($product);
        for ($i = 0; $i < 100; $i++){
            $user = new User();
            $user->setName('user'.$i);
            $user->setLastname($faker->lastName);
            $user->setCompany($faker->company);
            $user->setPassword(password_hash('user'.$i, PASSWORD_DEFAULT));
            $user->setEmail($faker->email);
            $user->setPhone('118218');
            $user->setRoles('ROLE_EXPO');
            
            $this->addReference('user'.$i, $user);
            
            $manager->persist($user);
        }
        
        $admin = new User();
        $admin->setName('admin');
        $admin->setLastname('admin');
        $admin->setCompany('admincompany');
        $admin->setPassword(password_hash('admin', PASSWORD_DEFAULT));
        $admin->setEmail('admin@email.com');
        $admin->setPhone('118218');
        $admin->setRoles('ROLE_EXPO');
        $manager->persist($admin);


        $manager->flush();
    }
}
