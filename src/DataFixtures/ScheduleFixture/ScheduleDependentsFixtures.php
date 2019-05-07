<?php declare(strict_types=1);

namespace App\DataFixtures\ScheduleFixture;


use App\Entity\Explicit\Carrier;
use App\Entity\Explicit\Connection;
use App\Entity\Explicit\TrackObjectType;
use App\Entity\Explicit\TrainService;
use App\Entity\Infrastructure\Route;
use App\Entity\Infrastructure\Station;
use App\Entity\Infrastructure\TrackObject;
use DateInterval;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;

/**
 * ConnectionFullStackFixture
 *
 * @package App\DataFixtures\TestFixtures
 */
class ScheduleDependentsFixtures extends Fixture implements FixtureGroupInterface
{

    /** @inheritDoc */
    public static function getGroups(): array
    {
        return ['schedule'];
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $route = new Route();
        $route->setName('Test route')
              ->setKbs(9999)
              ->setStationsName('Station A - Station C')
              ->setLength(50000)
              ->setMaxPermittedSpeed(280);

        $type = new TrackObjectType();
        $type->setName('Abstract Station')
             ->setStyleClass('css');

        $carrier = new Carrier();
        $carrier->setFullName('Test Carrier')
                ->setShortName('TestCarrier')
                ->setCountryIbanCode('a')
                ->setLogoFilePath(null)
                ->setShortcode('TEST')
                ->setWebsite('www.test.com');

        $service = new TrainService();
        $service->setCarrier($carrier)
                ->setCode('IC');

        $trackObjectA = new TrackObject();
        $trackObjectB = new TrackObject();
        $trackObjectC = new TrackObject();
        $stationA = new Station();
        $stationB = new Station();
        $stationC = new Station();

        $distanceAB = new Connection();
        $distanceBC = new Connection();

        $trackObjectA->setType($type)
                     ->setRoute($route)
                     ->setKilometer(0.0)
                     ->setName('Station A')
                     ->setStation($stationA);
        $stationA->setShortName('Station A')
                 ->setTrackObject($trackObjectA);

        $trackObjectB->setType($type)
                     ->setRoute($route)
                     ->setKilometer(20.0)
                     ->setName('Station B')
                     ->setStation($stationB);
        $stationB->setShortName('Station B')
                 ->setTrackObject($trackObjectB);

        $trackObjectC->setType($type)
                     ->setRoute($route)
                     ->setKilometer(50.0)
                     ->setName('Station C')
                     ->setStation($stationC);
        $stationC->setShortName('Station C')
                 ->setTrackObject($trackObjectC);

        $route->addTrackObject($trackObjectA)
              ->addTrackObject($trackObjectB)
              ->addTrackObject($trackObjectC);

        $distanceAB->setStationA($stationA)
                   ->setStationB($stationB)
                   ->setDistance(20000)
                   ->setTime(new DateInterval('PT3600S'));

        $distanceBC->setStationA($stationB)
                   ->setStationB($stationC)
                   ->setDistance(30000)
                   ->setTime(new DateInterval('PT1200S'));

        $manager->persist($route);

        $manager->persist($carrier);
        $manager->persist($type);
        $manager->persist($service);


        $manager->persist($stationA);
        $manager->persist($stationB);
        $manager->persist($stationC);

        $manager->persist($distanceAB);
        $manager->persist($distanceBC);

        $manager->persist($trackObjectA);
        $manager->persist($trackObjectB);
        $manager->persist($trackObjectC);

        $manager->flush();
    }
}
