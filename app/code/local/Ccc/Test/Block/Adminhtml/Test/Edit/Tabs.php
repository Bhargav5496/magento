<?php

class Ccc_Test_Block_Adminhtml_Test_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('form_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('test')->__('Test Information'));
    }

    protected function _beforeToHtml()
    {

        $this->addTab('test_information', array(
            'label'   => Mage::helper('test')->__('Test Information'),
            'title'   => Mage::helper('test')->__('Test Information'),
            'content' => $this->getLayout()->createBlock('test/adminhtml_test_edit_tab_test')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}
