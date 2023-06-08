<?php

class Bhargav_Brand_ViewController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('content')->append($this->getLayout()->createBlock('brand/brand')->setTemplate('brand/banner.phtml'));
        $this->renderLayout();
    }
}