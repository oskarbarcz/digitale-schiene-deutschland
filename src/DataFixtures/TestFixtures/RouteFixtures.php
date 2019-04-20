<?php

namespace App\DataFixtures\TestFixtures;

use App\Entity\Infrastructure\Route;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RouteFixtures extends Fixture
{
    /** @inheritDoc */
    public function load(ObjectManager $manager): void
    {
        $route = new Route();
        $route->setName('Riedbahn')
              ->setKbs(655)
              ->setLength(74800)
              ->setStationsName('Frankfurt Hbf - Karlsruhe Hbf');
        $manager->persist($route);

        $route = new Route();
        $route->setName('Berlin - Leipzig')
              ->setKbs(250)
              ->setLength(161600)
              ->setStationsName('Berlin Gesundbrunnen - Leipzig Hbf');
        $manager->persist($route);

        $route = new Route();
        $route->setName('Munchen - Garmisch')
              ->setKbs(5504)
              ->setLength(100600)
              ->setStationsName('Munchen Hbf - Garmisch-Partenkirchen');
        $manager->persist($route);


        $manager->flush();
    }
}
