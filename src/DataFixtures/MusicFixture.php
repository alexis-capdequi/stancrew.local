<?php

namespace App\DataFixtures;

use App\Entity\Music;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class MusicFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 15; $i++) {
            $music = new Music();
            $music
                ->setUniqid(uniqid())
                ->setTitle($faker->sentence($nbWords = 6, $variableNbWords = true))
                ->setMp3FileName('test.mp3')
                ->setOggFileName('test.ogg')
                ->setPublicationDate($faker->dateTime($max = 'now', $timezone = null))
                ->setUpdatedAt($faker->dateTime($max = 'now', $timezone = null));
            $manager->persist($music);
        }

        $manager->flush();
    }
}
