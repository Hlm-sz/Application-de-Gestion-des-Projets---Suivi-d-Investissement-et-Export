<?php


namespace App\Form;


use App\FiltreData\PartenaireFiltre;
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

class PartenaireFiltreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('search',null,['label'=>'Chercher','required'=>false])
            ->add('type',
            ChoiceType::class,
            [
                'label'=>'Type',
                'required'=>false,
                'choices'  => [
                    'Ministère ou Administration P.'=>' Ministère ou Administration P.',
                    'Association ou Fédération Professionnelle'=> 'Association ou Fédération Professionnelle',
                    'Ambassade ou Représentation Diplomatique'=>'Ambassade ou Représentation Diplomatique',
                    'CRI'=>'CRI','Chambre de Commerce'=>'Chambre de Commerce',
                    'Commission des Investissements'=>'Commission des Investissements',
                    'Relai'=>'Relai',
                    'Bureaux économiques étrangers'=>'Bureaux économiques étrangers',
                    'Organisations internationales'=>'Organisations internationales',
                    'Bailleurs de fonds et banques multilatérales'=>'Bailleurs de fonds et banques multilatérales',
                    'Institutions financières'=>'Institutions financières',
                    'Autres'=>'Autres'
                ]
            ]
        )
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
            'data_class' => PartenaireFiltre::class,
            'method' => 'GET',
            'csrf_protection'=> false
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }
}