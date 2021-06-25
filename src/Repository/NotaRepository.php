<?php

namespace App\Repository;

use App\Entity\Nota;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Nota|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nota|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nota[]    findAll()
 * @method Nota[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nota::class);
    }

     /**
      * @return Nota[] Returns an array of Nota objects
      */
    
    public function findByCodmateriaCursoPlanYear($col1,$col2,$col3,$col13)
    {
        return $this->createQueryBuilder('n')
            ->Join('n.materiaaula', 'm', 'WITH', 'm.id = n.materiaaula')
            ->Join('m.aniomateria', 'am', 'WITH', 'am.id = m.aniomateria')
            ->Join('m.aula', 'a', 'WITH', 'a.id = m.aula')
            ->Join('a.anio', 'an', 'WITH', 'an.id = a.anio')
            ->Join('a.ciclolectivo', 'c', 'WITH', 'c.id = a.ciclolectivo')
            ->Join('an.planestudio', 'p', 'WITH', 'p.id = an.planestudio')
            ->andWhere('am.codigo = :codmateria')
            ->andWhere('a.numero = :curso')
            ->andWhere('p.codigo = :plan')
            ->andWhere('c.year = :year')
            ->setParameter('codmateria', $col1)
            ->setParameter('curso', $col2)
            ->setParameter('plan', $col3)
            ->setParameter('year', $col13)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Nota
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
