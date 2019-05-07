<?php declare(strict_types=1);

namespace App\Services\DomainServices;

use App\DTO\RailVehicle;
use App\Entity\Infrastructure\Station;
use App\Entity\Schedule\Schedule;
use App\Entity\Schedule\ScheduleDataHolder;
use App\Entity\Schedule\Stop;
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
     * @throws Exception when DateInterval has incorrect value
     */
    public function create(ScheduleDataHolder $scheduleDataHolder): Schedule
    {
        $stops = [];
        $stations = $scheduleDataHolder->getStations();

        if (count($stations) < 2) {
            die('nie ma stacji');
        }

        // else try to build schedule
        foreach ($stations as $order => $currentStation) {
            //on first iteration
            if ($order === 0) {
                // add first stop with start delay time
                $startTime = $scheduleDataHolder->getStartTime()->add($this->departureDelay);
                $stops[] = $this->createStop($currentStation, $startTime);
                continue;
            }

            // try to find connection between previous and current station
            $connection = $this->connectionFinder->findDirect($stations[$order - 1], $currentStation);
            $arrivalTime = $this->lastDepartureTime->add($connection->getTime());

            $stops[] = $this->createStop($currentStation, $arrivalTime);
        }

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
     * Creates stop and writes departure time as field
     *
     * @param Station  $station
     * @param DateTime $arrivalTime
     * @return Stop
     */
    private function createStop(Station $station, DateTime $arrivalTime): Stop
    {
        $departureTime = $arrivalTime->add($this->stopInterval);
        $stop = new Stop();
        $stop->setStation($station)
             ->setArrivalTime($arrivalTime)
             ->setDepartureTime($departureTime);

        // cloning, not a
        $this->lastDepartureTime = clone $departureTime;
        return $stop;
    }
}
