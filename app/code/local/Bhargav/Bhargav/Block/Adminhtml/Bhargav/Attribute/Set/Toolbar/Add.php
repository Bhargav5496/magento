<?php
class Bhargav_Bhargav_Block_Adminhtml_Bhargav_Attribute_Set_Toolbar_Add extends Mage_Adminhtml_Block_Template
{
    protected function _construct()
    {
        $this->setTemplate('bhargav/attribute/set/toolbar/add.phtml');
    }

    protected function _prepareLayout()
    {
        $this->setChild('save_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label'     => Mage::helper('bhargav')->__('Save Bhargav Attribute Set'),
                    'onclick'   => 'if (addSet.submit()) disableElements(\'save\');',
                    'class' => 'save'
        )));
        $this->setChild('back_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label'     => Mage::helper('bhargav')->__('Back'),
                    'onclick'   => 'setLocation(\''.$this->getUrl('*/*/').'\')',
                    'class' => 'back'
        )));

        $this->setChild('setForm',
            $this->getLayout()->createBlock('bhargav/adminhtml_bhargav_attribute_set_main_formset')
        );
        return parent::_prepareLayout();
    }

    protected function _getHeader()
    {
        return Mage::helper('bhargav')->__('Add New bhargav Attribute Set');
    }

    protected function getSaveButtonHtml()
    {
        return $this->getChildHtml('save_button');
    }

    protected function getBackButtonHtml()
    {
        return $this->getChildHtml('back_button');
    }

    protected function getFormHtml()
    {
        return $this->getChildHtml('setForm');
    }

    protected function getFormId()
    {
        return $this->getChild('setForm')->getForm()->getId();
    }
}