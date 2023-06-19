<?php
class Bhargav_Banner_Block_Banner extends Mage_Core_Block_Template
{
    public function __construct()
    {

        parent::__construct();
        
    }

    public function getSliderData()
    {
        $grpId = Mage::getStoreConfig('banner/banner_group/banner_select');
        
        $collection = Mage::getModel('banner/banner')->getCollection();
        $collection->addFieldToFilter('group_id', $grpId);
        return $collection;
    }
}