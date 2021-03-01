<?php

namespace App\Repository;

use App\Entity\CategoryReunion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategoryReunion|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryReunion|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryReunion[]    findAll()
 * @method CategoryReunion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryReunionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryReunion::class);
    }

    // /**
    //  * @return CategoryReunion[] Returns an array of CategoryReunion objects
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
    public function findOneBySomeField($value): ?CategoryReunion
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
