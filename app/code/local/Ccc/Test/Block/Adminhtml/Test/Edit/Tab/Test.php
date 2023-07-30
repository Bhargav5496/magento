<?php

class Ccc_Test_Block_Adminhtml_Test_Edit_Tab_Test extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('model_data');
        $form  = new Varien_Data_Form();

        $fieldset = $form->addFieldset('test_form', array('legend' => Mage::helper('test')->__('Test Information')));

        $fieldset->addField('name', 'text', array(
            'label'              => Mage::helper('test')->__('Name'),
            // 'class'              => 'required-entry',
            'required'           => false,
            'name'               => 'name',
            // 'onclick'            => "alert('on click');",
            // 'onchange'           => "alert('on change');",
            // 'style'              => "border:10px",
            'disabled'           => false,
            // 'readonly'           => false,
            'after_element_html' => 'Enter the name of test',
        ));

        $fieldset->addField('status', 'select', array(
            'label'              => Mage::helper('test')->__('Status'),
            // 'class'              => 'required-entry',
            'required'           => false,
            'name'               => 'status',
            'onclick'            => "",
            'onchange'           => "",
            'values'             => array('1' => 'Active', '0' => 'Inactive'),
            'value'              => '0',
            'disabled'           => false,
            'readonly'           => false,
            'after_element_html' => 'Select the status',
            'tabindex'           => 1,
        ));

        $this->setForm($form);
        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}
