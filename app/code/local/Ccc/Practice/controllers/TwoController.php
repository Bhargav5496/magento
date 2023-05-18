<?php

class Ccc_Practice_TwoController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
 
        $model = Mage::getModel('practice/practice');
        $collection = $model->getCollection();

        $query = "INSERT INTO `vendor` (`first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `company`, `created_at`, `updated_at`) VALUES ('sahil', 'solanki', 'ss@gmail.com', '2', '9898989898', '1', 'cybercom', '2023-05-16 07:45:26.000000', NULL);";

        $connection = $collection->getConnection('core_write');
        $connection->query($query);

        print_r($collection->getData());
    }   
}