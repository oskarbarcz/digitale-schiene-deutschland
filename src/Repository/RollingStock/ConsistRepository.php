<?php declare(strict_types=1);

namespace App\Repository\RollingStock;

use App\Entity\RollingStock\Consist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Consist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Consist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Consist[]    findAll()
 * @method Consist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsistRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Consist::class);
    }
}
