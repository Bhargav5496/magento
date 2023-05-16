<?php

class Ccc_Practice_Block_Adminhtml_Practice_Edit_Tab_Practice extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('practice_data');
        $form = new Varien_Data_Form();
        $fieldset = $form->addFieldset('practice_form',array('legend'=>Mage::helper('practice')->__('Practice information')));

        $fieldset->addField('first_name', 'text', array(
            'name'      => 'practice[first_name]',
            'label'     => Mage::helper('practice')->__('First Name'),
            'required'  => true,
        ));

        $fieldset->addField('last_name', 'text', array(
            'name'      => 'practice[last_name]',
            'label'     => Mage::helper('practice')->__('Last Name'),
            'required'  => true,
        ));

        $fieldset->addField('email', 'text', array(
            'name'      => 'practice[email]',
            'label'     => Mage::helper('practice')->__('Email'),
            'required'  => true,
        ));

        $fieldset->addField('gender', 'select', array(
            'label'     => Mage::helper('practice')->__('Gender'),
            'title'     => Mage::helper('practice')->__('Gender'),
            'name'      => 'practice[gender]',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('practice')->__('Male'),
                '2' => Mage::helper('practice')->__('Female'),
            ),
        ));

        $fieldset->addField('mobile', 'text', array(
            'name'      => 'practice[mobile]',
            'label'     => Mage::helper('practice')->__('Mobile'),
            'required'  => true,
        ));

        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('practice')->__('Status'),
            'title'     => Mage::helper('practice')->__('Status'),
            'name'      => 'practice[status]',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('practice')->__('Active'),
                '2' => Mage::helper('practice')->__('Inactive'),
            ),
        ));

        $fieldset->addField('company', 'text', array(
            'name'      => 'practice[company]',
            'label'     => Mage::helper('practice')->__('Company'),
            'required'  => true,
        ));

        $this->setForm($form);
        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}
