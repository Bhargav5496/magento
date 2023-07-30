<?php

class Ccc_Category_Block_Adminhtml_Category_Edit_Tab_Progress extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('model_data');
        $form  = new Varien_Data_Form();

        $a       = $model->percentage_a ? "(" . number_format($model->percentage_a, 2) . "%)" : "(0%)";
        $b       = $model->percentage_b ? "(" . number_format($model->percentage_b, 2) . "%)" : "(0%)";
        $c       = $model->percentage_c ? "(" . number_format($model->percentage_c, 2) . "%)" : "(0%)";
        $d       = $model->percentage_d ? "(" . number_format($model->percentage_d, 2) . "%)" : "(0%)";
        $overAll = $model->percentage_overall ? "(" . number_format($model->percentage_overall, 2) . "%)" : "(0%)";

        $progressBar = $form->addField('progress_bar', 'note', array(
            'label' => 'Progress : ' . $overAll,
            'text'  => '<progress id="progressBar" value="' . $model->percentage_overall . '" max="100"></progress>',
        ));

        $fieldset = $form->addFieldset('category_form_1', array('legend' => Mage::helper('category')->__('Brand & Website Information') . " " . $a));

        $fieldset->addField('a1', 'text', array(
            'name'     => 'category[a][a1]',
            'value'    => null,
            'label'    => Mage::helper('category')->__('A1'),
            'required' => true,
        ));

        $fieldset->addField('a2', 'text', array(
            'name'  => 'category[a][a2]',
            'value' => null,
            'label' => Mage::helper('category')->__('A2'),
        ));

        $fieldset->addField('a3', 'text', array(
            'name'  => 'category[a][a3]',
            'value' => null,
            'label' => Mage::helper('category')->__('A3'),
        ));

        $fieldset->addField('a4', 'text', array(
            'name'  => 'category[a][a4]',
            'value' => null,
            'label' => Mage::helper('category')->__('A4'),
        ));

        $fieldset->addField('a5', 'text', array(
            'name'  => 'category[a][a5]',
            'value' => null,
            'label' => Mage::helper('category')->__('A5'),
        ));

        $fieldset = $form->addFieldset('category_form_2', array('legend' => Mage::helper('category')->__('Shipping') . " " . $b));


        $fieldset->addField('b1', 'text', array(
            'name'     => 'category[b][b1]',
            'value'    => null,
            'label'    => Mage::helper('category')->__('B1'),
            'required' => true,
        ));

        $fieldset->addField('b2', 'text', array(
            'name'  => 'category[b][b2]',
            'value' => null,
            'label' => Mage::helper('category')->__('B2'),
        ));

        $fieldset->addField('b3', 'text', array(
            'name'  => 'category[b][b3]',
            'value' => null,
            'label' => Mage::helper('category')->__('B3'),
        ));

        $fieldset = $form->addFieldset('category_form_3', array('legend' => Mage::helper('category')->__('Billing & Payment') . " " . $c));

        

        $fieldset->addField('c1', 'text', array(
            'name'     => 'category[c][c1]',
            'value'    => null,
            'label'    => Mage::helper('category')->__('C1'),
            'required' => true,
        ));

        $fieldset->addField('c2', 'text', array(
            'name'  => 'category[c][c2]',
            'value' => null,
            'label' => Mage::helper('category')->__('C2'),
        ));

        $fieldset->addField('c3', 'text', array(
            'name'  => 'category[c][c3]',
            'value' => null,
            'label' => Mage::helper('category')->__('C3'),
        ));

        $fieldset->addField('c4', 'text', array(
            'name'  => 'category[c][c4]',
            'value' => null,
            'label' => Mage::helper('category')->__('C4'),
        ));

        $fieldset = $form->addFieldset('category_form_4', array('legend' => Mage::helper('category')->__('Claims & Returns') . " " . $d));



        $fieldset->addField('d1', 'text', array(
            'name'     => 'category[d][d1]',
            'value'    => null,
            'label'    => Mage::helper('category')->__('D1'),
            'required' => true,
        ));

        $fieldset->addField('d2', 'text', array(
            'name'  => 'category[d][d2]',
            'value' => null,
            'label' => Mage::helper('category')->__('D2'),
        ));

        $fieldset->addField('d3', 'text', array(
            'name'  => 'category[d][d3]',
            'value' => null,
            'label' => Mage::helper('category')->__('D3'),
        ));

        $fieldset->addField('d4', 'text', array(
            'name'  => 'category[d][d4]',
            'value' => null,
            'label' => Mage::helper('category')->__('D4'),
        ));

        $fieldset->addField('d5', 'text', array(
            'name'  => 'category[d][d5]',
            'value' => null,
            'label' => Mage::helper('category')->__('D5'),
        ));

        $fieldset->addField('d6', 'text', array(
            'name'  => 'category[d][d6]',
            'value' => null,
            'label' => Mage::helper('category')->__('D6'),
        ));

        $this->setForm($form);
        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}
