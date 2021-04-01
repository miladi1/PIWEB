<?php

namespace App\Repository;

use App\Entity\Employeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Employeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Employeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Employeur[]    findAll()
 * @method Employeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employeur::class);
    }
    function rech($data)
    {
        return $this->createQueryBuilder('employeur')
            ->Where('employeur.nom Like :nom')
            ->setParameter('nom', '%'.$data.'%')
            ->getQuery()->getResult();
    }
    function tri_asc()
    {
        return $this->createQueryBuilder('employeur')
            ->orderBy('employeur.nom ','ASC')
            ->getQuery()->getResult();
    }
    function tri_desc()
    {
        return $this->createQueryBuilder('employeur')
            ->orderBy('employeur.nom ','DESC')
            ->getQuery()->getResult();
    }
    function fin($data)
    {
        return $this->createQueryBuilder('employeur')
            ->Where('employeur.nom Like :nom')
            ->setParameter('nom', '%'.$data.'%')
            ->getQuery()->getResult();
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
