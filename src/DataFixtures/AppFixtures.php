<?php

namespace App\DataFixtures;

use App\Entity\Country;
use App\Traits\Fixtures\CountryTrait;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    use CountryTrait;

    public function load(ObjectManager $manager)
    {
        foreach ($this->countries as $country) {
            $newCountry = new Country();
            $newCountry->setName($country['name']);
            $newCountry->setIso($country['iso']);
            $newCountry->setNicename($country['nicename']);
            $newCountry->setPhonecode($country['phonecode']);
            $manager->persist($newCountry);
        }

        $manager->flush();
    }
}
