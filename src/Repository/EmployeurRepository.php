<?php

namespace App\Repository;

use App\Entity\Employeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method employeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method employeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method employeur[]    findAll()
 * @method employeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, employeur::class);
    }

    // /**
    //  * @return Employeur[] Returns an array of Employeur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Employeur
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
