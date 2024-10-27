<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccesGroupeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add(
                'groupe',
                EntityType::class,
                [
                    'class' => 'App\Entity\Groupe',
                    'choice_label' => 'groupe',
                ]
            )
            ->add(
                'acces',
                EntityType::class,
                [
                    'class' => 'App\Entity\Acces',
                    'choice_label' => 'nom',
                ]
            )
            ->add('is_acces');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AccesGroupe::class,
        ]);
    }
}
