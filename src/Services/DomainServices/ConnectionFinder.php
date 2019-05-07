<?php declare(strict_types=1);

namespace App\Services\DomainServices;

use App\Entity\Explicit\Connection;
use App\Entity\Infrastructure\Station;
use App\Exceptions\NotFound\ConnectionNotFoundException as NotFound;
use App\Repository\Explicit\ConnectionRepository;

/**
 * Service that handles finding a connection
 *
 * @package App\Domain\Timetable
 */
class ConnectionFinder
{
    /** @var ConnectionRepository */
    protected $repository;

    /**
     * Assigns data from arguments as class fields
     *
     * @param ConnectionRepository $repository
     */
    public function __construct(ConnectionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Searches for connection between station A and station B
     *
     * @param Station $stationA
     * @param Station $stationB
     * @return Connection|null
     * @throws NotFound
     */
    public function findDirect(Station $stationA, Station $stationB): ?Connection
    {
        $connection = $this->repository->findOneBy(['stationA' => $stationA, 'stationB' => $stationB]);
        if (!$connection instanceof Connection) {
            throw new NotFound();
        }
        return $connection;
    }
}
