<?php declare(strict_types=1);

namespace App\Entity\Abstracts;

use App\Entity\Explicit\Carrier;

interface ConsistInterface
{
    /**
     * @return int entityID
     */
    public function getId(): ?int;

    /**
     * @return string consist name
     */
    public function getName(): ?string;

    /**
     * @return Carrier
     */
    public function getCarrier(): ?Carrier;

    /**
     * @return int continuous output in megawats
     */
    public function getContinuousOutput(): ?int;
}
