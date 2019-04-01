<?php

namespace App\Entity\RollingStock;

use App\Entity\Explicit\Carrier;
use App\Entity\Explicit\Producer;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RollingStock\MotorUnitRepository")
 */
class MotorUnit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Explicit\Carrier", inversedBy="motorUnits")
     */
    private $carrier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Explicit\Producer", inversedBy="motorUnits")
     */
    private $producer;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxPermittedSpeed;

    /**
     * @ORM\Column(type="integer")
     */
    private $seatsCount;

    /**
     * @ORM\Column(type="float")
     */
    private $totalLength;

    /**
     * @ORM\Column(type="integer")
     */
    private $continuousOutput;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalWeight;

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

    public function getCarrier(): ?Carrier
    {
        return $this->carrier;
    }

    public function setCarrier(?Carrier $carrier): self
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getProducer(): ?Producer
    {
        return $this->producer;
    }

    public function setProducer(?Producer $producer): self
    {
        $this->producer = $producer;

        return $this;
    }

    public function getMaxPermittedSpeed(): ?int
    {
        return $this->maxPermittedSpeed;
    }

    public function setMaxPermittedSpeed(int $maxPermittedSpeed): self
    {
        $this->maxPermittedSpeed = $maxPermittedSpeed;

        return $this;
    }

    /**
     * @return int total weight in kilograms
     */
    public function getTotalWeight(): int
    {
        return $this->totalWeight;

    }

    /**
     * @return float total weight in meters
     */
    public function getTotalLength(): float
    {
        return $this->totalLength;
    }

    /**
     * @return int seats in all cars/wagons
     */
    public function getSeatsCount(): int
    {
        return $this->seatsCount;
    }

    /**
     * @return int continuous output in megawats
     */
    public function getContinuousOutput(): int
    {
        return $this->continuousOutput;
    }

    public function setSeatsCount(int $seatsCount): self
    {
        $this->seatsCount = $seatsCount;

        return $this;
    }

    public function setTotalLength(int $totalLength): self
    {
        $this->totalLength = $totalLength;

        return $this;
    }

    public function setContinuousOutput(int $continuousOutput): self
    {
        $this->continuousOutput = $continuousOutput;

        return $this;
    }

    public function setTotalWeight(int $totalWeight): self
    {
        $this->totalWeight = $totalWeight;

        return $this;
    }
}
