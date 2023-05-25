<?php
class Bhargav_Bhargav_Block_Adminhtml_Bhargav_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{	
	public function __construct()
	{		
		$this->_blockGroup = 'bhargav';
        $this->_controller = 'adminhtml_bhargav';
        $this->_headerText = 'Add Bhargav';
        parent::__construct();
        if(!$this->getRequest()->getParam('set') && !$this->getRequest()->getParam('id'))
		{
			$this->_removeButton('save');
		} 
	}
}