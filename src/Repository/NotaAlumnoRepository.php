<?php

namespace App\Repository;

use App\Entity\NotaAlumno;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NotaAlumno|null find($id, $lockMode = null, $lockVersion = null)
 * @method NotaAlumno|null findOneBy(array $criteria, array $orderBy = null)
 * @method NotaAlumno[]    findAll()
 * @method NotaAlumno[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotaAlumnoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NotaAlumno::class);
    }

    // /**
    //  * @return NotaAlumno[] Returns an array of NotaAlumno objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findByCodmateriaCursoPlanYearAlumno($col0,$col1,$col2,$col3,$col13)
      {
          return $this->createQueryBuilder('na')
            ->Join('na.alumno', 'al', 'WITH', 'na.alumno = al.id')
            ->Join('na.notaId', 'n', 'WITH', 'n.id = na.notaId')
            ->Join('n.materiaaula', 'm', 'WITH', 'n.materiaaula = m.id')
            ->Join('m.aniomateria', 'am', 'WITH', 'am.id = m.aniomateria')
            ->Join('m.aula', 'a', 'WITH', 'a.id = m.aula')
            ->Join('a.anio', 'an', 'WITH', 'an.id = a.anio')
            ->Join('a.ciclolectivo', 'c', 'WITH', 'c.id = a.ciclolectivo')
            ->Join('an.planestudio', 'p', 'WITH', 'p.id = an.planestudio')
            ->andWhere('am.codigo = :codmateria')
            ->andWhere('a.numero = :curso')
            ->andWhere('p.codigo = :plan')
            ->andWhere('c.year = :year')
            ->andWhere('al.dni = :dni')
            ->setParameter('dni', $col0)
            ->setParameter('codmateria', $col1)
            ->setParameter('curso', $col2)
            ->setParameter('plan', $col3)
            ->setParameter('year', $col13)
            ->getQuery()
            ->getResult()
          ;
      }
    

    /*
    public function findOneBySomeField($value): ?NotaAlumno
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
