<?php
$installer = $this;
$installer->startSetup();

$installer->getConnection()->dropColumn($installer->getTable('test'), 'updated_at');

$installer->endSetup();