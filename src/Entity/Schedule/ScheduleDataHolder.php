<?php

namespace App\Entity\Schedule;

use App\Entity\Explicit\TrainService;
use App\Entity\Infrastructure\Route;
use App\Entity\Infrastructure\Station;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Schedule\ScheduleDataHolderRepository")
 */
class ScheduleDataHolder
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Infrastructure\Station")
     */
    private $stations;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Infrastructure\Route")
     * @ORM\JoinColumn(nullable=false)
     */
    private $route;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Explicit\TrainService")
     * @ORM\JoinColumn(nullable=false)
     */
    private $service;

    /**
     * @ORM\Column(type="integer")
     */
    private $relationNumber;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startTime;

    public function __construct()
    {
        $this->stations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Station[]
     */
    public function getStations(): Collection
    {
        return $this->stations;
    }

    public function addStation(Station $station): self
    {
        if (!$this->stations->contains($station)) {
            $this->stations[] = $station;
        }

        return $this;
    }

    public function removeStation(Station $station): self
    {
        if ($this->stations->contains($station)) {
            $this->stations->removeElement($station);
        }

        return $this;
    }

    public function getRoute(): ?Route
    {
        return $this->route;
    }

    public function setRoute(?Route $route): self
    {
        $this->route = $route;

        return $this;
    }

    public function getService(): ?TrainService
    {
        return $this->service;
    }

    public function setService(?TrainService $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getRelationNumber(): ?int
    {
        return $this->relationNumber;
    }

    public function setRelationNumber(int $relationNumber): self
    {
        $this->relationNumber = $relationNumber;

        return $this;
    }

    public function getStartTime(): DateTime
    {
        return $this->startTime;
    }

    public function setStartTime(DateTime $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }
}
