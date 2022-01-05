<?php

namespace App\Repository;

use App\Entity\Escala;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Escala|null find($id, $lockMode = null, $lockVersion = null)
 * @method Escala|null findOneBy(array $criteria, array $orderBy = null)
 * @method Escala[]    findAll()
 * @method Escala[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EscalaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Escala::class);
    }

    // /**
    //  * @return Escala[] Returns an array of Escala objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Escala
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
