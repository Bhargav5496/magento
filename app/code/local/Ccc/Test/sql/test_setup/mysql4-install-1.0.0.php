<?php
$installer = $this;
$installer->startSetup();

$installer->run("DROP TABLE IF EXISTS {$installer->getTable('test')};");
$table = $installer->getConnection()
    ->newTable($installer->getTable('test'))
    ->addColumn('test_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER, 11, [
            'identity' => true,
            'primary'  => true,
            'nullable' => false,
        ], 'Test ID')
    ->addColumn('title',
        Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, [
            'nullable' => false,
        ], 'Title')
    ->addColumn('content',
        Varien_Db_Ddl_Table::TYPE_TEXT, null, [
            'nullable' => false,
        ], 'Content')
    ->addColumn('status',
        Varien_Db_Ddl_Table::TYPE_SMALLINT, null, [
            'nullable' => false,
            'default'  => 0,
        ], 'Status')
    ->addColumn('created_at',
        Varien_Db_Ddl_Table::TYPE_DATETIME, null, [
            'nullable' => false,
        ], 'Created At')
    ->addColumn('updated_at',
        Varien_Db_Ddl_Table::TYPE_DATETIME, null, [
            'nullable' => true,
            'default'  => null,
        ], 'Updated At')
    ->addColumn('category_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER, 11, [
            'nullable' => false,
            'after'    => 'test_id',
        ], 'Category ID')
    ->addColumn('is_active',
        Varien_Db_Ddl_Table::TYPE_BOOLEAN, null, [
            'nullable' => false,
            'default'  => false,
            'after'    => 'status',
        ], 'Is Active')
    ->setComment('Test Table');

$installer->getConnection()->createTable($table);

$installer->getConnection()->addForeignKey(
    $installer->getFkName('test', 'category_id', 'category', 'category_id'),
    'test',
    'category_id',
    'category',
    'category_id',
    Varien_Db_Ddl_Table::ACTION_CASCADE,
    Varien_Db_Ddl_Table::ACTION_CASCADE
);

$installer->endSetup();
