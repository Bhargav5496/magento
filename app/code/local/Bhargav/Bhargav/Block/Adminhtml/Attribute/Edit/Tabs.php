<?php

class Bhargav_Bhargav_Block_Adminhtml_Attribute_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('bhargav_attribute_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('bhargav')->__('Attribute Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('main', array(
            'label'     => Mage::helper('bhargav')->__('Properties'),
            'title'     => Mage::helper('bhargav')->__('Properties'),
            'content'   => $this->getLayout()->createBlock('bhargav/adminhtml_attribute_edit_tab_main')->toHtml(),
            'active'    => true
        ));

        $model = Mage::registry('entity_attribute');

        $this->addTab('labels', array(
            'label'     => Mage::helper('bhargav')->__('Manage Label / Options'),
            'title'     => Mage::helper('bhargav')->__('Manage Label / Options'),
            'content'   => $this->getLayout()->createBlock('bhargav/adminhtml_attribute_edit_tab_options')->toHtml(),
        ));
        
        // /*if ('select' == $model->getFrontendInput()) {
        //     $this->addTab('options_section', array(
        //         'label'     => Mage::helper('bhargav')->__('Options Control'),
        //         'title'     => Mage::helper('bhargav')->__('Options Control'),
        //         'content'   => $this->getLayout()->createBlock('adminhtml/bhargav_bhargav_attribute_edit_tab_options')->toHtml(),
        //     ));
        // }*/

        return parent::_beforeToHtml();
    }

}
