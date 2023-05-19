<?php

class Bhargav_Bhargav_Block_Adminhtml_Bhargav_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('form_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('bhargav')->__('Bhargav Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('bhargav_section', array(
        'label' => Mage::helper('bhargav')->__('Bhargav Information'),
        'title' => Mage::helper('bhargav')->__('Bhargav Information'),
        'content' => $this->getLayout()->createBlock('bhargav/adminhtml_bhargav_edit_tab_bhargav')->toHtml(),
        ));

       /* $this->addTab('address_section', array(
        'label' => Mage::helper('bhargav')->__('Bhargav Address Information'),
        'title' => Mage::helper('bhargav')->__('Bhargav Address Information'),
        'content' => $this->getLayout()->createBlock('bhargav/adminhtml_bhargav_edit_tab_address')->toHtml(),
        ));*/
        return parent::_beforeToHtml();
    }
}
