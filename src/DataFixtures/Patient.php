<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Patient extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
for($i = 0 ; $i<10 ; $i++){
$day = rand(1,31);
$month = rand(1,12);
        $patient = new \App\Entity\Patient();
        $patient->setProfession('Patient 1'.$i);
        $patient->setStatusPatient('status 1'.$i);
        $patient->setFamilyHistory('family_history'.$i);
        $patient->setCreeEn(new \DateTime("2022-$month-$day"));
        $patient->setMiseAJourA(new \DateTime("2022-$month-$day"));
        $manager->persist($patient);
}
        $manager->flush();
    }
}
