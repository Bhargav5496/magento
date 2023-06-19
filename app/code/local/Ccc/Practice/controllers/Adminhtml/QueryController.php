<?php

class Ccc_Practice_Adminhtml_QueryController extends Mage_Adminhtml_Controller_Action
{
    public function oneAction()
    {
        $this->loadLayout();
        $this->_title($this->__("One Grid"));
        $this->_setActiveMenu('practice');
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_one'));
        $this->renderLayout();
    }

    // public function oneAction()
    // {
    //     $collection = Mage::getModel('catalog/product')->getCollection();
    //     $collection->addAttributeToSelect('name')
    //         ->addAttributeToSelect('sku')
    //         ->addAttributeToSelect('cost')
    //         ->addAttributeToSelect('price')
    //         ->addAttributeToSelect('color');

    //     foreach ($collection as $product) {
    //         echo "Product Name: " . $product->getName() . "<br>";
    //         echo "SKU: " . $product->getSku() . "<br>";
    //         echo "Cost: " . $product->getCost() . "<br>";
    //         echo "Price: " . $product->getPrice() . "<br>";
    //         echo "Color: " . $product->getColor() . "<br>";
    //         echo "<br>";
    //     }


    // }   
}