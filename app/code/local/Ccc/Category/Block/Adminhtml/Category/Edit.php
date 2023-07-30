<?php

class Ccc_Category_Block_Adminhtml_Category_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId   = 'category_id';
        $this->_blockGroup = 'category';
        $this->_controller = 'adminhtml_category';

        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('category')->__('Save And Continue'));
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
            return Mage::helper('category')->__("Edit Category");
        } else {
            return Mage::helper('category')->__('New Category');
        }
    }

    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', array('id' => $this->getRequest()->getParam('id')));
    }
}
