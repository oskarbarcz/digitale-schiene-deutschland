<?php

namespace App\Entity\Infrastructure;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Swagger\Annotations as SWG;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @JMS\ExclusionPolicy("none")
 * @UniqueEntity(fields={"kbs"}, message="route.already-exists")
 * @ORM\Entity(repositoryClass="App\Repository\Infrastructure\RouteRepository")
 */
class Route
{
    /**
     * @SWG\Property(description="Route's database unique identifer", readOnly=true)
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @SWG\Property(
     *     description="Kursbuchstrecke - German Railways unique line number",
     *     minimum="100",
     *     maximum="9999",
     *     uniqueItems=true
     * )
     * @Assert\NotNull(message="route.kbs.not-null")
     * @Assert\GreaterThan(value="100", message="route.kbs.not-correct-length")
     * @Assert\LessThan(value="9999", message="route.kbs.not-correct-length")
     * @ORM\Column(type="integer", unique=true)
     */
    private $kbs;

    /**
     * @SWG\Property(
     *     description="Some lines has custom names, created by region they connect, etc.",
     * )
     * @Assert\Length(max="64", maxMessage="route.length.too-long")
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $name;

    /**
     * @SWG\Property(description="Route name, generated using short versions of first and last station names")
     * @Assert\NotNull(message="route.name.not-null")
     * @Assert\Length(max="255", maxMessage="route.stations-name.too-long")
     * @ORM\Column(type="string", length=255)
     */
    private $stationsName;

    /**
     * @SWG\Property(
     *     description="Total line length in meters",
     *     minimum="100",
     *     maximum="1000000"
     * )
     * @Assert\NotNull(message="route.length.not-null")
     * @Assert\GreaterThan(value="100", message="route.length.too-short")
     * @Assert\LessThan(value="1000000", message="route.length.too-long")
     * @ORM\Column(type="integer")
     */
    private $length;

    /**
     * @SWG\Property(
     *     description="Maximum permitted speed on the whole route in kilometers per hour",
     *     minimum="10",
     *     maximum="320"
     * )
     * @Assert\NotNull(message="route.max-speed.not-null")
     * @Assert\GreaterThanOrEqual(value="10", message="route.max-speed.too-low")
     * @Assert\LessThanOrEqual(value="320", message="route.max-speed.too-high")
     * @ORM\Column(type="integer")
     */
    private $maxPermittedSpeed;

    /**
     * @JMS\Exclude()
     * @ORM\OneToMany(targetEntity="App\Entity\Infrastructure\TrackObject", mappedBy="route", orphanRemoval=true)
     */
    private $trackObjects;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Infrastructure\Station", mappedBy="route", orphanRemoval=true)
     */
    private $stations;

    public function __construct()
    {
        $this->trackObjects = new ArrayCollection();
        $this->stations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKbs(): ?int
    {
        return $this->kbs;
    }

    public function setKbs(?int $kbs): self
    {
        $this->kbs = $kbs;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStationsName(): ?string
    {
        return $this->stationsName;
    }

    public function setStationsName(?string $stationsName): self
    {
        $this->stationsName = $stationsName;

        return $this;
    }

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(?int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getMaxPermittedSpeed(): ?int
    {
        return $this->maxPermittedSpeed;
    }

    public function setMaxPermittedSpeed(?int $maxPermittedSpeed): self
    {
        $this->maxPermittedSpeed = $maxPermittedSpeed;

        return $this;
    }

    /**
     * @return Collection|TrackObject[]
     */
    public function getTrackObjects(): Collection
    {
        return $this->trackObjects;
    }

    public function addTrackObject(TrackObject $trackObject): self
    {
        if (!$this->trackObjects->contains($trackObject)) {
            $this->trackObjects[] = $trackObject;
            $trackObject->setRoute($this);
        }

        return $this;
    }

    public function removeTrackObject(TrackObject $trackObject): self
    {
        if ($this->trackObjects->contains($trackObject)) {
            $this->trackObjects->removeElement($trackObject);
            // set the owning side to null (unless already changed)
            if ($trackObject->getRoute() === $this) {
                $trackObject->setRoute(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->id . ' ' . $this->name;
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
            $station->setRoute($this);
        }

        return $this;
    }

    public function removeStation(Station $station): self
    {
        if ($this->stations->contains($station)) {
            $this->stations->removeElement($station);
            // set the owning side to null (unless already changed)
            if ($station->getRoute() === $this) {
                $station->setRoute(null);
            }
        }

        return $this;
    }
}
