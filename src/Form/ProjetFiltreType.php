<?php


namespace App\Form;


use App\Entity\EtatProjet;
use App\FiltreData\ProjetFiltre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetFiltreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('search',null,['label'=>'Chercher','required'=>false])
            ->add('type',
                EntityType::class,
                [
                    'class' => 'App\Entity\TypeProjet',
                    'choice_label' => 'nom',
                    // 'multiple'=>true,
                    // 'expanded' =>true,
                    'label_attr' => ['class' => 'checkbox-custom'],
                    'required'=>false
                ]
            )
            ->add(
                'status',
                EntityType::class,
                [
                    'class' => EtatProjet::class,
                    // 'multiple'=>true,
                    // 'expanded' =>true,
                    'label_attr' => ['class' => 'checkbox-custom'],
                    'required'=>false
                ]
            )
            ->add('gpac',CheckboxType::class,[
                'label_attr' => ['class' => 'checkbox-custom'],
                'label'=> 'GPAC',
                'required'=>false
            ])
            ->add('tri',HiddenType::class)
            ->add('confidentiel',CheckboxType::class,[
                'label_attr' => ['class' => 'checkbox-custom'],
                'label'=> 'Confidentiel',
                'required'=>false
            ])
            ->add('prioritaire',CheckboxType::class,[
                'label_attr' => ['class' => 'checkbox-custom'],
                'label'=> 'Stratégique',
                'required'=>false
            ])

            ->add('abouti',CheckboxType::class,[
                'label_attr' => ['class' => 'checkbox-custom'],
                'label'=> 'Abouti',
                'required'=>false
                ])
            ->add('nonabouti',CheckboxType::class,[
                'label_attr' => ['class' => 'checkbox-custom'],
                'label'=> 'Bloqué',
                'required'=>false
                ])
            ->add('pays',EntityType::class,[
                'class' => 'App\Entity\Pays',
                'choice_label' => 'nom',
                'label_attr' => ['class' => 'checkbox-custom'],
                'required'=>false
                ])
            ->add('startdate', DateType::class, [
                    'widget' => 'single_text',
                    'required'=>false,
                    'label' => 'Période',
                    'attr'   => ['max' => ( new \DateTime() )->format('Y-m-d')]
                ])
            ->add('enddate', DateType::class, [
                    'widget' => 'single_text',
                    'required'=>false,
                    'label' => ' ',
                    'attr'   => ['max' => ( new \DateTime() )->format('Y-m-d')]
        
                ])
            // ->add('gerePar', HiddenType::class)
            // ->add('user_filtre', TextType::class, [
            //     'required'=>false,
            //     'label'=>'Géré Par',
            //     'mapped'=>false
            // ])
             ->add('FiltregerePar',
            EntityType::class,
            [
                'class' => 'App\Entity\User',
                'choice_label' => 'nomcomplet',
                'required'=>false,
                'attr' => ['id' => 'filtregererpar'],
                'label' => 'Géré par',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.isDeleted = :isdel')
                        ->setParameter('isdel', false);
                }
            ]
        )
            // ->add('compte', HiddenType::class)
            // ->add('compte_filtre', TextType::class, [
            //     'required'=>false,
            //     'label'=>'Compte',
            //     'mapped'=>false
            // ])
            ->add('compte',null,['label'=>'Compte','required'=>false])

           ->add('secteur',HiddenType::class,[
               'required'=>false
           ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProjetFiltre::class,
            'method' => 'GET',
            'csrf_protection'=> false
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }

//     ->add('search',null,['label'=>'Chercher','required'=>false])
             
//     ->add('tri',HiddenType::class)
//    ->add('secteur',EntityType::class,
//    [
//        'class' => 'App\Entity\Secteur',
//        'choice_label' => 'nom',
//        'label_attr' => ['class' => 'checkbox-custom'],
//        'required'=>false
//    ]
//    )
//    ->add('year', DateType::class, [
//     'widget' => 'single_text',
//     'format' => 'yyyy-MM-dd',
//     'label' => 'Année'
// ]);

}