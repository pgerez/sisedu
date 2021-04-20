<?php

namespace App\Repository;

use App\Entity\Regimen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Regimen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Regimen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Regimen[]    findAll()
 * @method Regimen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegimenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Regimen::class);
    }

    // /**
    //  * @return Regimen[] Returns an array of Regimen objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Regimen
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
