<?php declare(strict_types=1);

namespace App\Domain\Timetable;


use App\DTO\RailVehicle;
use App\Entity\Explicit\ScheduleDataHolder;
use App\Entity\Explicit\TrainService;
use App\Entity\Infrastructure\Route;
use App\Entity\Infrastructure\Station;

/**
 * Creates complete and valid schedule object
 *
 * @package App\Domain\Timetable
 */
final class ScheduleCreator
{
    /**
     * Private constructor to prevent object creation
     */
    private function __construct()
    {
    }

    /**
     * @param ScheduleDataHolder $scheduleDataHolder
     * @return Schedule
     */
    public static function createFromStub(ScheduleDataHolder $scheduleDataHolder, RailVehicle $railVehicle): Schedule
    {
        return new Schedule();
    }

    /**
     * @param Station[]    $stations
     * @param string       $relation
     * @param RailVehicle  $railVehicle
     * @param Route        $route
     * @param TrainService $trainService
     * @return Schedule
     */
    public static function createFromRaw(
        array $stations,
        string $relation,
        RailVehicle $railVehicle,
        Route $route,
        TrainService $trainService
    ): Schedule {


        return new Schedule();
    }
}
