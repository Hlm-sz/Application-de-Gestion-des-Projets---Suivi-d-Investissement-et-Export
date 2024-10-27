<?php


namespace App\Services\Form;


use App\Entity\ContactData;
use Doctrine\ORM\EntityManagerInterface;

class DataForm
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
    }

    public function saveDataForm($form_fields,$form,$table,$where){

        $objectId=$where[key($where)]->getId();
        $objet=$where[key($where)];
        $objectName=key($where);
        foreach ($form_fields as $field){
            $options = $field["options"];
            $name=$field["name"];
            $type=$field["type"];
            $where_data=[
                '_key' => $name,
                $objectName => $objectId
            ];
            $data4 = $this->em->getRepository($table)->findOneBy($where_data);
            if ($data4) {
                if ($form[$name]->getData() == null) {
                    $data4->setValue("");
                } else {
                    $data4->setValue($form[$name]->getData());
                }
                $this->em->persist($data4);
                $this->em->flush();
            } else {
                if ($form[$name]->getData() != null) {
                    $data4_4 = new $table();
                    $data4_4->setKey($name);
                    $data4_4->setValue($form[$name]->getData());
                    $data4_4->setContact($objet);
                    $this->em->persist($data4_4);
                    $this->em->flush();
                }
            }

        }
    }

    public function getDataForm(&$form,$table,$where){

        $objectId=$where[key($where)]->getId();
        $objectName=key($where);
        foreach ($form as $key => &$data) {

            $where_data=[
                '_key' => $data["name"],
                $objectName => $objectId
            ];
            $dataProject = $this->em->getRepository($table)->findOneBy($where_data);
            $options_data = $dataProject ? $dataProject->getValue() : null;
            $data["options"]["data"] = $options_data;
        }
    }
}