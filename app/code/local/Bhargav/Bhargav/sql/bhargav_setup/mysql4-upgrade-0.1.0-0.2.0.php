<?php

$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
/* @var $installer Mage_Catalog_Model_Resource_Setup */

$installer->startSetup();

$installer->addAttribute(9, 'discount', array(
    'type'          => 'decimal',
    'group'         => 'Prices',
    'backend'       => 'catalog/product_attribute_backend_groupprice',
    'label'         => 'Discount',
    'input'         => 'decimal',
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'visible'       => true,
    'required'      => false,
));

$installer->addAttribute(9, 'date_of_birth', array(
    'type' => 'datetime',
    'group'         => 'Prices',
    'backend'       => 'catalog/product_attribute_backend_groupprice',
    'label'         => 'Date of Birth',
    'input'         => 'datetime',
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'visible'       => true,
    'required'      => false,
));

$installer->addAttribute(9, 'class', array(
    'type' => 'varchar',
    'group'         => 'Prices',
    'backend'       => 'catalog/product_attribute_backend_groupprice',
    'label'         => 'Class',
    'input'         => 'varchar',
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'visible'       => true,
    'required'      => false,
));

$installer->addAttribute(9, 'height', array(
    'type' => 'int',
    'group'         => 'Prices',
    'backend'       => 'catalog/product_attribute_backend_groupprice',
    'label'         => 'Height',
    'input'         => 'int',
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'visible'       => true,
    'required'      => false,
));
$installer->endSetup();