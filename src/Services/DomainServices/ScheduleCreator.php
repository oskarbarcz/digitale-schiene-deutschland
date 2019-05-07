<?php declare(strict_types=1);

namespace App\Services\DomainServices;

use App\DTO\Stop;
use App\Entity\Schedule\Schedule;
use App\Entity\Schedule\ScheduleDataHolder;
use DateInterval;
use Exception;

/**
 * Creates complete and valid schedule object
 *
 * @package App\Domain\Timetable
 */
class ScheduleCreator
{
    /** @var ConnectionFinder */
    protected $connectionFinder;

    /** @var int scenario starts with this delay set */
    private const DELAY_BEFORE_DEPARTURE = 120;

    /** @var int stop time */
    private const STOP_ON_EACH_STATION = 240;

    /**
     * Private constructor to prevent object creation
     *
     * @param ConnectionFinder $connectionFinder
     */
    private function __construct(ConnectionFinder $connectionFinder)
    {
        $this->connectionFinder = $connectionFinder;
    }

    /**
     * @param ScheduleDataHolder $scheduleDataHolder
     * @return Schedule
     * @throws Exception when DateInterval has incorrect value
     */
    public function createFromStub(ScheduleDataHolder $scheduleDataHolder): Schedule
    {
        if (count($scheduleDataHolder->getStations()) < 2) {
            // throw not possible
        }

        $stopInterval = new DateInterval('PT' . self::STOP_ON_EACH_STATION . 'S');
        $previousStation = null;
        $departureTime = null;
        $stops = [];

        foreach ($scheduleDataHolder->getStations() as $order => $currentStation) {

            //on first iteration
            if (!$previousStation) {
                $departureDelay = new DateInterval('PT' . self::DELAY_BEFORE_DEPARTURE . 'S');

                $stop = new Stop();
                $stop->setStation($currentStation);

                $startTime = $scheduleDataHolder->getStartTime()->add($departureDelay);
                $stop->setArrivalTime($startTime);

                $departureTime = $startTime->add($stopInterval);
                $stop->setDepartureTime($departureTime);

                $stops[] = $stop;

                // mark currentStation station as previous
                $previousStation = $scheduleDataHolder->getStations()->get($order);

                // skip to next iteration
                continue;
            }

            // try to find connection between previous and current station
            $connection = $this->connectionFinder->find($previousStation, $currentStation);

            // create new stop
            $stop = new Stop();
            $stop->setStation($currentStation);

            $arrivalTime = $departureTime->add($connection->getTime());
            $stop->setArrivalTime($arrivalTime);

            $departureTime = $arrivalTime->add($stopInterval);
            $stop->setDepartureTime($departureTime);

            $stops[] = $stop;

            $previousStation = $scheduleDataHolder->getStations()->get($order);
        }

        // compose schedule object
        $schedule = new Schedule();
        $schedule->setStops($stops)
                 ->setRelationNumber((string)$scheduleDataHolder->getRelationNumber())
                 ->setRoute($scheduleDataHolder->getRoute())
                 ->setTrainService($scheduleDataHolder->getService())
                 ->setRailVehicle(null);

        return $schedule;
    }
}
