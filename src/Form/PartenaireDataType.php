<?php

namespace App\Form;

use App\Entity\Partenaire;
use App\Utils\Form\BuilderForm;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartenaireDataType extends AbstractType
{
    private $form;
    public function __construct() 
    { 
        $this->form=new BuilderForm();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $schema = $options['schema_form'];
        $builder->add('nom', null, ['label_format' => 'nom']);
        $this->form->generateForm($builder, $schema);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Partenaire::class,
            'schema_form' => null,
        ]);
    }

}
