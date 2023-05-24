<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    static array $categories = [
        'category_Action',
        'category_Horreur',
        'category_Comedie',
        'category_Fantastique',
        'category_Aventure',
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i < 5; $i++)
        {
            $program = new Program();
            $program->setTitle($faker->word());
            $program->setSynopsis($faker->sentence());
            $program->setCategory($this->getReference(self::$categories[$i]));
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
