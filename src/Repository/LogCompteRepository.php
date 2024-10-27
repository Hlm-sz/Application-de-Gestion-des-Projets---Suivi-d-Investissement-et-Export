<?php

namespace App\Repository;

use App\Entity\LogCompte;
use App\Entity\Compte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LogProjet|null find($id, $lockMode = null, $lockVersion = null)
 * @method LogProjet|null findOneBy(array $criteria, array $orderBy = null)
 * @method LogProjet[]    findAll()
 * @method LogProjet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogCompteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LogCompte::class);
    }

    // /**
    //  * @return LogProjet[] Returns an array of LogProjet objects
    //  */

    public function listLogsByCompte($id_compte)
    {
        return $this->createQueryBuilder('l')
            ->join('l.compte','c')
            ->andWhere('c.id = :id')
            ->setParameter('id', $id_compte)
            ->orderBy('l.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function findlistLogsByCompte($id_compte,$dateS,$dateE,$statu)
    {  
          
    $qb = $this->createQueryBuilder('l');
        $qb->join('l.compte','c');

        $qb->andWhere('c.id = :id');
        $qb->setParameter('id', $id_compte);
        
        if(!empty($statu)){
            $qb->andWhere('l.status like :status');
            $qb->setParameter('status',"%{$statu}%");
        }
        if(!empty($dateS)){
            $qb->andWhere('l.dateCreation BETWEEN :startdate AND :enddate ');
            $qb->setParameter('startdate', $dateS);
            $qb->setParameter('enddate', $dateE);
        }
         
        $qb->orderBy('l.id', 'DESC');

        return  $qb->getQuery()->execute();

    }


    /*
    public function findOneBySomeField($value): ?LogProjet
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
