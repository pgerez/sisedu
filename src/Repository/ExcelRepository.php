<?php

namespace App\Repository;

use App\Entity\Excel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Excel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Excel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Excel[]    findAll()
 * @method Excel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExcelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Excel::class);
    }

     /**
      * @return Excel[] Returns an array of Excel objects
      * group by col13, col3, col2 order by col13, col3
      */
    
    public function findAnioEspCurso()
    {
        return $this->createQueryBuilder('e')
            ->select('e.col13, e.col3, e.col2')
            #->andWhere('e.exampleField = :val')
            #->setParameter('val', $value)
            ->groupBy('e.col13, e.col3, e.col2')
            ->orderBy('e.col13, e.col3', 'ASC')
            #->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findPrevias()
    {
        return $this->createQueryBuilder('e')
            #->select('e.col13, e.col3, e.col2')
            ->andWhere('e.col14 = 0')
            ->andWhere("e.col14 = ''")
            #->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findAlumnos($ciclo, $plan, $numero)
    {
        return $this->createQueryBuilder('e')
            ->select('e.col0')
            ->andWhere('e.col13 = :ciclo')
            ->andWhere('e.col3 = :plan')
            ->andWhere('e.col2 = :numero')
            ->setParameter('ciclo', $ciclo)
            ->setParameter('plan', $plan)
            ->setParameter('numero', $numero)
            ->groupBy('e.col0')
            #->orderBy('e.col13, e.col3', 'ASC')
            #->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByAlumnoMateriaYear($alumno, $codigo, $year)
    {
        return $this->createQueryBuilder('e')
            #->select('e.col0')
            ->andWhere('e.col0 = :dni')
            ->andWhere('e.col1 = :codigo')
            ->andWhere('e.col13 = :year')
            #->andWhere('e.col2 = :numero')
            ->setParameter('dni', $alumno)
            ->setParameter('codigo', $codigo)
            ->setParameter('year', $year)
            #->setParameter('numero', $numero)
            #->groupBy('e.col0')
            #->orderBy('e.col13, e.col3', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Excel
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
