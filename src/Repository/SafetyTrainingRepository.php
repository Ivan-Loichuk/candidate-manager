<?php

namespace App\Repository;

use App\Entity\SafetyTraining;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SafetyTraining|null find($id, $lockMode = null, $lockVersion = null)
 * @method SafetyTraining|null findOneBy(array $criteria, array $orderBy = null)
 * @method SafetyTraining[]    findAll()
 * @method SafetyTraining[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SafetyTrainingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SafetyTraining::class);
    }

    // /**
    //  * @return SafetyTraining[] Returns an array of SafetyTraining objects
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
    public function findOneBySomeField($value): ?SafetyTraining
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
