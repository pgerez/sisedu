<?php

namespace App\Repository;

use App\Entity\Aula;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Aula|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aula|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aula[]    findAll()
 * @method Aula[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AulaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aula::class);
    }

     /**
      * @return Aula[] Returns an array of Aula objects
      */
    
    public function findByCiclolectivo()
    {
        return $this->createQueryBuilder('a')
            ->join('a.ciclolectivo',  'c','WITH','a.ciclolectivo = c.id')
            #->join('a.seccion',  's','WITH','a.seccion = s.id')
            ->andWhere('c.activo = 1')
            ->orderBy('a.numero, a.seccion', 'ASC')
            #->orderBy('a.seccion', 'ASC')
            #->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Aula
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
