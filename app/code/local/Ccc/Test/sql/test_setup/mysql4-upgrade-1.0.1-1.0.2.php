<?php

$installer = $this;
$installer->startSetup();

$tableName = $installer->getTable('test');

$installer->getConnection()->addColumn($tableName, 'price', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'Price',
));

$installer->endSetup();
