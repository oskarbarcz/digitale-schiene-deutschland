<?php declare(strict_types=1);


namespace App\Services\EntityServices;


use App\Entity\Explicit\TrackObjectType as Type;
use App\Exceptions\NotFound\TrackObjectTypeNotFoundException as NotFound;
use App\Repository\Explicit\TrackObjectTypeRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * TrackObjectTypeService
 *
 * @package App\Services\EntityServices
 */
class TrackObjectTypeService
{
    public const TYPE_NOT_FOUND = 'type.not-found';
    /** @var TrackObjectTypeRepository */
    protected $trackObjectTypeRepository;
    /** @var EntityManagerInterface */
    protected $entityManager;

    /**
     * Assigns data from arguments as class fields
     *
     * @param TrackObjectTypeRepository $trackObjectTypeRepository
     * @param EntityManagerInterface    $entityManager
     */
    public function __construct(
        TrackObjectTypeRepository $trackObjectTypeRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->trackObjectTypeRepository = $trackObjectTypeRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * Facade function for getting all types
     *
     * @return Type[]
     */
    public function getAll(): array
    {
        return $this->trackObjectTypeRepository->findAll();
    }

    /**
     * Adds a type
     *
     * @param string $name
     * @param string $styleClass
     * @return Type
     */
    public function add(string $name, string $styleClass): Type
    {
        $type = new Type();
        $type->setName($name)
             ->setStyleClass($styleClass);

        $this->entityManager->persist($type);
        return $type;
    }

    /**
     * Edits a type
     *
     * @param int    $id
     * @param string $name
     * @param string $styleClass
     * @return Type
     * @throws NotFound
     */
    public function edit(int $id, string $name, string $styleClass): Type
    {
        $type = $this->get($id);
        $type->setName($name)
             ->setStyleClass($styleClass);

        $this->entityManager->persist($type);
        return $type;
    }

    /**
     * Gets one track object
     *
     * @param int $id
     * @return Type
     * @throws NotFound
     */
    public function get(int $id): Type
    {
        $type = $this->trackObjectTypeRepository->find($id);
        if (!$type instanceof Type) {
            throw new NotFound(self::TYPE_NOT_FOUND);
        }
        return $type;
    }

    /**
     * Deletes a type
     *
     * @param int $id
     * @throws NotFound
     */
    public function delete(int $id): void
    {
        $type = $this->get($id);
        $this->entityManager->remove($type);
    }

    /**
     * Flushes changes to database
     */
    public function __destruct()
    {
        $this->entityManager->flush();
    }
}
