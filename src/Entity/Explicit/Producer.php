<?php

namespace App\Entity\Explicit;

use App\Entity\RollingStock\ConsistElement\Car;
use App\Entity\RollingStock\ConsistElement\Engine;
use App\Entity\RollingStock\MotorUnit;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Train parts and consists procuder
 *
 * @ORM\Entity(repositoryClass="App\Repository\Explicit\ProducerRepository")
 */
class Producer
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
    private $fullName;

    /**
     * @ORM\Column(type="string", length=16, nullable=true)
     */
    private $shortName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logoFilePath;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RollingStock\ConsistElement\Engine", mappedBy="producer")
     */
    private $engines;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RollingStock\ConsistElement\Car", mappedBy="producer")
     */
    private $cars;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RollingStock\MotorUnit", mappedBy="producer")
     */
    private $motorUnits;

    public function __construct()
    {
        $this->engines = new ArrayCollection();
        $this->cars = new ArrayCollection();
        $this->motorUnits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    public function setShortName(?string $shortName): self
    {
        $this->shortName = $shortName;

        return $this;
    }

    public function getLogoFilePath(): ?string
    {
        return $this->logoFilePath;
    }

    public function setLogoFilePath(?string $logoFilePath): self
    {
        $this->logoFilePath = $logoFilePath;

        return $this;
    }

    /**
     * @return Collection|Engine[]
     */
    public function getEngines(): Collection
    {
        return $this->engines;
    }

    public function addEngine(Engine $engine): self
    {
        if (!$this->engines->contains($engine)) {
            $this->engines[] = $engine;
            $engine->setProducer($this);
        }

        return $this;
    }

    public function removeEngine(Engine $engine): self
    {
        if ($this->engines->contains($engine)) {
            $this->engines->removeElement($engine);
            // set the owning side to null (unless already changed)
            if ($engine->getProducer() === $this) {
                $engine->setProducer(null);
            }
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
            $car->setProducer($this);
        }

        return $this;
    }

    public function removeCar(Car $car): self
    {
        if ($this->cars->contains($car)) {
            $this->cars->removeElement($car);
            // set the owning side to null (unless already changed)
            if ($car->getProducer() === $this) {
                $car->setProducer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MotorUnit[]
     */
    public function getMotorUnits(): Collection
    {
        return $this->motorUnits;
    }

    public function addMotorUnit(MotorUnit $motorUnit): self
    {
        if (!$this->motorUnits->contains($motorUnit)) {
            $this->motorUnits[] = $motorUnit;
            $motorUnit->setProducer($this);
        }

        return $this;
    }

    public function removeMotorUnit(MotorUnit $motorUnit): self
    {
        if ($this->motorUnits->contains($motorUnit)) {
            $this->motorUnits->removeElement($motorUnit);
            // set the owning side to null (unless already changed)
            if ($motorUnit->getProducer() === $this) {
                $motorUnit->setProducer(null);
            }
        }

        return $this;
    }
}
