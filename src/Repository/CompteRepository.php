<?php

namespace App\Repository;

use App\Entity\Compte;
use App\FiltreData\CompteFiltre;
use App\FiltreData\PartenaireFiltre;
use App\Utils\Doctrine\Selector\FactorySelector;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;
 

/**
 * @method Compte|null find($id, $lockMode = null, $lockVersion = null)
 * @method Compte|null findOneBy(array $criteria, array $orderBy = null)
 * @method Compte[]    findAll()
 * @method Compte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteRepository extends ServiceEntityRepository
{
    private $user;
    private $selection;
    public function __construct(ManagerRegistry $registry, Security $user, FactorySelector $selection)
    {
        $this->user = $user->getUser();
        $this->selection = $selection;
        parent::__construct($registry, Compte::class);
    }

    // /**
    //  * @return Compte[] Returns an array of Compte objects
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
    public function findOneBySomeField($value): ?Compte
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /* public function getListsSecteurs($list)
    {
        //$listIds = $this->selection->getListIds('Secteur', 'JSS', array('sss' => 'ss'));
        // dd($listIds);
        //  dd($this->user->getUser()->getSecteurs());
        $qb = $this->createQueryBuilder('c')
            ->select('c.id as compte,s.id as secteur,u.id as user');
        $qb->join('c.responsableCompte', 'u');
        $qb->join('c.secteurs', 's');
        $this->liste('v1', 's', $qb);
        return  $qb
            ->getQuery()
            ->execute();
    }

    public function liste($alise, $acces, &$qb)
    {
        $type_selection = 1;
        if ($type_selection == '1') {
            $qb->andWhere('u.id = :val')
                ->setParameter('val', $this->user->getId());
        } else if ($type_selection == '2') {

            $qb->andWhere('s.id in( :val)')
                ->setParameter('val', 23);
        }
    }*/
    public function listsCompteBySeteurs(array $secteurs, int $id_table = null)
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c.id')
            ->join('c.secteurs', 's')
            ->andWhere('s.id in (:secteurs)')
            ->setParameter('secteurs', $secteurs);
        if ($id_table) {
            $qb->andWhere('c.id = :id_compte')
                ->setParameter('id_compte', $id_table);
        }
        return $qb->groupBy('c.id')
            ->getQuery()
            ->getResult();
    }



    public function findByName($value)
      {
          return $this->createQueryBuilder('c')
              ->andWhere('c.nomCompte like :val')
              ->setParameter('val', "%".$value."%")
              ->getQuery()
              ->getResult()
          ;
      }

    public function comptesSup3Month()
    {
        return $this->createQueryBuilder('c')
            ->select('c.id,c.dateModification')
            ->andWhere("c.dateModification < :date")
            ->andWhere("c.etatCompte != 6")
            ->setParameter('date', new \DateTime('-3 month'))
            ->getQuery()
            ->getResult()
            ;
    }
    public function comptesSup30Month()
    {
        return $this->createQueryBuilder('c')
            ->select('c.id,c.dateModification')
            ->andWhere("c.dateModification < :date")
            ->andWhere("c.etatCompte != 6")
            ->setParameter('date', new \DateTime('-30 month'))
            ->getQuery()
            ->getResult()
            ;
    }
    public function countCompte()
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id) as count')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
    public function countComptebydate($date_debut,$date_fin)
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id) as count')
            ->andWhere('(c.dateCreation  > :date_debut and c.dateCreation  < :date_fin )')
            ->setParameter('date_debut',$date_debut)
            ->setParameter('date_fin',$date_fin)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function searchCompteByName($name)
    {
        return $this->createQueryBuilder('c')
            ->select('c.id,c.nomCompte')
            ->andWhere('c.nomCompte like :val')
            ->setParameter('val', "%".$name."%")
            ->getQuery()
            ->getResult()
            ;
    }
    public function listeCompteWhitName()
    {
        return $this->createQueryBuilder('c')
            ->select('c.id,c.nomCompte')
            ->getQuery()
            ->getResult()
            ;
    }

    public function getListsComptes($id=null,CompteFiltre $filtre)
    {
        // $listIds = $this->selection->getIdsListe('Compte', 'PAR_SECTEUR', array('sss' => 'ss'));
        $qb = $this->createQueryBuilder('c');
        $qb->join('c.responsableCompte', 'u');
        $qb->join('c.secteurs', 's');

        // if (!is_null($listIds)) {
        //     $qb->andWhere('c.id in (:ids)');
        //     $qb->setParameter('ids', $listIds);
        // }
        if($id){
            $qb->andWhere('s.id = :id_secteur');
            $qb->setParameter('id_secteur', $id);
        }
        
        if(!empty($filtre->search)){
            $qb->andWhere('c.nomCompte like :nomCompte');
            $qb->setParameter('nomCompte',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $qb->andWhere('c.etatCompte in (:status)');
            $qb->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $qb->andWhere('c.type in (:type)');
            $qb->setParameter('type',$filtre->type);
        }else{
            $qb->andWhere('c.type in (:type)');
            $qb->setParameter('type',array(1,2,3));
        }
        if(!empty($filtre->signalement)){
            $qb->andWhere('c.signalement = 1');
        }

        if(!empty($filtre->FiltregerePar)){
            $qb->andWhere('c.responsableCompte = :responsableCompte');
            $qb->setParameter('responsableCompte', $filtre->FiltregerePar);
        }
        if(!empty($filtre->categorie)){
            $categorie=$filtre->categorie==1?1:0;
            $qb->andWhere("c.categorie = :categorie");
            $qb->setParameter("categorie", $categorie);
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $qb->andwhere($qb->expr()->between('c.dateCreation', "?1", "?2"));
            $qb->setParameter('1', $from);
            $qb->setParameter('2', $to);
        }
        if(!empty($filtre->tri)){
            if($filtre->tri=='compte'){
                $qb->orderBy('c.nomCompte');
            }else{
                $qb->orderBy('c.dateCreation');
            }
        }else{
            $qb->orderBy('c.dateCreation');
        }
        $qb->andWhere('c.isDeleted = :isDeleted');
        $qb->setParameter('isDeleted', false);
        $qb->orderBy('c.dateCreation', 'DESC');
        $qb->groupBy('c.id');
        return  $qb
            ->getQuery()
            ->execute();
    }
    public function getListsPartenaires($id=null,PartenaireFiltre $filtre)
    {
       // $listIds = $this->selection->getIdsListe('Compte', 'PAR_SECTEUR', array('sss' => 'ss'));
       $qb = $this->createQueryBuilder('c');
       $qb->join('c.responsableCompte', 'u');
       $qb->join('c.secteurs', 's');
       $qb->leftjoin('c.compteData','dp');


       // if (!is_null($listIds)) {
       //     $qb->andWhere('c.id in (:ids)');
       //     $qb->setParameter('ids', $listIds);
       // }
       if($id){
           $qb->andWhere('s.id = :id_secteur');
           $qb->setParameter('id_secteur', $id);
       }
       if(!empty($filtre->type)){
        $qb->andWhere("dp.cle = 'TypePartenaire' and ( dp.value='$filtre->type')");
       }
       if(!empty($filtre->search)){
           $qb->andWhere('c.nomCompte like :nomCompte');
           $qb->setParameter('nomCompte',"%{$filtre->search}%");
       }
           $qb->andWhere('c.type in (:type)');
           $qb->setParameter('type',array(4));
        
       if(!empty($filtre->FiltregerePar)){
           $qb->andWhere('c.responsableCompte = :responsableCompte');
           $qb->setParameter('responsableCompte', $filtre->FiltregerePar);
       }
       if(!empty($filtre->startdate) && !empty($filtre->enddate)){
        $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
        $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
        $qb->andwhere($qb->expr()->between('c.dateCreation', "?1", "?2"));
        $qb->setParameter('1', $from);
        $qb->setParameter('2', $to);
    }
       if(!empty($filtre->tri)){
           if($filtre->tri=='compte'){
               $qb->orderBy('c.nomCompte');
           }else{
               $qb->orderBy('c.dateCreation');
           }
       }else{
           $qb->orderBy('c.dateCreation');
       }
      
       $qb->andWhere('c.isDeleted = :isDeleted');
       $qb->setParameter('isDeleted', false);
       $qb->orderBy('c.dateCreation', 'DESC');
       $qb->groupBy('c.id');
       return  $qb
           ->getQuery()
           ->execute();
   }

    public function getValueField($id,$name){
        $qb = $this->createQueryBuilder('c')
            ->select('dp.value')
            ->join('c.compteData','dp');
        $qb->andWhere('c.id = :id_compte');
        $qb->setParameter('id_compte', $id);
        $qb->andWhere('dp.cle = :cle');
        $qb->setParameter('cle', $name);
        return  $qb->getQuery()
            ->getOneOrNullResult()
            ;
    }
    public function getCompteslistea()
    {
        $qb = $this->createQueryBuilder('c');
        $qb->join('c.responsableCompte', 'u');
        $qb->join('c.secteurs', 's');
        $qb->andWhere('c.type in (:type)');
        $qb->setParameter('type',array(1,2,3));
        $qb->andWhere('c.isDeleted = :isDeleted');
        $qb->setParameter('isDeleted', false);
        $qb->orderBy('c.dateCreation', 'DESC');
        $qb->groupBy('c.id');
        return  $qb
            ->getQuery()
            ->execute();
    }
    public function getCompteslisteExp()
    {
        $qb = $this->createQueryBuilder('c');
        $qb->join('c.responsableCompte', 'u');
        $qb->join('c.secteurs', 's');
        $qb->andWhere('c.type in (:type)');
        $qb->setParameter('type',array(1));
        $qb->andWhere('c.isDeleted = :isDeleted');
        $qb->setParameter('isDeleted', false);
        $qb->orderBy('c.dateCreation', 'DESC');
        $qb->groupBy('c.id');
        return  $qb
            ->getQuery()
            ->execute();
    }
    public function getCompteslisteInv()
    {
        $qb = $this->createQueryBuilder('c');
        $qb->join('c.responsableCompte', 'u');
        $qb->join('c.secteurs', 's');
        $qb->andWhere('c.type in (:type)');
        $qb->setParameter('type',array(2));
        $qb->andWhere('c.isDeleted = :isDeleted');
        $qb->setParameter('isDeleted', false);
        $qb->orderBy('c.dateCreation', 'DESC');
        $qb->groupBy('c.id');
        return  $qb
            ->getQuery()
            ->execute();
    }
    public function getCompteslisteDo()
    {
        $qb = $this->createQueryBuilder('c');
        $qb->join('c.responsableCompte', 'u');
        $qb->join('c.secteurs', 's');
        $qb->andWhere('c.type in (:type)');
        $qb->setParameter('type',array(3));
        $qb->andWhere('c.isDeleted = :isDeleted');
        $qb->setParameter('isDeleted', false);
        $qb->orderBy('c.dateCreation', 'DESC');
        $qb->groupBy('c.id');
        return  $qb
            ->getQuery()
            ->execute();
    }
    public function getListsPartenairesEve()
    {
        $qb = $this->createQueryBuilder('c');
        $qb->join('c.responsableCompte', 'u');
        $qb->join('c.secteurs', 's');
        $qb->andWhere('c.type in (:type)');
        $qb->setParameter('type',array(4));
        $qb->andWhere('c.isDeleted = :isDeleted');
        $qb->setParameter('isDeleted', false);
        $qb->orderBy('c.dateCreation', 'DESC');
        $qb->groupBy('c.id');
        return  $qb
            ->getQuery()
            ->execute();
    }

    
    public function listRelais(CompteRepository $Rp)               // *mael* 
    {
        return $Rp->createQueryBuilder('c')
            ->andWhere('c.type = :val')
            ->setParameter('val', 4 )
            ->orderBy('c.id', 'ASC')
            //->setMaxResults(10)
            //->getQuery()
            //->getResult()
        ;
    }

}
