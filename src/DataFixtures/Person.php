<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class Person extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('ar_SA');

        for ($i=0 ; $i<10 ; $i++) {
            $person = new \App\Entity\Person();
            $person->setAge($faker->numberBetween($min = 18, $max = 60));
            $person->setName($faker->name());
            $manager->persist($person);
        }

        $manager->flush();
    }
}
