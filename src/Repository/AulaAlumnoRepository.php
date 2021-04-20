<?php

namespace App\Repository;

use App\Entity\AulaAlumno;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AulaAlumno|null find($id, $lockMode = null, $lockVersion = null)
 * @method AulaAlumno|null findOneBy(array $criteria, array $orderBy = null)
 * @method AulaAlumno[]    findAll()
 * @method AulaAlumno[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AulaAlumnoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AulaAlumno::class);
    }

    // /**
    //  * @return AulaAlumno[] Returns an array of AulaAlumno objects
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
    public function findOneBySomeField($value): ?AulaAlumno
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
