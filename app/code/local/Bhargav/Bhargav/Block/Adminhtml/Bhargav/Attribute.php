<?php

class Bhargav_Bhargav_Block_Adminhtml_Bhargav_Attribute extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = 'bhargav';
		$this->_controller = 'adminhtml_bhargav_attribute';
		$this->_headerText = Mage::helper('vendor')->__('Manage Attributes');
        $this->_addButtonLabel = Mage::helper('vendor')->__('Add New Attribute');
		parent::__construct();
	}
}