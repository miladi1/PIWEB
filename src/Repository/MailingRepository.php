<?php

namespace App\Repository;

use App\Entity\Mailing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mailing|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mailing|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mailing[]    findAll()
 * @method Mailing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MailingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mailing::class);
    }

    // /**
    //  * @return Mailing[] Returns an array of Mailing objects
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
    public function findOneBySomeField($value): ?Mailing
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    function SearchNom($nsc)

    {
return $this->createQueryBuilder('m')
->where (' m.email LIKE :email')
 ->setParameter('email','%'.$nsc.'%')
->getQuery()->getResult();
;




    


    }
}
