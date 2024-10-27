<?php

namespace App\Form;

use App\Entity\Projets;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetStatusType extends AbstractType
{
    // public $dataProjet;
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $schema = $options['schema_form'];
        $this->generateForm($builder, $schema);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projets::class,
            'schema_form' => null,
        ]);
    }
    private function generateForm(FormBuilderInterface &$builder, $schema)
    {
        if ($schema) {
            foreach ($schema["groupes"] as $key => $value) {
                foreach ($value["properties"] as $keys => $propretie) {
                    $options = $propretie["options"];
                    switch ($propretie["type"]) {
                        case 'boolean':
                            $builder->add($propretie["nom"], ChoiceType::class, $options);
                            break;
                        case 'entity':
                            $builder->add($propretie["nom"], EntityType::class, $options);
                            break;
                        case 'document':
                            $builder->add($propretie["nom"], FileType::class, $options);
                            break;
                        case 'textarea':
                            $builder->add($propretie["nom"], TextareaType::class, $options);
                            break;

                        default:
                            $builder->add($propretie["nom"], $propretie["type"], $options);
                            break;
                    }
                }
            }
        }
    }
}
