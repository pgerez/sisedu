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

     /**
      * @return MateriaAula[] Returns an array of MateriaAula objects
      */
    
    public function findByCodmateriaCursoPlanYear($col1,$col2,$col3,$col13)
    {
        return $this->createQueryBuilder('m')
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
