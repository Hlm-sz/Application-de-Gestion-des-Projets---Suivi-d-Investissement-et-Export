<?php

namespace App\Repository;

use App\Entity\Partenaire;
use App\FiltreData\PartenaireFiltre;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Partenaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Partenaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Partenaire[]    findAll()
 * @method Partenaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartenaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Partenaire::class);
    }

    // /**
    //  * @return Partenaire[] Returns an array of Partenaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Partenaire
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findPartenaire(PartenaireFiltre $filtre)
    {
        
                    
            $query=$this->createQueryBuilder('p')
            ->select('p');
            if(!empty($filtre->search)){
                $query->andWhere('p.nom like :search');
                $query->setParameter('search',"%{$filtre->search}%");
            }
            // if(!empty($filtre->canal)){
            //     $query->andWhere('c.canal = :oocanal');
            //     $query->setParameter('oocanal',$filtre->canal);
            // }
            // if(!empty($filtre->profil)){
            //     $query->andWhere('c.profil = :ooprofil');
            //     $query->setParameter('ooprofil',$filtre->profil);

            // }
            // $query->andWhere('c.isArchived = :isDeleted');
            // $query->setParameter('isDeleted', false);
            
            return $query->getQuery()->execute();
            
    }

}
