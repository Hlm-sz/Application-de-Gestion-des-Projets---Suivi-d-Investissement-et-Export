<?php

namespace App\Form;

use App\Entity\Compte;
use App\Utils\Form\BuilderForm;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;              // *mael* 
use App\Repository\CanalRepository;                 // *mael* 
use Symfony\Bridge\Doctrine;                        // *mael* 
use Doctrine\Persistence\ManagerRegistry;           // *mael* 
use Doctrine\ORM\EntityManagerInterface;            // *mael* 
use Symfony\Component\Form\Test\FormInterface;      // *mael* 
use App\Repository\EventRepository;                 // *mael* 
use Symfony\Component\Form\Extension\Core\Type\TextType;


class CompteType extends AbstractType
{
    private $form;
    private $Manager; // *mael* 

    public function __construct(ManagerRegistry $Manager)
    {
        $this->form=new BuilderForm();
        $this->Manager = $Manager;

    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomCompte', TextType::class, [
                'label_format' => 'compte.NomCompte'
            ])
            ->add('categorie', null, ['label_format' => 'compte.InstalleMaroc'])
            ->add(
                'centreDecision',

                EntityType::class,
                [
                    'class' => 'App\Entity\Pays',
                    'choice_label' => 'nom',
                    'label_format' => 'compte.CentreDecision',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->andWhere('p.isDeleted NOT IN (:isDeleted)')
                            ->setParameter('isDeleted', true);
                    }
                ]
            )
            ->add('chiffreAffaires', IntegerType::class,
             ['label_format' => 'Chiffre d’affaires (Milliers/DHs)',
             'required' => false
             ])
            ->add('detailLibre', null, ['label_format' => 'compte.DetailLibre'])
            ->add('signalement', null, ['label_format' => 'compte.Signalement'])
            ->add(
                'type',
                EntityType::class,
                [
                    'class' => 'App\Entity\TypeCompte',
                    'choice_label' => 'nom',
                    // 'multiple' => true,
                    'label_format' => 'compte.Type'
                ]
            )
            ->add(
                'paysSiege',
                EntityType::class,
                [
                    'class' => 'App\Entity\Pays',
                    'choice_label' => 'nom',
                    'required' => true,
                    'label_format' => 'compte.PaysSiege',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->andWhere('p.isDeleted NOT IN (:isDeleted)')
                            ->setParameter('isDeleted', true);
                    }
                ]
            )
            ->add(
                'paysImplantationSuccursales',
                EntityType::class,
                [
                    'class' => 'App\Entity\Pays',
                    'choice_label' => 'nom',
                    'multiple' => true,
                    'required' => false,
                    'label_format' => 'compte.paysImplantationSuccursales',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->andWhere('p.isDeleted NOT IN (:isDeleted)')
                            ->setParameter('isDeleted', true);
                    }
                ]
            )
            ->add(
                'secteurs',
                EntityType::class,
                [
                    'class' => 'App\Entity\Secteur',
                    'choice_label' => 'nom',
                    'multiple' => true,
                    'required' => false,
                    'label_format' => 'compte.Secteurs',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('s')
                            ->andWhere('s.isDeleted NOT IN (:isDeleted)')
                            ->setParameter('isDeleted', true);
                    }
                ]
            )
            ->add(
                'ecosystemeFiliere',
                EntityType::class,
                [
                    'class' => 'App\Entity\EcosystemeFiliere',
                    'choice_label' => 'nom',
                    'required' => false,
                    'label_format' => 'compte.EcosystemeFiliere'
                ]
            )
            ->add(
                'responsableCompte',
                EntityType::class,
                [
                    'class' => 'App\Entity\User',
                    'choice_label' => function ($user) {
                        return $user->getPrenom() . " " . $user->getNom();
                    },
                    'label_format' => 'compte.ResponsableCompte',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->andWhere('u.isDeleted NOT IN (:isDeleted)')
                            ->setParameter('isDeleted', true);
                    }
                ]
            )
            ->add(
                'etatCompte',
                EntityType::class,
                [
                    'class' => 'App\Entity\EtatCompte',
                    'choice_label' => 'nom',
                    'label_format' => 'compte.EtatCompte',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                                  ->andWhere('e.id not in (:val)')
                                  ->setParameter('val',array(5));
                    }
                ]
            )->add('logo', FileType::class,array('data_class' => null,'required' => false))
            ;

            $builder
            ->add(
                'canal_aux',
                EntityType::class,
                [
                    'class' => 'App\Entity\Canal',
                    'mapped' => false,
                    'required' => false,
                    'choice_label'=> 'nom',
                    'label' => 'Canal Source d\'insertion ',
                    'placeholder' => 'Choisir votre canal ...',
                    'query_builder' => 'App\Repository\CanalRepository::CanalList'

                ]
            )
            ->add(
                'canal_opt_n1_aux', 
                EntityType::class ,
                [
                    'label' => 'Détails du canal source',
                    'class' => 'App\Entity\TEvent',
                    'mapped' => false,
                    'required' => false,
                    'choice_label'=> 'nom',
                    'placeholder' => 'Choisir en premier (...canal/source)',
                    'attr' => ['readonly' => true],
                    //'disabled' => true,
                    'choices' => [], 
                    //'query_builder' => 'App\Repository\CanalRepository::listCanal'

                ]
            )
            ->add(
                'canal_opt_n2_aux', 
                EntityType::class ,
                [
                    'label' => 'Détails secondaire du canal source',
                    'class' => 'App\Entity\Event',
                    'mapped' => false,
                    'required' => false,
                    'choices' => [], 
                    'choice_label'=> 'nom',
                    'placeholder' => 'Plus de détails (...canal/source)',
                ]
            )
            ;



            $builder
                ->get('canal_aux')
                    ->addEventListener (
                        FormEvents::POST_SUBMIT, 
                        function( FormEvent $event )
                        {
//dd( $event);
                            $canal = $event->getForm()->getData(); 
                            $toto = null === $canal ? null : $canal->getId();
                            $canal_info = CanalRepository::listCanal( 
                                            new CanalRepository( $this->Manager ) 
                                        )
                                ->getQuery()->getResult();

                            if ( $canal === null ) 
                                return;
                            /* Canal Direct :: FREE INFOS */
                            if ( $canal->getId() == 16 )
                            {
                                $event->getForm()->getParent()->add(
                                    'canal_opt_n1_aux',
                                    TextType::class, 
                                    [
                                        'empty_data' => 'Informations libres',
                                        'mapped' => false,
                                        'label' => 'Détails du canal/source',
                                        ]
                                )
                                ;
                            }
                            /* ::: END ::: Canal Direct :: FREE INFOS ::: */
                            else if ( $canal->getId() == 17 )
                            /* Canal :: Social NetWork  */
                            {
                                $event->getForm()->getParent()->add(
                                    'canal_opt_n1_aux',
                                    EntityType::class, 
                                    [
                                        'class' => 'App\Entity\Canal',
                                        'mapped' => false,
                                        'required' => false,
                                        'choice_label'=> 'nom',
                                        'placeholder' => '( ... Social Network )',
                                        'attr' => ['class' => 'custom-select'],
                                        'query_builder' => 'App\Repository\CanalRepository::CanalSocNet',
                                        'label' => 'Détails du canal/source',
                                        ]
                                )
                                ;
                            }
                            /* ::: END ::: Canal :: Social NetWork ::: */
                            else if (  $canal->getId() == 15 )
                            /* Canal :: Evenement */
                            {
                                $event->getForm()->getParent()->add(
                                    'canal_opt_n1_aux',
                                    EntityType::class, 
                                    [
                                        'class' => 'App\Entity\TEvent',
                                        'mapped' => false,
                                        'required' => false,
                                        'choice_label'=> 'nom',
                                        'placeholder' => '( ... Event Type )',
                                        'attr' => ['class' => 'custom-select'],
                                        'label' => 'Détails du canal/source',
                                        // 'query_builder' => function (EntityRepository $er) {
                                        //     return $er->createQueryBuilder('p')
                                        //         ->andWhere('p.active IN (:active)')
                                        //         ->setParameter('active', true);
                                        // }
                                    ]
                                )
                                ;
/* /************************** */
//dd( $this) ;
/* /************************** */

                            }
                            /* ::: END ::: Canal :: Evenement ::: */
                            else
                            /* Canal :: Relais */
                            {
                                $event->getForm()->getParent()->add(
                                    'canal_opt_n1_aux',
                                    EntityType::class, 
                                    [
                                        'class' => 'App\Entity\Compte',
                                        'mapped' => false,
                                        'required' => false,
                                        'choice_label'=> 'nom_compte',
                                        'placeholder' => '( ... Relais )',
                                        'attr' => ['class' => 'custom-select'],
                                        'query_builder' => 'App\Repository\CompteRepository::listRelais', // listRelais // getListsPartenaires
                                        'label' => 'Détails du canal/source',
                                        ]
                                )
                                ;
                            }
                            /* ::: END ::: Canal :: Relais ::: */
                            // dd( $event->getForm()->getData() );
                        }/* ::: END ::: function :: function( FormEvent $event ) ::: */
                    )
            ;
            

            /* List :: Events */ 
            $builder
            ->get('canal_opt_n1_aux')
                ->addEventListener(
                    FormEvents::POST_SUBMIT, 
                    function( FormEvent $event )
                    {
                        $tEvent = $event->getForm()->getData();

                        $result = null === $tEvent ? [] : EventRepository::ListEvent( 
                                    $tEvent->getNom() /*'Road Show' /*$tEvent->getNom()*/ ,
                                    new EventRepository( $this->Manager )
                                )
                                ->getQuery()->getResult()
                        ;

                        $event->getForm()->getParent()->add(
                            'canal_opt_n2_aux',
                            EntityType::class, 
                            [
                                'class' => 'App\Entity\Event',
                                'choices' => $result,
                                'mapped' => false,
                                'required' => false,
                                'choice_label'=> 'nom',
                                'placeholder' => '(...Events)',
                                'attr' => ['class' => 'custom-select'],
                                //'query_builder' => 'App\Repository\EventRepository::listEvent',
                                'label' => 'Plus de détails (...canal/source)',
                                ]
                        )
                        ;
                    }
                )
            ;
            /* ::: END ::: List :: Events ::: */




        $schema = $options['schema_form'];

        $this->form->generateForm($builder, $schema);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Compte::class,
            'schema_form' => null
        ]);
    }
}
