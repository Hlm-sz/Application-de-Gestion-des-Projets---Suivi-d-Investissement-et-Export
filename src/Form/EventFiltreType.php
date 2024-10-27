<?php


namespace App\Form;


use App\FiltreData\EventFiltre;
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

class EventFiltreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('search',null,['label'=>'Chercher','required'=>false])
            ->add('typeEvenement',ChoiceType::class,[
                'choices'=>[
                    'Investissement'=>'Investissement',
                    'Export' => 'Export',
                    'Institutionnel' => 'Institutionnel'
                ],
                'multiple'=>true,
                'expanded' =>true,
                'label' => 'Type évènement',
                'label_attr' => ['class' => 'checkbox-custom'],
            ])
            ->add('formatParticipation',ChoiceType::class,[
                'choices'=>[
                    'Salon spécialisé'=>'Salon spécialisé',
                    'Foire et exposition international'=>'Foire et exposition international',
                    'institutionnel (Forum; conférence)'=>'institutionnel (Forum; conférence)',
                    'Convention d’affaire'=>'Convention d’affaire',
                    'Suppliers days'=>'Suppliers days',
                    'Incoming Visit'=>'Incoming Visit',
                    'Road Show'=>'Road Show',
                    'BtoB'=>'BtoB'
                ],'required' => false
            ])
            ->add('mois',ChoiceType::class,[
                'choices'=>[
                    'Janvier' => 'Janvier',
                    'Février' => 'Février',
                    'Mars' => 'Mars',
                    'Avril' => 'Avril',
                    'Mai' => 'Mai',
                    'juin' => 'Juin',
                    'Juillet' => 'Juillet',
                    'Août' => 'Août',
                    'Septembre' => 'Septembre',
                    'Octobre' => 'Octobre',
                    'Novembre' => 'Novembre',
                    'Décembre' => 'Décembre'
                ],'required' => false
            ])
            ->add('annee',ChoiceType::class,[
                'choices'=>[
                    '2020' => '2020',
                    '2021' => '2021',
                    '2022' => '2022',
                    '2023' => '2023',
                    '2024' => '2024',
                    '2025' => '2025',
                    '2026' => '2026',
                    '2027' => '2027',
                    '2028' => '2028',
                    '2029' => '2029',
                    '2030' => '2030'],
                    'required' => false
                ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EventFiltre::class,
            'method' => 'GET',
            'csrf_protection'=> false
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }
}