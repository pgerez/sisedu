<?php

namespace App\Repository;

use App\Entity\Certificado;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Certificado|null find($id, $lockMode = null, $lockVersion = null)
 * @method Certificado|null findOneBy(array $criteria, array $orderBy = null)
 * @method Certificado[]    findAll()
 * @method Certificado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CertificadoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Certificado::class);
    }

    /**
     * @return Certificado[] Returns an array of Certificado objects
     */
    
    public function findByCodigoDni($codigo, $dni)
    {
        return $this->createQueryBuilder('c')
            ->join('c.alumno',  'a','WITH','a.id = c.alumno')
            ->andWhere('c.codigo = :codigo')
            ->andWhere('a.dni = :dni')
            ->setParameter('codigo', $codigo)
            ->setParameter('dni', $dni)
            ->getQuery()
            ->getOneOrNullResult()
        ;

    }
    

    /*
    public function findOneBySomeField($value): ?Certificado
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
