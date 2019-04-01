<?php

namespace App\Repository;

use App\Entity\Consisr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Consisr|null find($id, $lockMode = null, $lockVersion = null)
 * @method Consisr|null findOneBy(array $criteria, array $orderBy = null)
 * @method Consisr[]    findAll()
 * @method Consisr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsisrRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Consisr::class);
    }

    // /**
    //  * @return Consisr[] Returns an array of Consisr objects
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
    public function findOneBySomeField($value): ?Consisr
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
