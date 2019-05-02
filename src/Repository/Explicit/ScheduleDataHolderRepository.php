<?php

namespace App\Repository\Explicit;

use App\Entity\Explicit\ScheduleDataHolder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ScheduleDataHolder|null find($id, $lockMode = null, $lockVersion = null)
 * @method ScheduleDataHolder|null findOneBy(array $criteria, array $orderBy = null)
 * @method ScheduleDataHolder[]    findAll()
 * @method ScheduleDataHolder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScheduleDataHolderRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ScheduleDataHolder::class);
    }

    // /**
    //  * @return ScheduleDataHolder[] Returns an array of ScheduleDataHolder objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ScheduleDataHolder
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
