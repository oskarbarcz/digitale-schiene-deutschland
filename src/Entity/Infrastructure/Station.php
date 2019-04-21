<?php

namespace App\Entity\Infrastructure;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Infrastructure\StationRepository")
 */
class Station
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $shortName;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $fullName;

    /**
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
