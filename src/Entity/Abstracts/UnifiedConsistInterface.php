<?php declare(strict_types=1);

namespace App\Entity\Abstracts;

interface UnifiedConsistInterface
{
    /**
     * @return int total weight in kilograms
     */
    public function getTotalWeight(): ?int;

    /**
     * @return float total weight in meters
     */
    public function getTotalLength(): ?float;

    /**
     * @return int maximum allowed speed in kilometer per hour
     */
    public function getMaxPermittedSpeed(): ?int;

    /**
     * @return int seats in all cars/wagons
     */
    public function getSeatsCount(): ?int;

    /**
     * @return int continuous output in megawats
     */
    public function getContinuousOutput(): ?int;
}
