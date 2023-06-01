<?php

namespace App\DataFixtures;

use App\Entity\Program;
use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();
        for ($i=1; $i <= 5; $i++) { 

            $program = new Program();
            $season = new Season();
            $season->setNumber($i);
            $season->setProgram($this->getReference('program_aut'));
            $season->setYear($faker->numberBetween(19,20) . $faker->numberBetween(23,99));
            $season->setDescription($faker->paragraph(5));
            $this->addReference('Season_' . $i, $season);
            $manager->persist($season);

        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
