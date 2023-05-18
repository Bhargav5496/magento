<?php

// 6. How to prepare queries based on SQL SELECT class and fetch records in object format and array format?

class Ccc_Practice_SixController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
 
        $model = Mage::getModel('practice/practice');
        $collection = $model->getCollection();
        $connection = $collection->getConnection();
        echo $query = $connection->select()
                    ->from('vendor', array('first_name', 'last_name'));

        print_r($connection->fetchAll($query));

        $query = "SELECT * FROM `vendor` WHERE `vendor_id`='8'";
        print_r($connection->fetchRow($query));

    }
}