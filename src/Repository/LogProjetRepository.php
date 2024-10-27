<?php

namespace App\Repository;

use App\Entity\LogProjet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LogProjet|null find($id, $lockMode = null, $lockVersion = null)
 * @method LogProjet|null findOneBy(array $criteria, array $orderBy = null)
 * @method LogProjet[]    findAll()
 * @method LogProjet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogProjetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LogProjet::class);
    }

    // /**
    //  * @return LogProjet[] Returns an array of LogProjet objects
    //  */

    public function listLogsByProjet($id_projet)
    {
        return $this->createQueryBuilder('l')
            ->join('l.projet','p')
            ->andWhere('p.id = :id')
            ->setParameter('id', $id_projet)
            ->orderBy('l.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function listLogsByProjetStatus($id_projet)
    {
        return $this->createQueryBuilder('l')
            ->join('l.projet','p')
            ->andWhere('p.id = :id')
            ->andWhere('l.status != :ai')
            ->andWhere('l.status != :ad')
            ->setParameter('id', $id_projet)
            ->setParameter('ai', "Action Intérêt")
            ->setParameter('ad', "Action Décision")
            ->orderBy('l.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function findlistLogsByProjet($id_compte,$dateS,$dateE,$statu)
    {  
          
    $qb = $this->createQueryBuilder('l');
        $qb->join('l.projet','p');

        $qb->andWhere('p.id = :id');
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
