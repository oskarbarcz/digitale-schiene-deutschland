<?php

namespace App\Entity\Explicit;

use App\Entity\Infrastructure\Station;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Explicit\DistanceRepository")
 */
class Distance
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
    private $meters;

    /**
     * @ORM\Column(type="integer")
     */
    private $minutes;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMeters(): ?int
    {
        return $this->meters;
    }

    public function setMeters(int $meters): self
    {
        $this->meters = $meters;

        return $this;
    }

    public function getMinutes(): ?int
    {
        return $this->minutes;
    }

    public function setMinutes(int $minutes): self
    {
        $this->minutes = $minutes;

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

    public function setStationB(?Station $stationB): self
    {
        $this->stationB = $stationB;

        return $this;
    }
}
