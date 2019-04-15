ALTER TABLE `order_table` ADD `islunch` BOOLEAN NOT NULL DEFAULT FALSE ;
ALTER TABLE `order_table` ADD `isdinner` BOOLEAN NOT NULL DEFAULT FALSE ;
ALTER TABLE `order_table` ADD `shippingcharge` INT NOT NULL ;
ALTER TABLE `order_table` ADD `unit` INT NOT NULL DEFAULT '1' ;
ALTER TABLE `order_table` ADD `mealamount` INT NOT NULL ;
ALTER TABLE `order_table` CHANGE `isactive` `isactive` TINYINT(4) NOT NULL DEFAULT '0';