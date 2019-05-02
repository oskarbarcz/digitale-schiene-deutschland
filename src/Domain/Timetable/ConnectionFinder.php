<?php declare(strict_types=1);

namespace App\Domain\Timetable;


use App\Entity\Explicit\Connection;
use App\Entity\Infrastructure\Station;

/**
 * ConnectionFinder
 *
 * @package App\Domain\Timetable
 */
class ConnectionFinder
{
    /**
     * @param Station $stationA
     * @param Station $stationB
     * @return Connection
     */
    public static function find(Station $stationA, Station $stationB): Connection
    {
        return new Connection();
    }
}
