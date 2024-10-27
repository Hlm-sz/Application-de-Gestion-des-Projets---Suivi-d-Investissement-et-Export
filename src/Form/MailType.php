<?php

namespace App\Form;

use App\Entity\Mail;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class MailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $contacts= $options['contact'];

        $builder
            ->add('objet',TextType::class,
            [
                'label_format' => 'Objet Email',
            ] 
            )
            ->add('contact',
            EntityType::class,
                [
                    'class' => 'App\Entity\Contact',
                    'choice_label' => 'email',
                    'label_format' => 'Distinataires',
                    'multiple' => true,
                    'data'=>$contacts
                ]
            )
            ->add('contenu', CKEditorType::class
            )
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Annonces' => 'Annonces',
                    'Informations' => 'Informations',
                    'Enquête de satisfaction' => 'Enquête de satisfaction',
                    'Mailing spécifique' => 'Mailing spécifique',
                    'Relance' => 'Relance'
                ],
                'label_format' => 'Type Email'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mail::class,
            'contact' => null
        ]);
    }
}
