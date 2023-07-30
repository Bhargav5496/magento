<?php
$installer = $this;
$installer->startSetup();

$resource   = Mage::getSingleton('core/resource');
$connection = $resource->getConnection('core_write');
$tableName  = $resource->getTableName('test');

$data = [
    [
        'title'       => 'Apple',
        'content'     => 'Content 1',
        'status'      => 1,
        'created_at'  => '2023-07-18 12:00:00',
        'category_id' => '1',
        'is_active'   => 1,
        'enum'        => '0',
        'price'       => '1200.00',
    ],
    [
        'title'       => 'Dell',
        'content'     => 'Content 2',
        'status'      => 1,
        'created_at'  => '2023-07-19 12:00:00',
        'category_id' => '1',
        'is_active'   => 0,
        'enum'        => '1',
        'price'       => '900.00',
    ],
    [
        'title'       => 'Samsung',
        'content'     => 'Content 3',
        'status'      => 1,
        'created_at'  => '2023-07-20 12:00:00',
        'category_id' => '1',
        'is_active'   => 1,
        'enum'        => '0',
        'price'       => '1500.00',
    ],
    [
        'title'       => 'Vivo',
        'content'     => 'Content 4',
        'status'      => 1,
        'created_at'  => '2023-07-21 12:00:00',
        'category_id' => '1',
        'is_active'   => 0,
        'enum'        => '1',
        'price'       => '1400.00',
    ],
    [
        'title'       => 'MI',
        'content'     => 'Content 5',
        'status'      => 1,
        'created_at'  => '2023-07-22 12:00:00',
        'category_id' => '1',
        'is_active'   => 1,
        'enum'        => '2',
        'price'       => '1300.00',
    ],
];

$connection->insertMultiple($tableName, $data);

$installer->endSetup();
