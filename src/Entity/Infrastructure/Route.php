<?php

namespace App\Entity\Infrastructure;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Infrastructure\RouteRepository")
 */
class Route
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $kbs;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $stationsName;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKbs(): ?int
    {
        return $this->kbs;
    }

    public function setKbs(int $kbs): self
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

    public function setStationsName(string $stationsName): self
    {
        $this->stationsName = $stationsName;

        return $this;
    }
}
