<?php
namespace App\Utils\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;



use Symfony\Component\Form\FormBuilderInterface;

class BuilderForm
{

    public function __construct()
    {
    }

    public function generateForm(FormBuilderInterface &$builder, $schema)
    {
        if ($schema) {

            foreach ($schema as $keys => $propretie) {
                $options = $propretie["options"];
                $name=$propretie["name"];
                $type=$propretie["type"];
                switch ($propretie["type"]) {

                    case 'CheckboxType':
                        $builder->add($name, CheckboxType::class, $options);
                        break;
                    case 'ChoiceType':
                        $builder->add($name, ChoiceType::class, $options);
                        break;
                    case 'EntityType':
                        $builder->add($name, EntityType::class, $options);
                        break;
                    case 'MultiSelectType':
                        $builder->add($name, EntityType::class, $options);
                        break;
                    case 'FileType':
                        $builder->add($name, FileType::class, $options);
                        break;
                    case 'TextareaType':
                        $builder->add($name, TextareaType::class, $options);
                        break;
                    case 'DateType':
                        $propretie["options"]["attr"]  = [
                            'max' => ( new \DateTime() )->format('Y-m-d')
                        ];
                        $options = $propretie["options"];
                        // dd($options);
                        $builder->add($name, DateType::class, $options);
                        break;
                    case 'IntegerType':
                        $builder->add($name, IntegerType::class, $options);
                        break;
                    case 'NumberType':
                        $builder->add($name, NumberType::class, $options);
                        break;
                    default:
                        $builder->add($name, $type, $options);
                        break;
                }
            }

        }
    }

}
