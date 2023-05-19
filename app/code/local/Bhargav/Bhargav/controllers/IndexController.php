<?php 

class Bhargav_Bhargav_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        // echo "111";
        echo '<pre>';
        print_r(get_class_methods($this->getLayout()));
        // print_r(get_class_methods("Ccc_bhargav_IndexController"));
        // print_r(Mage::getModel('bhargav/bhargav')); 
        // print_r($this->getLayout()->createBlock('bhargav/test_bhargav')); 
        print_r(Mage::helper('bhargav/bhargav')); 
        print_r(Mage::helper('bhargav')); 
    }
  
}