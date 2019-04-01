<?php declare(strict_types=1);

namespace App\Entity\Abstracts;

use App\Entity\Explicit\Carrier;
use App\Entity\Explicit\Producer;

interface ConsistInterface
{
    /**
     * @return int entityID
     */
    public function getId(): ?int;

    /**
     * @return string consist name
     */
    public function getName(): string;

    /**
     * @return Carrier
     */
    public function getCarrier(): ?Carrier;

    /**
     * @return Producer
     */
    public function getProducer(): ?Producer;

    /**
     * @return int continuous output in megawats
     */
    public function getContinuousOutput(): int;
}
