<?php

namespace App\Entity\Explicit;

use App\Entity\Infrastructure\TrackObject;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @JMS\ExclusionPolicy("none")
 * @ORM\Entity(repositoryClass="App\Repository\Explicit\TrackObjectTypeRepository")
 */
class TrackObjectType
{
    /**
     * @JMS\Type("integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @JMS\Type("string")
     * @ORM\Column(type="string", length=32)
     */
    private $name;

    /**
     * @JMS\SerializedName("cssClass")
     * @JMS\Type("string")
     * @ORM\Column(type="string", length=255)
     */
    private $styleClass;

    /**
     * @JMS\Exclude()
     * @ORM\OneToMany(targetEntity="App\Entity\Infrastructure\TrackObject", mappedBy="type")
     */
    private $trackObjects;

    public function __construct()
    {
        $this->trackObjects = new ArrayCollection();
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

    public function getStyleClass(): ?string
    {
        return $this->styleClass;
    }

    public function setStyleClass(string $styleClass): self
    {
        $this->styleClass = $styleClass;

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
            $trackObject->setType($this);
        }

        return $this;
    }

    public function removeTrackObject(TrackObject $trackObject): self
    {
        if ($this->trackObjects->contains($trackObject)) {
            $this->trackObjects->removeElement($trackObject);
            // set the owning side to null (unless already changed)
            if ($trackObject->getType() === $this) {
                $trackObject->setType(null);
            }
        }

        return $this;
    }
}
