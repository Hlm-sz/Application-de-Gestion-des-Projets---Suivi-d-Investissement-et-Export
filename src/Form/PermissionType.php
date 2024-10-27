<?php

namespace App\Form;

use App\Entity\Permission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PermissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, ['label_format' => 'acces.Nom'])
            ->add('nomConstant', HiddenType::class)
            ->add('isActive', null, ['label_format' => 'acces.Active'])
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $permission = $event->getData();
                if ($permission["nomConstant"] == "") {
                    $nom_constant = $this->stripAccents($permission["nom"]);
                    $permission["nomConstant"] = strtoupper(str_replace(" ", "_", $nom_constant));
                }
                $event->setData($permission);
            });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Permission::class,
        ]);
    }
    private function stripAccents($str)
    {
        return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    }
}
