<?php

namespace App\DataFixtures;

use App\Entity\Country;
use App\Traits\Fixtures\CountryTrait;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

    }
}
