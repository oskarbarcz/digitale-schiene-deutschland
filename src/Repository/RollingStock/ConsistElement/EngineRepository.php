<?php declare(strict_types=1);

namespace App\Repository\RollingStock\ConsistElement;

use App\Entity\RollingStock\ConsistElement\Engine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Engine|null find($id, $lockMode = null, $lockVersion = null)
 * @method Engine|null findOneBy(array $criteria, array $orderBy = null)
 * @method Engine[]    findAll()
 * @method Engine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EngineRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Engine::class);
    }
}
