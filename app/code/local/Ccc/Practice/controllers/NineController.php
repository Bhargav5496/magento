<?php

// 9. Check all methods available in our row class and find out how it works in Magento ?


class Ccc_Practice_NineController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
        $row = Mage::getModel('practice/practice');

        print_r(get_class_methods($row));
    }   
}