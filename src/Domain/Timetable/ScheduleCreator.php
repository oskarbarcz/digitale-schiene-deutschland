<?php declare(strict_types=1);

namespace App\Domain\Timetable;


use App\Entity\Explicit\ScheduleDataHolder;
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
    public static function createFromStub(ScheduleDataHolder $scheduleDataHolder): Schedule
    {
        return new Schedule();
    }

    /**
     * @param Station[] $stations
     * @param string    $relation
     * @return Schedule
     */
    public static function createFromRaw(array $stations, string $relation): Schedule
    {
        return new Schedule();
    }
}
