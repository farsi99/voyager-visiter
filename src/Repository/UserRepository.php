<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * cette méthode traite les meilleurs hôte
     */
    public function bestHote($limit = 4)
    {
        $req = $this->createQueryBuilder('u')
            ->join('u.biens', 'b')
            ->join('b.reservers', 'r')
            ->join('r.commentaires', 'c')
            ->select('u as utilisateur, AVG(c.vote) as voter,COUNT(c) as somCmt')
            ->groupBy('u')
            ->having('somCmt >3')
            ->orderBy('voter', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
        return $req;
    }
}
