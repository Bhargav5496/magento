<?php
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
$installer->addAttribute(4, 'brand', array(
    'group'                      => 'General',
    'input'                      => 'select',
    'type'                       => 'int',
    'label'                      => 'Brand',
    'backend'                    => '',
    'visible'                    => 1,
    'required'                   => 0,
    'source'                     => 'Bhargav_Brand_Model_Source_Model',
    'user_defined'               => 1,
    'searchable'                 => 1,
    'filterable'                 => 0,
    'comparable'                 => 1,
    'visible_on_front'           => 1,
    'visible_in_advanced_search' => 0,
    'is_html_allowed_on_front'   => 1,
));
$installer->endSetup();