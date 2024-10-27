<?php

namespace App\Form;
 
use App\Entity\CarteVisite;
use App\Entity\Compte;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class CarteVisiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'fonction',
                EntityType::class,
                [
                    'class' => 'App\Entity\Fonction',
                    'choice_label' => 'nom',
                    'label_format' => 'carteVisite.Fonction'
                ]
            ) 
            ->add('tel', IntegerType::class, ['label_format' => 'carteVisite.Tel'])
            ->add('tel2', IntegerType::class, ['label_format' => 'carteVisite.Tel.2'])
            ->add('web', null, ['label_format' => 'carteVisite.Web'])
            ->add('adresse', null, ['label_format' => 'carteVisite.Adresse'])
            ->add('email', EmailType::class, ['label_format' => 'carteVisite.Email'])
            // ->add('organisation', null, ['label_format' => 'Organisation','required'   => true])
            ->add(
                'profil',
                EntityType::class,
                [
                    'class' => 'App\Entity\Profils',
                    'choice_label' => 'nom',
                    'label_format' => 'contact.Profil'
                ]
            )
           
            // ->add('compte_autre', null, ['label' => 'Compte'])
            /* ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $user = $event->getData();



                // checks whether the user has chosen to display their email or not.
                // If the data was submitted previously, the additional value that is
                // included in the request variables needs to be removed.
                if ($user['compte'] == "") {
                    $user['compte'] = "";
                }
            })*/;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CarteVisite::class,
        ]);
    }
}
