<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'prenom',
                TextType::class,
                [
                    'label_format' => 'user.Prenom'
                ]
            )
            ->add(
                'nom',
                TextType::class,
                [
                    'label_format' => 'user.Nom'
                ]
            )

            ->add(
                'groupe',
                EntityType::class,
                [
                    'class' => 'App\Entity\Groupe',
                    'choice_label' => 'nom',
                    'label_format' => 'user.Groupe',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('g')
                            ->andWhere('g.isDeleted NOT IN (:isDeleted)')
                            ->setParameter('isDeleted', true);
                    }
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'label_format' => 'user.Email'
                ]
            )
            ->add(
                'secteurs',
                EntityType::class,
                [
                    'class' => 'App\Entity\Secteur',
                    'choice_label' => 'nom',
                    'multiple' => true,
                    'label' => 'Secteurs',
                    // 'label_format' => 'role.Restrictions'
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('s')
                            ->andWhere('s.isDeleted NOT IN (:isDeleted)')
                            ->setParameter('isDeleted', true);
                    }
                ]
            )
            ->add('photo', FileType::class,array('data_class' => null,'required' => false))
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les champs du mot de passe doivent correspondre.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label_format' => 'user.Password'],
                'second_options' => ['label' => 'Répéter le mot de passe'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
