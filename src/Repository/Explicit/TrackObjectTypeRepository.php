<?php

namespace App\Repository\Explicit;

use App\Entity\Explicit\TrackObjectType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TrackObjectType|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrackObjectType|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrackObjectType[]    findAll()
 * @method TrackObjectType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrackObjectTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TrackObjectType::class);
    }

    // /**
    //  * @return TrackObjectType[] Returns an array of TrackObjectType objects
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
    public function findOneBySomeField($value): ?TrackObjectType
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
