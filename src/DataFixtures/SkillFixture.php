<?php

namespace App\DataFixtures;

use App\Entity\Skill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SkillFixture extends Fixture
{
    const SKILLS = 'skills';
    public function load(ObjectManager $manager): void
    {
        $skills = [
            ["name" => "HTML/CSS", "type" => "Technique", "level" => "Avancé"],
            ["name" => "JavaScript", "type" => "Technique", "level" => "Intermédiaire"],
            ["name" => "PHP", "type" => "Technique", "level" => "Avancé"],
            ["name" => "SQL/MySQL", "type" => "Technique", "level" => "Intermédiaire"],
            ["name" => "Git & GitHub", "type" => "Technique", "level" => "Avancé"],
            ["name" => "Communication orale", "type" => "Soft Skill", "level" => "Avancé"],
            ["name" => "Travail en équipe", "type" => "Soft Skill", "level" => "Avancé"],
            ["name" => "Résolution de problèmes", "type" => "Soft Skill", "level" => "Intermédiaire"],
            ["name" => "Gestion du temps", "type" => "Soft Skill", "level" => "Intermédiaire"],
            ["name" => "Anglais professionnel", "type" => "Langue", "level" => "Avancé"],
            ["name" => "Français", "type" => "Langue", "level" => "Langue maternelle"],
            ["name" => "Espagnol", "type" => "Langue", "level" => "Débutant"],
            ["name" => "Leadership", "type" => "Soft Skill", "level" => "Intermédiaire"],
            ["name" => "Python", "type" => "Technique", "level" => "Débutant"],
            ["name" => "Gestion de projet", "type" => "Gestion", "level" => "Intermédiaire"],
            ["name" => "Scrum / Agile", "type" => "Gestion", "level" => "Intermédiaire"],
            ["name" => "Empathie", "type" => "Soft Skill", "level" => "Avancé"],
            ["name" => "WordPress", "type" => "Technique", "level" => "Intermédiaire"],
            ["name" => "Créativité", "type" => "Soft Skill", "level" => "Avancé"],
            ["name" => "Conception UI/UX", "type" => "Technique", "level" => "Débutant"]
        ];

        foreach ($skills as $skillElement) {
            $skill = new Skill();
            $skill->setDesignation($skillElement["name"]);
            $manager->persist($skill);
        }
        $manager->flush();
    }
}
