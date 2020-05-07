<?php

namespace App\Repository;

use App\Entity\DelegationList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DelegationList|null find($id, $lockMode = null, $lockVersion = null)
 * @method DelegationList|null findOneBy(array $criteria, array $orderBy = null)
 * @method DelegationList[]    findAll()
 * @method DelegationList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DelegationListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DelegationList::class);
    }

    // /**
    //  * @return DelegationList[] Returns an array of DelegationList objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DelegationList
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
