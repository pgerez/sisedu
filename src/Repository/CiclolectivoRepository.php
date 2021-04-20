<?php

namespace App\Repository;

use App\Entity\Ciclolectivo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ciclolectivo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ciclolectivo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ciclolectivo[]    findAll()
 * @method Ciclolectivo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CiclolectivoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ciclolectivo::class);
    }

    // /**
    //  * @return Ciclolectivo[] Returns an array of Ciclolectivo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ciclolectivo
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
