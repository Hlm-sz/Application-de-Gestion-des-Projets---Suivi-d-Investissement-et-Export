<?php


namespace App\Services\Form;

use App\Entity\CompteData;
use App\Entity\ContactData;
use App\Entity\ProjetsData;
use App\Form\ProjetDataType;
use App\Entity\PartenaireData;
use App\Utils\Uploader\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CreateForm
{
    private $container;
    private $em;
    private $fileUploader;
    public function __construct(ContainerInterface $container,EntityManagerInterface $em,FileUploader $fileUploader)
    {
        $this->container=$container;
        $this->em=$em;
        $this->fileUploader=$fileUploader;
    }

    public function createFrom($form,$objectdata,$where,$name){

        $config_form=[
            'type_form'=>$form['type_form'],
            'form'=> $form['form'],
            'fields'=>$form['fields'],
            'path'=> $this->container->getParameter('forms_directory') . '/'.$form['path'],
        ];
        $generateForm=new GenerateForm($config_form['type_form'],$config_form['path']);
        $form_fields=$generateForm->getFields($config_form['fields']);
        $this->getDataForm($form_fields,$objectdata,$where,$name);
        return $form_fields;
    }

    private function getDataForm(&$form_fields,$table,$where,$name){
            $contact_id = $where["compte"];
            $entityname = $name;
            foreach ($form_fields as &$field){
            $options = $field["options"];
            $name=$field["name"];
            $type=$field["type"];
            $where['cle']=$name;
            $dataProject = $this->em->getRepository($table)->findOneBy([$entityname => $contact_id, 'cle' => $name]);
            $options_data = $dataProject ? $dataProject->getValue() : null;
            if ($type == "FileType") {
                if ($options_data) {
                    $field["options"]["data"] =  new File($this->container->getParameter('uploader_directory') . '/' . $options_data);
                } else {
                    $field["options"]["data_class"] = null;
                }
            }
            else if ($type == "CheckboxType") {
                if ($options_data) {
                    $field["options"]["data"] = $options_data ? true : false;
                } else {
                    $field["options"]["data"] = false;
                }
            }
            else if ($type == "MultiSelectType") {
                $field["options"]["data"] = $this->em->getRepository($options["class"])->findby(['id' => json_decode($options_data)]);
            }

            else if ($type == "EntityType") {
                $field["options"]["data"] = $this->em->getRepository($options["class"])->findOneBy(['id' => $options_data]);
            }  else if ($type == "DateType") {
                if($options_data){
                $field["options"]["data"] =  new \DateTime($options_data);
                }
              } else {
              $field["options"]["data"] = $options_data;
            }
        }
    }

    public function SaveData($form_fields,$form,$table,&$objet,$where,$name){
        $entityManager=$this->em;
        $contact_id = $where["compte"];
        $entityname = $name;
        foreach ($form_fields as $field) {
            $name=$field["name"];
            $type=$field["type"];
            $where['cle']=$name;
            $getdataObject = $objet->getId() ? $this->em->getRepository($table)->findOneBy([$entityname => $contact_id, 'cle' => $name]):null;
            if($getdataObject){
                if($type == "EntityType"){

                    // $getdataObject->setValue($form[$name]->getData()->getId());
                    // $entityManager->persist($getdataObject);
                    // $entityManager->flush();
                }elseif ($type =="FileType"){
                    $file = $form->get($name)->getData();
                    if ($file) {
                        $newFilename = $this->fileUploader->upload($file);
                        $getdataObject->setValue($newFilename);
                        $entityManager->persist($getdataObject);
                    }
                } elseif ($type == "MultiSelectType") {
                    if($form[$name]->getData()){
                        $array_object=[];
                        foreach ($form[$name]->getData() as $object){
                            array_push($array_object,$object->getId());
                        }
                        $getdataObject->setValue(json_encode($array_object));
                    }
                    $entityManager->persist($getdataObject);
                } elseif ($type == "DateType") {
                        $getdataObject->setValue($form[$name]->getData());
                  } else{
                    if ($form[$name]->getData() == null) {
                        $getdataObject->setValue("");
                    } else {
                        $getdataObject->setValue($form[$name]->getData());
                    }
                    $entityManager->persist($getdataObject);
                }
                $entityManager->flush();
            }else{

                if($form[$name]->getData() != null){
                    $data=['name'=>$name,'object'=>$objet];
                    if($type == "EntityType"){
                        //dd($form)
                        $data['value']=$form[$name]->getData()->getId();
                        //$data['value']=1;
                    }elseif ($type == "FileType"){
                        $brochureFile = $form->get($name)->getData();
                        if ($brochureFile) {
                            $newFilename = $this->fileUploader->upload($brochureFile);
                            $data['value']=$newFilename;
                        }
                    }else if ($type == "MultiSelectType") {
                        if($form[$name]->getData()){
                            $array_object=[];
                            foreach ($form[$name]->getData() as $object){
                                array_push($array_object,$object->getId());
                            }
                            $data['value']=json_encode($array_object);
                        }
                    }else{
                        $data['value']= $form[$name]->getData();
                    }

                    $this->saveDataForm($table,$objet,$data);
                  //  dd($objet);
                    $entityManager->flush();
                }
            }

        }
    }

    private function saveDataForm($objectName,&$object,$data){

        switch ($objectName) {
            case 'App\Entity\ProjetsData':
               $this->SaveDataProjet($data);
                break;
            case 'App\Entity\CompteData':
                $this->SaveDataCompte($data,$object);
                break;
            case 'App\Entity\ContactData':
                $this->saveDataContact($data,$object);
                break;
            case 'App\Entity\PartenaireData':
                $this->saveDataPartenaire($data,$object);
                break;
            default:
                $var="null";
                break;
        }
    }

    private function SaveDataProjet($data){
        $newObjectData = new ProjetsData();
        $newObjectData->setCle($data['name']);
        $newObjectData->setValue($data['value']);
        $newObjectData->setProjet($data['object']);
        $this->em->persist($newObjectData);
    }

    private function SaveDataCompte($data,&$object){
      if($data["name"] == "date_prospe"){

       $newObjectData = new CompteData();
       $newObjectData->setCle($data['name']);
       $newObjectData->setValue($data['value']->format('Y-m-d'));
       $newObjectData->setCompte($data['object']);
       $object->addCompteData($newObjectData);
       $this->em->persist($object);
      }elseif($data["name"] == "Date_reali"){

        $newObjectData = new CompteData();
        $newObjectData->setCle($data['name']);
        $newObjectData->setValue($data['value']->format('Y-m-d'));
        $newObjectData->setCompte($data['object']);
        $object->addCompteData($newObjectData);
        $this->em->persist($object);
       }elseif($data["name"] == "Date_interaction"){
        $newObjectData = new CompteData();
        $newObjectData->setCle($data['name']);
        $newObjectData->setValue($data['value']->format('Y-m-d'));
        $newObjectData->setCompte($data['object']);
        $object->addCompteData($newObjectData);
        $this->em->persist($object);
       }else{
        $newObjectData = new CompteData();
        $newObjectData->setCle($data['name']);
        $newObjectData->setValue($data['value']);
        $newObjectData->setCompte($data['object']);
        $object->addCompteData($newObjectData);
        $this->em->persist($object);
      }
 
    }

    private function saveDataContact($data,&$object)
    {
        $newObjectData = new ContactData();
        $newObjectData->setCle($data['name']);
        $newObjectData->setValue($data['value']);
        $newObjectData->setContact($data['object']);
        $object->addContactData($newObjectData);
        $this->em->persist($object);
    }

    private function saveDataPartenaire($data,&$object)
    {
        $newObjectData = new PartenaireData();
        $newObjectData->setCle($data['name']);
        $newObjectData->setValue($data['value']);
        $newObjectData->setPartenaire($data['object']);
        $object->addPartenaireData($newObjectData);
        $this->em->persist($object);
    }

}
