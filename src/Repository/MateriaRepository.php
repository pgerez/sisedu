<?php

namespace App\Repository;

use App\Entity\Materia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Materia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Materia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Materia[]    findAll()
 * @method Materia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MateriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Materia::class);
    }

    /**
     * @return Materia[] Returns an array of Materia objects
     */
   
    public function findNombre($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.nombre = :val')
            ->setParameter('val', $value)
            #->orderBy('m.id', 'ASC')
            #->setMaxResults(10)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
 

    /*
    public function findOneBySomeField($value): ?Materia
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
