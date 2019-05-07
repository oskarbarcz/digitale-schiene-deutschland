<?php declare(strict_types=1);

namespace App\Domain\Timetable;


use App\Entity\Explicit\Connection;
use App\Entity\Infrastructure\Station;
use App\Repository\Explicit\ConnectionRepository;

/**
 * ConnectionFinder
 *
 * @package App\Domain\Timetable
 */
class ConnectionFinder
{
    /** @var ConnectionRepository */
    protected $repository;

    public function __construct(ConnectionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Station $stationA
     * @param Station $stationB
     * @return Connection|null
     */
    public function find(Station $stationA, Station $stationB): ?Connection
    {
        return $this->repository->findOneBy(['stationA' => $stationA, 'stationB' => $stationB]);
    }
}
