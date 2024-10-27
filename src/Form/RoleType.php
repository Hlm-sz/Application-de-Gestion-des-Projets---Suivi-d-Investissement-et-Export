<?php

namespace App\Form;

use App\Entity\Role;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('role', TextType::class, [
                'label_format' => 'role.Role'
            ])
            ->add(
                'permissions',
                EntityType::class,
                [
                    'class' => 'App\Entity\Permission',
                    'choice_label' => 'nom',
                    'multiple' => true,
                    'expanded' => true,
                    'label_format' => 'acces.Permission'

                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Role::class,
        ]);
    }
}
