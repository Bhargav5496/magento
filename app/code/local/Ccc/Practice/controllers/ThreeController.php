<?php

// How to insert a single row into a table using a row object ?

class Ccc_Practice_ThreeController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
 
        $model = Mage::getModel('practice/practice');
        $collection = $model->getCollection();

        $data = [
            "first_name" => "sahil",
            "last_name" => "solanki",
            "email" => "ss@gmail.com",
            "gender" => "2",
            "mobile" => "9898989898",
            "status" => "1",
            "company" => "cybercom",
            "created_at" => "2023-05-16 07:45:26"
        ];

        $model->setData($data);


        print_r($model->getData());

        $model->save();


        print_r($collection->getData());
    }   
}