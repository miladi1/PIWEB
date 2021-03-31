<?php

namespace App\Repository;

use App\Entity\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Evenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evenement[]    findAll()
 * @method Evenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementRepository extends ServiceEntityRepository
{
    function dempar($idevents)

    {


        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p.nombre_par
            FROM App\Entity\Evenement p
            WHERE p.id == :str'

        )->setParameter('str', $idevents);

        // returns an array of Product objects
        $e= $query->getResult();


    }
    function SearchNom($nsc)

    {
        return $this->createQueryBuilder('o')
            ->where ('o.titre LIKE :nom_entreprise')
            ->setParameter('nom_entreprise','%'.$nsc.'%')
            ->getQuery()->getResult();
        ;

    }

    public function findEntitiesByString($str)
    {

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Evenement p
            WHERE p.titre LIKE :str'

        )->setParameter('str', $str);

        // returns an array of Product objects
        return $query->getResult();
    }

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenement::class);
    }
    public function findok()
    {
        $Query=$this->getEntityManager()
            ->createQuery("SELECT l FROM App\Entity\Evenement l 
        ");

        return $Query->getResult();

    }
    // /**
    //  * @return Evenement[] Returns an array of Evenement objects
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
    public function findOneBySomeField($value): ?Evenement
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
