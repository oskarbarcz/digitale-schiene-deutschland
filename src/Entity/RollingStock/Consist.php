<?php

namespace App\Entity\RollingStock;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConsistRepository")
 */
class Consist
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="Engine", inversedBy="consists")
     */
    private $engines;

    /**
     * @ORM\ManyToMany(targetEntity="Car", inversedBy="consists")
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
}
