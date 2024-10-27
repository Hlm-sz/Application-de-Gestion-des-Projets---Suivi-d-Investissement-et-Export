<?php


namespace App\Form;


use App\FiltreData\CompteFiltre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
 
class CompteFiltreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('search',null,['label'=>'Chercher','required'=>false])
            ->add('categorie',
                ChoiceType::class,
                [
                    'choices' => ['Installés au Maroc' => 1 ,'Non Installés au Maroc'=> 2 ],
                   // 'multiple'=>false,
                    //'expanded' =>true,
                    'label_attr' => ['class' => 'radio-custom'],
                    'required'=>false,
                    'label'=> 'Catégorie',
                ]
            )
            ->add('type',
                EntityType::class,
                [
                    'class' => 'App\Entity\TypeCompte',
                    'choice_label' => 'nom',
                    // 'multiple'=>true,
                    // 'expanded' =>true,
                    // 'label_attr' => ['class' => 'checkbox-custom'],
                    'required'=>false
                ]
            )
            ->add('status',
                EntityType::class,
                [
                    'class' => 'App\Entity\EtatCompte',
                    'choice_label' => 'nom',
                    'required'=>false,
                    'placeholder' => '',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('s')
                            ->andWhere('s.id NOT IN (:isDeleted)')
                            ->setParameter('isDeleted', 7);
                    }
                ]
            )

            ->add('signalement',CheckboxType::class,[
                'label_attr' => ['class' => 'checkbox-custom'],
                'label'=> 'Signalement',
                'required'=>false
            ])
            ->add('startdate', DateType::class, [
                'widget' => 'single_text',
                'required'=>false,
                'label' => 'Période de creation',
                'attr'   => ['max' => ( new \DateTime() )->format('Y-m-d')]
            ])
            ->add('enddate', DateType::class, [
                'widget' => 'single_text',
                'required'=>false,
                'label' => ' ',
                'attr'   => ['max' => ( new \DateTime() )->format('Y-m-d')]
    
            ])
            ->add('tri',HiddenType::class)
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
           ->add('secteur',HiddenType::class,[
               'required'=>false
           ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CompteFiltre::class,
            'method' => 'GET',
            'csrf_protection'=> false
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }
}