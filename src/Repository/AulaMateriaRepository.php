<?php

namespace App\Repository;

use App\Entity\AulaMateria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AulaMateria|null find($id, $lockMode = null, $lockVersion = null)
 * @method AulaMateria|null findOneBy(array $criteria, array $orderBy = null)
 * @method AulaMateria[]    findAll()
 * @method AulaMateria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AulaMateriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AulaMateria::class);
    }

    // /**
    //  * @return AulaMateria[] Returns an array of AulaMateria objects
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
    public function findOneBySomeField($value): ?AulaMateria
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
