<?php

namespace App\Form;

use App\Entity\Groupe;
use App\Repository\AccesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroupeType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, ['label_format' => 'groupe.Groupe'])
            ->add(
                'roles',
                EntityType::class,
                [
                    'class' => 'App\Entity\Role',
                    'choice_label' => 'role',
                    'multiple' => true,
                    'label_format' => 'groupe.Roles'
                    //'label_format' => 'groupe.ROle'
                ]
            )
            ->add(
                'restrictions',
                EntityType::class,
                [
                    'class' => 'App\Entity\Restriction',
                    'choice_label' => 'nom',
                    'multiple' => true,
                    'expanded' => true,
                    'label' => 'Restrictions',
                    // 'label_format' => 'role.Restrictions'
                    'label_attr' => ['class' => 'checkbox-custom']
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Groupe::class,
            //  'groupe' => null
        ]);
    }
}
