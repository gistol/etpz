UPDATE `classes` SET `id` = 8, `name` = 'currency' WHERE (id = 8);

/*--NEXT--*/

CREATE TABLE IF NOT EXISTS `object_query_8` (
			  `oo_id` int(11) NOT NULL default '0',
			  `oo_classId` int(11) default '8',
			  `oo_className` varchar(255) default 'currency',
			  PRIMARY KEY  (`oo_id`)
			) DEFAULT CHARSET=utf8mb4;

/*--NEXT--*/

ALTER TABLE `object_query_8` ALTER COLUMN `oo_className` SET DEFAULT 'currency';

/*--NEXT--*/

CREATE TABLE IF NOT EXISTS `object_store_8` (
			  `oo_id` int(11) NOT NULL default '0',
			  PRIMARY KEY  (`oo_id`)
			) DEFAULT CHARSET=utf8mb4;

/*--NEXT--*/

CREATE TABLE IF NOT EXISTS `object_relations_8` (
          `src_id` int(11) NOT NULL DEFAULT '0',
          `dest_id` int(11) NOT NULL DEFAULT '0',
          `type` varchar(50) NOT NULL DEFAULT '',
          `fieldname` varchar(70) NOT NULL DEFAULT '0',
          `index` int(11) unsigned NOT NULL DEFAULT '0',
          `ownertype` enum('object','fieldcollection','localizedfield','objectbrick') NOT NULL DEFAULT 'object',
          `ownername` varchar(70) NOT NULL DEFAULT '',
          `position` varchar(70) NOT NULL DEFAULT '0',
          PRIMARY KEY (`src_id`,`dest_id`,`ownertype`,`ownername`,`fieldname`,`type`,`position`),
          KEY `index` (`index`),
          KEY `src_id` (`src_id`),
          KEY `dest_id` (`dest_id`),
          KEY `fieldname` (`fieldname`),
          KEY `position` (`position`),
          KEY `ownertype` (`ownertype`),
          KEY `type` (`type`),
          KEY `ownername` (`ownername`)
        ) DEFAULT CHARSET=utf8mb4;

/*--NEXT--*/

ALTER TABLE `object_query_8` ADD COLUMN `name` varchar(190) NULL;

/*--NEXT--*/

ALTER TABLE `object_store_8` ADD COLUMN `name` varchar(190) NULL;

/*--NEXT--*/

ALTER TABLE `object_query_8` DROP INDEX `p_index_name`;

/*--NEXT--*/

ALTER TABLE `object_store_8` DROP INDEX `p_index_name`;

/*--NEXT--*/

ALTER TABLE `object_query_8` ADD COLUMN `rate` double NULL;

/*--NEXT--*/

ALTER TABLE `object_store_8` ADD COLUMN `rate` double NULL;

/*--NEXT--*/

ALTER TABLE `object_query_8` DROP INDEX `p_index_rate`;

/*--NEXT--*/

ALTER TABLE `object_store_8` DROP INDEX `p_index_rate`;

/*--NEXT--*/

CREATE OR REPLACE VIEW `object_8` AS SELECT * FROM `object_query_8` JOIN `objects` ON `objects`.`o_id` = `object_query_8`.`oo_id`;

/*--NEXT--*/

