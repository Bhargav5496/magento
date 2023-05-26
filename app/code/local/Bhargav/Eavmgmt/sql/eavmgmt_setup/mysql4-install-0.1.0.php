<?php

$installer = $this;

$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS `eavmgmt`;
CREATE TABLE `eavmgmt` (
  `eavmgmt_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `company` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;



ALTER TABLE `eavmgmt`
  ADD PRIMARY KEY (`eavmgmt_id`);


ALTER TABLE `eavmgmt`
  MODIFY `eavmgmt_id` int(11) NOT NULL AUTO_INCREMENT;

");
$installer->endSetup();

?>