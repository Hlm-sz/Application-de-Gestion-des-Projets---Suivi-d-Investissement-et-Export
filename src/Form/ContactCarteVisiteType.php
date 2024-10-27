<?php

namespace App\Form;

use App\Entity\CarteVisite;
use App\Entity\Contact;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactCarteVisiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', null, ['label_format' => 'contact.Prenom'])
            ->add('nom', null, ['label_format' => 'contact.Nom'])
            ->add('organisation', null, ['label_format' => 'contact.Organisation','required'   => true])
            ->add('email', null, ['label_format' => 'contact.Email'])
            ->add('tel', null, ['label_format' => 'contact.Tel'])
            ->add('exclusif', null, ['label_format' => 'contact.Exclusif'])
            ->add('langugePrincipale', ChoiceType::class, [
                'choices' => [
                    'Francais' => 'Francais',
                    'Anglais' => 'Anglais',
                    'Chinois' => 'Chinois',
                    'Espagnol' => 'Espagnol',
                    'Hindi' => 'Hindi',
                    'Arabe' => 'Arabe'

                ],
                'label_format' => 'contact.LanguePrincipale'
            ])
            ->add('langueSecondaire', ChoiceType::class, [
                'choices' => [
                    'Francais' => 'Francais',
                    'Anglais' => 'Anglais',
                    'Chinois' => 'Chinois',
                    'Espagnol' => 'Espagnol',
                    'Hindi' => 'Hindi',
                    'Arabe' => 'Arabe'

                ],
                'label_format' => 'contact.LangueSecondaire'
            ])
            ->add('detailsLibres', null, ['label_format' => 'contact.DetailsLibres'])
            ->add(
                'profil',
                EntityType::class,
                [
                    'class' => 'App\Entity\Profils',
                    'choice_label' => 'nom',
                    'label_format' => 'contact.Profil'
                ]
            )
            ->add(
                'canal',
                EntityType::class,
                [
                    'class' => 'App\Entity\Canal',
                    'choice_label' => 'nom',
                    'label_format' => 'contact.Canal'
                ]
            )
            ->add(
                'responsableContact',
                EntityType::class,
                [
                    'class' => 'App\Entity\User',
                    'choice_label' => function ($user) {
                        return $user->getPrenom().' '.$user->getNom();
                    },
                    'label_format' => 'contact.RespContact',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->andWhere('u.isDeleted NOT IN (:isDeleted)')
                            ->setParameter('isDeleted', true);
                    }
                ]
            )->add(
                'carteVisites',
                CollectionType::class,
                [

                    'entry_type' => CarteVisiteType::class,
                    'label' => false,
                    'entry_options' => [
                        'label' => false
                    ],
                    //'data' => $options['default_country'],
                    'by_reference' => false,
                    // this allows the creation of new forms and the prototype too
                    'allow_add' => true,
                    // self explanatory, this one allows the form to be removed
                    'allow_delete' => true,
                    'prototype' => true,
                ]
            ); 
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
