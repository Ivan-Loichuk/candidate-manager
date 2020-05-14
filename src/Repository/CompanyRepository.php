<?php

namespace App\Repository;

use App\Entity\Company;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Company|null find($id, $lockMode = null, $lockVersion = null)
 * @method Company|null findOneBy(array $criteria, array $orderBy = null)
 * @method Company[]    findAll()
 * @method Company[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class);
    }

    /**
     * @param string|null $term
     * @return QueryBuilder
     */
    public function getWithSearchQueryBuilder(?string $term): QueryBuilder
    {
        $qb = $this->createQueryBuilder('c');

        if ($term) {
            $qb->andWhere('LOWER(c.name) LIKE :term OR c.id = :id')
                ->setParameter('term', '%' . strtolower($term) . '%')
                ->setParameter('id', (int) $term)
            ;
        }

        return $qb;
    }

    /**
     * @param int $company_id
     * @return bool
     */
    public function hasEmployees(int $company_id): bool
    {
        if (!$company_id) {
            return false;
        }

        $qb = $this->createQueryBuilder('c')
            ->innerJoin('c.employee', 'e')
            ->where('c.id = :company_id')
            ->setParameter('company_id', $company_id)
            ->setMaxResults(1);

        $query = $qb->getQuery();

        return (int) count($query->getResult());
    }

    // /**
    //  * @return Company[] Returns an array of Company objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Company
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
