<?php

class Bhargav_Brand_Block_Brand extends Mage_Core_Block_Template
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getBrands()
    {
        return Mage::getModel('brand/brand')->getCollection()->addFieldToFilter('status',1)->addOrder('sort_order',ASC);
    }

    public function getBanner()
    {   
        return Mage::getModel('brand/brand')->getCollection()->addFieldToFilter('brand_id', $this->getRequest()->getParam('id'));
    }

    public function getProductsByBrand()
    {

        $brandAttributeCode = 'brand'; // Replace with your brand attribute code
        $brandAttribute = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $brandAttributeCode);

        $brandValue = $this->getRequest()->getParam('id'); // Replace with your desired brand attribute value (integer)
        $productCollection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToFilter($brandAttributeCode, $brandValue)
            ->getAllIds();

        $products = Mage::getModel('catalog/product')->getCollection()
            ->addIdFilter($productCollection)
            ->addAttributeToSelect('*');
        return $products;
    }

    public function getProductUrl($product)
    {
        
    $rewriteCollection = Mage::getModel('core/url_rewrite')->getCollection()
    ->addFieldToFilter('product_id', array('in' => $productIds))
    ->addFieldToFilter('is_system', 1);
    }    
}