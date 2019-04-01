<?php

namespace App\Repository;

use App\Entity\Wagon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Wagon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wagon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wagon[]    findAll()
 * @method Wagon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WagonRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Wagon::class);
    }

    // /**
    //  * @return Wagon[] Returns an array of Wagon objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Wagon
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
