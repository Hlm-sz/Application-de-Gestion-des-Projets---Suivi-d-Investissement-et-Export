<?php

namespace App\Services\Form;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Yaml\Yaml;

class GenerateForm
{
    private $type;
    private $path;

    public function __construct($type,$path)
    {
        $this->type=$type;
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
        return null;
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