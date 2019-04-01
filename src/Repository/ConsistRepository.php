<?php

namespace App\Repository;

use App\Entity\Consist;
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

    // /**
    //  * @return Consist[] Returns an array of Consist objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Consist
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
