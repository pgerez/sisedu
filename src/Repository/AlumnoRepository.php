<?php

namespace App\Repository;

use App\Entity\Alumno;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Alumno|null find($id, $lockMode = null, $lockVersion = null)
 * @method Alumno|null findOneBy(array $criteria, array $orderBy = null)
 * @method Alumno[]    findAll()
 * @method Alumno[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlumnoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Alumno::class);
    }

     /**
      * @return Alumno[] Returns an array of Alumno objects
      */
    
    public function findDni($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.dni = :val')
            ->setParameter('val', $value)
            #->orderBy('a.id', 'ASC')
            #->setMaxResults(10)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Alumno
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
