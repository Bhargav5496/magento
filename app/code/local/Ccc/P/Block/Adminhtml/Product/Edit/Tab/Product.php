<?php

class Ccc_Product_Block_Adminhtml_Product_Edit_Tab_Product extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('product_data');
        $form = new Varien_Data_Form();
        $fieldset = $form->addFieldset('product_form',array('legend'=>Mage::helper('product')->__('product information')));
        
        $fieldset->addField('parent_id', 'text', array(
            'name'      => 'product[parent_id]',
            'label'     => Mage::helper('product')->__('parent_id'),
            'required'  => true,
        ));


        $fieldset->addField('path', 'text', array(
            'name'      => 'product[path]',
            'label'     => Mage::helper('product')->__('Path'),
            'required'  => true,
        ));

        $fieldset->addField('name', 'text', array(
            'name'      => 'product[name]',
            'label'     => Mage::helper('product')->__('Name'),
            'required'  => true,
        ));


        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('product')->__('Status'),
            'title'     => Mage::helper('product')->__('Status'),
            'name'      => 'product[status]',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('product')->__('Active'),
                '2' => Mage::helper('product')->__('Inactive'),
            ),
        ));
        
        $fieldset->addField('description', 'text', array(
            'name'      => 'product[description]',
            'label'     => Mage::helper('product')->__('Description'),
            'required'  => true,
        ));

        $this->setForm($form);
        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}
