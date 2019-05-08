<?php declare(strict_types=1);

namespace App\Services\DomainServices;

use App\DTO\RailVehicle;
use App\Entity\Infrastructure\Station;
use App\Entity\Schedule\Schedule;
use App\Entity\Schedule\ScheduleDataHolder;
use App\Entity\Schedule\Stop;
use App\Exceptions\NotFound\ConnectionNotFoundException;
use App\Exceptions\NotFound\NoEnoughStationsException;
use DateInterval;
use DateTime;
use Exception;
use function count;

/**
 * Creates complete and valid schedule object
 *
 * @package App\Domain\Timetable
 */
class ScheduleCreator
{
    /** @var DateInterval time that train will stop on each station */
    private $stopInterval;

    /** @var DateInterval time that will be added at the schedule start */
    private $departureDelay;

    /** @var DateTime holds time of last departure, changed recursively */
    private $lastDepartureTime;

    /** @var ConnectionFinder */
    protected $connectionFinder;

    /** @var int scenario starts with this delay set */
    private const DELAY_BEFORE_DEPARTURE = 120;

    /** @var int stop time */
    private const STOP_ON_EACH_STATION = 240;

    /**
     * Assings values to fields
     *
     * @param ConnectionFinder $connectionFinder
     * @throws Exception actually never...
     */
    public function __construct(ConnectionFinder $connectionFinder)
    {
        $this->connectionFinder = $connectionFinder;
        $this->stopInterval = new DateInterval('PT' . self::STOP_ON_EACH_STATION . 'S');
        $this->departureDelay = new DateInterval('PT' . self::DELAY_BEFORE_DEPARTURE . 'S');


    }

    /**
     * @param ScheduleDataHolder $scheduleDataHolder
     * @return Schedule
     * @throws NoEnoughStationsException
     * @throws Exception when DateInterval has incorrect value
     */
    public function create(ScheduleDataHolder $scheduleDataHolder): Schedule
    {
        $stations = $scheduleDataHolder->getStations()->toArray();
        $stops = $this->assign($stations, $scheduleDataHolder->getStartTime());

        $railV = new RailVehicle();

        // compose schedule object
        $schedule = new Schedule();
        $schedule->setStops($stops)
                 ->setRelationNumber($scheduleDataHolder->getRelationNumber())
                 ->setRoute($scheduleDataHolder->getRoute())
                 ->setTrainService($scheduleDataHolder->getService())
                 ->setRailVehicle($railV);

        return $schedule;
    }

    /**
     * Converts stations to stops with given start time
     *
     * @param Station[] $stations
     * @param DateTime  $startTime
     * @return Stop[]
     * @throws ConnectionNotFoundException
     * @throws NoEnoughStationsException
     */
    private function assign(array $stations, DateTime $startTime = null): array
    {
        // if start time not provided, start now
        if (!$startTime) {
            $startTime = new DateTime();
        }

        // if less than 2 stations, creating schedule is impossible
        if (count($stations) < 2) {
            throw new NoEnoughStationsException();
        }

        $stops = [];

        // else try to build schedule
        foreach ($stations as $order => $currentStation) {
            //on first iteration
            if ($order === 0) {
                // add first stop with start delay time
                $startTime = $startTime->add($this->departureDelay);
                $stops[] = $this->createStop($currentStation, $startTime);
                continue;
            }
            // try to find connection between previous and current station
            $connection = $this->connectionFinder->findDirect($stations[$order - 1], $currentStation);
            $arrivalTime = $this->lastDepartureTime->add($connection->getTime());
            $stops[] = $this->createStop($currentStation, $arrivalTime);
        }

        return $stops;
    }

    /**
     * Creates stop and writes departure time as field
     *
     * @param Station  $station
     * @param DateTime $arrivalTime
     * @return Stop
     */
    private function createStop(Station $station, DateTime $arrivalTime): Stop
    {
        $stop = new Stop();
        $stop->setStation($station)
             ->setArrivalTime($arrivalTime);
        $arrivalTime = clone $arrivalTime;
        $stop->setDepartureTime($arrivalTime->add($this->stopInterval));

        // cloning, not assigning
        $this->lastDepartureTime = clone $stop->getDepartureTime();
        return $stop;
    }
}
