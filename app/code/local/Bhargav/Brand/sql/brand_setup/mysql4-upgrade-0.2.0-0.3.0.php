<?php
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
$tableName = $installer->getTable('brand/brand');
$installer->getConnection()
    ->addColumn($tableName, 'banner_image', [
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length' => 255,
        'nullable' => true,
        'comment' => 'banner_image',
        'after'=>'image'
    ]);

$installer->getConnection()
    ->addColumn($tableName, 'url_key', [
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length' => 255,
        'nullable' => true,
        'after' => 'banner_image',
        'comment' => 'url_key'
    ]);
$installer->getConnection()
    ->addColumn($installer->getTable('brand'),'sort_order', array(
        'type'      => Varien_Db_Ddl_Table::TYPE_INTEGER,
        'nullable'  => false,
        'length'    => 11,
        'after'     => 'description', 
        'comment'   => 'Sort Order'
        ));
$installer->getConnection()
    ->addColumn($installer->getTable('brand'),'status', array(
        'type'      => Varien_Db_Ddl_Table::TYPE_SMALLINT,
        'nullable'  => false,
        'length'    => 4,
        'after'     => 'banner_image', 
        'comment'   => 'Status'
        ));
$installer->endSetup();