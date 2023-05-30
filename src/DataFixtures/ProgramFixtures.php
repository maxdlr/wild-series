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
        'category_Aventure',
        'category_Fantastique',
        'category_Horreur',
        'category_Comedie',
        'category_Art Martiaux'
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i < 60; $i++)
        {
            $program = new Program();
            $program->setTitle($faker->word());
            $program->setSynopsis($faker->sentence());
            $program->setCategory($this->getReference(self::$categories[$faker->numberBetween(0,5)]));
            $program->setPoster($faker->imageUrl(300,300,$program->getTitle(), true));
            $this->addReference('program_' . $program->getTitle(), $program);
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
