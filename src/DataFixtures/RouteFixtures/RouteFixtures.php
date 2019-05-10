<?php

namespace App\DataFixtures\RouteFixtures;

use App\Entity\Infrastructure\Route;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;

class RouteFixtures extends Fixture implements FixtureGroupInterface
{
    /** @var int how many routes will be added */
    private $amounts = 10;

    /** @inheritDoc */
    public static function getGroups(): array
    {
        return ['all', 'route', 'basic-func'];
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < $this->amounts; $i++) {
            $route = new Route();
            $route->setName('Route ' . $i)
                  ->setKbs(100 + $i)
                  ->setMaxPermittedSpeed(280)
                  ->setLength(random_int(1000, 100000))
                  ->setStationsName('Route ' . $i);
            $manager->persist($route);
        }
        $manager->flush();
    }
}
