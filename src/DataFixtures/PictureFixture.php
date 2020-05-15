<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PictureFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $picture = new Picture();
            $picture
                ->setUniqid(uniqid())
                ->setImageName('test.jpg')
                ->setPublicationDate($faker->dateTime($max = 'now', $timezone = null))
                ->setComment($faker->text($maxNbChars = 400))
                ->setUpdatedAt($faker->dateTime($max = 'now', $timezone = null));
            $manager->persist($picture);
        }

        $manager->flush();
    }
}
