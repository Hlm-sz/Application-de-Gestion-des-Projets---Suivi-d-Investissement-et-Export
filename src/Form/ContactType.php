<?php

namespace App\Form;

use App\Entity\CarteVisite;
use App\Entity\Contact;
use App\Entity\Fonction;
use App\Utils\Form\BuilderForm;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', null, ['label_format' => 'contact.Prenom','required'   => true])
            ->add('nom', null, ['label_format' => 'contact.Nom','required'   => true])
            ->add('email', null, ['label_format' => 'contact.Email'],['error_bubbling' => true])
            ->add('tel', IntegerType::class, ['label_format' => 'contact.Tel'])
            // ->add('organisation', null, ['label_format' => ' '])
            ->add('exclusif', null, ['label_format' => 'contact.Exclusif'])
            // ->add('exclusif', CheckboxType::class, [
            //     'label_attr' => ['class' => 'switch-custom'],
            //     'label_format' => 'contact.Exclusif',
            //     'mapped' => false
            // ])
            ->add('langugePrincipale', ChoiceType::class, [
                'choices' => [
                    'Francais' => 'Francais',
                    'Anglais' => 'Anglais',
                    'Chinois' => 'Chinois',
                    'Espagnol' => 'Espagnol',
                    'Hindi' => 'Hindi',
                    'Arabe' => 'Arabe',
                    'Allemand' => 'Allemand',
                    'Italien' => 'Italien'
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
                    'Arabe' => 'Arabe',
                    'Allemand' => 'Allemand',
                    'Italien' => 'Italien'
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
                    'label_format' => 'contact.Canal', 
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->andWhere('p.isDeleted NOT IN (:isDeleted)')
                            ->setParameter('isDeleted', true);
                    }

                ]
            )
            ->add(
                'fonction',
                EntityType::class,
                [
                    'class' => 'App\Entity\Fonction',
                    'choice_label' => 'nom',
                    'label_format' => 'contact.fonction'
                ]
            ) 
            ->add(
                'responsableContact',
                EntityType::class,
                [
                    'class' => 'App\Entity\User',
                    'choice_label' => function ($user) {
                        return $user->getPrenom() . " " . $user->getNom();
                    },
                    'label_format' => 'compte.ResponsableCompte',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->andWhere('u.isDeleted NOT IN (:isDeleted)')
                            ->setParameter('isDeleted', true);
                    }
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
