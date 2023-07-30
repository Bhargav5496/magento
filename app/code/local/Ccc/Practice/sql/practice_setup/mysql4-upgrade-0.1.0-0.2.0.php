<?php
require_once 'app/Mage.php';

// Attribute data
$attributeCode = 'bottom_color';
$attributeLabel = 'Bottom Color';
$attributeType = 'int';
$attributeOptions = array('red','blue','yellow','black','white','brown','silver','gold','orange','pink','purple');

// Create attribute
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();

$installer->addAttribute('catalog_product',$attributeCode,
    array(
        'group'             => 'General',
        'type'              => $attributeType,
        'backend'           => '',
        'frontend'          => '',
        'label'             => $attributeLabel,
        'input'             => 'select',
        'class'             => '',
        'source'            => '',
        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
        'visible'           => true,
        'required'          => false,
        'user_defined'      => true,
        'default'           => '',
        'searchable'        => false,
        'filterable'        => false,
        'comparable'        => false,
        'visible_on_front'  => false,
        'visible_in_advanced_search' => false,
        'unique'            => false,
        'is_configurable'   => false,
        'used_for_promo_rules' => true,
        'option'            => array('values' => $attributeOptions)
    )
);

$installer->endSetup();

