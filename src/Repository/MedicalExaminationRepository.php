<?php

namespace App\Repository;

use App\Entity\MedicalExamination;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MedicalExamination|null find($id, $lockMode = null, $lockVersion = null)
 * @method MedicalExamination|null findOneBy(array $criteria, array $orderBy = null)
 * @method MedicalExamination[]    findAll()
 * @method MedicalExamination[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicalExaminationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MedicalExamination::class);
    }

    // /**
    //  * @return MedicalExamination[] Returns an array of MedicalExamination objects
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
    public function findOneBySomeField($value): ?MedicalExamination
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
