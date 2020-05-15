<?php

namespace App\DataFixtures;

use App\Entity\Concert;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ConcertFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 15; $i++) {
            $concert = new Concert();
            $concert
                ->setTitle($faker->sentence($nbWords = 6, $variableNbWords = true))
                ->setDatetime($faker->dateTime($max = 'now', $timezone = null))
                ->setAddress($faker->streetAddress)
                ->setCity($faker->city)
                ->setPostalCode($faker->postcode)
                ->setReservationLink($faker->url)
                ->setComment($faker->text($maxNbChars = 400));
            $manager->persist($concert);
        }

        $manager->flush();
    }
}
