<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\TEvent;
use App\Repository\CompteRepository;
use App\Repository\SecteurRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use App\Entity\EventCompte;

class EventType extends AbstractType
{

    private $entityManager;
    private $compteRepository;
    private $secteurRepository;
    private $compteFusion;


    public function __construct(EntityManagerInterface $entityManager,CompteRepository $compteRepository,SecteurRepository $secteurRepository)
    {
        $this->entityManager = $entityManager;
        $this->compteRepository = $compteRepository;
        $this->secteurRepository = $secteurRepository;
        $this->compteFusion= [];

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',null,['label_format' => 'event.Nom_event',
            'required'   => true])
            ->add('mois',ChoiceType::class,[
                'choices' => [
                    'Janvier' => 'Janvier',
                    'Février' => 'Février',
                    'Mars' => 'Mars',
                    'Avril' => 'Avril',
                    'Mai' => 'Mai',
                    'juin' => 'Juin',
                    'Juillet' => 'Juillet',
                    'Août' => 'Août',
                    'Septembre' => 'Septembre',
                    'Octobre' => 'Octobre',
                    'Novembre' => 'Novembre',
                    'Décembre' => 'Décembre'
                ],
                'label_format' => 'event.Mois',
            ])
            ->add('annee',ChoiceType::class,[
                'choices' => [
                    '2020' => '2020',
                    '2021' => '2021',
                    '2022' => '2022',
                    '2023' => '2023',
                    '2024' => '2024',
                    '2025' => '2025',
                    '2026' => '2026',
                    '2027' => '2027',
                    '2028' => '2028',
                    '2029' => '2029',
                    '2030' => '2030',
                ],
                'label_format' => 'event.Annee',
            ])
            ->add(
                'pays',
                EntityType::class,
                [
                    'label_format' => 'event.Pays',
                    'class' => 'App\Entity\Pays',
                    'choice_label' => 'nom',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->andWhere('p.isDeleted NOT IN (:isDeleted)')
                            ->setParameter('isDeleted', true);
                    }
                ]

            )->add('documet', FileType::class,array('data_class' => null,'required' => false))

            // ->add('secteur',
            //     EntityType::class,
            //     [
            //         'label_format' => 'event.Secteur',
            //         'class' => 'App\Entity\Secteur',
            //         'choice_label' => 'nom',
            //         'query_builder' => function (EntityRepository $er) {
            //             return $er->createQueryBuilder('s')
            //                 ->andWhere('s.isDeleted NOT IN (:isDeleted)')
            //                 ->setParameter('isDeleted', true);
            //         },
                    
            //     ]
            // )
            ->add("secteur", ChoiceType::class,
                [
                    "label" => "event.Secteur",
                    "choices" => $this->getSecteurs(),
                    "attr" => array("class" => "form-control"), 
                    'multiple' => true
                    // 'data' => $this->getSecteurs()
                ]
            )
            ->add('formatParticipation',ChoiceType::class,[
                'choices'=>[
                    'Salon spécialisé'=>'Salon spécialisé',
                    'Foire et exposition internationale'=>'Foire et exposition internationale',
                    'institutionnel (Forum; conférence)'=>'institutionnel (Forum; conférence)',
                    'Convention d’affaire'=>'Convention d’affaire',
                    'Suppliers days'=>'Suppliers days',
                    'Incoming Visit'=>'Incoming Visit',
                    'Road Show'=>'Road Show',
                    'BtoB'=>'BtoB',
                ],
                'label_format' => 'event.Format_participation',
            ])

            // ->add('format_participation', EntityType::class,[
            //     'class' => 'App\Entity\TEvent',
            //     'label_format' => 'event.Format_participation',
            //     'choice_label' => 'nom',
            //     'query_builder' => function (EntityRepository $er) {
            //         return $er->createQueryBuilder('p')
            //             ->andWhere('p.is_old IN (:is_old)')
            //             ->setParameter('is_old', true);
            //     }

            // ])

           

            ->add('Organisateur',ChoiceType::class,

                [
                    'choices'=> [
                        'AMDIE'=>'AMDIE',
                        'Partenaire'=>'Partenaire',
                        'Autre'=>'Autre'
                    ],
                    'label_format' => 'event.Organisateur',
                ]

            )
            // ->add('partenaires',
            //     EntityType::class,
            //     [
            //         'label_format' => 'event.Comptes',
            //         'class' => 'App\Entity\Compte',
            //         'choice_label' => 'nomCompte',
            //         'multiple' => true,
            //         'query_builder' => function (EntityRepository $er) {
            //             return $er->createQueryBuilder('c')
            //                 ->andWhere('c.type in (:type)')
            //                 ->setParameter('type',4)
            //                 ->andWhere('c.isDeleted NOT IN (:isDeleted)')
            //                 ->setParameter('isDeleted', true);
            //         }
            //     ]
            // )
            ->add("partenaires", ChoiceType::class,
                    ["label" => "partenaires",
                    "choices" => $this->getPartenaires(),
                    "attr" => array("class" => "form-control"), 
                    'multiple' => true,
                    ])
            
            ->add('nom',null,[
                'label_format' => 'event.Nom_event',])

            //add field for nombre_procpects_invesstisseur 
            ->add('nombre_procpects_invesstisseur',null,[
                'label_format' => 'Nombre Procpects Invesstisseur',])

            //add field for nombre_business_dev_investisseur 
            ->add('nombre_business_dev_investisseur',null,[
                'label_format' => 'Nombre de BtoB (Business Dev – Investisseur)',])

            //add field for nombre_prospects_do 
            ->add('nombre_prospects_do',null,[
                'label_format' => 'Nombre de prospects DO',])
                
            //add field for nombre_entreprises_accompagnees 
            ->add('nombre_entreprises_accompagnees',null,[
                'label_format' => 'Nombre d’entreprises accompagnées',])

            //add field for nombre_business_dev_do 
            ->add('nombre_business_dev_do',null,[
                'label_format' => 'Nombre de BtoB (Business Dev – DO) ',])
                
            //add field for nombre_entreprises_accompagnees 
            ->add('nombre_exportateur_do',null,[
                'label_format' => 'Nombre de BtoB (Exportateur – DO)',])    

            ->add('typeEvenement', ChoiceType::class, [
                'choices'  => [
                    'Investissement' => 'Investissement',
                    'Export' => 'Export',
                    'Institutionnel' => 'Institutionnel',
                    'Hybride' => 'Hybride (Investissement / Export)'
                ],
                'multiple'=> true,
            ])
            
            ->add('description')

            ->add('listeInvestisseurs', EntityType::class, [
                'label' => 'Liste Investisseurs',
                'class' => 'App\Entity\Compte',
                'choice_label' => 'nomCompte',
                //'mapped' => false,
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                                return $er->createQueryBuilder('c')
                                    ->andWhere('c.type in (:type)')
                                    ->setParameter('type',array(2))
                                    ->andWhere('c.isDeleted NOT IN (:isDeleted)')
                                    ->setParameter('isDeleted', true);
                }
            ])
            
            ->add('listeDO', EntityType::class, [
                'label' => 'Liste DO',
                'class' => 'App\Entity\Compte',
                'choice_label' => 'nomCompte',
                //'mapped' => false,
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->andWhere('c.type = :type')
                        ->setParameter('type',array(3))
                        ->andWhere('c.isDeleted = :isDeleted')
                        ->setParameter('isDeleted', false);
                }
            ])
            ->add('listeExportateurs', EntityType::class, [
                'label' => 'Liste Exportateurs',
                'class' => 'App\Entity\Compte',
                'choice_label' => 'nomCompte',
                //'mapped' => false,
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->andWhere('c.type = :type')
                        ->setParameter('type',array(1))
                        ->andWhere('c.isDeleted = :isDeleted')
                        ->setParameter('isDeleted', false);
                }
            ])
        
            ->add('comptes',
                EntityType::class,
                [
                    'label_format' => 'event.Comptes',
                    'class' => 'App\Entity\Compte',
                    'choice_label' => 'nomCompte',
                    'multiple' => true,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('c')
                            ->andWhere('c.type in (:type)')
                            ->setParameter('type',array(1,2,3))
                            ->andWhere('c.isDeleted NOT IN (:isDeleted)')
                            ->setParameter('isDeleted', true);
                    }
                ]
            )

        ;
    
        


