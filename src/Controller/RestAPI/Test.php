<?php declare(strict_types=1);

namespace App\Controller\RestAPI;


use App\Domain\Timetable\Schedule;
use App\DTO\Stop;
use App\Entity\Explicit\Carrier;
use App\Entity\Explicit\Connection;
use App\Entity\Explicit\TrackObjectType;
use App\Entity\Explicit\TrainService;
use App\Entity\Infrastructure\Route;
use App\Entity\Infrastructure\Station;
use App\Entity\Infrastructure\TrackObject;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Test
 *
 * @package App\Controller\RestAPI
 */
class Test extends AbstractController
{

    /**
     * @param DateTime $startTime
     * @return Response
     */
    public function index(DateTime $startTime): Response
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
                ->setCountryIbanCode('TEST')
                ->setLogoFilePath(null)
                ->setShortcode('TEST')
                ->setWebsite('www.test.com');

        $service = new TrainService();
        $service->setCarrier($carrier);

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
                   ->setDistance(20000);

        $distanceBC->setStationA($stationB)
                   ->setStationB($stationC)
                   ->setDistance(30000);

        $stop1 = new Stop();
        $stop2 = new Stop();
        $stop3 = new Stop();

        $stop1->setStation($stationA)
              ->setArrivalTime($startTime)
              ->setDepartureTime($startTime);

        $stop2->setStation($stationB)
              ->setArrivalTime($arrivalTime)
              ->setDepartureTime($departureTime);

        $stop3->setStation($stationB)
              ->setArrivalTime($arrivalTime)
              ->setDepartureTime($departureTime);

        $stops = [$stop1, $stop2, $stop3];

        $timetable = new Schedule();
        $timetable->setRoute($route)
                  ->setStops($stops)
                  ->setTrainService($service);


    }
}
