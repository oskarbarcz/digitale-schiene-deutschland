<?php declare(strict_types=1);

namespace App\DTO;

use App\Entity\Infrastructure\Station;
use DateTime;

/**
 * Stop
 *
 * @package App\DTO
 */
class Stop
{
    /** @var Station valid station object */
    private $station;

    /** @var DateTime time then trainset arrives at the Station */
    private $arrivalTime;

    /** @var DateTime time when train departs from the Station */
    private $departureTime;

    /**
     * @return Station
     */
    public function getStation(): Station
    {
        return $this->station;
    }

    /**
     * @param Station $station
     * @return Stop
     */
    public function setStation(Station $station): self
    {
        $this->station = $station;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getArrivalTime(): DateTime
    {
        return $this->arrivalTime;
    }

    /**
     * @param DateTime $arrivalTime
     * @return Stop
     */
    public function setArrivalTime(DateTime $arrivalTime): self
    {
        $this->arrivalTime = $arrivalTime;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDepartureTime(): DateTime
    {
        return $this->departureTime;
    }

    /**
     * @param DateTime $departureTime
     * @return Stop
     */
    public function setDepartureTime(DateTime $departureTime): self
    {
        $this->departureTime = $departureTime;
        return $this;
    }
}
