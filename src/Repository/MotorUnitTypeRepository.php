<?php

namespace App\Repository;

use App\Entity\MotorUnitType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MotorUnitType|null find($id, $lockMode = null, $lockVersion = null)
 * @method MotorUnitType|null findOneBy(array $criteria, array $orderBy = null)
 * @method MotorUnitType[]    findAll()
 * @method MotorUnitType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MotorUnitTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MotorUnitType::class);
    }

    // /**
    //  * @return MotorUnitType[] Returns an array of MotorUnitType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MotorUnitType
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
