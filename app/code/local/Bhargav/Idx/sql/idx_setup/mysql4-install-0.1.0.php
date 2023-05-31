<?php

$installer = $this;

$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS `import_product_idx`;
CREATE TABLE `import_product_idx` (
  `index` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10) NOT NULL,
  `cost` decimal(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `collection` varchar(255) NOT NULL,
  `collection_id` int(11) NOT NULL,
  `description` TEXT(1000) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;



ALTER TABLE `import_product_idx`
  ADD PRIMARY KEY (`index`);


ALTER TABLE `import_product_idx`
  MODIFY `index` int(11) NOT NULL AUTO_INCREMENT;

");

$installer->endSetup();

?>