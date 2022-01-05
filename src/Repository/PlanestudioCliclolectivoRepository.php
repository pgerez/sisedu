<?php

namespace App\Repository;

use App\Entity\PlanestudioCliclolectivo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PlanestudioCliclolectivo|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanestudioCliclolectivo|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanestudioCliclolectivo[]    findAll()
 * @method PlanestudioCliclolectivo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanestudioCliclolectivoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanestudioCliclolectivo::class);
    }

    // /**
    //  * @return PlanestudioCliclolectivo[] Returns an array of PlanestudioCliclolectivo objects
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
    public function findOneBySomeField($value): ?PlanestudioCliclolectivo
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
