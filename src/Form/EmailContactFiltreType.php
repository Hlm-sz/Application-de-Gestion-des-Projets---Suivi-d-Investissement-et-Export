<?php

namespace App\Form;

use App\Entity\Contact;
use App\FiltreData\EmailContactFiltre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmailContactFiltreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('profil',
        EntityType::class,
        [
            'class' => 'App\Entity\Profils',
            'choice_label' => 'nom',
            'multiple'=>true,
            'expanded' =>true,
            'label_attr' => ['class' => 'checkbox-custom'],
            'required'=>false
        ]
    )
        ->add('canal',
            EntityType::class,
            [
                'class' => 'App\Entity\Canal',
                'choice_label' => 'nom',
                'multiple'=>true,
                'expanded' =>true,
                'label_attr' => ['class' => 'checkbox-custom'],
                'required'=>false
            ]
        )
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EmailContactFiltre::class,
            'method' => 'GET',
            'csrf_protection'=> false
        ]);
    }
}
