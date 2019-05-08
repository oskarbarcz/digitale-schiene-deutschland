<?php declare(strict_types=1);

namespace App\Entity\Schedule;

use App\Entity\Infrastructure\Station;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Stop
 *
 * @package App\DTO
 */
class Stop
{
    /**
     * @var Station valid station object
     */
    private $station;

    /**
     * @var DateTime time then trainset arrives at the Station
     * @Assert\Type(type="DateTime", message="stop.date-time")
     */
    private $arrivalTime;

    /**
     * @var DateTime time when train departs from the Station
     * @Assert\Type(type="DateTime", message="stop.date-time")
     */
    private $departureTime;

    // <editor-fold desc="GETTERS AND SETTERS">

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

    // </editor-fold>
    // <editor-fold desc="VALIDATION">
    /**
     * Checks if arrival is set after departure
     * @Assert\IsTrue(message="stop.departure-after-arrival")
     *
     * @return bool
     */
    protected function isDepartureAfterArrival(): bool
    {
        return ((int)$this->arrivalTime > (int)$this->departureTime);
    }
    // </editor-fold>

}
