<?php

class Ccc_Practice_OneController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
        

        $collection = new Ccc_Practice_Model_Resource_Practice_Collection();
        print_r(get_class_methods($controller));

        
        echo $collection->getSelect();
        print_r($collection->getData());


        echo $collection->getSelect()
                ->joinLeft(
                    array('c'=>'category'),
                    'c.category_id = main_table.vendor_id'
                );

        print_r($collection->getData());
    }
}