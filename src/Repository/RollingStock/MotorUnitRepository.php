<?php

namespace App\Repository\RollingStock;

use App\Entity\RollingStock\MotorUnit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MotorUnit|null find($id, $lockMode = null, $lockVersion = null)
 * @method MotorUnit|null findOneBy(array $criteria, array $orderBy = null)
 * @method MotorUnit[]    findAll()
 * @method MotorUnit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MotorUnitRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MotorUnit::class);
    }
}
