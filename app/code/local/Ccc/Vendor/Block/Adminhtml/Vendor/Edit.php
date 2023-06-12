<?php

class Ccc_Vendor_Block_Adminhtml_Vendor_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()

    {
        parent::__construct();
        $this->_objectId = 'vendor_id';
        $this->_blockGroup = 'vendor';
        $this->_controller = 'adminhtml_vendor';

        $this->_updateButton('save', 'label', Mage::helper('vendor')->__('Save'));
        $this->_addButton('delete', array(
            'label'   => Mage::helper('adminhtml')->__('Delete'),
            'onclick' => "deleteConfirm('" . Mage::helper('adminhtml')->__('Are you sure you want to delete this vendor data?') . "', '" . $this->getDeleteUrl() . "')",
            'class'   => 'delete',
        ));

        $this->_removeButton('reset');
    }

    public function getHeaderText()
    {
        if (Mage::registry('vendor_data')->getId()) {
            return Mage::helper('vendor')->__("Edit Vendor");
        }
        else {
            return Mage::helper('vendor')->__('New Vendor');
        }
    }

    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', array('id' => $this->getRequest()->getParam('id')));
    }

}
