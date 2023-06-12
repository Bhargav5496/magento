<?php

// 4. How to insert multiple rows at a time when required to insert multiple rows into a table ? Check the function.

class Ccc_Practice_FourController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
 
        $model = Mage::getModel('practice/practice');
        $collection = $model->getCollection();

        $rows = array(
            [
                "first_name" => "sahil",
                "last_name" => "solanki",
                "email" => "ss@gmail.com",
                "gender" => "2",
                "mobile" => "9898989898",
                "status" => "1",
                "company" => "cybercom",
                "created_at" => "2023-05-16 07:45:26"
            ],
            [
                "first_name" => "sahil",
                "last_name" => "solanki",
                "email" => "ss@gmail.com",
                "gender" => "2",
                "mobile" => "9898989898",
                "status" => "1",
                "company" => "cybercom",
                "created_at" => "2023-05-16 07:45:26"
            ],
        );

        $collection->getConnection()->insertMultiple('vendor', $rows);

        print_r($collection->getData());
    }   
}