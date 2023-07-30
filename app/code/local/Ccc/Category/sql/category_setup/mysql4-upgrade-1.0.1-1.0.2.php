<?php

$installer = $this;
$installer->startSetup();

$tableName = $installer->getTable('category');

$installer->getConnection()->addColumn($tableName, 'a1', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'A1',
));
$installer->getConnection()->addColumn($tableName, 'a2', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'A2',
));
$installer->getConnection()->addColumn($tableName, 'a3', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'A3',
));
$installer->getConnection()->addColumn($tableName, 'a4', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'A4',
));
$installer->getConnection()->addColumn($tableName, 'a5', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'A5',
));

$installer->getConnection()->addColumn($tableName, 'percentage_a', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'Percentage A',
));

$installer->getConnection()->addColumn($tableName, 'b1', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'B1',
));
$installer->getConnection()->addColumn($tableName, 'b2', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'B2',
));
$installer->getConnection()->addColumn($tableName, 'b3', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'B3',
));

$installer->getConnection()->addColumn($tableName, 'percentage_b', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'Percentage B',
));

$installer->getConnection()->addColumn($tableName, 'c1', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'C1',
));
$installer->getConnection()->addColumn($tableName, 'c2', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'C2',
));
$installer->getConnection()->addColumn($tableName, 'c3', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'C3',
));
$installer->getConnection()->addColumn($tableName, 'c4', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'C4',
));

$installer->getConnection()->addColumn($tableName, 'percentage_c', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'Percentage C',
));

$installer->getConnection()->addColumn($tableName, 'd1', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'D1',
));
$installer->getConnection()->addColumn($tableName, 'd2', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'D2',
));
$installer->getConnection()->addColumn($tableName, 'd3', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'D3',
));
$installer->getConnection()->addColumn($tableName, 'd4', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'D4',
));
$installer->getConnection()->addColumn($tableName, 'd5', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'D5',
));
$installer->getConnection()->addColumn($tableName, 'd6', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'D6',
));

$installer->getConnection()->addColumn($tableName, 'percentage_d', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'Percentage D',
));

$installer->getConnection()->addColumn($tableName, 'percentage_overall', array(
    'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length'  => 100,
    'nullable' => true,
    'default' => null,
    'comment' => 'Overall Percentage',
));

$installer->endSetup();
