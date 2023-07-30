<?php

class Ccc_Category_Block_Adminhtml_Category_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('form_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('category')->__('Category Information'));
    }

    protected function _beforeToHtml()
    {

        $this->addTab('input_percentage_count', array(
            'label'   => Mage::helper('category')->__('Input Progress Calculation'),
            'title'   => Mage::helper('category')->__('Input Progress Calculation'),
            'content' => $this->getLayout()->createBlock('category/adminhtml_category_edit_tab_progress')->toHtml(),
        ));

        $this->addTab('category_information', array(
            'label'   => Mage::helper('category')->__('Category Information'),
            'title'   => Mage::helper('category')->__('Category Information'),
            'content' => $this->getLayout()->createBlock('category/adminhtml_category_edit_tab_category')->toHtml(),
        ));
        
        $this->addTab('all_input_type_practice', array(
            'label'   => Mage::helper('category')->__('Input Types Practice'),
            'title'   => Mage::helper('category')->__('Input Types Practice'),
            'content' => $this->getLayout()->createBlock('category/adminhtml_category_edit_tab_inputpractice')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}
