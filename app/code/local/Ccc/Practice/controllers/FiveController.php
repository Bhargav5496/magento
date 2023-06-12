<?php

// 5. How to prepare queries based on collection class and fetch records in object format and array format?

class Ccc_Practice_FiveController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
 
        $model = Mage::getModel('practice/practice');
        $collection = $model->getCollection();

        echo $collection->getSelect()->where('vendor_id = 8');

        print_r($collection->getItems());        
        print_r($collection->toArray());        
        print_r($collection->getData());
    }
}