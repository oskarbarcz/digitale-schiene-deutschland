<?php declare(strict_types=1);

namespace App\Services\EntityServices;


use App\Entity\Infrastructure\TrackObject;
use App\Exceptions\NotFound\TrackObjectNotFoundException as NotFound;
use App\Repository\Infrastructure\TrackObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * TrackObjectService
 *
 * @package App\Services\EntityServices
 */
class TrackObjectService
{

    protected const MESSAGE_NOT_FOUND = 'track-object.not-found';
    /** @var EntityManagerInterface */
    protected $entityManager;
    /** @var TrackObjectRepository */
    protected $trackObjectRepository;

    /**
     * Assigns data from arguments as class fields
     *
     * @param TrackObjectRepository  $trackObjectRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(TrackObjectRepository $trackObjectRepository, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->trackObjectRepository = $trackObjectRepository;
    }

    /**
     * Facade to get all track objects
     *
     * @return TrackObject[]
     */
    public function getAll(): array
    {
        return $this->trackObjectRepository->findAll();
    }

    /**
     * Adds a track object by it's contraints
     */
    public function add()
    {
    }

    /**
     * Edits a track object by it's constraints
     */
    public function edit()
    {
    }

    /**
     * Deletes an object
     *
     * @param int $id
     * @throws NotFound
     */
    public function delete(int $id): void
    {
        $object = $this->get($id);
        $this->entityManager->remove($object);
    }

    /**
     * Gets track object by Id
     *
     * @param int $id
     * @return TrackObject
     * @throws NotFound
     */
    public function get(int $id): TrackObject
    {
        $object = $this->trackObjectRepository->find($id);
        if (!$object instanceof TrackObject) {
            throw new NotFound(self::MESSAGE_NOT_FOUND);
        }
        return $object;
    }

    /**
     * Runs on object destruction
     */
    public function __destruct()
    {
        $this->entityManager->flush();
    }
}
