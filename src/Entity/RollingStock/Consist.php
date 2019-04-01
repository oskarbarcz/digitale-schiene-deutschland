<?php

namespace App\Entity\RollingStock;

use App\Entity\Abstracts\ConsistInterface;
use App\Entity\Abstracts\UnifiedConsistInterface;
use App\Entity\Explicit\Producer;
use App\Entity\RollingStock\ConsistElement\Car;
use App\Entity\RollingStock\ConsistElement\Engine;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RollingStock\ConsistRepository")
 */
class Consist implements UnifiedConsistInterface, ConsistInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $name;

    /**
     * @var Engine
     * @ORM\ManyToMany(targetEntity="App\Entity\RollingStock\ConsistElement\Engine", inversedBy="consists")
     */
    private $engines;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\RollingStock\ConsistElement\Car", inversedBy="consists")
     */
    private $cars;

    public function __construct()
    {
        $this->engines = new ArrayCollection();
        $this->cars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Engine|Engine[]|array|ArrayCollection
     */
    public function getEngines()
    {
        return $this->engines;
    }

    public function addEngine(Engine $engine): self
    {
        if (!$this->engines->contains($engine)) {
            $this->engines[] = $engine;
        }
        return $this;
    }

    public function removeEngine(Engine $engine): self
    {
        if ($this->engines->contains($engine)) {
            $this->engines->removeElement($engine);
        }
        return $this;
    }

    /**
     * @return Collection|Car[]
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Car $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars[] = $car;
        }
        return $this;
    }

    public function removeCar(Car $car): self
    {
        if ($this->cars->contains($car)) {
            $this->cars->removeElement($car);
        }
        return $this;
    }

    /**
     * @return Producer
     */
    public function getProducer(): ?Producer
    {
        /** @var Engine $engine */
        return $engine->getProducer();
    }

    /**
     * @return int total weight in kilograms
     */
    public function getTotalWeight(): int
    {
        $total = 0;
        foreach ($this->engines as $engine) {
            /** @var Engine $engine */
            $total += $engine->getWeight();
        }
        foreach ($this->cars as $car) {
            /** @var Car $car */
            $total += $car->getWeight();
        }
        return $total;
    }

    /**
     * @return float total weight in meters
     */
    public function getTotalLength(): float
    {
        $total = 0;
        foreach ($this->engines as $engine) {
            /** @var Engine $engine */
            $total += $engine->getLength();
        }
        foreach ($this->cars as $car) {
            /** @var Car $car */
            $total += $car->getLength();
        }
        return $total;
    }

    /**
     * @return int maximum allowed speed in kilometer per hour
     */
    public function getMaxPermittedSpeed(): int
    {
        return 0;
    }

    /**
     * @return int seats in all cars/wagons
     */
    public function getSeatsCount(): int
    {
        $seats = 0;
        foreach ($this->cars as $car) {
            /** @var Car $car */
            $seats += $car->getSeatsCount();
        }
        return $seats;
    }

    /**
     * @return int continuous output in megawats
     */
    public function getContinuousOutput(): int
    {
        $power = 0;
        foreach ($this->engines as $engine) {
            /** @var Engine $engine */
            $power += $engine->getContinuousOutput();
        }
        return $power;
    }
}
