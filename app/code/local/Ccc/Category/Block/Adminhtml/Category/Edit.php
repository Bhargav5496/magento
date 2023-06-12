<?php

class Ccc_Category_Block_Adminhtml_Category_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()

    {
        $this->_objectId = 'category_id';
        $this->_blockGroup = 'category';
        $this->_controller = 'adminhtml_category';

        parent::__construct();
        
        $this->_updateButton('save', 'label', Mage::helper('category')->__('Save'));
        $this->_addButton('delete', array(
            'label'   => Mage::helper('adminhtml')->__('Delete'),
            'onclick' => "deleteConfirm('" . Mage::helper('adminhtml')->__('Are you sure you want to delete this item?') . "', '" . $this->getDeleteUrl() . "')",
            'class'   => 'delete',
        ));

        $this->_removeButton('saveandcontinue');    
        $this->_removeButton('reset');    
    }

    public function getHeaderText()
    {
        if (Mage::registry('category_data')->getId()) {
            return Mage::helper('category')->__("Edit Category");
        }
        else {
            return Mage::helper('category')->__('New Category');
        }
    }

    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', array('id' => $this->getRequest()->getParam('id')));
    }

    

}
