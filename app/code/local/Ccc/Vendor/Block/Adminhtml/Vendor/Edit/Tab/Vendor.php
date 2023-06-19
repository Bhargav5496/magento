<?php

class Ccc_Vendor_Block_Adminhtml_Vendor_Edit_Tab_Vendor extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('vendor_data');
        $form = new Varien_Data_Form();
        $fieldset = $form->addFieldset('vendor_form',array('legend'=>Mage::helper('vendor')->__('Vendor information')));

        $fieldset->addField('name', 'text', array(
            'name'      => 'vendor[name]',
            'label'     => Mage::helper('vendor')->__('Name'),
            'required'  => true,
        ));

        $fieldset->addField('email', 'text', array(
            'name'      => 'vendor[email]',
            'label'     => Mage::helper('vendor')->__('Email'),
            'required'  => true,
        ));

        $fieldset->addField('password', 'password', array(
            'name'      => 'vendor[password]',
            'label'     => Mage::helper('vendor')->__('Password'),
            'required'  => true,
        ));


        $fieldset->addField('mobile', 'text', array(
            'name'      => 'vendor[mobile]',
            'label'     => Mage::helper('vendor')->__('Mobile'),
            'required'  => true,
        ));

        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('vendor')->__('Status'),
            'title'     => Mage::helper('vendor')->__('Status'),
            'name'      => 'vendor[status]',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('vendor')->__('Active'),
                '2' => Mage::helper('vendor')->__('Not Active'),
            ),
        ));

        $this->setForm($form);
        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}
