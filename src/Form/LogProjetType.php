<?php

namespace App\Form;

use App\Entity\Canal;
use App\Entity\LogProjet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LogProjetType extends AbstractType
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status',
                ChoiceType::class,
                [
                    'label'=>'Activité',
                    'choices'  => [
                        'Echange' => 'Echange',
                        'Rencontre B2B' => 'Rencontre B2B',
                        'Incoming Visit' => 'Incoming Visit',
                        'Event' => 'Event',
                        'Traitement de requête' => 'Traitement de requête',
                        'Autre' => 'Autre'
                    ]
                ]
            )
            ->add('commentaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LogProjet::class,
        ]);
    }

    private function listCanaux(){
        $canaux=$this->em->getRepository(Canal::class)->findAll();
        $data=[];
        foreach ($canaux as $canal){
            $data[$canal->getNom()]=$canal->getNom();
        }
        return $data;
    }
}
