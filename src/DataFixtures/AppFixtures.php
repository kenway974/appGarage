<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\CarFactory;
use App\Factory\BrandFactory;
use App\Factory\PieceFactory;
use App\Factory\ServiceFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        BrandFactory::createAll();
        ServiceFactory::createAll();
        CarFactory::createAll();
        PieceFactory::createAll();

        $manager->flush();
    }
}
