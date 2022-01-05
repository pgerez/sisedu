<?php

namespace App\Repository;

use App\Entity\Planestudio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Planestudio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Planestudio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Planestudio[]    findAll()
 * @method Planestudio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanestudioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Planestudio::class);
    }

    // /**
    //  * @return Planestudio[] Returns an array of Planestudio objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Planestudio
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
