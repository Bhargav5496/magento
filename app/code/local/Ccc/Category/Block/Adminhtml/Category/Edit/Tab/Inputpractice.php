<?php

class Ccc_Category_Block_Adminhtml_Category_Edit_Tab_Inputpractice extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('input_practice_data');
        $form  = new Varien_Data_Form();

        $fieldset = $form->addFieldset('input_practice_form', array('legend' => Mage::helper('category')->__('Magento Input Fields') . " " . $a));

        $fieldset->addField('first_name', 'text', array(
            'label'              => Mage::helper('category')->__('First Name'),
            // 'class'              => 'required-entry',
            'required'           => false,
            'name'               => 'input_practice[first_name]',
            // 'onclick'            => "alert('on click');",
            // 'onchange'           => "alert('on change');",
            // 'style'              => "border:10px",
            'disabled'           => false,
            // 'readonly'           => false,
            'after_element_html' => 'Textfield',
        ));

        $fieldset->addField('note', 'note', array(
            'text' => Mage::helper('category')->__('This is note - Text Text'),
        ));

        $fieldset->addField('address', 'textarea', array(
            'label'              => Mage::helper('category')->__('Address'),
            // 'class'              => 'required-entry',
            'required'           => false,
            'name'               => 'input_practice[address]',
            'onclick'            => "",
            'onchange'           => "",
            'disabled'           => false,
            // 'readonly'           => true,
            'after_element_html' => 'Enter your address',
        ));

        $fieldset->addField('birth_date', 'date', array(
            'label'              => Mage::helper('category')->__('Birth Date'),
            'after_element_html' => 'Birth Date',
            'name'               => 'input_practice[birth_date]',
            'image'              => $this->getSkinUrl('images/grid-cal.gif'),
            'format'             => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM),
        ));

        $fieldset->addField('bith_time', 'time', array(
            'label'              => Mage::helper('category')->__('Birth Time'),
            // 'class'              => 'required-entry',
            'required'           => false,
            'name'               => 'input_practice[birth_time]',
            'onclick'            => "",
            'onchange'           => "",
            'disabled'           => false,
            'readonly'           => false,
            'after_element_html' => 'Birth Time',
            'tabindex'           => 1,
        ));

        $fieldset->addField('country', 'select', array(
            'label'              => Mage::helper('category')->__('Country'),
            // 'class'              => 'required-entry',
            'required'           => false,
            'name'               => 'input_practice[country]',
            'onclick'            => "",
            'onchange'           => "",
            'values'             => array(
                '-1' => 'Please Select..',
                '1'  => array(
                    'value' => array(
                        array('value' => '1', 'label' => 'India'), array('value' => '2', 'label' => 'China')),
                    'label' => 'Asia'),
                '2'  => array(
                    'value' => array(
                        array('value' => '3', 'label' => 'Kenya'), array('value' => '3', 'label' => 'Zimbabwe')),
                    'label' => 'Africa'),
            ),
            'disabled'           => false,
            'readonly'           => false,
            'after_element_html' => 'Drop down',
            'tabindex'           => 1,
        ));

        $fieldset->addField('status', 'select', array(
            'label'              => Mage::helper('category')->__('Status'),
            // 'class'              => 'required-entry',
            'required'           => false,
            'name'               => 'input_practice[status]',
            'onclick'            => "",
            'onchange'           => "",
            'values'             => array('1' => 'Active', '0' => 'Inactive'),
            // 'disabled'           => false,
            // 'readonly'           => false,
            'after_element_html' => 'Drop down',
            'tabindex'           => 1,
        ));

        $fieldset->addField('color', 'checkboxes', array(
            'label'              => Mage::helper('category')->__('Color'),
            'name'               => 'input_practice[color]',
            'values'             => array(
                array('value' => '1', 'label' => 'Red'),
                array('value' => '2', 'label' => 'Blue'),
                array('value' => '3', 'label' => 'Orange'),
            ),
            'onclick'            => "",
            'onchange'           => "",
            'disabled'           => false,
            'after_element_html' => 'Select the colors',
            'tabindex'           => 1,
            'multiple'           => true,
        ));

        $fieldset->addField('subject', 'multiselect', array(
            'label'              => Mage::helper('category')->__('Subject'),
            // 'class'              => 'required-entry',
            'required'           => false,
            'name'               => 'input_practice[subject]',
            // 'onclick'            => "return false;",
            // 'onchange'           => "return false;",
            'value'              => '4',
            'values'             => array(
                '-1' => array(
                    'label' => 'Please Select..',
                    'value' => '-1'),
                '1'  => array(
                    'label' => 'Computer Science',
                    'value' => array(
                        array('value' => '1', 'label' => 'Data Structure'),
                        array('value' => '2', 'label' => 'Java Programming'),
                    ),
                ),
                '2'  => array(
                    'label' => 'Mechanical',
                    'value' => array(
                        array('value' => '3', 'label' => 'Kinematic Analysis and Synthesis.'),
                        array('value' => '4', 'label' => 'Fluid Mechanics.')),
                ),
            ),
            'disabled'           => false,
            'readonly'           => false,
            'after_element_html' => "Select the subject(s)",
            'tabindex'           => 1,
        ));

        $fieldset->addField('gender', 'radios', array(
            'label'    => Mage::helper('category')->__('Gender'),
            'name'     => 'gender',
            'onclick'  => "",
            'onchange' => "",
            'value'    => '2',
            'values'   => array(
                array('value' => '1', 'label' => 'Male'),
                array('value' => '2', 'label' => 'Female'),
            ),
            'disabled' => false,
            'readonly' => false,
            // 'after_element_html' => 'Radios button',
            'tabindex' => 1,
        ));

        $fieldset->addField('password', 'password', array(
            'label'              => Mage::helper('category')->__('Password'),
            // 'class'              => 'required-entry',
            'required'           => false,
            'name'               => 'input_practice[password]',
            'onclick'            => "",
            'onchange'           => "",
            'style'              => "",
            'disabled'           => false,
            // 'readonly'           => false,
            'after_element_html' => 'Password',
        ));

        $fieldset->addField('obscure', 'obscure', array(
            'label'              => Mage::helper('category')->__('Obscure'),
            // 'class'              => 'required-entry',
            'required'           => false,
            'name'               => 'input_practice[obscure]',
            'onclick'            => "",
            'onchange'           => "",
            'style'              => "",
            'value'              => '123456789',
            'after_element_html' => 'Obscure is an another type of password',
        ));

        $fieldset->addField('link', 'link', array(
            'label'              => 'Link Field',
            'href'               => Mage::getBaseUrl('media') . 'input/practice/' . $model->image,
            'value'              => 'Click Here', // The text to display for the link
            'after_element_html' => '<a href="' . Mage::getBaseUrl('media') . 'input/practice/' . $model->image . '" target="_blank">' . $model->image . '</a>',
        ));

        $fieldset->addField('image', 'file', array(
            'label'              => Mage::helper('category')->__('Upload Image'),
            'value'              => 'Upload',
            'disabled'           => false,
            'name'               => 'input_practice[image]',
            'readonly'           => true,
            'after_element_html' => 'File upload',
            'tabindex'           => 1,
        ));

        $this->setForm($form);
        $form->setValues($model->getData());

        // echo '<pre>';print_r($model->getData());die;

        return parent::_prepareForm();
    }
}
