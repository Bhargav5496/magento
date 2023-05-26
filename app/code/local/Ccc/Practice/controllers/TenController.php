<?php

// 10. Understand and practice parent classes methods related to layout and blocks.

class Ccc_Practice_TenController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";

        print_r(get_class_methods('Mage_Core_Model_Layout'));
        print_r(get_class_methods('Mage_Core_Block_Abstract'));
    }   
} 