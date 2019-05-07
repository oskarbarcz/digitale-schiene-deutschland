<?php

namespace App\Entity\Explicit;

use App\Entity\Infrastructure\Station;
use DateInterval;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Explicit\ConnectionRepository")
 */
class Connection
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $distance;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Infrastructure\Station")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stationA;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Infrastructure\Station")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stationB;

    /**
     * @ORM\Column(type="dateinterval")
     */
    private $time;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDistance(): ?int
    {
        return $this->distance;
    }

    public function setDistance(int $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getStationA(): ?Station
    {
        return $this->stationA;
    }

    public function setStationA(?Station $stationA): self
    {
        $this->stationA = $stationA;

        return $this;
    }

    public function getStationB(): ?Station
    {
        return $this->stationB;
    }

    public function setStationB(Station $stationB): self
    {
        $this->stationB = $stationB;

        return $this;
    }

    public function getTime(): DateInterval
    {
        return $this->time;
    }

    public function setTime(DateInterval $time): self
    {
        $this->time = $time;

        return $this;
    }
}
