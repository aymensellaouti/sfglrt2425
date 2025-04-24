<?php

namespace App\DataFixtures;

use App\Entity\Person;
use App\Entity\Skill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PersonFixtures extends Fixture  implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $fakerAr = Factory::create('ar_SA');
        $fakerFr = Factory::create('fr_FR');
        $skills = $manager->getRepository(Skill::class)->findAll();
        //$this->getReference(SkillFixture::SKILLS, SkillFixture::class)->skills;
        for ($i=0 ; $i<10 ; $i++) {
            $faker = $i%2 ? $fakerAr : $fakerFr;
            $person = new Person();
            shuffle($skills);
            for ($j=0 ; $j< 3 ; $j++) {
                $person->addSkill($skills[$j]);
            }
            $person->setAge($faker->numberBetween($min = 18, $max = 60));
            $person->setName($faker->name());
            $manager->persist($person);
        }

        $manager->flush();
    }

    public function getDependencies(): array {
        return [SkillFixture::class];
    }
}
