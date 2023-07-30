<?php

class Ccc_Test_Block_Adminhtml_Test_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId   = 'test_id';
        $this->_blockGroup = 'test';
        $this->_controller = 'adminhtml_test';

        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('test')->__('Save And Continue'));
        $this->_addButton('delete', array(
            'label'   => Mage::helper('adminhtml')->__('Delete'),
            'onclick' => "deleteConfirm('" . Mage::helper('adminhtml')->__('Are you sure you want to delete this item?') . "', '" . $this->getDeleteUrl() . "')",
            'class'   => 'delete',
        ));

        // $this->_addButton('save_and_continue', array(
        //     'label'   => Mage::helper('adminhtml')->__('Save and Continue'),
        //     'onclick' => "deleteConfirm('" . Mage::helper('adminhtml')->__('Are you sure you want to delete this item?') . "', '" . $this->getDeleteUrl() . "')",
        //     'class'   => 'delete',
        // ));
        
    }

    public function getHeaderText()
    {
        if (Mage::registry('model_data')->getId()) {
            return Mage::helper('test')->__("Edit Test");
        } else {
            return Mage::helper('test')->__('New Test');
        }
    }

    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', array('id' => $this->getRequest()->getParam('id')));
    }
}
