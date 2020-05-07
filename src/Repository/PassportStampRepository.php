<?php

namespace App\Repository;

use App\Entity\PassportStamp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PassportStamp|null find($id, $lockMode = null, $lockVersion = null)
 * @method PassportStamp|null findOneBy(array $criteria, array $orderBy = null)
 * @method PassportStamp[]    findAll()
 * @method PassportStamp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PassportStampRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PassportStamp::class);
    }

    // /**
    //  * @return PassportStamp[] Returns an array of PassportStamp objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PassportStamp
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
