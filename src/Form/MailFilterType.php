<?php

namespace App\Form;

use App\Entity\Mail;
use App\Entity\Canal;
use App\Entity\Profils;
use App\Entity\TypeMail;
use App\FiltreData\EmailFiltre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MailFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contact',
                EntityType::class,
                [
                    'class' => 'App\Entity\Contact',
                    'choice_label' => 'email',
                    'multiple'=> true,
                    'required'=>false,
                    'attr' => [
                        'class' => 'select-contacts'
                    ]

                ]
            )
            // ->add('pays',
            //     EntityType::class,
            //     [
            //         'class' => 'App\Entity\Pays',
            //         'choice_label' => 'nom',
            //         'multiple'=> true,
            //         'required'=>false,
            //         'attr' => [
            //             'class' => 'select-pays'
            //         ]

            //     ]
            // )
            ->add('secteur',
                EntityType::class,
                [
                    'class' => 'App\Entity\Secteur',
                    'choice_label' => 'nom',
                    'multiple'=> true,
                    'required'=>false,
                    'attr' => [
                        'class' => 'select-secteurs'
                    ]

                ]
            )
            // ->add('event',
            //     EntityType::class,
            //     [
            //         'class' => 'App\Entity\Event',
            //         'choice_label' => 'nom',
            //         'multiple'=> true,
            //         'required'=>false,
            //         'attr' => [
            //             'class' => 'select-events'
            //         ]

            //     ]
            // )
           /* ->add('canal',
                EntityType::class,
                [
                    'class' => 'App\Entity\Canal',
                    'choice_label' => 'nom',
                ]
            )
            ->add('profil',
            EntityType::class,
            [
                'class' => 'App\Entity\Profils',
                'choice_label' => 'nom',

            ]
            )
            ->add('type',
            EntityType::class,
            [
                'class' => 'App\Entity\TypeMail',
                'choice_label' => 'nom',
                'multiple'=>true,
                'expanded' =>true,
                'label_attr' => ['class' => 'checkbox-custom'],
                'required'=>false
            ]
            )*/

        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EmailFiltre::class,
            'method' => 'GET',
            'csrf_protection'=> false
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }
}
