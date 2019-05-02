<?php

namespace App\Repository\Explicit;

use App\Entity\Explicit\TrainService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TrainService|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrainService|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrainService[]    findAll()
 * @method TrainService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrainServiceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TrainService::class);
    }

    // /**
    //  * @return TrainService[] Returns an array of TrainService objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TrainService
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
