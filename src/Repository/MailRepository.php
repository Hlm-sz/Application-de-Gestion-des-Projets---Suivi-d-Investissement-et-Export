<?php

namespace App\Repository;

use App\Entity\Mail;
use App\FiltreData\EmailFiltre;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Mail|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mail|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mail[]    findAll()
 * @method Mail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mail::class);
    }

    // /**
    //  * @return Mail[] Returns an array of Mail objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mail
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findSearch(EmailFiltre $filtre){

        $query= $this->createQueryBuilder('m')
            ->select('m')
            ->join('m.contact','c')
            ->join('c.carteVisites','cv')
            ->join('cv.compte','co')
            ->join('co.secteurs','s')
            ->join('co.paysSiege','p')
            ->join('co.events','e');

        if(!empty($filtre->contact)){
            $query->andWhere('c.id = :contact');
            $query->setParameter('contact',$filtre->contact);
        }
        if(!empty($filtre->pays)){
            $query->andWhere('p.id = :oopays');
            $query->setParameter('oopays',$filtre->pays);
        }
        if(!empty($filtre->secteur)){
            $query->andWhere('s.id = :oosecteur');
            $query->setParameter('oosecteur',$filtre->secteur);
        }
        if(!empty($filtre->event)){
            $query->andWhere('s.id = :ooevent');
            $query->setParameter('ooevent',$filtre->event);
        }

      return $query->getQuery()->getResult();
    }

    public function Contacts(EmailContactFiltre $filtre)
    {        
            $query=$this->createQueryBuilder('c')
            ->select('c');
            if(!empty($filtre->profil)){
                $query->andWhere('c.profil = :ooprofil');
                $query->setParameter('ooprofil',array($filtre->profil));}

            if(!empty($filtre->canal)){
                $query->andWhere('c.canal = :oocanal');
                $query->setParameter('oocanal',array($filtre->canal));
            }

            return $query->getQuery()->execute();
    }

    public function find_Email(EmailContactFiltre $filtre)
    {
            $query=$this->createQueryBuilder('c')
            ->select('c.email');
            if(!empty($filtre->canal)){
                $query->andWhere('c.canal = :oocanal');
                $query->setParameter('oocanal',$filtre->canal);
            }
            if(!empty($filtre->profil)){
                $query->andWhere('c.profil = :ooprofil');
                $query->setParameter('ooprofil',$filtre->profil);}

            return $query->getQuery()->execute();
    }

}
