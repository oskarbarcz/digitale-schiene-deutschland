<?php

namespace App\Entity\Infrastructure;

use App\Entity\Explicit\TrackObjectType;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Infrastructure\TrackObjectRepository")
 */
class TrackObject
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
     * @ORM\Column(type="float", nullable=true)
     */
    private $kilometer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Explicit\TrackObjectType", inversedBy="trackObjects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Infrastructure\Station")
     */
    private $station;

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

    public function getKilometer(): ?float
    {
        return $this->kilometer;
    }

    public function setKilometer(?float $kilometer): self
    {
        $this->kilometer = $kilometer;

        return $this;
    }

    public function getType(): ?TrackObjectType
    {
        return $this->type;
    }

    public function setType(?TrackObjectType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStation(): ?Station
    {
        return $this->station;
    }

    public function setStation(?Station $station): self
    {
        $this->station = $station;

        return $this;
    }
}
