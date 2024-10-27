<?php

namespace App\Form;

use App\Entity\Partenaire;
use App\Utils\Form\BuilderForm;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartenaireType extends AbstractType
{
    private $form;
    public function __construct()
    {
        $this->form=new BuilderForm();
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, ['label_format' => 'Eros'])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Ministère ou Administration P.' => 'Ministère ou Administration P.',
                    'Association ou Fédération Professionnelle' => 'Association ou Fédération Professionnelle',
                    'Ambassade ou Représentation Diplomatique' => 'Ambassade ou Représentation Diplomatique',
                    'CRI' => 'CRI',
                    'Chambre de Commerce' => 'Chambre de Commerce',
                    'Commission des Investissements' => 'Commission des Investissements',
                    'Relai' => 'Relai',
                ],
                'label_format' => 'Relai'
            ])
            ->add(
                'payscible',
                EntityType::class,
                [
                    'class' => 'App\Entity\Pays',
                    'choice_label' => 'nom',
                    'multiple' => true,
                    'label_format' => 'partenaire.Payscible',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->andWhere('p.isDeleted NOT IN (:isDeleted)')
                            ->setParameter('isDeleted', true);
                    }
                ]
            )
            ->add(
                'paysorigine',
                EntityType::class,
                [
                    'class' => 'App\Entity\Pays',
                    'choice_label' => 'nom',
                    'multiple' => true,
                    'label_format' => 'partenaire.Paysorigine',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->andWhere('p.isDeleted NOT IN (:isDeleted)')
                            ->setParameter('isDeleted', true);
                    }
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
            $schema = $options['schema_form'];

        $this->form->generateForm($builder, $schema);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Partenaire::class,
            'schema_form' => null
        ]);
    }
}
