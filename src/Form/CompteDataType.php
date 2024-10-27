<?php

namespace App\Form;

use App\Entity\Compte;
use App\Entity\Contact;
use App\Entity\Projets;
use App\Utils\Form\BuilderForm;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompteDataType extends AbstractType
{
    private $form;
    public function __construct()
    {
        $this->form=new BuilderForm();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $schema = $options['schema_form'];
        $builder->add('nomCompte', null, [
            'label_format' => 'compte.NomCompte'
            ])
            ->add('categorie', null, ['label_format' => ' '])
            ->add(
                'type',
                EntityType::class,
                [
                    'class' => 'App\Entity\TypeCompte',
                    'choice_label' => 'nom',
                    'label_format' => 'compte.Type'
                ]
        )
            ->add(
                'responsableCompte',
                EntityType::class,
                [
                    'class' => 'App\Entity\User',
                    'choice_label' => function ($user) {
                        return $user->getPrenom().' '.$user->getNom();
                    },
                    'label_format' => 'compte.ResponsableCompte',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->andWhere('u.isDeleted NOT IN (:isDeleted)')
                            ->setParameter('isDeleted', true);
                    }
                ]
            )
            ->add(
                'ere',
                EntityType::class,
                [
                    'class' => 'App\Entity\Contact',
                    'choice_label' => function ($contact) {
                        return $contact->getPrenom().' '.$contact->getNom();
                    },
                    'label_format' => 'compte.contact',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u');
                            // ->andWhere('u.isDeleted NOT IN (:isDeleted)')
                            // ->setParameter('isDeleted', true);
                    }
                ]
            )
            ->add('logo', FileType::class,
                array(
                    'data_class' => null,
                    'required' => false,
                    'attr'=>array(
                        'onchange'=>'fileInfo()',
                        'style'=> 'display: none'
                    )
                )
            )
        ;
        $this->form->generateForm($builder, $schema);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Compte::class,
            'schema_form' => null,
        ]);
    }

}
