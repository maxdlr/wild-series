<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    static array $seasons = [
        'Season_1',
        'Season_2',
        'Season_3',
        'Season_4',
        'Season_5',
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i=1; $i <= 60; $i++) { 
            
            $episode = new Episode();
            $episode->setTitle($faker->word());
            $episode->setSynopsis($faker->paragraph(10));
            for ($x=1; $x <= 5; $x++) { 
                $episode->setNumber($x);
            }
            $episode->setSeason($this->getReference(self::$seasons[$faker->numberBetween(0,4)]));
    
            $manager->persist($episode);
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
