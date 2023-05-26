<?php

class Bhargav_Eavmgmt_Block_Adminhtml_Eavmgmt_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()

    {
        parent::__construct();
        $this->_objectId = 'eavmgmt_id';
        $this->_blockGroup = 'eavmgmt';
        $this->_controller = 'adminhtml_eavmgmt';

        $this->_updateButton('save', 'label', Mage::helper('eavmgmt')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('eavmgmt')->__('Delete'));

        $this->_addButton('saveandcontinue', array(
        'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
        'onclick' => 'saveAndContinueEdit()',
        'class' => 'save',
        ), -100);
    }

    public function getHeaderText()
    {
        return Mage::helper('eavmgmt')->__('Edit Eavmgmt');
    }

}
