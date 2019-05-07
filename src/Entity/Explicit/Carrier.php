<?php

namespace App\Entity\Explicit;

use App\Entity\RollingStock\ConsistElement\Engine;
use App\Entity\RollingStock\MotorUnit;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Represents an company that is allowed to carry goods or passengers through railway network
 *
 * @ORM\Entity(repositoryClass="App\Repository\Explicit\CarrierRepository")
 */
class Carrier
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
     * @ORM\Column(type="string", length=4)
     */
    private $countryIbanCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $website;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logoFilePath;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $shortcode;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RollingStock\ConsistElement\Engine", mappedBy="carrier")
     */
    private $engines;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RollingStock\MotorUnit", mappedBy="carrier")
     */
    private $motorUnits;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Explicit\TrainService", mappedBy="carrier", orphanRemoval=true)
     */
    private $trainServices;

    public function __construct()
    {
        $this->engines = new ArrayCollection();
        $this->motorUnits = new ArrayCollection();
        $this->trainServices = new ArrayCollection();
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

    public function getCountryIbanCode(): ?string
    {
        return $this->countryIbanCode;
    }

    public function setCountryIbanCode(string $countryIbanCode): self
    {
        $this->countryIbanCode = $countryIbanCode;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): self
    {
        $this->website = $website;

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

    public function getShortcode(): ?string
    {
        return $this->shortcode;
    }

    public function setShortcode(string $shortcode): self
    {
        $this->shortcode = $shortcode;

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
            $engine->setCarrier($this);
        }

        return $this;
    }

    public function removeEngine(Engine $engine): self
    {
        if ($this->engines->contains($engine)) {
            $this->engines->removeElement($engine);
            // set the owning side to null (unless already changed)
            if ($engine->getCarrier() === $this) {
                $engine->setCarrier(null);
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
            $motorUnit->setCarrier($this);
        }

        return $this;
    }

    public function removeMotorUnit(MotorUnit $motorUnit): self
    {
        if ($this->motorUnits->contains($motorUnit)) {
            $this->motorUnits->removeElement($motorUnit);
            // set the owning side to null (unless already changed)
            if ($motorUnit->getCarrier() === $this) {
                $motorUnit->setCarrier(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TrainService[]
     */
    public function getTrainServices(): Collection
    {
        return $this->trainServices;
    }

    public function addTrainService(TrainService $trainService): self
    {
        if (!$this->trainServices->contains($trainService)) {
            $this->trainServices[] = $trainService;
            $trainService->setCarrier($this);
        }

        return $this;
    }

    public function removeTrainService(TrainService $trainService): self
    {
        if ($this->trainServices->contains($trainService)) {
            $this->trainServices->removeElement($trainService);
            // set the owning side to null (unless already changed)
            if ($trainService->getCarrier() === $this) {
                $trainService->setCarrier(null);
            }
        }

        return $this;
    }
}
