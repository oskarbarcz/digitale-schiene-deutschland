<?php

namespace App\DataFixtures\ExplicitFixtures;

use App\Entity\Infrastructure\Route;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RouteFixtures extends Fixture implements FixtureGroupInterface
{
    /** @inheritDoc */
    public function load(ObjectManager $manager): void
    {
        $route = new Route();
        $route->setName('Riedbahn')
              ->setKbs(655)
              ->setMaxPermittedSpeed(280)
              ->setLength(74800)
              ->setStationsName('Frankfurt Hbf - Karlsruhe Hbf');
        $manager->persist($route);

        $route = new Route();
        $route->setName('Berlin - Leipzig')
              ->setKbs(250)
              ->setMaxPermittedSpeed(200)
              ->setLength(161600)
              ->setStationsName('Berlin Gesundbr. - Leipzig Hbf');
        $manager->persist($route);

        $route = new Route();
        $route->setName('Munchen - Garmisch')
              ->setKbs(5504)
              ->setMaxPermittedSpeed(160)
              ->setLength(100600)
              ->setStationsName('Munchen Hbf - Garmisch-P.');
        $manager->persist($route);


        $manager->flush();
    }

    /**
     * This method must return an array of groups
     * on which the implementing class belongs to
     *
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['dev'];
    }
}
