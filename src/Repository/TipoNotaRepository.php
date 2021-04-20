<?php

namespace App\Repository;

use App\Entity\TipoNota;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoNota|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoNota|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoNota[]    findAll()
 * @method TipoNota[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoNotaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoNota::class);
    }

    // /**
    //  * @return TipoNota[] Returns an array of TipoNota objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipoNota
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
