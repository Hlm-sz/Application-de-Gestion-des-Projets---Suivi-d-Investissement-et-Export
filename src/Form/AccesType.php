<?php

namespace App\Form;

use App\Entity\AccePermissionsRepository;
use App\Entity\Acces;
use App\Repository\AccePermissionsRepository as RepositoryAccePermissionsRepository;
use App\Repository\AccesRepository;
use App\Repository\PermissionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccesType extends AbstractType
{
    /* private $permission;
    private $accePermission;

    public function __construct(PermissionRepository $permission, RepositoryAccePermissionsRepository $accePermission)
    {
        $this->permission = $permission;
        $this->accePermission = $accePermission;
    }*/
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label_format' => 'acces.Nom'
            ])
            ->add(
                'nom_constant',
                HiddenType::class,
                [
                    'label_format' => 'acces.Nom_constant'
                ]
            )
            ->add(
                'permssions',
                EntityType::class,
                [
                    'class' => 'App\Entity\Permission',
                    'choice_label' => 'nom',
                    'multiple' => true,
                    'expanded' => true,
                    'label_format' => 'role.Restrictions'
                ]
            )
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $acces = $event->getData();
                if ($acces["nom_constant"] == "") {
                    $nom_constant = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $acces["nom"]);
                    $nom_constant = strtoupper(str_replace(" ", "'", $nom_constant));
                    $acces["nom_constant"] = strtoupper(str_replace(" ", "_", $nom_constant));
                }
                $event->setData($acces);
            });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Acces::class,
            'acces' => null
        ]);
    }
    /* private function listsPermission()
    {
        $listsPermission = [];
        $lists = $this->permission->getListPermissions();

        foreach ($lists as $key => $value) {
            $listsPermission[$value['id']] = $value['nom'];
        }

        return array_combine(array_values($listsPermission), array_keys($listsPermission));
    }
    private function getSelectedValues($acces)
    {
        $data = null;
        if ($acces) {
            $listsIdsAccesGroupe = [];
            $lists = $this->accePermission->getListePermissionByAcces($acces);
            foreach ($lists as $key => $value) {
                $listsIdsAccesGroupe[$value['id']] = $value['id'];
            }
            $data = array_keys($listsIdsAccesGroupe);
        }
        return $data;
    }*/
}
