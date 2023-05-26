<?php

class Bhargav_Eavmgmt_Block_Adminhtml_Eavmgmt_Edit_Tab_Eavmgmt extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('eavmgmt_data');
        $form = new Varien_Data_Form();
        $fieldset = $form->addFieldset('eavmgmt_form',array('legend'=>Mage::helper('eavmgmt')->__('Eavmgmt information')));

        $fieldset->addField('first_name', 'text', array(
            'name'      => 'eavmgmt[first_name]',
            'label'     => Mage::helper('eavmgmt')->__('First Name'),
            'required'  => true,
        ));

        $fieldset->addField('last_name', 'text', array(
            'name'      => 'eavmgmt[last_name]',
            'label'     => Mage::helper('eavmgmt')->__('Last Name'),
            'required'  => true,
        ));

        $fieldset->addField('email', 'text', array(
            'name'      => 'eavmgmt[email]',
            'label'     => Mage::helper('eavmgmt')->__('Email'),
            'required'  => true,
        ));

        $fieldset->addField('gender', 'select', array(
            'label'     => Mage::helper('eavmgmt')->__('Gender'),
            'title'     => Mage::helper('eavmgmt')->__('Gender'),
            'name'      => 'eavmgmt[gender]',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('eavmgmt')->__('Male'),
                '2' => Mage::helper('eavmgmt')->__('Female'),
            ),
        ));

        $fieldset->addField('mobile', 'text', array(
            'name'      => 'eavmgmt[mobile]',
            'label'     => Mage::helper('eavmgmt')->__('Mobile'),
            'required'  => true,
        ));

        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('eavmgmt')->__('Status'),
            'title'     => Mage::helper('eavmgmt')->__('Status'),
            'name'      => 'eavmgmt[status]',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('eavmgmt')->__('Active'),
                '2' => Mage::helper('eavmgmt')->__('Inactive'),
            ),
        ));

        $fieldset->addField('company', 'text', array(
            'name'      => 'eavmgmt[company]',
            'label'     => Mage::helper('eavmgmt')->__('Company'),
            'required'  => true,
        ));

        $this->setForm($form);
        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}
