<?php

namespace App\Repository;

use App\Entity\Anio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Anio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Anio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Anio[]    findAll()
 * @method Anio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Anio::class);
    }

    // /**
    //  * @return Anio[] Returns an array of Anio objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Anio
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
