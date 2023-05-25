<?php 
class Bhargav_Bhargav_Block_Adminhtml_Bhargav extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = 'bhargav';
		$this->_controller = 'adminhtml_bhargav';
		$this->_headerText = $this->__('Bhargav Grid');
		$this->_addButtonLabel = $this->__('Add Bhargav');
		parent::__construct();
	}
}