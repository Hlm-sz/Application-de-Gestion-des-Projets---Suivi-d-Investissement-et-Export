<?php

namespace App\Repository;

use App\Entity\Canal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Canal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Canal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Canal[]    findAll()
 * @method Canal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CanalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Canal::class);
    }

    // /**
    //  * @return Canal[] Returns an array of Canal objects
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
    public function findOneBySomeField($value): ?Canal
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

        
    public function listCanal(CanalRepository $CanalRp) {
        return $CanalRp->createQueryBuilder('c')
        ->orderBy('c.nom', 'ASC')
        //->setMaxResults(2)
        ; 
     } 

     public static function listCanal2(CanalRepository $CanalRp) {
        return $CanalRp->createQueryBuilder('c')
        ->orderBy('c.nom', 'ASC')
        ->setMaxResults(2)
        ; 
     }

     public function CanalList(CanalRepository $CanalRp) {
        return $CanalRp->createQueryBuilder('c')
        ->andWhere('c.parent IS NULL' )
        ->andWhere('c.active = :bol')
        ->setParameter('bol', 1 )
        ->orderBy('c.sorting', 'ASC')
        //->setMaxResults(2)
        ; 
     } 

     public function CanalSocNet(CanalRepository $CanalRp) {
        return $CanalRp->createQueryBuilder('c')
        ->andWhere('c.parent = :val' )
        ->setParameter('val', 17 )
        ->andWhere('c.active = :bol')
        ->setParameter('bol', 1 )
        ->orderBy('c.sorting', 'ASC')
        //->setMaxResults(2)
        ; 
     }

     
        
}
