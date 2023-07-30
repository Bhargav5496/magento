<?php
$installer = $this;
$installer->startSetup();

$tableName = $installer->getTable('test');
$connection = $installer->getConnection();

$connection->modifyColumn(
    $tableName,
    'price',
    [
        'type'     => Varien_Db_Ddl_Table::TYPE_DECIMAL,
        'length'   => '10,2',
        'nullable' => false,
        'comment'  => 'Price',
    ]
);

$installer->endSetup();
