<?php

namespace App\Repository;

use App\Entity\AnioMateria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AnioMateria|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnioMateria|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnioMateria[]    findAll()
 * @method AnioMateria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnioMateriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnioMateria::class);
    }

    // /**
    //  * @return AnioMateria[] Returns an array of AnioMateria objects
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
    public function findOneBySomeField($value): ?AnioMateria
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
