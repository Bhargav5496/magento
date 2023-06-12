<?php

class Ccc_Category_Block_Adminhtml_Category_Edit_Tab_Category extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('category_data');
        $form = new Varien_Data_Form();

        $fieldset = $form->addFieldset('category_form',array('legend'=>Mage::helper('category')->__('Category Information')));
        
        $fieldset->addField('name', 'text', array(
            'name'      => 'category[name]',
            'label'     => Mage::helper('category')->__('Name'),
            'required'  => true,
        ));


        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('category')->__('Status'),
            'title'     => Mage::helper('category')->__('Status'),
            'name'      => 'category[status]',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('category')->__('Active'),
                '2' => Mage::helper('category')->__('Inactive'),
            ),
        ));
        
        $this->setForm($form);
        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}
