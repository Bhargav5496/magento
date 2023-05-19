<?php

class Bhargav_Bhargav_Block_Adminhtml_Bhargav_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()

    {
        parent::__construct();
        $this->_objectId = 'entity_id';
        $this->_blockGroup = 'bhargav';
        $this->_controller = 'adminhtml_bhargav';

        $this->_updateButton('save', 'label', Mage::helper('bhargav')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('bhargav')->__('Delete'));

        $this->_addButton('saveandcontinue', array(
        'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
        'onclick' => 'saveAndContinueEdit()',
        'class' => 'save',
        ), -100);
    }

    public function getHeaderText()
    {
        return Mage::helper('bhargav')->__('Edit bhargav');
    }

}