$builder->addEventListener(FormEvents::PRE_SUBMIT, function(FormEvent $event) {
    // Récupérer les données soumises
    $formData = $event->getData();
       
    // Récupérer les listes depuis les données soumises et les convertir en tableaux
    $listeInvestisseurs = isset($formData['listeInvestisseurs']) ? $formData['listeInvestisseurs'] : [];
    $listeDO = isset($formData['listeDO']) ? $formData['listeDO'] : [];
    $listeExportateurs = isset($formData['listeExportateurs']) ? $formData['listeExportateurs'] : [];

    // Fusionner les valeurs des trois champs en un seul champ
    $comptes = array_merge($listeInvestisseurs, $listeDO, $listeExportateurs);
    // dd($comptes);
    // Ajouter les comptes fusionnés aux données soumises
    $formData['comptes'] = $comptes;
    //dd($formData);
    // Mettre à jour les données soumises
    $event->setData($formData);
});


// $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
//     // Récupérer les données soumises
//     $formData = $event->getData();
//      dd($formData);   
//     // Récupérer les listes depuis le formulaire et les convertir en tableaux
//     $listeInvestisseurs = $formData->getListeInvestisseurs()->toArray();
//     $listeDO = $formData->getListeDO()->toArray();
//     $listeExportateurs = $formData->getListeExportateurs()->toArray();

