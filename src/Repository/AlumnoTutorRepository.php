<?php

namespace App\Repository;

use App\Entity\AlumnoTutor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AlumnoTutor|null find($id, $lockMode = null, $lockVersion = null)
 * @method AlumnoTutor|null findOneBy(array $criteria, array $orderBy = null)
 * @method AlumnoTutor[]    findAll()
 * @method AlumnoTutor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlumnoTutorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AlumnoTutor::class);
    }

    // /**
    //  * @return AlumnoTutor[] Returns an array of AlumnoTutor objects
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
    public function findOneBySomeField($value): ?AlumnoTutor
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