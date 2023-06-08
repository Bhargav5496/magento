<?php

class Bhargav_Brand_Block_Adminhtml_Brand_Edit_Tab_Brand extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('brand_data');
        $form = new Varien_Data_Form();
        $fieldset = $form->addFieldset('brand_form',array('legend'=>Mage::helper('brand')->__('Brand information')));

        $fieldset->addField('name', 'text', array(
            'name'      => 'brand[name]',
            'label'     => Mage::helper('brand')->__('Name'),
            'required'  => true,
        ));


        $fieldset->addField('image', 'image', array(
            'name'      => 'image',
            'class'     => 'validate-image-file',
            'label'     => Mage::helper('brand')->__('Brand Image'),
            'required'  => true,
        ));

        
        $fieldset->addField('sort_order', 'text', array(
            'label' => Mage::helper('brand')->__('Sort Order'),
            'name' => 'brand[sort_order]',
            'required' => true
        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('brand')->__('Status'),
            'name' => 'brand[status]',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('brand')->__('Active')
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('brand')->__('Inactive')
                )
            )
        ));

        $fieldset->addField('banner_image', 'image', array(
            'name'      => 'banner_image',
            'class'     => 'validate-banner-image-file',
            'label'     => Mage::helper('brand')->__('Banner Image'),
            'required'  => true,
        ));

        $fieldset->addField('description', 'textarea', array(
            'name'      => 'brand[description]',
            'label'     => Mage::helper('brand')->__('Description'),
            'required'  => true,
        ));

        $this->setForm($form);
        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}
