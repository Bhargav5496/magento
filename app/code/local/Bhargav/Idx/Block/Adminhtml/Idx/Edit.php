<?php

class Bhargav_Idx_Block_Adminhtml_Idx_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'idx';
        $this->_blockGroup = 'idx';
        $this->_controller = 'adminhtml_idx';

        $this->_updateButton('save', 'label', Mage::helper('idx')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('idx')->__('Delete'));

        $this->_addButton('saveandcontinue', array(
        'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
        'onclick' => 'saveAndContinueEdit()',
        'class' => 'save',
        ), -100);
    }

    public function getHeaderText()
    {
        return Mage::helper('idx')->__('Edit Idx');
    }

}
