<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $schema = $options['schema_form'];
        foreach ($schema->groupes as $key => $value) {
            foreach ($value->properties as $keys => $values) {
                $options = json_decode(json_encode($values->options), true);
                switch ($values->type) {
                    case 'boolean':
                        $builder->add($values->nom, ChoiceType::class, $options);
                        break;
                    case 'entity':
                        $builder->add($values->nom, EntityType::class, $options);
                        break;
                    case 'document':
                        $builder->add($values->nom, FileType::class, $options);
                        break;
                    case 'textarea':
                        $builder->add($values->nom, TextareaType::class, $options);
                        break;

                    default:
                        $builder->add($values->nom, $values->type, $options);
                        break;
                }
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'schema_form' => null,
        ]);
    }
}
