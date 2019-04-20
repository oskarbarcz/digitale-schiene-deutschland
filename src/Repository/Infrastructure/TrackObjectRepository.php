<?php

namespace App\Repository\Infrastructure;

use App\Entity\Infrastructure\TrackObject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TrackObject|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrackObject|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrackObject[]    findAll()
 * @method TrackObject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrackObjectRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TrackObject::class);
    }

    // /**
    //  * @return TrackObject[] Returns an array of TrackObject objects
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
    public function findOneBySomeField($value): ?TrackObject
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
