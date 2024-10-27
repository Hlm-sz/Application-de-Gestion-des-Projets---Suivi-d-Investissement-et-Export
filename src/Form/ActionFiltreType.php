<?php


namespace App\Form;


use App\FiltreData\ActionsFiltre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActionFiltreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('log_status', ChoiceType::class, [
            'choices'  => [
                'Considération' => 'Considération',
                'Prospection' => 'Prospection',
                'Intérêt' => 'Intérêt',
                'Décision' => 'Décision',
                'Suivi' => 'Suivi',
                'Fermé' => 'Fermé',
            ],
        ])
        ->add('log_date', DateType::class, [
            'widget' => 'single_text',
            'label' => 'Période log'
        ])
        ->add('log_date_end', DateType::class, [
            'widget' => 'single_text',
            'label' => ' '
        ]);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ActionsFiltre::class,
            'method' => 'POST',
            'csrf_protection'=> false
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }
}