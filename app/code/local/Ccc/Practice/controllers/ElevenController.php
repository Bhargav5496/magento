<?php

// 11. Understand methods related to the controller parent class and understand how to use it along with messages class.

class Ccc_Practice_ElevenController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
        print_r(get_class_methods($this));
    }   
}