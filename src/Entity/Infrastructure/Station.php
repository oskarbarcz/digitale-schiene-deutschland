<?php

namespace App\Entity\Infrastructure;

use Doctrine\ORM\Mapping as ORM;
use Swagger\Annotations as SWG;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Infrastructure\StationRepository")
 */
class Station
{
    /**
     * @SWG\Property(description="Station unique identifier", readOnly=true)
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @SWG\Property(description="Station short name", example="Berlin Hbf")
     * @Assert\NotNull(message="station.short-name.not-null")
     * @Assert\Length(max="16", maxMessage="station.short-name.too-long")
     * @ORM\Column(type="string", length=16)
     */
    private $shortName;

    /**
     * @SWG\Property(
     *     description="Station full name",
     *     example="Berlin Hauptbahnhof (tief)"
     *     )
     * @Assert\NotNull(message="station.long-name.not-null")
     * @Assert\Length(max="128", maxMessage="station.long-name.too-long")
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $fullName;

    /**
     * @SWG\Property(description="Related track object")
     * @Assert\NotNull(message="station.track-object.not-null")
     * @Assert\Type(type="TrackObject::class", message="station.track-object.type")
     * @ORM\OneToOne(
     *     targetEntity="App\Entity\Infrastructure\TrackObject",
     *     mappedBy="station",
     *     cascade={"persist", "remove"})
     */
    private $trackObject;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    public function setShortName(string $shortName): self
    {
        $this->shortName = $shortName;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(?string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getTrackObject(): ?TrackObject
    {
        return $this->trackObject;
    }

    public function setTrackObject(?TrackObject $trackObject): self
    {
        $this->trackObject = $trackObject;

        // set (or unset) the owning side of the relation if necessary
        $newStation = $trackObject === null ? null : $this;
        if ($newStation !== $trackObject->getStation()) {
            $trackObject->setStation($newStation);
        }

        return $this;
    }
}