//     // Fusionner les valeurs des trois champs en un seul champ
//     $comptes = array_merge($listeInvestisseurs, $listeDO, $listeExportateurs);

//     // Ajouter les comptes fusionnés aux données du formulaire
//     $formData->setComptes($comptes);

//     // Définir les données mises à jour
//     $event->setData($formData);
// });



//         $builder->addEventListener(FormEvents::PRE_SUBMIT, function(FormEvent $event) {
//             $formData = $event->getData();
//               // Ajouter les nouvelles données aux données existantes
//     foreach (['listeExportateurs', 'listeInvestisseurs', 'listeDO'] as $fieldName) {
//         if (isset($formData[$fieldName]) && is_array($formData[$fieldName])) {
//             // Utiliser array_merge pour ajouter les nouvelles données à $this->compteFusion
//             $this->compteFusion = array_merge($this->compteFusion, $formData[$fieldName]);
//         }
//     }
// });
        // $builder->get('listeExportateurs')->addEventListener(FormEvents::PRE_SUBMIT , function(FormEvent $eve)
        //     {
        //         $data = $eve->getData() ;
        //         $this->compteFusion = array_merge( $this->compteFusion, $eve->getData());
        //     }
        // );
        // $builder->get('listeInvestisseurs')->addEventListener(FormEvents::PRE_SUBMIT , function(FormEvent $eve)
        // {
        //     $data = $eve->getData() ;
        //     $this->compteFusion = array_merge( $this->compteFusion, $eve->getData());
        // }
        // );
        // $builder->get('listeDO')->addEventListener(FormEvents::PRE_SUBMIT , function(FormEvent $eve)
        // {
        //     $data = $eve->getData() ;
        //     $this->compteFusion = array_merge( $this->compteFusion, $eve->getData());
        // }
        // );
        // $builder->get('comptes')->addEventListener(FormEvents::PRE_SUBMIT , function(FormEvent $eve)
        // {
        //     $eve->setData( $this->compteFusion ) ;
            
        // }
        // );

    }

    

    private function getPartenaires() {
    $results = $this->compteRepository->getListsPartenairesEve();
        $PartUnit = array();
        $PartUnits = array();
        foreach($results as $part){
            $PartUnit[$part->getNomCompte()] = $part->getNomCompte();
         }
        return $PartUnit;
    }
    private function getSecteurs() {
        $results = $this->secteurRepository->ListsSecteurs();
            $PartUnit = array();
            $PartUnits = array();
            foreach($results as $part){
                $PartUnit[$part->getNom()] = $part->getNom();
            }
            return $PartUnit;
    }

    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
    
}
