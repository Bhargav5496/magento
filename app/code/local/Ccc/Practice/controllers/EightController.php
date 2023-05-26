<?php

// 8. Check all methods available in our resource class and find out how it works in Magento ?

class Ccc_Practice_EightController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $coreResource = Mage::getSingleton('core/resource');

        echo "<pre>";
        print_r(get_class_methods($coreResource));
    }
}

