<?php

namespace App\Entity\Infrastructure;

use App\Entity\Explicit\TrackObjectType;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Swagger\Annotations as SWG;

/**
 * @JMS\ExclusionPolicy("none")
 * @ORM\Entity(repositoryClass="App\Repository\Infrastructure\TrackObjectRepository")
 */
class TrackObject
{
    /**
     * @SWG\Property(description="Route's database unique identifer", readOnly=true)
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @SWG\Property(description="Name of object. It should be short and understandable.")
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @SWG\Property(description="Kilometer of route on which object is situated.")
     * @ORM\Column(type="float", nullable=true)
     */
    private $kilometer;

    /**
     * @SWG\Property(description="Track object type (relation)")
     * @ORM\ManyToOne(targetEntity="App\Entity\Explicit\TrackObjectType", inversedBy="trackObjects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @SWG\Property(description="If object is a station, it has to have assigned station ID.")
     * @ORM\ManyToOne(targetEntity="App\Entity\Infrastructure\Station")
     */
    private $station;

    /**
     * @SWG\Property(description="Route ID that object belongs to.")
     * @ORM\ManyToOne(targetEntity="App\Entity\Infrastructure\Route", inversedBy="trackObjects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $route;

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

    public function getRoute(): ?Route
    {
        return $this->route;
    }

    public function setRoute(?Route $route): self
    {
        $this->route = $route;

        return $this;
    }
}
