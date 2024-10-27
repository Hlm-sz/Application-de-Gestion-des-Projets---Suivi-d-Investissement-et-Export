<?php


namespace App\Form;


use App\Entity\EtatProjet;
use App\FiltreData\ActionsPartenaires;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActionsPartenairesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('search',null,['label'=>'Chercher','required'=>false])
            ->add('startdate', DateType::class, [
                    'widget' => 'single_text',
                    'required'=>false,
                    'label' => 'Période',
                    'attr'   => ['max' => ( new \DateTime() )->format('Y-m-d')]
                ])
            ->add('enddate', DateType::class, [
                    'widget' => 'single_text',
                    'required'=>false,
                    'label' => ' ',
                    'attr'   => ['max' => ( new \DateTime() )->format('Y-m-d')]
        
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ActionsPartenaires::class,
            'method' => 'GET',
            'csrf_protection'=> false
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }

}