<?php

namespace App\DataFixtures;

use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class VideoFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $video = new Video();
            $video
                ->setUniqid(uniqid())
                ->setTitle($faker->sentence($nbWords = 6, $variableNbWords = true))
                ->setLink('https://www.youtube.com/embed/azbLRQ1EJD0')
                ->setPublicationDate($faker->dateTime($max = 'now', $timezone = null))
                ->setDescription($faker->text($maxNbChars = 400))
                ->setType($faker->randomElement($array = array ('preview','clip','concert')))
                ->setImageName('test.jpg')
                ->setUpdatedAt($faker->dateTime($max = 'now', $timezone = null));
            $manager->persist($video);
        }

        $manager->flush();
    }
}
