<?php

class Ccc_Vendor_Block_Adminhtml_Vendor_Edit_Tab_Address extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('vendor_address_data');
        $form = new Varien_Data_Form();
        $fieldset = $form->addFieldset('vendor_address_form',array('legend'=>Mage::helper('vendor')->__('Vendor Address information')));

        $fieldset->addField('address', 'text', array(
            'name'      => 'address[address]',
            'label'     => Mage::helper('vendor')->__('Address'),
            'required'  => true,
        ));

        $fieldset->addField('postal_code', 'text', array(
            'name'      => 'address[postal_code]',
            'label'     => Mage::helper('vendor')->__('Postal Code'),
            'required'  => true,
        ));

        $fieldset->addField('city', 'text', array(
            'name'      => 'address[city]',
            'label'     => Mage::helper('vendor')->__('City'),
            'required'  => true,
        ));


       $fieldset->addField('country', 'select', array(
            'name'      => 'address[country]',
            'label'     => Mage::helper('vendor')->__('Country'),
            'required'  => true,
            'values'    => Mage::getModel('directory/country')->getResourceCollection()
                            ->loadByStore()
                            ->toOptionArray(),
            'onchange'  => 'updateStateOptions(this.value)',
        ));

        $fieldset->addField('state', 'select', array(
            'name'      => 'address[state]',
            'label'     => Mage::helper('vendor')->__('State'),
            'required'  => true,
            'values'    => Mage::getModel('directory/region')->getResourceCollection()
                            ->addCountryFilter($countryId)
                            ->load()
                            ->toOptionArray()
        ));

        $this->setForm($form);
        $form->setValues($model->getData());

        $script = '
            <script>
            function updateStateOptions(countryId) {
                console.log(countryId);
                var url = "' . $this->getUrl('*/*/updateStateOptions') . '"; // Replace with your controller action URL
                new Ajax.Request(url, {
                    method: "post",
                    parameters: { country_id: countryId },
                    onSuccess: function(transport) {
                        var response = transport.responseText.evalJSON();
                        var stateField = $("state");
                        stateField.update("");
                        response.each(function(option) {
                            stateField.insert(new Element("option", { value: option.value }).update(option.label));
                        });
                    }
                });
            }
            </script>';
        $fieldset->addField('ajax_script', 'note', array(
            'text'     => $script,
            'after_element_html' => '',
        ));

        return parent::_prepareForm();
    }
}
