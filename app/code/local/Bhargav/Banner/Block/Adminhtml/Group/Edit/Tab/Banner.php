<?php
class Bhargav_Banner_Block_Adminhtml_Group_Edit_Tab_Banner extends Mage_Adminhtml_Block_Catalog_Form
{
    function __construct()
    {
        $this->setTemplate('banner/banner.phtml');
    }

    public function getModel()
    {
        return Mage::getModel('banner/banner');
    }
}