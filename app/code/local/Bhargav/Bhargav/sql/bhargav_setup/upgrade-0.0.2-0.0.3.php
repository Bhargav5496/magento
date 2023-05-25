<?php 

$installer = $this;

$installer->startSetup();

$installer->getConnection()->addKey($installer->getTable('bhargav/bhargav_decimal'),
    'UNQ_Bhargav_DECIMAL', array('entity_id','attribute_id', 'store_id'), 'unique');

$installer->getConnection()->addKey($installer->getTable('bhargav/bhargav_datetime'),
    'UNQ_Bhargav_DECIMAL', array('entity_id','attribute_id', 'store_id'), 'unique');

$installer->getConnection()->addKey($installer->getTable('bhargav/bhargav_int'),
    'UNQ_Bhargav_DECIMAL', array('entity_id','attribute_id', 'store_id'), 'unique');

$installer->getConnection()->addKey($installer->getTable('bhargav/bhargav_text'),
    'UNQ_Bhargav_DECIMAL', array('entity_id','attribute_id', 'store_id'), 'unique');

$installer->endSetup();

?>