<?php

namespace App\Repository;

use App\Entity\Biens;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Biens|null find($id, $lockMode = null, $lockVersion = null)
 * @method Biens|null findOneBy(array $criteria, array $orderBy = null)
 * @method Biens[]    findAll()
 * @method Biens[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BiensRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Biens::class);
    }

    /**
     * cette requete doit retourner les top bien
     */
    public function tophebergement($limit)
    {
        $req = $this->findAllBiens()
            ->orderBy('voter', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
        return $req;
    }

    /**
     * cette requete retourne toutes les valeurs des biens (annonce)
     */
    private function findAllBiens()
    {
        return $this->createQueryBuilder('b')
            ->SELECT('b as annonce, AVG(c.vote) as voter')
            ->join('b.reservers', 'r')
            ->join('r.commentaires', 'c')
            ->groupBy('b');
    }

    // /**
    //  * @return Biens[] Returns an array of Biens objects
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
    public function findOneBySomeField($value): ?Biens
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
