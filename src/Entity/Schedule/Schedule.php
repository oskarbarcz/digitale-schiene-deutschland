<?php declare(strict_types=1);

namespace App\Entity\Schedule;

use App\DTO\RailVehicle;
use App\Entity\Explicit\TrainService;
use App\Entity\Infrastructure\Route;

/**
 * Object that has exactly all needed stuff for describing Schedule
 *
 * @package App\Domain\Timetable
 */
class Schedule
{
    /** @var Stop[] all stops on route */
    private $stops;

    /** @var TrainService */
    private $trainService;

    /** @var RailVehicle */
    private $railVehicle;

    /** @var Route */
    private $route;

    /** @var string */
    private $relationNumber;

    /**
     * @return Stop[]
     */
    public function getStops(): array
    {
        return $this->stops;
    }

    /**
     * @param Stop[] $stops
     * @return Schedule
     */
    public function setStops(array $stops): self
    {
        $this->stops = $stops;
        return $this;
    }

    /**
     * @return TrainService
     */
    public function getTrainService(): TrainService
    {
        return $this->trainService;
    }

    /**
     * @param TrainService $trainService
     * @return Schedule
     */
    public function setTrainService(TrainService $trainService): self
    {
        $this->trainService = $trainService;
        return $this;
    }

    /**
     * @return RailVehicle
     */
    public function getRailVehicle(): RailVehicle
    {
        return $this->railVehicle;
    }

    /**
     * @param RailVehicle $railVehicle
     * @return Schedule
     */
    public function setRailVehicle(RailVehicle $railVehicle): self
    {
        $this->railVehicle = $railVehicle;
        return $this;
    }

    /**
     * @return Route
     */
    public function getRoute(): Route
    {
        return $this->route;
    }

    /**
     * @param Route $route
     * @return Schedule
     */
    public function setRoute(Route $route): self
    {
        $this->route = $route;
        return $this;
    }

    /**
     * @return string
     */
    public function getRelationNumber(): string
    {
        return $this->relationNumber;
    }

    /**
     * @param string $relationNumber
     * @return Schedule
     */
    public function setRelationNumber(string $relationNumber): Schedule
    {
        $this->relationNumber = $relationNumber;
        return $this;
    }
}
