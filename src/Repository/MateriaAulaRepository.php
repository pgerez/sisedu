<?php

namespace App\Repository;

use App\Entity\MateriaAula;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MateriaAula|null find($id, $lockMode = null, $lockVersion = null)
 * @method MateriaAula|null findOneBy(array $criteria, array $orderBy = null)
 * @method MateriaAula[]    findAll()
 * @method MateriaAula[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MateriaAulaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MateriaAula::class);
    }

    // /**
    //  * @return MateriaAula[] Returns an array of MateriaAula objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MateriaAula
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
