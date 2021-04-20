<?php

namespace App\Repository;

use App\Entity\NotaAlumno;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NotaAlumno|null find($id, $lockMode = null, $lockVersion = null)
 * @method NotaAlumno|null findOneBy(array $criteria, array $orderBy = null)
 * @method NotaAlumno[]    findAll()
 * @method NotaAlumno[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotaAlumnoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NotaAlumno::class);
    }

    // /**
    //  * @return NotaAlumno[] Returns an array of NotaAlumno objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NotaAlumno
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
