<?php

namespace App\Form;

use App\Entity\Projets;
use App\Utils\Form\BuilderForm;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ProjetDataType extends AbstractType
{
    private $form;
    public function __construct()
    {
        $this->form=new BuilderForm();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $schema = $options['schema_form'];
        $builder->add(
        'gere_par',
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
        );
        $this->form->generateForm($builder, $schema);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projets::class,
            'schema_form' => null,

            // enable/disable CSRF protection for this form
            'csrf_protection' => false,
            // the name of the hidden HTML field that stores the token
            'csrf_field_name' => '_token',
            // an arbitrary string used to generate the value of the token
            // using a different string for each form improves its security
            'csrf_token_id'   => 'task_item',
        ]);
    }

}
