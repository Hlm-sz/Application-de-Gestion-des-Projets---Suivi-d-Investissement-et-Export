<?php

namespace App\Form;

use App\Entity\CarteVisite;
use App\Entity\Contact;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File as ConstraintsFile;

class ContactImportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, array(
                'attr'=>[
                    'id'=>'file_upload',
                    'onchange'=>'fileInfo()',
                    'style'=> 'display: none'
                ],
                'constraints' =>
                    [
                        new ConstraintsFile([
                            'mimeTypes' => [
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            ],
                            'mimeTypesMessage' => 'Le type du fichier est invalide. Les types autorisés sont "Xls,Xlsx".'
                        ])
                    ],
                'label' => 'Fichier à importer'
            ))
            ->add('save', SubmitType::class, array(

                'label' => 'Continuer', 'attr' => ['disabled'=>'disabled','class' => 'btn btn-btn-blue']
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }
}
