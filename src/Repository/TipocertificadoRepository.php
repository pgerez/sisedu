<?php

namespace App\Repository;

use App\Entity\Tipocertificado;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Tipocertificado|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tipocertificado|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tipocertificado[]    findAll()
 * @method Tipocertificado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipocertificadoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tipocertificado::class);
    }

    // /**
    //  * @return Tipocertificado[] Returns an array of Tipocertificado objects
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
    public function findOneBySomeField($value): ?Tipocertificado
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
