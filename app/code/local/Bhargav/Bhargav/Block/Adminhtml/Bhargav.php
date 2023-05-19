<?php
 
class Bhargav_Bhargav_Block_Adminhtml_Bhargav extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'bhargav';
        $this->_controller = 'adminhtml_bhargav';
        $this->_headerText = Mage::helper('bhargav')->__('Manage Bhargavs');
        $this->_addButtonLabel = Mage::helper('bhargav')->__('Add New Bhargav');
        parent::__construct();
    }
}