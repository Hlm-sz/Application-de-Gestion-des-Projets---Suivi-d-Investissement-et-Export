<?php

namespace App\Form;

use App\Entity\Contact;
use App\Utils\Form\BuilderForm;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactDataType extends AbstractType
{
    private $form;
    public function __construct()
    {
        $this->form=new BuilderForm();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $schema = $options['schema_form'];
        $builder->add('prenom', null, ['label_format' => 'contact.Prenom'])
        ->add('Date_interaction', null, [
            'required' => false,
            'data_class' => null,
            'empty_data' => ''
        ]);
        $this->form->generateForm($builder, $schema);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            'schema_form' => null,
        ]);
    }

}
