<?php

// Check all methods available in our adapter class and find out how it works in Magento ?

class Ccc_Practice_SevenController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $collection = new Ccc_Practice_Model_Resource_Practice_Collection();

        $adapter = $collection->getConnection();
        echo "<pre>";
        print_r(get_class_methods($adapter));
    }
}