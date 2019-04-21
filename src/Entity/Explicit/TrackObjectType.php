<?php

namespace App\Entity\Explicit;

use App\Entity\Infrastructure\TrackObject;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Swagger\Annotations as SWG;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Representation of all track objects
 *
 * @JMS\ExclusionPolicy("none")
 * @ORM\Entity(repositoryClass="App\Repository\Explicit\TrackObjectTypeRepository")
 */
class TrackObjectType
{
    /**
     * @JMS\Type("integer")
     * @SWG\Property(description="Type's database unique identifer", readOnly=true)
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @SWG\Property(description="Name that has to be helpful to identify Type in editors")
     * @Assert\NotBlank(message="types.name.not-blank")
     * @Assert\Length(
     *     min="5",
     *     minMessage="types.name.too-short",
     *     max="255",
     *     maxMessage="types.name.too-long")
     * @JMS\Type("string")
     * @ORM\Column(type="string", length=32)
     */
    private $name;

    /**
     * @SWG\Property(description="CSS class assigned to this element. It'll define how the Type will be rendered.")
     * @Assert\NotBlank(message="types.styleClass.not-blank")
     * @Assert\Length(
     *     min="5",
     *     minMessage="types.styleClass.too-short",
     *     max="255",
     *     maxMessage="types.styleClass.too-long")
     * @JMS\SerializedName("cssClass")
     * @JMS\Type("string")
     * @ORM\Column(type="string", length=255)
     */
    private $styleClass;

    /**
     * @JMS\Exclude()
     * @ORM\OneToMany(targetEntity="App\Entity\Infrastructure\TrackObject", mappedBy="type", cascade={"persist"})
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

    public function __toString()
    {
        return $this->id . ' ' . $this->name;
    }
}
