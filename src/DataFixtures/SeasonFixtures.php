<?php

namespace App\DataFixtures;

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
        for ($i=1; $i <= 60; $i++) { 

            $season = new Season();
            
            for ($y=1; $y <= 5; $y++) { 
                $season->setProgram($this->getReference('program_' . 'Program-title_' . $i));
                $season->setNumber($i.$y);
                $this->addReference('season_' . $i . $y, $season);
                $season->setYear($faker->numberBetween(1995,2023));
                $season->setDescription($faker->paragraph(5));
                $manager->persist($season);
            }


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
