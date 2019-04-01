<?php

namespace App\Entity\RollingStock\ConsistElement;

use App\Entity\Explicit\Carrier;
use App\Entity\Explicit\Producer;
use App\Entity\RollingStock\Consist;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RollingStock\ConsistElement\EngineRepository")
 */
class Engine
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
     * @ORM\ManyToMany(targetEntity="App\Entity\RollingStock\Consist", mappedBy="engines")
     */
    private $consists;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Explicit\Carrier", inversedBy="engines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $carrier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Explicit\Producer", inversedBy="engines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $producer;

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
            $consist->addEngine($this);
        }
        return $this;
    }

    public function removeConsist(Consist $consist): self
    {
        if ($this->consists->contains($consist)) {
            $this->consists->removeElement($consist);
            $consist->removeEngine($this);
        }
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
}
