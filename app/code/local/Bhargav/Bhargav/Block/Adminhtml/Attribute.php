<?php
class Bhargav_Bhargav_Block_Adminhtml_Attribute extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'adminhtml_attribute';
        $this->_blockGroup = 'bhargav';
        $this->_headerText = Mage::helper('bhargav')->__('Manage Attributes');
        $this->_addButtonLabel = Mage::helper('bhargav')->__('Add New Attribute');
        parent::__construct();
    }

}
