<?php

namespace App\Repository;

use App\Entity\Birthplace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Birthplace|null find($id, $lockMode = null, $lockVersion = null)
 * @method Birthplace|null findOneBy(array $criteria, array $orderBy = null)
 * @method Birthplace[]    findAll()
 * @method Birthplace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BirthplaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Birthplace::class);
    }

    // /**
    //  * @return Birthplace[] Returns an array of Birthplace objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Birthplace
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
