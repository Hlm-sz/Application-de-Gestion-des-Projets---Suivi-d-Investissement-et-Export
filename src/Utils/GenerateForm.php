<?php

namespace App\Utils;

use App\Entity\CompteData;
use App\Entity\ContactData;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Yaml\Yaml;

class GenerateForm
{
    private $type;
    private $path;
    private $em;

    public function __construct($type,$path,EntityManagerInterface $em)
    {
        $this->type=$type;
        $this->em=$em;
        $this->path=$path;
    }

    public function getForms(array $key_forms){
        return null;
    }
    public function getFormByType(int $key_form){
        return null;
    }



    public function getForm()
    {
        return $this->getPath()['projets'][$this->getType()]['forms'];
    }

    public function getFields(array $forms)
    {
        $fields=[];
        foreach ($forms as $form){
            foreach ($this->getForm()[$form]['fields'] as $field) {
                array_push($fields,$field);
            }
        }
        return $fields;
    }

    public function setDataForm(&$form_fields,$table,$object,$name_find){

        foreach ($form_fields as &$field){
            $options = $field["options"];
            $name=$field["name"];
            $type=$field["type"];
            $dataProject = $this->em->getRepository($table)->findOneBy([$name_find => $object->getId(), 'cle' => $name]);
            $options_data = $dataProject ? $dataProject->getValue() : null;
            if ($type == "FileType") {
                if ($options_data) {
                    $field["options"]["data"] =  new File($this->getParameter('uploader_directory') . '/' . $options_data);
                } else {
                    $field["options"]["data_class"] = null;
                }
            }

             else if ($type == "MultiSelectType") {

                $field["options"]["data"] = $this->em->getRepository($options["class"])->findby(['id' => json_decode($options_data)]);

            }
            else if ($type == "EntityType") {

                    $field["options"]["data"] = $this->em->getRepository($options["class"])->findOneBy(['id' => $options_data]);

            } else {
                $field["options"]["data"] = $options_data;
            }
        }
    }



    public function getType()
    {
        return $this->type;
    }

    public function setType($type): void
    {
        $this->type = $type;
    }

    public function getPath()
    {
        return Yaml::parse(file_get_contents($this->path));
    }

    public function setPath($path): void
    {
        $this->path = $path;
    }
}