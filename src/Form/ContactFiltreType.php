<?php


namespace App\Form;


use App\Entity\EtatProjet;
use App\FiltreData\ContactFiltre;
use App\FiltreData\ProjetFiltre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security as atom;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class ContactFiltreType extends AbstractType 
{

    private $user;
    public function __construct(atom $security)
    {
        $this->user=$security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $restrictions=$this->user->getUser()->getGroupe()->getRestrictions();
        $exclusif = false;
        if($restrictions){
            foreach ($restrictions as $restriction){
                if($restriction->getId() == 5){
                    $exclusif = true;
                } 
            }
        }
        if($exclusif){
                    $builder
                        ->add('search',
                        EntityType::class,
                        [
                            'class' => 'App\Entity\Contact',
                            'choice_label' => 'nomcomplet',
                            'required'=>false,
                            'query_builder' => function (EntityRepository $er) {
                                return $er->createQueryBuilder('c')
                                        ->andWhere('c.exclusif = :isEX')
                                        ->setParameter('isEX', false);
                            }
                        ])
                        ->add('canal',
                            EntityType::class,
                            [
                                'class' => 'App\Entity\Canal', 
                                'choice_label' => 'nom',
                                // 'multiple'=>true,
                                // 'expanded' =>true,
                                'label_attr' => ['class' => 'checkbox-custom'],
                                'required'=>false
                            ]
                        )
                        ->add('profil',
                        EntityType::class,
                        [
                            'class' => 'App\Entity\Profils',
                            'choice_label' => 'nom',
                            'required'=>false
                        ] 
                    )
                    ->add('startdate', DateType::class,[
                        'attr'   => ['max' => ( new \DateTime() )->format('Y-m-d')],
                        'widget' => 'single_text',
                        'required'=>false,
                        'label' => 'Période de creation'
                    ])
                    ->add('enddate', DateType::class,[
                        'attr'   => ['max' => ( new \DateTime() )->format('Y-m-d')],
                        'widget' => 'single_text',
                        'required'=>false,
                        'label' => ' '
                    ]);
        }else{
            $builder
                ->add('search',
                EntityType::class,
                [
                    'class' => 'App\Entity\Contact',
                    'choice_label' => 'nomcomplet',
                    'required'=>false
                ])
                ->add('canal',
                    EntityType::class,
                    [
                        'class' => 'App\Entity\Canal', 
                        'choice_label' => 'nom',
                        // 'multiple'=>true,
                        // 'expanded' =>true,
                        'label_attr' => ['class' => 'checkbox-custom'],
                        'required'=>false
                    ]
                )
                ->add('profil',
                EntityType::class,
                [
                    'class' => 'App\Entity\Profils',
                    'choice_label' => 'nom',
                    'required'=>false
                ] 
            )
            ->add('startdate', DateType::class,[
                'attr'   => ['max' => ( new \DateTime() )->format('Y-m-d')],
                'widget' => 'single_text',
                'required'=>false,
                'label' => 'Période de creation'
            ])
            ->add('enddate', DateType::class,[
                'attr'   => ['max' => ( new \DateTime() )->format('Y-m-d')],
                'widget' => 'single_text',
                'required'=>false,
                'label' => ' '
            ]);
        }

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactFiltre::class,
            'method' => 'GET',
            'csrf_protection'=> false
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }
}