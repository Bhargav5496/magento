<?php
 
class Bhargav_Eavmgmt_Block_Adminhtml_Eavmgmt extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'eavmgmt';
        $this->_controller = 'adminhtml_eavmgmt';
        $this->_headerText = Mage::helper('eavmgmt')->__('Manage Eavmgmts');
        $this->_addButtonLabel = Mage::helper('eavmgmt')->__('Add New Eavmgmt');
        parent::__construct();
    }
}