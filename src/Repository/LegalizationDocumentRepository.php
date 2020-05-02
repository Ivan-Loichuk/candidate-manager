<?php

namespace App\Repository;

use App\Entity\LegalizationDocument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LegalizationDocument|null find($id, $lockMode = null, $lockVersion = null)
 * @method LegalizationDocument|null findOneBy(array $criteria, array $orderBy = null)
 * @method LegalizationDocument[]    findAll()
 * @method LegalizationDocument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LegalizationDocumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LegalizationDocument::class);
    }

    // /**
    //  * @return LegalizationDocument[] Returns an array of LegalizationDocument objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LegalizationDocument
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
