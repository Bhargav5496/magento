<?php
class Ccc_UserAttributeLog_Block_Adminhtml_Log extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'userattributelog';
        $this->_controller = 'adminhtml_log';
        $this->_headerText = Mage::helper('userattributelog')->__('Manage Logs');
        parent::__construct();
        $this->_removeButton('add');
    }
}	    
