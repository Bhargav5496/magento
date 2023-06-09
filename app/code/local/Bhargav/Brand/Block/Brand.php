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

    // public function getProductsByBrand()
    // {

    //     $brandAttributeCode = 'brand'; // Replace with your brand attribute code
    //     $brandAttribute = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $brandAttributeCode);

    //     $brandValue = $this->getRequest()->getParam('id'); // Replace with your desired brand attribute value (integer)
    //     $productCollection = Mage::getModel('catalog/product')->getCollection()
    //         ->addAttributeToFilter($brandAttributeCode, $brandValue)
    //         ->getAllIds();

    //     $products = Mage::getModel('catalog/product')->getCollection()
    //         ->addIdFilter($productCollection)
    //         ->addAttributeToSelect('*');
    //     return $products;
    // }

    // public function getCategories()
    // {
    //     $categories = Mage::getModel('catalog/category')
    //             ->getCollection()
    //             ->addFieldToFilter('level', 2)
    //             ->addAttributeToSelect('*');
    //     return $categories;
    // }


   public function getProducts()
    {
        if ($this->getRequest()->getParam('cat')) 
        {
            $category = '*';
        }
        $category = $this->getRequest()->getParam('cat');
        $brandAttributeCode = 'brand';
        $brandAttribute = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $brandAttributeCode);

        // $categoryAttributeCode = 'category'; // Replace with your brand attribute code
        // $categoryAttribute = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $categoryAttributeCode);

        $productCollection = Mage::getModel('catalog/product')->load($category);


        $brandValue = $this->getRequest()->getParam('id'); 
        $productCollection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToFilter($brandAttributeCode, $brandValue)
            // ->addAttributeToFilter($categoryAttributeCode, $category)
            ->getAllIds();

        $products = Mage::getModel('catalog/product')->getCollection()
            ->addIdFilter($productCollection)
            ->addCategoryFilter(Mage::getModel('catalog/category')->load($category))
             // ->addAttributeToFilter('category_id', $category)
            // ->addCategoryFilter($category)
            ->addAttributeToSelect('*');

        return $products;
    }

    public function getCategory()
    {
        $categories = Mage::getModel('catalog/category')
            ->getCollection()
            ->addAttributeToSelect('name')
            ->addFieldToFilter('level', 2)
            ->addIsActiveFilter();

        return $categories;
    }

}