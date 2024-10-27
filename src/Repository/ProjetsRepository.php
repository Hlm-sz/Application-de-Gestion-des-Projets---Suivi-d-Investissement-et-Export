<?php

namespace App\Repository;

use App\Entity\Projets;
use App\FiltreData\ProjetFiltre;
use App\FiltreData\ActionsPartenaires;
use App\Utils\Doctrine\Selector\FactorySelector;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\ProjectFactory;
use Symfony\Component\Security\Core\Security;

/**
 * @method Projets|null find($id, $lockMode = null, $lockVersion = null)
 * @method Projets|null findOneBy(array $criteria, array $orderBy = null)
 * @method Projets[]    findAll()
 * @method Projets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetsRepository extends ServiceEntityRepository
{
    private $user;
    private $selection;
    public function __construct(ManagerRegistry $registry, Security $user, FactorySelector $selection)
    {
        $this->user = $user->getUser();
        $this->selection = $selection;
        parent::__construct($registry, Projets::class);
    }

    // /**
    //  * @return Projets[] Returns an array of Projets objects
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
    public function findOneBySomeField($value): ?Projets
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


  public function getListeProjet($id=null,$search=null)
  {
      $listIds = $this->selection->getIdsListe('Compte', 'PAR_SECTEUR', array('sss' => 'ss'));
       $qb = $this->createQueryBuilder('p')
           ->select('p')
           ->join('p.compte', 'c')
           ->join('c.secteurs','s');

       if($search){
           $qb->where('( p.titre like :search )');
           $qb->setParameter('search', '%'.$search.'%');
       }
            if($id){
                $qb->andWhere('s.id = :id_secteur');
                $qb->setParameter('id_secteur', $id);
            }
           if (!is_null($listIds)) {
               $qb->andWhere('c.id in (:ids)');
               $qb->setParameter('ids', $listIds);
           }
        $qb->andWhere('p.isDeleted = :isDeleted');
        $qb->setParameter('isDeleted', false);
           return  $qb->getQuery()
          ->getResult()
      ;
  }
  
    public function listeProjetBysecteur($id,ProjetFiltre $filtre)
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p')
            ->join('p.compte', 'c')
            ->join('c.secteurs','s');
            
        $qb->join('p.typeProjet','t')
        ->join('p.etatProjet','e');
        

        if(!empty($filtre->confidentiel) || !empty($filtre->prioritaire)){
          $qb->join('p.projetsData','pd');
        }
        $qb->andWhere('p.isDeleted = :isDeleted');
        $qb->setParameter('isDeleted', false);
        $qb->andWhere('s.id = :id_secteur');
        $qb->setParameter('id_secteur', $id);

        if(!empty($filtre->search)){
            $qb->andWhere('p.titre like :title');
            $qb->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $qb->andWhere('e.id in (:status)');
            $qb->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $qb->andWhere('t.id in (:type)');
            $qb->setParameter('type',$filtre->type);
        }else{
            $qb->andWhere('p.type not in (:type)');
            $qb->setParameter('type',4);
        }
        if(!empty($id)){
            $qb->andWhere('s.id = :id_secteur');
            $qb->setParameter('id_secteur', $id);
        }

        if(!empty($filtre->gpac)){
            $qb->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->confidentiel)){
            $qb->andWhere("pd.cle = 'Confidentiel' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->prioritaire)){
            $qb->andWhere("pd.cle = 'Prioritaire' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->compte)){
          
            $qb->andWhere('c.nomCompte = :nomCompte');
            $qb->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->pays)){
            $qb->andWhere('c.paysSiege = :pays');
            $qb->setParameter('pays', $filtre->pays->getID());
        }
        if(!empty($filtre->FiltregerePar)){
            $qb->andWhere('p.gere_par = :gere_par');
            $qb->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $qb->andwhere($qb->expr()->between('p.date_creation', "?1", "?2"));
            $qb->setParameter('1', $from);
            $qb->setParameter('2', $to);
       }
       if(!empty($filtre->secteur)){
            $qb->andWhere('s.id = :id_secteur');
            $qb->setParameter('id_secteur', $filtre->secteur);
       }
       

        return  $qb->getQuery()
            ->getResult()
            ;
    }

    public function listeProjetBysecteurNewOrg($id,ProjetFiltre $filtre)
    {
        $qb = $this->createQueryBuilder('p')
        ->select('p')
        ->join('p.compte', 'c')
        ->join('p.projetsData','pd'); // mael change ++
        // ->join('c.secteurs','s'); // mael change ++
        
        $qb->join('p.typeProjet','t')
        ->join('p.etatProjet','e');
        
        // mael change ++
        $qb->andWhere('p.isDeleted = :isDeleted');
        $qb->setParameter('isDeleted', false);
        // if(!empty($filtre->confidentiel) || !empty($filtre->prioritaire)){
        //   $qb->join('p.projetsData','pd');
        // }
        // $qb->andWhere('p.isDeleted = :isDeleted');
        // $qb->setParameter('isDeleted', false);
        // $qb->andWhere('s.id = :id_secteur');
        // $qb->setParameter('id_secteur', $id);
        // mael change ++
        
        if(!empty($filtre->search)){
            $qb->andWhere('p.titre like :title');
            $qb->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $qb->andWhere('e.id in (:status)');
            $qb->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $qb->andWhere('t.id in (:type)');
            $qb->setParameter('type',$filtre->type);
        }else{
            $qb->andWhere('p.type not in (:type)');
            $qb->setParameter('type',4);
        }
        if(!empty($id)){
            $qb->andWhere('pd.cle like :cle_secteur'); // mael change ++
            $qb->andWhere('pd.value = :id_secteur'); // mael change ++
            $qb->setParameter('cle_secteur', 'secteur%'); // mael change ++
            $qb->setParameter('id_secteur', $id); // mael change ++
        }
        
        if(!empty($filtre->gpac)){
            $qb->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->confidentiel)){
            $qb->join('p.projetsData','pdc');
            $qb->andWhere("pdc.cle = 'Confidentiel' and ( pdc.value='oui' or pdc.value = 1 )");
        }
        if(!empty($filtre->prioritaire)){
            $qb->join('p.projetsData','pdp');
            $qb->andWhere("pdp.cle = 'Prioritaire' and ( pdp.value='oui' or pdp.value = 1 )");
        }
        if(!empty($filtre->compte)){
            
            $qb->andWhere('c.nomCompte = :nomCompte');
            $qb->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->pays)){
            $qb->andWhere('c.paysSiege = :pays');
            $qb->setParameter('pays', $filtre->pays->getID());
        }
        if(!empty($filtre->FiltregerePar)){
            $qb->andWhere('p.gere_par = :gere_par');
            $qb->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
            
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $qb->andwhere($qb->expr()->between('p.date_creation', "?1", "?2"));
            $qb->setParameter('1', $from);
            $qb->setParameter('2', $to);
        }
        if(!empty($filtre->secteur)){
            $qb->andWhere('pd.cle like :cle_secteur'); // mael change ++
            $qb->andWhere('pd.value = :id_secteur'); // mael change ++
            $qb->setParameter('cle_secteur', 'secteur%'); // mael change ++
            $qb->setParameter('id_secteur', $filtre->secteur); // mael change ++
            //$qb->andWhere('s.id = :id_secteur');
            //$qb->setParameter('id_secteur', $filtre->secteur);
        }
        
        //dump( ["listeProjetBysecteur " , $qb->getQuery()->getParameters(), $qb->getQuery()->getSql(), $filtre]  );
        return  $qb->getQuery()->getResult();
    }

    public function listeProjetBysecteurUser($id,ProjetFiltre $filtre,$user)
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p')
            ->join('p.compte', 'c')
            ->join('c.secteurs','s');

        $qb->join('p.typeProjet','t')
        ->join('p.etatProjet','e');
        

        if(!empty($filtre->confidentiel) || !empty($filtre->prioritaire)){
          $qb->join('p.projetsData','pd');
        }
        $qb->andWhere('p.isDeleted = :isDeleted');
        $qb->setParameter('isDeleted', false);
        $qb->andWhere('s.id = :id_secteur');
        $qb->setParameter('id_secteur', $id);

        if(!empty($filtre->search)){
            $qb->andWhere('p.titre like :title');
            $qb->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $qb->andWhere('e.id in (:status)');
            $qb->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $qb->andWhere('t.id in (:type)');
            $qb->setParameter('type',$filtre->type);
        }else{
            $qb->andWhere('p.type not in (:type)');
            $qb->setParameter('type',4);
        }
        if(!empty($id)){
            $qb->andWhere('s.id = :id_secteur');
            $qb->setParameter('id_secteur', $id);
        }

        if(!empty($filtre->gpac)){
            $qb->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->confidentiel)){
            $qb->andWhere("pd.cle = 'Confidentiel' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->prioritaire)){
            $qb->andWhere("pd.cle = 'Prioritaire' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->compte)){
          
            $qb->andWhere('c.nomCompte = :nomCompte');
            $qb->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $qb->andWhere('p.gere_par = :gere_par');
            $qb->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if(!empty($filtre->pays)){
            $qb->andWhere('c.paysSiege = :pays');
            $qb->setParameter('pays', $filtre->pays->getID());
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $qb->andwhere($qb->expr()->between('p.date_creation', "?1", "?2"));
            $qb->setParameter('1', $from);
            $qb->setParameter('2', $to);
       }
       if(!empty($filtre->secteur)){
        $qb->andWhere('s.id = :id_secteur');
        $qb->setParameter('id_secteur', $filtre->secteur);
        }

        $qb->andWhere('p.cree_par = :user');
        $qb->setParameter('user', $user);

        return  $qb->getQuery()
            ->getResult()
            ;
    }
  public function listProjets(){
      $qb = $this->createQueryBuilder('p')
      ->select("p");

      $qb->andWhere('p.isDeleted = :isDeleted');
      $qb->setParameter('isDeleted', false);
      $qb->orderBy('p.date_creation', 'DESC');

      return  $qb->getQuery()
          ->getResult()
          ;
  }
    public function telechargerListProjets(ProjetFiltre $filtre){
        $query = $this->createQueryBuilder('p')
            ->select("p.id,p.titre as projet,p.date_creation as date,c.nomCompte as compte,e.nom as status,t.nom as type,p.GPAC as is_gpac,CONCAT(gp.prenom,' ',gp.nom) as nom_user")
            ->join('p.compte', 'c')
            ->join('c.secteurs','s')
            ->join('p.typeProjet','t')
            ->join('p.etatProjet','e')

            ->join('p.gere_par','gp');
        if(!empty($filtre->confidentiel) || !empty($filtre->prioritaire)){
            $query->join('p.projetsData','pd');
        }
        if(!empty($filtre->search)){
            $query->andWhere('p.titre like :title');
            $query->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $query->andWhere('e.id in (:status)');
            $query->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $query->andWhere('t.id in (:type)');
            $query->setParameter('type',$filtre->type);
        }
        if(!empty($filtre->secteur)){
            $query->andWhere('s.id = :id_secteur');
            $query->setParameter('id_secteur', $filtre->secteur);
        }

        if(!empty($filtre->gpac)){
            $query->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->confidentiel)){
            $query->andWhere("pd.cle = 'Confidentiel' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->prioritaire)){
            $query->andWhere("pd.cle = 'Prioritaire' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->compte)){
          
            $query->andWhere('c.nomCompte = :nomCompte');
            $query->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $query->andWhere('p.gere_par = :gere_par');
            $query->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if(!empty($filtre->pays)){
            $query->andWhere('c.paysSiege = :pays');
            $query->setParameter('pays', $filtre->pays->getID());
        }
        $query->andWhere('p.isDeleted = :isDeleted');
        $query->setParameter('isDeleted', false);
        if(!empty($filtre->tri)){
            if($filtre->tri=='projet'){
                $query->orderBy('p.titre');
            }else{
                $query->orderBy('p.date_creation'); 
            }
        }else{
            $query->orderBy('p.date_creation');
        }

        return  $query->getQuery()
            ->getResult()
            ;
    }
    
    public function countProjet(){
        $qb = $this->createQueryBuilder('p')
            ->select("count(p.id) as count")
            ->join('p.compte','c')
            ->join('p.etatProjet','ep')
            ->join('p.typeProjet','tp')
            ->join('p.gere_par','gp');
        return  $qb->getQuery()
            ->getOneOrNullResult()
            ;
    }
    public function countProjetbydate($date_debut,$date_fin){
        $qb = $this->createQueryBuilder('p')
            ->select("count(p.id) as count")
            ->join('p.compte','c')
            ->join('p.etatProjet','ep') 
            ->join('p.typeProjet','tp')
            ->join('p.gere_par','gp')
            ->andWhere('(p.date_creation  > :date_debut and p.date_creation  < :date_fin )')
            ->setParameter('date_debut',$date_debut)
            ->setParameter('date_fin',$date_fin);
        return  $qb->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function getValueField($id,$name){
        $qb = $this->createQueryBuilder('p')
            ->select('dp.value')
            ->join('p.projetsData','dp');
        $qb->andWhere('p.id = :id_projet');
        $qb->setParameter('id_projet', $id);
        $qb->andWhere('dp.cle = :cle');
        $qb->setParameter('cle', $name);
        return  $qb->getQuery()->getOneOrNullResult();
    }
    public function getValueFieldPro($id,$name){
        $qb = $this->createQueryBuilder('p')
            ->select('p,dp.value')
            ->join('p.projetsData','dp');
        $qb->andWhere('p.id = :id_projet');
        $qb->setParameter('id_projet', $id);
        $qb->andWhere('dp.cle = :cle');
        $qb->setParameter('cle', $name);
        return  $qb->getQuery()->getOneOrNullResult();
    }
    public function getValueProByValue($id,$name,$pid){
        $qb = $this->createQueryBuilder('p')
            ->select('p,dp.value')
            ->join('p.projetsData','dp');
        $qb->andWhere('p.id = :id_projet');
        $qb->setParameter('id_projet', $id);
        $qb->andWhere('dp.cle = :cle');
        $qb->setParameter('cle', $name);
        return  $qb->getQuery()->getOneOrNullResult();
    }
    public function getCountBystatusprojet($status,$type){
        $qb = $this->createQueryBuilder('p')

            ->select('count(p.id) as count')
            ->andWhere('p.etatProjet = :status')
            ->setParameter('status',$status)
            ->andWhere('p.typeProjet = :type')
            ->setParameter('type',$type);
        return  $qb->getQuery()
            ->getOneOrNullResult()
            ;
    }
    public function getCountBystatusprojetdate($date_debut,$date_fin,$status,$type){
        $qb = $this->createQueryBuilder('p')

            ->select('count(p.id) as count')
            ->andWhere('p.etatProjet = :status')
            ->setParameter('status',$status)
            ->andWhere('p.typeProjet = :type')
            ->setParameter('type',$type)
            ->andWhere('(p.date_creation  > :date_debut and p.date_creation  < :date_fin )')
            ->setParameter('date_debut',$date_debut)
            ->setParameter('date_fin',$date_fin);
        return  $qb->getQuery()
            ->getOneOrNullResult()
            ;
    }
    public function getCountByprojetDate($date_debut,$date_fin,$type){
        $qb = $this->createQueryBuilder('p')
            ->select('count(p.id) as count')
            ->andWhere('p.typeProjet = :type')
            ->setParameter('type',$type)
            ->andWhere('(p.date_creation  > :date_debut and p.date_creation  < :date_fin )')
            ->setParameter('date_debut',$date_debut)
            ->setParameter('date_fin',$date_fin);
        return  $qb->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findSearch(ProjetFiltre $filtre){
        $listIds = $this->selection->getIdsListe('Compte', 'PAR_SECTEUR', array('sss' => 'ss'));
        
        $query= $this->createQueryBuilder('p')
          ->select('p')
            ->join('p.compte', 'c')
            ->join('c.secteurs','s')
            ->join('p.typeProjet','t')
            ->join('p.etatProjet','e')
            ->join('p.projetsData','pd');
        
        if(!empty($filtre->search)){
            $query->andWhere('p.titre like :title');
            $query->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $query->andWhere('e.id in (:status)');
            $query->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $query->andWhere('t.id in (:type)');
            $query->setParameter('type',$filtre->type);
        }else{
            $query->andWhere('p.type not in (:type)');
            $query->setParameter('type',4);
        }
        if(!empty($filtre->secteur)){
            $query->andWhere('s.id = :id_secteur');
            $query->setParameter('id_secteur', $filtre->secteur);
        }

        if(!empty($filtre->gpac)){
            $query->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->confidentiel)){
            $query->andWhere("pd.cle = 'Confidentiel' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->prioritaire)){
            $query->andWhere("pd.cle = 'Prioritaire' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->abouti)){
            $query->andWhere("pd.cle = 'Abouti'");
            $query->andWhere("pd.value = :abouti");
            $query->setParameter('abouti',$filtre->abouti);
            $query->orderBy('p.id');
        }
        if(!empty($filtre->nonabouti)){
            $query->andWhere("pd.cle = 'NAbouti' and ( pd.value = :nonabouti )");
            $query->setParameter('nonabouti',$filtre->nonabouti);
        }
        if(!empty($filtre->pays)){
            $query->andWhere('c.paysSiege = :pays');
            $query->setParameter('pays', $filtre->pays->getID());
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $query->andwhere($query->expr()->between('p.date_creation', "?1", "?2"));
            $query->setParameter('1', $from);
            $query->setParameter('2', $to);
       }
        if(!empty($filtre->compte)){
            $query->andWhere('c.nomCompte = :nomCompte');
            $query->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $query->andWhere('p.gere_par = :gere_par');
            $query->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if (!is_null($listIds)) {
            $query->andWhere('c.id in (:ids)');
            $query->setParameter('ids', $listIds);
        }
        $query->andWhere('p.isDeleted = :isDeleted');
        $query->setParameter('isDeleted', false);
        $query->orderBy('p.date_creation', 'DESC');

        if(!empty($filtre->tri)){
            if($filtre->tri=='projet'){
                $query->orderBy('p.date_creation','DESC');
            }else{
                $query->orderBy('p.date_creation','DESC');
            }
        }else{
            $query->orderBy('p.date_creation','DESC');
        }
       return $query->getQuery()->getResult();
    }

    public function findSearchNewOrg(ProjetFiltre $filtre, $Secteurs = null ){
        //$listIds = $this->selection->getIdsListe('Compte', 'PAR_SECTEUR', array('sss' => 'ss'));
        
        //dump( ['listIds' , $listIds ]);
        
        $query= $this->createQueryBuilder('p')
        ->select('p')
        ->join('p.compte', 'c')
        //->join('c.secteurs','s.') // mael change ++
        ->join('p.typeProjet','t')
        ->join('p.etatProjet','e')
        ->join('p.projetsData','pd');
        
        if(!empty($filtre->search)){
            $query->andWhere('p.titre like :title');
            $query->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $query->andWhere('e.id in (:status)');
            $query->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $query->andWhere('t.id in (:type)');
            $query->setParameter('type',$filtre->type);
        }else{
            $query->andWhere('p.type not in (:type)');
            $query->setParameter('type',4);
        }
        if(!empty($filtre->secteur)){
            $query->andWhere('pd.cle like :cle_secteur'); // mael change ++
            $query->andWhere('pd.value = :id_secteur'); // mael change ++
            $query->setParameter('cle_secteur', 'secteur%'); // mael change ++
            $query->setParameter('id_secteur', $filtre->secteur); // mael change ++
            // $query->andWhere('s.id = :id_secteur');
            // $query->setParameter('id_secteur', $filtre->secteur);
        }
        
        if(!empty($filtre->gpac)){
            $query->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->confidentiel)){
            $query->join('p.projetsData','pdc');
            $query->andWhere("pdc.cle = 'Confidentiel' and ( pdc.value='oui' or pdc.value = 1 )");
        }
        if(!empty($filtre->prioritaire)){
            $query->join('p.projetsData','pdp');
            $query->andWhere("pdp.cle = 'Prioritaire' and ( pdp.value='oui' or pdp.value = 1 )");
        }
        if(!empty($filtre->abouti)){
            $query->join('p.projetsData','pda');
            $query->andWhere("pda.cle = 'Abouti'");
            $query->andWhere("pda.value = :abouti");
            $query->setParameter('abouti',$filtre->abouti);
            $query->orderBy('p.id');
        }
        if(!empty($filtre->nonabouti)){
            $query->join('p.projetsData','pdna');
            $query->andWhere("pdna.cle = 'NAbouti' and ( pdna.value = :nonabouti )");
            $query->setParameter('nonabouti',$filtre->nonabouti);
        }
        if(!empty($filtre->pays)){
            $query->andWhere('c.paysSiege = :pays');
            $query->setParameter('pays', $filtre->pays->getID());
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
            
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $query->andwhere($query->expr()->between('p.date_creation', "?1", "?2"));
            $query->setParameter('1', $from);
            $query->setParameter('2', $to);
        }
        if(!empty($filtre->compte)){
            $query->andWhere('c.nomCompte = :nomCompte');
            $query->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $query->andWhere('p.gere_par = :gere_par');
            $query->setParameter('gere_par', $filtre->FiltregerePar);
        }
        //dump(['Secteurs' , $this->getUser()->getSecteurs() ]);
        $_ssecteurs= [];
        if ( !is_null( $Secteurs ) ) {
            
            foreach ( $Secteurs as $_secteur ) {
                array_push( $_ssecteurs , $_secteur->getId() );
            }
            $query->andWhere('pd.cle like :cle_secteur'); // mael change ++
            $query->andWhere('pd.value in (:tab_secteur)'); // mael change ++
            $query->setParameter('cle_secteur', 'secteur%'); // mael change ++
            $query->setParameter('tab_secteur', $_ssecteurs ); // mael change ++
        }
        // mael change ++
        // if (!is_null($listIds)) {
        //     $query->andWhere('c.id in (:ids)');
        //     $query->setParameter('ids', $listIds);
        // }
        // mael change ++
        $query->andWhere('p.isDeleted = :isDeleted');
        $query->setParameter('isDeleted', false);
        $query->orderBy('p.date_creation', 'DESC');
        
        if(!empty($filtre->tri)){
            if($filtre->tri=='projet'){
                $query->orderBy('p.date_creation','DESC');
            }else{
                $query->orderBy('p.date_creation','DESC');
            }
        }else{
            $query->orderBy('p.date_creation','DESC');
        }
        
        //dump( ["findSearch" , $query->getQuery()->getSql()]  );
        return $query->getQuery()->getResult();
    }

    public function getNonConfid(ProjetFiltre $filtre){
        $qb = $this->createQueryBuilder('p')
            ->select('p')
            ->join('p.compte', 'c')
            ->join('c.secteurs','s')
            ->join('p.typeProjet','t')
            ->join('p.etatProjet','e')
            ->join('p.projetsData','dp');

        if(!empty($filtre->search)){
            $qb->andWhere('p.titre like :title');
            $qb->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $qb->andWhere('e.id in (:status)');
            $qb->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $qb->andWhere('t.id in (:type)');
            $qb->setParameter('type',$filtre->type);
        }
        if(!empty($filtre->secteur)){
            $qb->andWhere('s.id = :id_secteur');
            $qb->setParameter('id_secteur', $filtre->secteur);
        }

        if(!empty($filtre->gpac)){
            $qb->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->confidentiel)){
            $qb->andWhere("dp.cle = 'Confidentiel' and ( dp.value='oui' or dp.value = 1 )");
        }
        if(!empty($filtre->prioritaire)){
            $qb->andWhere("dp.cle = 'Prioritaire' and ( dp.value='oui' or dp.value = 1 )");
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $qb->andwhere($qb->expr()->between('p.date_creation', "?1", "?2"));
            $qb->setParameter('1', $from);
            $qb->setParameter('2', $to);
       }
        if(!empty($filtre->compte)){
          
            $qb->andWhere('c.nomCompte = :nomCompte');
            $qb->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $qb->andWhere('p.gere_par = :gere_par');
            $qb->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if(!empty($filtre->pays)){
            $qb->andWhere('c.paysSiege = :pays');
            $qb->setParameter('pays', $filtre->pays->getID());
        }
        $qb->andWhere('p.Confidentiel != :conf');
        $qb->setParameter('conf', 1);
         
        $qb->andWhere('p.isDeleted = :isDeleted');
        $qb->setParameter('isDeleted', false);
        $qb->orderBy('p.date_creation', 'DESC');


        // if(!empty($filtre->tri)){
        //     if($filtre->tri=='projet'){
        //         $qb->orderBy('p.date_creation','DESC');
        //     }else{
        //         $qb->orderBy('p.date_creation','DESC');
        //     }
        // }else{
        //     $qb->orderBy('p.date_creation','DESC');
        // }
      return $qb->getQuery()->getResult();
    }

    public function telechargerListProjetsNonConf(ProjetFiltre $filtre){
        $query = $this->createQueryBuilder('p')
            ->select("p.id,p.titre as projet,p.date_creation as date,c.nomCompte as compte,e.nom as status,t.nom as type,p.GPAC as is_gpac,CONCAT(gp.prenom,' ',gp.nom) as nom_user")
            ->join('p.compte', 'c')
            ->join('c.secteurs','s')
            ->join('p.typeProjet','t')
            ->join('p.etatProjet','e')
            ->join('p.gere_par','gp')
            ->join('p.projetsData','pd');
            
        if(!empty($filtre->confidentiel) || !empty($filtre->prioritaire)){
        }
        if(!empty($filtre->search)){
            $query->andWhere('p.titre like :title');
            $query->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $query->andWhere('e.id in (:status)');
            $query->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $query->andWhere('t.id in (:type)');
            $query->setParameter('type',$filtre->type);
        }
        if(!empty($filtre->secteur)){
            $query->andWhere('s.id = :id_secteur');
            $query->setParameter('id_secteur', $filtre->secteur);
        }

        if(!empty($filtre->gpac)){
            $query->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->prioritaire)){
            $query->andWhere("pd.cle = 'Prioritaire' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $query->andwhere($query->expr()->between('p.date_creation', "?1", "?2"));
            $query->setParameter('1', $from);
            $query->setParameter('2', $to);
       }
        if(!empty($filtre->compte)){
            $query->andWhere('c.nomCompte = :nomCompte');
            $query->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $query->andWhere('p.gere_par = :gere_par');
            $query->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if(!empty($filtre->pays)){
            $query->andWhere('c.paysSiege = :pays');
            $query->setParameter('pays', $filtre->pays->getID());
        }
        $query->andWhere('p.isDeleted = :isDeleted');
        $query->setParameter('isDeleted', false);
        $query->orderBy('p.date_creation', 'DESC');

        if(!empty($filtre->tri)){
            if($filtre->tri=='projet'){
                $query->orderBy('p.date_creation','DESC'); 
            }else{
                $query->orderBy('p.date_creation','DESC'); 
            }
        }else{
            $query->orderBy('p.date_creation','DESC');
        }

        return  $query->getQuery()
            ->getResult()
            ;
    }
    public function listeProjetNonConfBysecteur($id,ProjetFiltre $filtre)
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p')
            ->join('p.compte', 'c')
            ->join('c.secteurs','s');

        $qb->join('p.typeProjet','t')
        ->join('p.etatProjet','e');
        $qb->join('p.projetsData','pd');
        
      if(!empty($filtre->confidentiel) || !empty($filtre->prioritaire)){
      }
        $qb->andWhere('p.isDeleted = :isDeleted');
        $qb->setParameter('isDeleted', false);
        $qb->andWhere('s.id = :id_secteur');
        $qb->setParameter('id_secteur', $id);

        if(!empty($filtre->search)){
            $qb->andWhere('p.titre like :title');
            $qb->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $qb->andWhere('e.id in (:status)');
            $qb->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $qb->andWhere('t.id in (:type)');
            $qb->setParameter('type',$filtre->type);
        }
        if(!empty($id)){
            $qb->andWhere('s.id = :id_secteur');
            $qb->setParameter('id_secteur', $id);
        }

        if(!empty($filtre->gpac)){
            $qb->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->confidentiel)){
            $qb->andWhere("pd.cle = 'Confidentiel' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->prioritaire)){
            $qb->andWhere("pd.cle = 'Prioritaire' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $qb->andwhere($qb->expr()->between('p.date_creation', "?1", "?2"));
            $qb->setParameter('1', $from);
            $qb->setParameter('2', $to);
       }
        if(!empty($filtre->compte)){
          
            $qb->andWhere('c.nomCompte = :nomCompte');
            $qb->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $qb->andWhere('p.gere_par = :gere_par');
            $qb->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if(!empty($filtre->pays)){
            $qb->andWhere('c.paysSiege = :pays');
            $qb->setParameter('pays', $filtre->pays->getID());
        }
        if(!empty($filtre->secteur)){
            $qb->andWhere('s.id = :id_secteur');
            $qb->setParameter('id_secteur', $filtre->secteur);
       }
        $qb->orderBy('p.date_creation', 'DESC');


        return  $qb->getQuery()
            ->getResult()
            ;
    }


    public function findSearchAction(ProjetFiltre $filtre){
        $listIds = $this->selection->getIdsListe('Compte', 'PAR_SECTEUR', array('sss' => 'ss'));
        
        $query= $this->createQueryBuilder('p')
          ->select('p')
            ->join('p.compte', 'c')
            ->join('c.secteurs','s')
            ->join('p.typeProjet','t')
            ->join('p.etatProjet','e')
            ->join('p.projetsData','pd');
        
        if(!empty($filtre->search)){
            $query->andWhere('p.titre like :title');
            $query->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $query->andWhere('e.id in (:status)');
            $query->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $query->andWhere('t.id in (:type)');
            $query->setParameter('type',$filtre->type);
        }else{
            $query->andWhere('t.id in (:type)');
            $query->setParameter('type',4);
        }
        if(!empty($filtre->secteur)){
            $query->andWhere('s.id = :id_secteur');
            $query->setParameter('id_secteur', $filtre->secteur);
        }

        if(!empty($filtre->gpac)){
            $query->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->confidentiel)){
            $query->andWhere("pd.cle = 'Confidentiel' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->prioritaire)){
            $query->andWhere("pd.cle = 'Prioritaire' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->abouti)){
            $query->andWhere("pd.cle = 'Abouti'");
            $query->andWhere("pd.value = :abouti");
            $query->setParameter('abouti',$filtre->abouti);
            $query->orderBy('p.id');
        }
        if(!empty($filtre->nonabouti)){
            $query->andWhere("pd.cle = 'NAbouti' and ( pd.value = :nonabouti )");
            $query->setParameter('nonabouti',$filtre->nonabouti);
        }
        // if(!empty($filtre->pays)){
        //      $query->andWhere("pd.cle = 'Localisation' ");
        //     $query->andWhere("pd.value = :pays");
        //     $query->setParameter('pays',"1");
        //     $query->orderBy('p.id');

        // }
        if(!empty($filtre->pays)){
            $query->andWhere('c.paysSiege = :pays');
            $query->setParameter('pays', $filtre->pays->getID());
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $query->andwhere($query->expr()->between('p.date_creation', "?1", "?2"));
            $query->setParameter('1', $from);
            $query->setParameter('2', $to);
       }
        if(!empty($filtre->compte)){
          
            $query->andWhere('c.nomCompte = :nomCompte');
            $query->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $query->andWhere('p.gere_par = :gere_par');
            $query->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if (!is_null($listIds)) {
            $query->andWhere('c.id in (:ids)');
            $query->setParameter('ids', $listIds);
        }
        $query->andWhere('p.isDeleted = :isDeleted');
        $query->setParameter('isDeleted', false);
        $query->orderBy('p.date_creation', 'DESC');

        if(!empty($filtre->tri)){
            if($filtre->tri=='projet'){
                $query->orderBy('p.date_creation','DESC');
            }else{
                $query->orderBy('p.date_creation','DESC');
            }
        }else{
            $query->orderBy('p.date_creation','DESC');
        }
       return $query->getQuery()->getResult();
    }

    public function getListeProjetInvest(ProjetFiltre $filtre){
        $listIds = $this->selection->getIdsListe('Compte', 'PAR_SECTEUR', array('sss' => 'ss'));
        
        $query= $this->createQueryBuilder('p')
          ->select('p')
            ->join('p.compte', 'c')
            ->join('c.secteurs','s')
            ->join('p.typeProjet','t')
            ->join('p.etatProjet','e')
            ->join('p.projetsData','pd');
        
        if(!empty($filtre->search)){
            $query->andWhere('p.titre like :title');
            $query->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $query->andWhere('e.id in (:status)');
            $query->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $query->andWhere('t.id in (:type)');
            $query->setParameter('type',$filtre->type);
        }
        if(!empty($filtre->secteur)){
            $query->andWhere('s.id = :id_secteur');
            $query->setParameter('id_secteur', $filtre->secteur);
        }

        if(!empty($filtre->gpac)){
            $query->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->confidentiel)){
            $query->andWhere("pd.cle = 'Confidentiel' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->prioritaire)){
            $query->andWhere("pd.cle = 'Prioritaire' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->abouti)){
            $query->andWhere("pd.cle = 'Abouti'");
            $query->andWhere("pd.value = :abouti");
            $query->setParameter('abouti',$filtre->abouti);
            $query->orderBy('p.id');
        }
        if(!empty($filtre->nonabouti)){
            $query->andWhere("pd.cle = 'NAbouti' and ( pd.value = :nonabouti )");
            $query->setParameter('nonabouti',$filtre->nonabouti);
        }
        // if(!empty($filtre->pays)){
        //      $query->andWhere("pd.cle = 'Localisation' ");
        //     $query->andWhere("pd.value = :pays");
        //     $query->setParameter('pays',"1");
        //     $query->orderBy('p.id');

        // }
        if(!empty($filtre->pays)){
            $query->andWhere('c.paysSiege = :pays');
            $query->setParameter('pays', $filtre->pays->getID());
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $query->andwhere($query->expr()->between('p.date_creation', "?1", "?2"));
            $query->setParameter('1', $from);
            $query->setParameter('2', $to);
       }
        if(!empty($filtre->compte)){
          
            $query->andWhere('c.nomCompte = :nomCompte');
            $query->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $query->andWhere('p.gere_par = :gere_par');
            $query->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if (!is_null($listIds)) {
            $query->andWhere('c.id in (:ids)');
            $query->setParameter('ids', $listIds);
        }

        $query->andWhere('p.type in (:type)');
        $query->setParameter('type',1);
        
        $query->andWhere('p.isDeleted = :isDeleted');
        $query->setParameter('isDeleted', false);
        $query->orderBy('p.date_creation', 'DESC');

        if(!empty($filtre->tri)){
            if($filtre->tri=='projet'){
                $query->orderBy('p.date_creation','DESC');
            }else{
                $query->orderBy('p.date_creation','DESC');
            }
        }else{
            $query->orderBy('p.date_creation','DESC');
        }
       return $query->getQuery()->getResult();
    }

    public function getListeProjetExpoSourcing(ProjetFiltre $filtre){
        $listIds = $this->selection->getIdsListe('Compte', 'PAR_SECTEUR', array('sss' => 'ss'));
        
        $query= $this->createQueryBuilder('p')
          ->select('p')
            ->join('p.compte', 'c')
            ->join('c.secteurs','s')
            ->join('p.typeProjet','t')
            ->join('p.etatProjet','e')
            ->join('p.projetsData','pd');
        
        if(!empty($filtre->search)){
            $query->andWhere('p.titre like :title');
            $query->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $query->andWhere('e.id in (:status)');
            $query->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $query->andWhere('t.id in (:type)');
            $query->setParameter('type',$filtre->type);
        }else{
            $query->andWhere('p.type in (:type)');
            $query->setParameter('type',array(2,3));
        }
        if(!empty($filtre->secteur)){
            $query->andWhere('s.id = :id_secteur');
            $query->setParameter('id_secteur', $filtre->secteur);
        }

        if(!empty($filtre->gpac)){
            $query->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->confidentiel)){
            $query->andWhere("pd.cle = 'Confidentiel' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->prioritaire)){
            $query->andWhere("pd.cle = 'Prioritaire' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->abouti)){
            $query->andWhere("pd.cle = 'Abouti'");
            $query->andWhere("pd.value = :abouti");
            $query->setParameter('abouti',$filtre->abouti);
            $query->orderBy('p.id');
        }
        if(!empty($filtre->nonabouti)){
            $query->andWhere("pd.cle = 'NAbouti' and ( pd.value = :nonabouti )");
            $query->setParameter('nonabouti',$filtre->nonabouti);
        }
        // if(!empty($filtre->pays)){
        //      $query->andWhere("pd.cle = 'Localisation' ");
        //     $query->andWhere("pd.value = :pays");
        //     $query->setParameter('pays',"1");
        //     $query->orderBy('p.id');

        // }
        if(!empty($filtre->pays)){
            $query->andWhere('c.paysSiege = :pays');
            $query->setParameter('pays', $filtre->pays->getID());
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $query->andwhere($query->expr()->between('p.date_creation', "?1", "?2"));
            $query->setParameter('1', $from);
            $query->setParameter('2', $to);
       }
        if(!empty($filtre->compte)){
          
            $query->andWhere('c.nomCompte = :nomCompte');
            $query->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $query->andWhere('p.gere_par = :gere_par');
            $query->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if (!is_null($listIds)) {
            $query->andWhere('c.id in (:ids)');
            $query->setParameter('ids', $listIds);
        }
        $query->andWhere('p.isDeleted = :isDeleted');
        $query->setParameter('isDeleted', false);
        $query->orderBy('p.date_creation', 'DESC');

        if(!empty($filtre->tri)){
            if($filtre->tri=='projet'){
                $query->orderBy('p.date_creation','DESC');
            }else{
                $query->orderBy('p.date_creation','DESC');
            }
        }else{
            $query->orderBy('p.date_creation','DESC');
        }
       return $query->getQuery()->getResult();
    }

    public function listeProjetInvestBysecteur($id,ProjetFiltre $filtre)
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p')
            ->join('p.compte', 'c')
            ->join('c.secteurs','s');

        $qb->join('p.typeProjet','t')
        ->join('p.etatProjet','e');
        

        if(!empty($filtre->confidentiel) || !empty($filtre->prioritaire)){
          $qb->join('p.projetsData','pd');
        }
        $qb->andWhere('p.isDeleted = :isDeleted');
        $qb->setParameter('isDeleted', false);
        $qb->andWhere('s.id = :id_secteur');
        $qb->setParameter('id_secteur', $id);

        if(!empty($filtre->search)){
            $qb->andWhere('p.titre like :title');
            $qb->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $qb->andWhere('e.id in (:status)');
            $qb->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $qb->andWhere('t.id in (:type)');
            $qb->setParameter('type',$filtre->type);
        }
        if(!empty($id)){
            $qb->andWhere('s.id = :id_secteur');
            $qb->setParameter('id_secteur', $id);
        }

        if(!empty($filtre->gpac)){
            $qb->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->confidentiel)){
            $qb->andWhere("pd.cle = 'Confidentiel' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->prioritaire)){
            $qb->andWhere("pd.cle = 'Prioritaire' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $qb->andwhere($qb->expr()->between('p.date_creation', "?1", "?2"));
            $qb->setParameter('1', $from);
            $qb->setParameter('2', $to);
       }
        if(!empty($filtre->compte)){
          
            $qb->andWhere('c.nomCompte = :nomCompte');
            $qb->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $qb->andWhere('p.gere_par = :gere_par');
            $qb->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if(!empty($filtre->pays)){
            $qb->andWhere('c.paysSiege = :pays');
            $qb->setParameter('pays', $filtre->pays->getID());
        }
        if(!empty($filtre->secteur)){
            $qb->andWhere('s.id = :id_secteur');
            $qb->setParameter('id_secteur', $filtre->secteur);
       }

        $qb->andWhere('p.type in (:type)');
        $qb->setParameter('type',1);
        return  $qb->getQuery()
            ->getResult()
            ;
    }
    public function listeProjetExpSourBysecteur($id,ProjetFiltre $filtre)
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p')
            ->join('p.compte', 'c')
            ->join('c.secteurs','s');

        $qb->join('p.typeProjet','t')
        ->join('p.etatProjet','e');
        

        if(!empty($filtre->confidentiel) || !empty($filtre->prioritaire)){
          $qb->join('p.projetsData','pd');
        }
        $qb->andWhere('p.isDeleted = :isDeleted');
        $qb->setParameter('isDeleted', false);
        $qb->andWhere('s.id = :id_secteur');
        $qb->setParameter('id_secteur', $id);

        if(!empty($filtre->search)){
            $qb->andWhere('p.titre like :title');
            $qb->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $qb->andWhere('e.id in (:status)');
            $qb->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $qb->andWhere('t.id in (:type)');
            $qb->setParameter('type',$filtre->type);
        }
        if(!empty($id)){
            $qb->andWhere('s.id = :id_secteur');
            $qb->setParameter('id_secteur', $id);
        }

        if(!empty($filtre->gpac)){
            $qb->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->confidentiel)){
            $qb->andWhere("pd.cle = 'Confidentiel' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->prioritaire)){
            $qb->andWhere("pd.cle = 'Prioritaire' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $qb->andwhere($qb->expr()->between('p.date_creation', "?1", "?2"));
            $qb->setParameter('1', $from);
            $qb->setParameter('2', $to);
       }
        if(!empty($filtre->compte)){
          
            $qb->andWhere('c.nomCompte = :nomCompte');
            $qb->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $qb->andWhere('p.gere_par = :gere_par');
            $qb->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if(!empty($filtre->pays)){
            $qb->andWhere('c.paysSiege = :pays');
            $qb->setParameter('pays', $filtre->pays->getID());
        }
        if(!empty($filtre->secteur)){
            $qb->andWhere('s.id = :id_secteur');
            $qb->setParameter('id_secteur', $filtre->secteur);
       }

        $qb->andWhere('p.type in (:type)');
        $qb->setParameter('type',array(2,3));

        return  $qb->getQuery()
            ->getResult()
            ;
    }

    public function getListeProjetListeByCompte($compte)
    {
          $qb = $this->createQueryBuilder('p')
             ->select('p')
             ->join('p.compte', 'c')
             ->join('p.etatProjet','e');
          $qb->andWhere('p.compte = :compte');
          $qb->setParameter('compte', $compte);
          $qb->andWhere('p.isDeleted = :isDeleted');
          $qb->setParameter('isDeleted', false);
             return  $qb->getQuery()
            ->getResult()
        ;
    }
    public function getListeNonconfProjetListeByCompte($compte)
    {
          $qb = $this->createQueryBuilder('p')
             ->select('p')
             ->join('p.compte', 'c')
             ->join('p.etatProjet','e');
          $qb->andWhere('p.compte = :compte');
          $qb->setParameter('compte', $compte);
          $qb->andWhere('p.Confidentiel != :conf');
          $qb->setParameter('conf', 1);     
          $qb->andWhere('p.isDeleted = :isDeleted');
          $qb->setParameter('isDeleted', false);
             return  $qb->getQuery()
            ->getResult()
        ;
    }

    public function getListeProjetByCompteIN($compte)
    {
          $qb = $this->createQueryBuilder('p')
             ->select('p')
             ->join('p.compte', 'c')
             ->join('p.etatProjet','e');
          $qb->andWhere('p.compte = :compte');
          $qb->setParameter('compte', $compte);
          $qb->andWhere('e.id in (:status)');
          $qb->setParameter('status',1);
          $qb->andWhere('p.isDeleted = :isDeleted');
          $qb->setParameter('isDeleted', false);
             return  $qb->getQuery()
            ->getResult()
        ;
    }
    public function getListeProjetByCompteDE($compte)
    {
          $qb = $this->createQueryBuilder('p')
             ->select('p')
             ->join('p.compte', 'c')
             ->join('p.etatProjet','e');
          $qb->andWhere('p.compte = :compte');
          $qb->setParameter('compte', $compte);
          $qb->andWhere('e.id in (:status)');
          $qb->setParameter('status',2);
          $qb->andWhere('p.isDeleted = :isDeleted');
          $qb->setParameter('isDeleted', false);
             return  $qb->getQuery()
            ->getResult()
        ;
    }
    public function getListeProjetByCompteFer($compte)
    {
          $qb = $this->createQueryBuilder('p')
             ->select('p')
             ->join('p.compte', 'c')
             ->join('p.etatProjet','e');
          $qb->andWhere('p.compte = :compte');
          $qb->setParameter('compte', $compte);
          $qb->andWhere('e.id in (:status)');
          $qb->setParameter('status',3);
          $qb->andWhere('p.isDeleted = :isDeleted');
          $qb->setParameter('isDeleted', false);
             return  $qb->getQuery()
            ->getResult()
        ;
    }

    public function findSearchPartenaireactions(ActionsPartenaires $filtre){
        $listIds = $this->selection->getIdsListe('Compte', 'PAR_SECTEUR', array('sss' => 'ss'));
        
        $query= $this->createQueryBuilder('p')
          ->select('p')
            ->join('p.compte', 'c')
            ->join('c.secteurs','s')
            ->join('p.typeProjet','t')
            ->join('p.etatProjet','e')
            ->join('p.projetsData','pd');
        
        if(!empty($filtre->search)){
            $query->andWhere('p.titre like :title');
            $query->setParameter('title',"%{$filtre->search}%");
        }
        $query->andWhere('t.id in (:type)');
        $query->setParameter('type',4);
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){       
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $query->andwhere($query->expr()->between('p.date_creation', "?1", "?2"));
            $query->setParameter('1', $from);
            $query->setParameter('2', $to);
       }
        
        $query->andWhere('p.isDeleted = :isDeleted');
        $query->setParameter('isDeleted', false);
        $query->orderBy('p.date_creation', 'DESC');

        if(!empty($filtre->tri)){
            if($filtre->tri=='projet'){
                $query->orderBy('p.date_creation','DESC');
            }else{
                $query->orderBy('p.date_creation','DESC');
            }
        }else{
            $query->orderBy('p.date_creation','DESC');
        }
       return $query->getQuery()->getResult();
    }
    public function getListeProjetExpoSourcingOwnNoConf(ProjetFiltre $filtre, $user){
        $listIds = $this->selection->getIdsListe('Compte', 'PAR_SECTEUR', array('sss' => 'ss'));
        
        $query= $this->createQueryBuilder('p')
          ->select('p')
            ->join('p.compte', 'c')
            ->join('c.secteurs','s')
            ->join('p.typeProjet','t')
            ->join('p.etatProjet','e')
            ->join('p.projetsData','pd');
        
        if(!empty($filtre->search)){
            $query->andWhere('p.titre like :title');
            $query->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $query->andWhere('e.id in (:status)');
            $query->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $query->andWhere('t.id in (:type)');
            $query->setParameter('type',$filtre->type);
        }else{
            $query->andWhere('p.type in (:type)');
            $query->setParameter('type',array(2,3));
        }
        if(!empty($filtre->secteur)){
            $query->andWhere('s.id = :id_secteur');
            $query->setParameter('id_secteur', $filtre->secteur);
        }

        if(!empty($filtre->gpac)){
            $query->andWhere('p.GPAC = 1');
        }
        
        if(!empty($filtre->prioritaire)){
            $query->andWhere("pd.cle = 'Prioritaire' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->abouti)){
            $query->andWhere("pd.cle = 'Abouti'");
            $query->andWhere("pd.value = :abouti");
            $query->setParameter('abouti',$filtre->abouti);
            $query->orderBy('p.id');
        }
        if(!empty($filtre->nonabouti)){
            $query->andWhere("pd.cle = 'NAbouti' and ( pd.value = :nonabouti )");
            $query->setParameter('nonabouti',$filtre->nonabouti);
        }
        // if(!empty($filtre->pays)){
        //      $query->andWhere("pd.cle = 'Localisation' ");
        //     $query->andWhere("pd.value = :pays");
        //     $query->setParameter('pays',"1");
        //     $query->orderBy('p.id');

        // }
        if(!empty($filtre->pays)){
            $query->andWhere('c.paysSiege = :pays');
            $query->setParameter('pays', $filtre->pays->getID());
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $query->andwhere($query->expr()->between('p.date_creation', "?1", "?2"));
            $query->setParameter('1', $from);
            $query->setParameter('2', $to);
       }
        if(!empty($filtre->compte)){
          
            $query->andWhere('c.nomCompte = :nomCompte');
            $query->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $query->andWhere('p.gere_par = :gere_par');
            $query->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if (!is_null($listIds)) {
            $query->andWhere('c.id in (:ids)');
            $query->setParameter('ids', $listIds);
        }
        $query->andWhere('p.isDeleted = :isDeleted');
        $query->setParameter('isDeleted', false);
        $query->orderBy('p.date_creation', 'DESC');

        $query->andWhere('p.Confidentiel = :conf');
        $query->setParameter('conf', 0);        

        $query->andWhere('p.cree_par = :user');
        $query->setParameter('user', $user);

        if(!empty($filtre->tri)){
            if($filtre->tri=='projet'){
                $query->orderBy('p.date_creation','DESC');
            }else{
                $query->orderBy('p.date_creation','DESC');
            }
        }else{
            $query->orderBy('p.date_creation','DESC');
        }
       return $query->getQuery()->getResult();
    }
    public function getListeProjetExpoSourcingOwnConf(ProjetFiltre $filtre, $user){
        $listIds = $this->selection->getIdsListe('Compte', 'PAR_SECTEUR', array('sss' => 'ss'));
        
        $query= $this->createQueryBuilder('p')
          ->select('p')
            ->join('p.compte', 'c')
            ->join('c.secteurs','s')
            ->join('p.typeProjet','t')
            ->join('p.etatProjet','e')
            ->join('p.projetsData','pd');
        
        if(!empty($filtre->search)){
            $query->andWhere('p.titre like :title');
            $query->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $query->andWhere('e.id in (:status)');
            $query->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $query->andWhere('t.id in (:type)');
            $query->setParameter('type',$filtre->type);
        }else{
            $query->andWhere('p.type in (:type)');
            $query->setParameter('type',array(2,3));
        }
        if(!empty($filtre->secteur)){
            $query->andWhere('s.id = :id_secteur');
            $query->setParameter('id_secteur', $filtre->secteur);
        }

        if(!empty($filtre->gpac)){
            $query->andWhere('p.GPAC = 1');
        }
        
        if(!empty($filtre->prioritaire)){
            $query->andWhere("pd.cle = 'Prioritaire' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->abouti)){
            $query->andWhere("pd.cle = 'Abouti'");
            $query->andWhere("pd.value = :abouti");
            $query->setParameter('abouti',$filtre->abouti);
            $query->orderBy('p.id');
        }
        if(!empty($filtre->nonabouti)){
            $query->andWhere("pd.cle = 'NAbouti' and ( pd.value = :nonabouti )");
            $query->setParameter('nonabouti',$filtre->nonabouti);
        }
        // if(!empty($filtre->pays)){
        //      $query->andWhere("pd.cle = 'Localisation' ");
        //     $query->andWhere("pd.value = :pays");
        //     $query->setParameter('pays',"1");
        //     $query->orderBy('p.id');

        // }
        if(!empty($filtre->pays)){
            $query->andWhere('c.paysSiege = :pays');
            $query->setParameter('pays', $filtre->pays->getID());
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $query->andwhere($query->expr()->between('p.date_creation', "?1", "?2"));
            $query->setParameter('1', $from);
            $query->setParameter('2', $to);
       }
        if(!empty($filtre->compte)){
          
            $query->andWhere('c.nomCompte = :nomCompte');
            $query->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $query->andWhere('p.gere_par = :gere_par');
            $query->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if (!is_null($listIds)) {
            $query->andWhere('c.id in (:ids)');
            $query->setParameter('ids', $listIds);
        }
        $query->andWhere('p.isDeleted = :isDeleted');
        $query->setParameter('isDeleted', false);
        $query->orderBy('p.date_creation', 'DESC');

        // $query->andWhere('p.Confidentiel = :conf');
        // $query->setParameter('conf', 1);

        $query->andWhere('p.cree_par = :user');
        $query->setParameter('user', $user);

        if(!empty($filtre->tri)){
            if($filtre->tri=='projet'){
                $query->orderBy('p.date_creation','DESC');
            }else{
                $query->orderBy('p.date_creation','DESC');
            }
        }else{
            $query->orderBy('p.date_creation','DESC');
        }
       return $query->getQuery()->getResult();
    }
    public function getListeProjetInvestOwnNoConf(ProjetFiltre $filtre, $user){
        $listIds = $this->selection->getIdsListe('Compte', 'PAR_SECTEUR', array('sss' => 'ss'));
        
        $query= $this->createQueryBuilder('p')
          ->select('p')
            ->join('p.compte', 'c')
            ->join('c.secteurs','s')
            ->join('p.typeProjet','t')
            ->join('p.etatProjet','e')
            ->join('p.projetsData','pd');
        
        if(!empty($filtre->search)){
            $query->andWhere('p.titre like :title');
            $query->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $query->andWhere('e.id in (:status)');
            $query->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $query->andWhere('t.id in (:type)');
            $query->setParameter('type',$filtre->type);
        }
        if(!empty($filtre->secteur)){
            $query->andWhere('s.id = :id_secteur');
            $query->setParameter('id_secteur', $filtre->secteur);
        }

        if(!empty($filtre->gpac)){
            $query->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->confidentiel)){
            $query->andWhere("pd.cle = 'Confidentiel' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->prioritaire)){
            $query->andWhere("pd.cle = 'Prioritaire' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->abouti)){
            $query->andWhere("pd.cle = 'Abouti'");
            $query->andWhere("pd.value = :abouti");
            $query->setParameter('abouti',$filtre->abouti);
            $query->orderBy('p.id');
        }
        if(!empty($filtre->nonabouti)){
            $query->andWhere("pd.cle = 'NAbouti' and ( pd.value = :nonabouti )");
            $query->setParameter('nonabouti',$filtre->nonabouti);
        }
        // if(!empty($filtre->pays)){
        //      $query->andWhere("pd.cle = 'Localisation' ");
        //     $query->andWhere("pd.value = :pays");
        //     $query->setParameter('pays',"1");
        //     $query->orderBy('p.id');

        // }
        if(!empty($filtre->pays)){
            $query->andWhere('c.paysSiege = :pays');
            $query->setParameter('pays', $filtre->pays->getID());
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $query->andwhere($query->expr()->between('p.date_creation', "?1", "?2"));
            $query->setParameter('1', $from);
            $query->setParameter('2', $to);
       }
        if(!empty($filtre->compte)){
          
            $query->andWhere('c.nomCompte = :nomCompte');
            $query->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $query->andWhere('p.gere_par = :gere_par');
            $query->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if (!is_null($listIds)) {
            $query->andWhere('c.id in (:ids)');
            $query->setParameter('ids', $listIds);
        }

        $query->andWhere('p.type in (:type)');
        $query->setParameter('type',1);
        
        $query->andWhere('p.isDeleted = :isDeleted');
        $query->setParameter('isDeleted', false);
        $query->orderBy('p.date_creation', 'DESC');

        $query->andWhere('p.Confidentiel = :conf');
        $query->setParameter('conf', 0);     

        $query->andWhere('p.cree_par = :user');
        $query->setParameter('user', $user);

        if(!empty($filtre->tri)){
            if($filtre->tri=='projet'){
                $query->orderBy('p.date_creation','DESC');
            }else{
                $query->orderBy('p.date_creation','DESC');
            }
        }else{
            $query->orderBy('p.date_creation','DESC');
        }
       return $query->getQuery()->getResult();
    }
    public function getListeProjetInvestOwnConf(ProjetFiltre $filtre, $user){
        $listIds = $this->selection->getIdsListe('Compte', 'PAR_SECTEUR', array('sss' => 'ss'));
        
        $query= $this->createQueryBuilder('p')
          ->select('p')
            ->join('p.compte', 'c')
            ->join('c.secteurs','s')
            ->join('p.typeProjet','t')
            ->join('p.etatProjet','e')
            ->join('p.projetsData','pd');
        
        if(!empty($filtre->search)){
            $query->andWhere('p.titre like :title');
            $query->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $query->andWhere('e.id in (:status)');
            $query->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $query->andWhere('t.id in (:type)');
            $query->setParameter('type',$filtre->type);
        }
        if(!empty($filtre->secteur)){
            $query->andWhere('s.id = :id_secteur');
            $query->setParameter('id_secteur', $filtre->secteur);
        }

        if(!empty($filtre->gpac)){
            $query->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->confidentiel)){
            $query->andWhere("pd.cle = 'Confidentiel' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->prioritaire)){
            $query->andWhere("pd.cle = 'Prioritaire' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->abouti)){
            $query->andWhere("pd.cle = 'Abouti'");
            $query->andWhere("pd.value = :abouti");
            $query->setParameter('abouti',$filtre->abouti);
            $query->orderBy('p.id');
        }
        if(!empty($filtre->nonabouti)){
            $query->andWhere("pd.cle = 'NAbouti' and ( pd.value = :nonabouti )");
            $query->setParameter('nonabouti',$filtre->nonabouti);
        }
        // if(!empty($filtre->pays)){
        //      $query->andWhere("pd.cle = 'Localisation' ");
        //     $query->andWhere("pd.value = :pays");
        //     $query->setParameter('pays',"1");
        //     $query->orderBy('p.id');

        // }
        if(!empty($filtre->pays)){
            $query->andWhere('c.paysSiege = :pays');
            $query->setParameter('pays', $filtre->pays->getID());
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $query->andwhere($query->expr()->between('p.date_creation', "?1", "?2"));
            $query->setParameter('1', $from);
            $query->setParameter('2', $to);
       }
        if(!empty($filtre->compte)){
          
            $query->andWhere('c.nomCompte = :nomCompte');
            $query->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $query->andWhere('p.gere_par = :gere_par');
            $query->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if (!is_null($listIds)) {
            $query->andWhere('c.id in (:ids)');
            $query->setParameter('ids', $listIds);
        }

        $query->andWhere('p.type in (:type)');
        $query->setParameter('type',1);
        
        $query->andWhere('p.isDeleted = :isDeleted');
        $query->setParameter('isDeleted', false);
        $query->orderBy('p.date_creation', 'DESC');

        // $query->andWhere('p.Confidentiel = :conf');
        // $query->setParameter('conf', 0);     
        
        $query->andWhere('p.cree_par = :user');
        $query->setParameter('user', $user);

        if(!empty($filtre->tri)){
            if($filtre->tri=='projet'){
                $query->orderBy('p.date_creation','DESC');
            }else{
                $query->orderBy('p.date_creation','DESC');
            }
        }else{
            $query->orderBy('p.date_creation','DESC');
        }
       return $query->getQuery()->getResult();
    }
    public function getOwnConfid(ProjetFiltre $filtre,$user){
        $qb = $this->createQueryBuilder('p')
            ->select('p')
            ->join('p.compte', 'c')
            ->join('c.secteurs','s')
            ->join('p.typeProjet','t')
            ->join('p.etatProjet','e')
            ->join('p.projetsData','dp');
        $qb->andWhere('p.id = dp.projet');
        

        if(!empty($filtre->search)){
            $qb->andWhere('p.titre like :title');
            $qb->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $qb->andWhere('e.id in (:status)');
            $qb->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $qb->andWhere('t.id in (:type)');
            $qb->setParameter('type',$filtre->type);
        }else{
            $qb->andWhere('p.type not in (:type)');
            $qb->setParameter('type',4);
        }
        if(!empty($filtre->secteur)){
            $qb->andWhere('s.id = :id_secteur');
            $qb->setParameter('id_secteur', $filtre->secteur);
        }

        if(!empty($filtre->gpac)){
            $qb->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->confidentiel)){
            $qb->andWhere("dp.cle = 'Confidentiel' and ( dp.value='oui' or dp.value = 1 )");
        }
        if(!empty($filtre->prioritaire)){
            $qb->andWhere("dp.cle = 'Prioritaire' and ( dp.value='oui' or dp.value = 1 )");
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $qb->andwhere($qb->expr()->between('p.date_creation', "?1", "?2"));
            $qb->setParameter('1', $from);
            $qb->setParameter('2', $to);
       }
        if(!empty($filtre->compte)){
          
            $qb->andWhere('c.nomCompte = :nomCompte');
            $qb->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $qb->andWhere('p.gere_par = :gere_par');
            $qb->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if(!empty($filtre->pays)){
            $qb->andWhere('c.paysSiege = :pays');
            $qb->setParameter('pays', $filtre->pays->getID());
        }
        
        $qb->andWhere('p.cree_par = :user');
        $qb->setParameter('user', $user);
         
        $qb->andWhere('p.isDeleted = :isDeleted');
        $qb->setParameter('isDeleted', false);
        $qb->orderBy('p.date_creation', 'DESC');
        

        if(!empty($filtre->tri)){
            if($filtre->tri=='projet'){
                $qb->orderBy('p.date_creation','DESC');
            }else{
                $qb->orderBy('p.date_creation','DESC');
            }
        }else{
            $qb->orderBy('p.date_creation','DESC');
        }
      return $qb->getQuery()->getResult();
    }
    public function listeProjetInvestBysecteurOwnNoCOnf($id,ProjetFiltre $filtre,$user)
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p')
            ->join('p.compte', 'c')
            ->join('c.secteurs','s');

        $qb->join('p.typeProjet','t')
        ->join('p.etatProjet','e');
        

        if(!empty($filtre->confidentiel) || !empty($filtre->prioritaire)){
          $qb->join('p.projetsData','pd');
        }
        $qb->andWhere('p.isDeleted = :isDeleted');
        $qb->setParameter('isDeleted', false);
        $qb->andWhere('s.id = :id_secteur');
        $qb->setParameter('id_secteur', $id);

        if(!empty($filtre->search)){
            $qb->andWhere('p.titre like :title');
            $qb->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $qb->andWhere('e.id in (:status)');
            $qb->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $qb->andWhere('t.id in (:type)');
            $qb->setParameter('type',$filtre->type);
        }
        if(!empty($id)){
            $qb->andWhere('s.id = :id_secteur');
            $qb->setParameter('id_secteur', $id);
        }

        if(!empty($filtre->gpac)){
            $qb->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->confidentiel)){
            $qb->andWhere("pd.cle = 'Confidentiel' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->prioritaire)){
            $qb->andWhere("pd.cle = 'Prioritaire' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $qb->andwhere($qb->expr()->between('p.date_creation', "?1", "?2"));
            $qb->setParameter('1', $from);
            $qb->setParameter('2', $to);
       }
        if(!empty($filtre->compte)){
          
            $qb->andWhere('c.nomCompte = :nomCompte');
            $qb->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $qb->andWhere('p.gere_par = :gere_par');
            $qb->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if(!empty($filtre->pays)){
            $qb->andWhere('c.paysSiege = :pays');
            $qb->setParameter('pays', $filtre->pays->getID());
        }
        if(!empty($filtre->secteur)){
            $qb->andWhere('s.id = :id_secteur');
            $qb->setParameter('id_secteur', $filtre->secteur);
       }
        $qb->andWhere('p.Confidentiel = :conf');
        $qb->setParameter('conf', 0);     
        $qb->andWhere('p.cree_par = :user');
        $qb->setParameter('user', $user);

        $qb->andWhere('p.type in (:type)');
        $qb->setParameter('type',1);
        return  $qb->getQuery()
            ->getResult()
            ;
    }
    public function listeProjetInvestBysecteurOwnCOnf($id,ProjetFiltre $filtre,$user)
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p')
            ->join('p.compte', 'c')
            ->join('c.secteurs','s');

        $qb->join('p.typeProjet','t')
        ->join('p.etatProjet','e');
        

        if(!empty($filtre->confidentiel) || !empty($filtre->prioritaire)){
          $qb->join('p.projetsData','pd');
        }
        $qb->andWhere('p.isDeleted = :isDeleted');
        $qb->setParameter('isDeleted', false);
        $qb->andWhere('s.id = :id_secteur');
        $qb->setParameter('id_secteur', $id);

        if(!empty($filtre->search)){
            $qb->andWhere('p.titre like :title');
            $qb->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $qb->andWhere('e.id in (:status)');
            $qb->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $qb->andWhere('t.id in (:type)');
            $qb->setParameter('type',$filtre->type);
        }
        if(!empty($id)){
            $qb->andWhere('s.id = :id_secteur');
            $qb->setParameter('id_secteur', $id);
        }

        if(!empty($filtre->gpac)){
            $qb->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->confidentiel)){
            $qb->andWhere("pd.cle = 'Confidentiel' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->prioritaire)){
            $qb->andWhere("pd.cle = 'Prioritaire' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $qb->andwhere($qb->expr()->between('p.date_creation', "?1", "?2"));
            $qb->setParameter('1', $from);
            $qb->setParameter('2', $to);
       }
        if(!empty($filtre->compte)){
          
            $qb->andWhere('c.nomCompte = :nomCompte');
            $qb->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $qb->andWhere('p.gere_par = :gere_par');
            $qb->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if(!empty($filtre->pays)){
            $qb->andWhere('c.paysSiege = :pays');
            $qb->setParameter('pays', $filtre->pays->getID());
        }
        if(!empty($filtre->secteur)){
            $qb->andWhere('s.id = :id_secteur');
            $qb->setParameter('id_secteur', $filtre->secteur);
       }
        // $qb->andWhere('p.Confidentiel = :conf');
        // $qb->setParameter('conf', 0);     
        $qb->andWhere('p.cree_par = :user');
        $qb->setParameter('user', $user);

        $qb->andWhere('p.type in (:type)');
        $qb->setParameter('type',1);
        return  $qb->getQuery()
            ->getResult()
            ;
    }

    public function listeProjetExpSourBysecteurOwnNoConf($id,ProjetFiltre $filtre,$user)
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p')
            ->join('p.compte', 'c')
            ->join('c.secteurs','s');

        $qb->join('p.typeProjet','t')
        ->join('p.etatProjet','e');
        

        if(!empty($filtre->confidentiel) || !empty($filtre->prioritaire)){
          $qb->join('p.projetsData','pd');
        }
        $qb->andWhere('p.isDeleted = :isDeleted');
        $qb->setParameter('isDeleted', false);
        $qb->andWhere('s.id = :id_secteur');
        $qb->setParameter('id_secteur', $id);

        if(!empty($filtre->search)){
            $qb->andWhere('p.titre like :title');
            $qb->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $qb->andWhere('e.id in (:status)');
            $qb->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $qb->andWhere('t.id in (:type)');
            $qb->setParameter('type',$filtre->type);
        }
        if(!empty($id)){
            $qb->andWhere('s.id = :id_secteur');
            $qb->setParameter('id_secteur', $id);
        }

        if(!empty($filtre->gpac)){
            $qb->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->confidentiel)){
            // $qb->andWhere("pd.cle = 'Confidentiel' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->prioritaire)){
            $qb->andWhere("pd.cle = 'Prioritaire' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $qb->andwhere($qb->expr()->between('p.date_creation', "?1", "?2"));
            $qb->setParameter('1', $from);
            $qb->setParameter('2', $to);
       }
        if(!empty($filtre->compte)){
          
            $qb->andWhere('c.nomCompte = :nomCompte');
            $qb->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $qb->andWhere('p.gere_par = :gere_par');
            $qb->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if(!empty($filtre->pays)){
            $qb->andWhere('c.paysSiege = :pays');
            $qb->setParameter('pays', $filtre->pays->getID());
        }
        if(!empty($filtre->secteur)){
            $qb->andWhere('s.id = :id_secteur');
            $qb->setParameter('id_secteur', $filtre->secteur);
       }
        $qb->andWhere('p.Confidentiel = :conf');
        $qb->setParameter('conf', 0);
        $qb->andWhere('p.cree_par = :user');
        $qb->setParameter('user', $user);

        $qb->andWhere('p.type in (:type)');
        $qb->setParameter('type',array(2,3));

        return  $qb->getQuery()
            ->getResult()
            ;
    }
    public function listeProjetExpSourBysecteurOwnConf($id,ProjetFiltre $filtre,$user)
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p')
            ->join('p.compte', 'c')
            ->join('c.secteurs','s');

        $qb->join('p.typeProjet','t')
        ->join('p.etatProjet','e');
        

        if(!empty($filtre->confidentiel) || !empty($filtre->prioritaire)){
          $qb->join('p.projetsData','pd');
        }
        $qb->andWhere('p.isDeleted = :isDeleted');
        $qb->setParameter('isDeleted', false);
        $qb->andWhere('s.id = :id_secteur');
        $qb->setParameter('id_secteur', $id);

        if(!empty($filtre->search)){
            $qb->andWhere('p.titre like :title');
            $qb->setParameter('title',"%{$filtre->search}%");
        }
        if(!empty($filtre->status)){
            $qb->andWhere('e.id in (:status)');
            $qb->setParameter('status',$filtre->status);
        }
        if(!empty($filtre->type)){
            $qb->andWhere('t.id in (:type)');
            $qb->setParameter('type',$filtre->type);
        }
        if(!empty($id)){
            $qb->andWhere('s.id = :id_secteur');
            $qb->setParameter('id_secteur', $id);
        }

        if(!empty($filtre->gpac)){
            $qb->andWhere('p.GPAC = 1');
        }
        if(!empty($filtre->confidentiel)){
            // $qb->andWhere("pd.cle = 'Confidentiel' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->prioritaire)){
            $qb->andWhere("pd.cle = 'Prioritaire' and ( pd.value='oui' or pd.value = 1 )");
        }
        if(!empty($filtre->startdate) && !empty($filtre->enddate)){
           
            $from = new \DateTimeImmutable($filtre->startdate->format('Y-m-d')." 00:00:00");
            $to   = new \DateTimeImmutable($filtre->enddate->format('Y-m-d')." 23:59:59");
            $qb->andwhere($qb->expr()->between('p.date_creation', "?1", "?2"));
            $qb->setParameter('1', $from);
            $qb->setParameter('2', $to);
       }
        if(!empty($filtre->compte)){
          
            $qb->andWhere('c.nomCompte = :nomCompte');
            $qb->setParameter('nomCompte', $filtre->compte);
        }
        if(!empty($filtre->FiltregerePar)){
            $qb->andWhere('p.gere_par = :gere_par');
            $qb->setParameter('gere_par', $filtre->FiltregerePar);
        }
        if(!empty($filtre->pays)){
            $qb->andWhere('c.paysSiege = :pays');
            $qb->setParameter('pays', $filtre->pays->getID());
        }
        if(!empty($filtre->secteur)){
            $qb->andWhere('s.id = :id_secteur');
            $qb->setParameter('id_secteur', $filtre->secteur);
       }
        // $qb->andWhere('p.Confidentiel = :conf');
        // $qb->setParameter('conf', 0);
        $qb->andWhere('p.cree_par = :user');
        $qb->setParameter('user', $user);

        $qb->andWhere('p.type in (:type)');
        $qb->setParameter('type',array(2,3));

        return  $qb->getQuery()->getResult();
    }
}
