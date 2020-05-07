<?php

namespace App\Repository;

use App\Entity\VehicleMileage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VehicleMileage|null find($id, $lockMode = null, $lockVersion = null)
 * @method VehicleMileage|null findOneBy(array $criteria, array $orderBy = null)
 * @method VehicleMileage[]    findAll()
 * @method VehicleMileage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleMileageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VehicleMileage::class);
    }

    // /**
    //  * @return VehicleMileage[] Returns an array of VihicleMileage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VehicleMileage
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
