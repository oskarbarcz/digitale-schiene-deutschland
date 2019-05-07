<?php

namespace App\Repository\Schedule;

use App\Entity\Schedule\ScheduleDataHolder;
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
}
