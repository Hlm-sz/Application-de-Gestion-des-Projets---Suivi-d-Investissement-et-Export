<?php

namespace App\Repository;

use App\Entity\Contact;
use App\FiltreData\EmailFiltre;
use App\FiltreData\ContactFiltre;
use App\FiltreData\EmailContactFiltre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;


/**
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
 class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    // /**
    //  * @return Contact[] Returns an array of Contact objects
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
    public function findOneBySomeField($value): ?Contact
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getContactByCompte($compte)
    {
        return $this->createQueryBuilder('c')
            ->join('c.carteVisites','v')
            ->join('v.compte','cm')
            ->andWhere('cm.id = :id_compte')
            ->setParameter('id_compte', $compte)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function contatSiteWebAmdie($secteurs)
    {
        return $this->createQueryBuilder('c')
            ->select('c.id,c.nom,c.prenom,c.detailsLibres')
            ->leftJoin('c.carteVisites','v')
            ->andWhere('c.canal = 4')
            ->andWhere('v.id is NULL')
            ->andWhere('c.detailsLibres like :secteurs')
            ->setParameter('secteurs',"%{$secteurs}%")
           // ->
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findContact(ContactFiltre $filtre)
    {
            $query=$this->createQueryBuilder('c')
            ->select('c');
            if(!empty($filtre->search)){
                $query->andWhere('c.id like :search');
                $query->setParameter('search',$filtre->search);
            }
            if(!empty($filtre->canal)){
                $query->andWhere('c.canal = :oocanal');
                $query->setParameter('oocanal',$filtre->canal);
            }
            if(!empty($filtre->profil)){
                $query->andWhere('c.profil = :ooprofil');
                $query->setParameter('ooprofil',$filtre->profil);

            }
            if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
                $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
                $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
                $query->andwhere($query->expr()->between('c.dateCreation', "?1", "?2"));
                $query->setParameter('1', $from);
                $query->setParameter('2', $to);
           }
            $query->andWhere('c.isArchived = :isDeleted');
            $query->setParameter('isDeleted', false);

            $query->orderBy('c.dateCreation', 'DESC');
            
             return $query->getQuery()->execute();

    }
    public function findNoExclusifContact(ContactFiltre $filtre)
    {
            $query=$this->createQueryBuilder('c')
            ->select('c');
            if(!empty($filtre->search)){
                $query->andWhere('c.id like :search');
                $query->setParameter('search',$filtre->search);
            }
            if(!empty($filtre->canal)){
                $query->andWhere('c.canal = :oocanal');
                $query->setParameter('oocanal',$filtre->canal);
            }
            if(!empty($filtre->profil)){
                $query->andWhere('c.profil = :ooprofil');
                $query->setParameter('ooprofil',$filtre->profil);

            }
            if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
                $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
                $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
                $query->andwhere($query->expr()->between('c.dateCreation', "?1", "?2"));
                $query->setParameter('1', $from);
                $query->setParameter('2', $to);
           }

           $query->andWhere('c.exclusif = :isExclusif');
           $query->setParameter('isExclusif', false);

            $query->andWhere('c.isArchived = :isDeleted');
            $query->setParameter('isDeleted', false);

            $query->orderBy('c.dateCreation', 'DESC');
            
             return $query->getQuery()->execute();

    }
    public function findExclusifContact(ContactFiltre $filtre,$user)
    {
            $query=$this->createQueryBuilder('c')
            ->select('c');
            if(!empty($filtre->search)){
                $query->andWhere('c.id like :search');
                $query->setParameter('search',$filtre->search);
            }
            if(!empty($filtre->canal)){
                $query->andWhere('c.canal = :oocanal');
                $query->setParameter('oocanal',$filtre->canal);
            }
            if(!empty($filtre->profil)){
                $query->andWhere('c.profil = :ooprofil');
                $query->setParameter('ooprofil',$filtre->profil);

            }
            if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
                $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
                $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
                $query->andwhere($query->expr()->between('c.dateCreation', "?1", "?2"));
                $query->setParameter('1', $from);
                $query->setParameter('2', $to);
           }

        //    $query->andWhere('c.exclusif = :isExclusif');
        //    $query->setParameter('isExclusif', false);

           $query->andWhere('c.cree_par = :user');
           $query->setParameter('user', $user);

            $query->andWhere('c.isArchived = :isDeleted');
            $query->setParameter('isDeleted', false);

            $query->orderBy('c.dateCreation', 'DESC');
            
             return $query->getQuery()->execute();

    }


    public function countContact()
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id) as count')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
    public function getContactNonExclusives()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exclusif = :Exclusif')
            ->setParameter('Exclusif', 0)
             ->getQuery()
            ->getResult()
        ;
    }

    public function Contacts(EmailFiltre $filtre)
   {
           $query=$this->createQueryBuilder('c');

           if(!empty($filtre->contact)){
               $query->andWhere('c.id = :contact');
               $query->setParameter('contact',$filtre->contact);
           }
        //    if(!empty($filtre->profil)){
        //        $query->andWhere('c.profil = :ooprofil');
        //        $query->setParameter('ooprofil',$filtre->profil);
        //    }
        //    if(!empty($filtre->canal)){
        //        $query->andWhere('c.canal = :oocanal');
        //        $query->setParameter('oocanal',$filtre->canal);
        //    }
        //    if(!empty($filtre->pays)){
        //        $query->andWhere('p.id = :oopays');
        //        $query->setParameter('oopays',$filtre->pays);
        //    }
           if(!empty($filtre->secteur)){
               $query->andWhere('s.id = :oosecteur');
               $query->setParameter('oosecteur',$filtre->secteur);
           }
        //    if(!empty($filtre->event)){
        //        $query->andWhere('s.id = :ooevent');
        //        $query->setParameter('ooevent',$filtre->event);
        //    }

           return $query->getQuery()->execute();
   }
   public function find_Email(EmailContactFiltre $filtre)
   {
           $query=$this->createQueryBuilder('c')
           ->select('c.email');
           if(!empty($filtre->profil)){
               $query->andWhere('c.profil = :ooprofil');
               $query->setParameter('ooprofil',$filtre->profil);
           }
           if(!empty($filtre->canal)){
               $query->andWhere('c.canal = :oocanal');
               $query->setParameter('oocanal',$filtre->canal);
           }

           return $query->getQuery()->execute();
   }

   public function find_Id(EmailContactFiltre $filtre)
   {
           $query=$this->createQueryBuilder('c')
           ->select('c.id');
           if(!empty($filtre->profil)){
               $query->andWhere('c.profil = :ooprofil');
               $query->setParameter('ooprofil',$filtre->profil);
           }
           if(!empty($filtre->canal)){
               $query->andWhere('c.canal = :oocanal');
               $query->setParameter('oocanal',$filtre->canal);
           }

           return $query->getQuery()->execute();
   }
}
