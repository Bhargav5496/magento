<?php

class Bhargav_Bhargav_Block_Adminhtml_Bhargav_Edit_Tab_Bhargav extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('bhargav_data');
        $form = new Varien_Data_Form();
        $fieldset = $form->addFieldset('bhargav_form',array('legend'=>Mage::helper('bhargav')->__('Bhargav information')));

        $fieldset->addField('first_name', 'text', array(
            'name'      => 'bhargav[first_name]',
            'label'     => Mage::helper('bhargav')->__('First Name'),
            'required'  => true,
        ));

        $fieldset->addField('last_name', 'text', array(
            'name'      => 'bhargav[last_name]',
            'label'     => Mage::helper('bhargav')->__('Last Name'),
            'required'  => true,
        ));

        $fieldset->addField('email', 'text', array(
            'name'      => 'bhargav[email]',
            'label'     => Mage::helper('bhargav')->__('Email'),
            'required'  => true,
        ));

        $fieldset->addField('gender', 'select', array(
            'label'     => Mage::helper('bhargav')->__('Gender'),
            'title'     => Mage::helper('bhargav')->__('Gender'),
            'name'      => 'bhargav[gender]',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('bhargav')->__('Male'),
                '2' => Mage::helper('bhargav')->__('Female'),
            ),
        ));

        $fieldset->addField('mobile', 'text', array(
            'name'      => 'bhargav[mobile]',
            'label'     => Mage::helper('bhargav')->__('Mobile'),
            'required'  => true,
        ));

        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('bhargav')->__('Status'),
            'title'     => Mage::helper('bhargav')->__('Status'),
            'name'      => 'bhargav[status]',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('bhargav')->__('Active'),
                '2' => Mage::helper('bhargav')->__('Inactive'),
            ),
        ));

        $fieldset->addField('company', 'text', array(
            'name'      => 'bhargav[company]',
            'label'     => Mage::helper('bhargav')->__('Company'),
            'required'  => true,
        ));

        $this->setForm($form);
        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}
