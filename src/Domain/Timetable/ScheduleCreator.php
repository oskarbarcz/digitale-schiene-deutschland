<?php declare(strict_types=1);

namespace App\Domain\Timetable;


use App\Entity\Infrastructure\Station;

/**
 * TimetableCreator
 *
 * @package App\Domain\Timetable
 */
class ScheduleCreator
{

    /**
     * @param Station[] $stations
     * @return Schedule
     */
    public static function createFromGlobals(array $stations): Schedule
    {


        return new Schedule();
    }
}
