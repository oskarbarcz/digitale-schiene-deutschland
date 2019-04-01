<?php

namespace App\Entity\RollingStock\ConsistElement;

use App\Entity\Explicit\Producer;
use App\Entity\RollingStock\Consist;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RollingStock\ConsistElement\CarRepository")
 */
class Car
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
     * @ORM\ManyToMany(targetEntity="App\Entity\RollingStock\Consist", mappedBy="cars")
     */
    private $consists;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Explicit\Producer", inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
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
    private $length;

    /**
     * @ORM\Column(type="integer")
     */
    private $weight;

    public function __construct()
    {
        $this->consists = new ArrayCollection();
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
     * @return Collection|Consist[]
     */
    public function getConsists(): Collection
    {
        return $this->consists;
    }

    public function addConsist(Consist $consist): self
    {
        if (!$this->consists->contains($consist)) {
            $this->consists[] = $consist;
            $consist->addCar($this);
        }
        return $this;
    }

    public function removeConsist(Consist $consist): self
    {
        if ($this->consists->contains($consist)) {
            $this->consists->removeElement($consist);
            $consist->removeCar($this);
        }
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

    public function getSeatsCount(): ?int
    {
        return $this->seatsCount;
    }

    public function setSeatsCount(int $seatsCount): self
    {
        $this->seatsCount = $seatsCount;

        return $this;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(float $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }
}
