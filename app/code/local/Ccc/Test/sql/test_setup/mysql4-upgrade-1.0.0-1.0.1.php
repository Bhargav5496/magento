<?php
$installer = $this;
$installer->startSetup();

$installer->run("ALTER TABLE `test` ADD `enum` ENUM('0','1','2') NOT NULL COMMENT 'enum' AFTER `is_active`;");

$installer->endSetup();