<?php

namespace App\Entity\Explicit;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Explicit\TrainServiceRepository")
 */
class TrainService
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Explicit\Carrier", inversedBy="trainServices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $carrier;

    public function getId(): ?int
    {
        return $this->id;
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
}
