<?php

namespace App\Repository;

use App\Entity\Event;
use App\FiltreData\EventFiltre;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    // /**
    //  * @return Event[] Returns an array of Event objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    
    public function findOneByid($value): ?Event
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function getAllsEvents()
    {
        $qb = $this->createQueryBuilder('e');
        $qb->orderBy('e.created_at', 'DESC');
        $qb->groupBy('e.id');
        $qb->groupBy('e.id');
        return  $qb
            ->getQuery()
            ->execute(); 
    }
    public function getListsEvents(EventFiltre $filtre)
    {
        $qb = $this->createQueryBuilder('e');
        if(!empty($filtre->search)){
            $qb->andWhere('e.nom like :nom');
            $qb->setParameter('nom',"%{$filtre->search}%");
        }
        if(!empty($filtre->typeEvenement)){
            $qb->andWhere('e.typeEvenement in (:status)');
            $qb->setParameter('status',json_encode($filtre->typeEvenement));
        }
        if(!empty($filtre->formatParticipation)){
            $qb->andWhere('e.formatParticipation like :type');
            $qb->setParameter('type',"%{$filtre->formatParticipation}%");
        }
        // if(!empty($filtre->startdate) && !empty($filtre->enddate)){
        //     $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
        //     $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
        //     $qb->andwhere($qb->expr()->between('e.created_at', "?1", "?2"));
        //     $qb->setParameter('1', $from);
        //     $qb->setParameter('2', $to);
        // }
        if(!empty($filtre->mois)){
            $qb->andWhere('e.mois like :mois');
            $qb->setParameter('mois',"%{$filtre->mois}%");
        }
        if(!empty($filtre->annee)){
            $qb->andWhere('e.annee like :annee');
            $qb->setParameter('annee',"%{$filtre->annee}%");
        }
        $qb->orderBy('e.created_at', 'DESC');
        $qb->groupBy('e.id');
        $qb->groupBy('e.id');
        return  $qb
            ->getQuery()
            ->execute();
    }
    public function countEvent()
    {
        return $this->createQueryBuilder('e')
            ->select('count(e.id) as count')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
    public function countEventbydate($date_debut,$date_fin)
    {
        return $this->createQueryBuilder('e')
            ->select('count(e.id) as count')
            ->andWhere('(e.created_at  > :date_debut and e.created_at  < :date_fin )')
            ->setParameter('date_debut',$date_debut)
            ->setParameter('date_fin',$date_fin)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
    public function findByComptes($compte)
    {
        $qb = $this->createQueryBuilder('e');
        $qb->where($qb->expr()->isMemberOf(':compte', 'e.comptes'));
    }

    public function ListEvent(String $value, EventRepository $Rp) {
        return $Rp->createQueryBuilder('c')
        ->andWhere('c.formatParticipation like :val' )
        ->setParameter('val', $value )
        ->orderBy('c.created_at', 'DESC')
        ->setMaxResults(10)
        ; 
     }
}
