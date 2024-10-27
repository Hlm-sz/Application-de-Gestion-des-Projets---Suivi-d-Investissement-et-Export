<?php

namespace App\Form;

use App\Entity\Projets;
use App\Utils\Form\BuilderForm;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetsType extends AbstractType
{
    private $form;
    public function __construct()
    {
        $this->form=new BuilderForm();
    }

    // public $dataProjet;
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $dataProjet = $options['data_projet'] ? $options['data_projet'] : null;
        $builder
            ->add('type', HiddenType::class)
            ->add(
                'gere_par',
                EntityType::class,
                [
                    'class' => 'App\Entity\User',
                    'choice_label' => function ($user) {
                        return $user->getPrenom() . " " . $user->getNom();
                    },
                    'label_format' => 'projet.Gere_par',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->andWhere('u.isDeleted NOT IN (:isDeleted)')
                            ->setParameter('isDeleted', true);
                    }
                ]
            )
            ->add(
                'compte',
                EntityType::class,
                [
                    'class' => 'App\Entity\Compte',
                    'choice_label' => 'nomCompte',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('c')
                            ->andWhere('c.type NOT IN (:type)')
                            ->setParameter('type', 4);
                    }
                ]
            )
            ->add(
                'etatProjet',
                EntityType::class,
                [
                    'class' => 'App\Entity\EtatProjet',
                    'choice_label' => 'nom',
                    'label_format' => 'projet.Etat_projet'
                ]
            )
            ->add(
                'GPAC',
                null,
                ['label_format' => 'projet.GPAC']
            )
            ->add('Confidentiel', CheckboxType::class, [
                'label'    => 'Confidentiel',
                'required' => false,
            ]);
        $schema = $options['schema_form'];

        $this->form->generateForm($builder, $schema);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projets::class,
            'schema_form' => null,
        ]);
    }
}
