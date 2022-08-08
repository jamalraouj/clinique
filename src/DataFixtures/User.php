<?php

namespace App\DataFixtures;
use App\Entity\Patient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class User extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for($i = 0 ; $i<100 ; $i++){
            $day = rand(1,31);
            $id = rand(1,100);
            $month = rand(1,12);
            $user = new \App\Entity\User();
            $user->setNom('username'.$i);
            $user->setPrenom('username'.$i);
            $user->setAge(rand(1,100));
            $user->setTelephone(rand(1,100));
            $user->setCin(rand(1,100));
            $user->setAddress('address'.$i);
            $user->setEmail('email'.$i);
            $user->setPassword('password'.$i);
            $user->setDerniereConexion(new \DateTime("2022-$month-$day"));
            $user->setUserRole('user_role'.$i);
            $user->setMiseAJourA(new \DateTime("2022-$month-$day"));
            $user->setJoindreA(new \DateTime("2022-$month-$day"));
            $manager->persist($user);
        }
        $manager->flush();

       
    }
}
