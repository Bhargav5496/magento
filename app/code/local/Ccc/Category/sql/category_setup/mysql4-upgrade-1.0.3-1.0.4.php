<?php

$installer = $this;
$installer->startSetup();

$tableName = $installer->getTable('category');

$installer->getConnection()->addColumn($tableName, 'input_practice_id', array(
    'type'     => Varien_Db_Ddl_Table::TYPE_INTEGER,
    'length'   => 11,
    'nullable' => true,
    'default'  => null,
    'comment'  => 'Input Type Id',
));

$installer->run("
  ALTER TABLE `category` ADD FOREIGN KEY (`input_practice_id`) REFERENCES `input_type_practice`(`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE;
");

$installer->endSetup();
