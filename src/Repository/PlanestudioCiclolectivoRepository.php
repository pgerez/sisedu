<?php

namespace App\Repository;

use App\Entity\PlanestudioCiclolectivo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PlanestudioCiclolectivo|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanestudioCiclolectivo|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanestudioCiclolectivo[]    findAll()
 * @method PlanestudioCiclolectivo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanestudioCiclolectivoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanestudioCiclolectivo::class);
    }

    // /**
    //  * @return PlanestudioCiclolectivo[] Returns an array of PlanestudioCiclolectivo objects
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
    public function findOneBySomeField($value): ?PlanestudioCiclolectivo
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
