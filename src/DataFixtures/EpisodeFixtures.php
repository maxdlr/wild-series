<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i=1; $i <= 60; $i++) { 
            
            $episode = new Episode();
            for ($x=1; $x <= 5; $x++) {
                $episode->setTitle($faker->word());
                $episode->setSynopsis($faker->paragraph(10));
                $episode->setNumber($i.$x);
                $episode->setSeason($this->getReference('season_' . $i . $x));
                $manager->persist($episode);
            }
    
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }
}
