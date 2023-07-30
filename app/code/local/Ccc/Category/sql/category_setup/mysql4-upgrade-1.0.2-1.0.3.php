<?php

$installer = $this;
$installer->startSetup();

$installer->run("
  DROP TABLE IF EXISTS {$this->getTable('input_type_practice')};
  CREATE TABLE `magento`.`input_type_practice` (
    `entity_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `first_name` VARCHAR(255) NOT NULL , 
    `address` TEXT NOT NULL , 
    `birth_date` DATE NOT NULL , 
    `birth_time` TIME NOT NULL , 
    `country` TINYINT(4) NOT NULL , 
    `status` TINYINT(4) NOT NULL , 
    `color` VARCHAR(50) NOT NULL , 
    `subject` VARCHAR(50) NOT NULL , 
    `gender` TINYINT(4) NOT NULL , 
    `password` VARCHAR(255) NOT NULL , 
    `obscure` VARCHAR(255) NOT NULL , 
    `image` VARCHAR(255) NOT NULL , 
    PRIMARY KEY (`entity_id`)) ENGINE = InnoDB;
");

$installer->endSetup();
