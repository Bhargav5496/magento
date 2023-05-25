<?php 

$this->startSetup();

$this->addEntityType(Bhargav_Bhargav_Model_Resource_Bhargav::ENTITY,[
	'entity_model'=>'bhargav/bhargav',
	'attribute_model'=>'bhargav/attribute',
	'table'=>'bhargav/bhargav',
	'increment_per_store'=> '0',
	'additional_attribute_table' => 'bhargav/eav_attribute',
	'entity_attribute_collection' => 'bhargav/bhargav_attribute_collection'
]);

$this->createEntityTables('bhargav');
$this->installEntities();

$default_attribute_set_id = Mage::getModel('eav/entity_setup', 'core_setup')
    						->getAttributeSetId('bhargav', 'Default');

$this->run("UPDATE `eav_entity_type` SET `default_attribute_set_id` = {$default_attribute_set_id} WHERE `entity_type_code` = 'bhargav'");

$this->endSetup();