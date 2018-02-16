UPDATE `classes` SET `id` = 6, `name` = 'Collection' WHERE (id = 6);

/*--NEXT--*/

CREATE TABLE IF NOT EXISTS `object_query_6` (
			  `oo_id` int(11) NOT NULL default '0',
			  `oo_classId` int(11) default '6',
			  `oo_className` varchar(255) default 'Collection',
			  PRIMARY KEY  (`oo_id`)
			) DEFAULT CHARSET=utf8mb4;

/*--NEXT--*/

ALTER TABLE `object_query_6` ALTER COLUMN `oo_className` SET DEFAULT 'Collection';

/*--NEXT--*/

CREATE TABLE IF NOT EXISTS `object_store_6` (
			  `oo_id` int(11) NOT NULL default '0',
			  PRIMARY KEY  (`oo_id`)
			) DEFAULT CHARSET=utf8mb4;

/*--NEXT--*/

CREATE TABLE IF NOT EXISTS `object_relations_6` (
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

ALTER TABLE `object_query_6` DROP INDEX `p_index_name`;

/*--NEXT--*/

ALTER TABLE `object_store_6` DROP INDEX `p_index_name`;

/*--NEXT--*/

ALTER TABLE `object_query_6` DROP INDEX `p_index_related_cat_attributes_to_collection`;

/*--NEXT--*/

ALTER TABLE `object_store_6` DROP INDEX `p_index_related_cat_attributes_to_collection`;

/*--NEXT--*/

ALTER TABLE `object_query_6` DROP INDEX `p_index_related_attributes_to_collection`;

/*--NEXT--*/

ALTER TABLE `object_store_6` DROP INDEX `p_index_related_attributes_to_collection`;

/*--NEXT--*/

CREATE OR REPLACE VIEW `object_6` AS SELECT * FROM `object_query_6` JOIN `objects` ON `objects`.`o_id` = `object_query_6`.`oo_id`;

/*--NEXT--*/

CREATE TABLE IF NOT EXISTS `object_metadata_6` (
              `o_id` int(11) NOT NULL default '0',
              `dest_id` int(11) NOT NULL default '0',
	          `type` VARCHAR(50) NOT NULL DEFAULT '',
              `fieldname` varchar(71) NOT NULL,
              `column` varchar(190) NOT NULL,
              `data` text,
              `ownertype` ENUM('object','fieldcollection','localizedfield','objectbrick') NOT NULL DEFAULT 'object',
              `ownername` VARCHAR(70) NOT NULL DEFAULT '',
              `position` VARCHAR(70) NOT NULL DEFAULT '0',
              PRIMARY KEY (`o_id`, `dest_id`, `type`, `fieldname`, `column`, `ownertype`, `ownername`, `position`),
              INDEX `o_id` (`o_id`),
              INDEX `dest_id` (`dest_id`),
              INDEX `fieldname` (`fieldname`),
              INDEX `column` (`column`),
              INDEX `ownertype` (`ownertype`),
              INDEX `ownername` (`ownername`),
              INDEX `position` (`position`)
		) DEFAULT CHARSET=utf8mb4;

/*--NEXT--*/

CREATE TABLE IF NOT EXISTS `object_metadata_6` (
              `o_id` int(11) NOT NULL default '0',
              `dest_id` int(11) NOT NULL default '0',
	          `type` VARCHAR(50) NOT NULL DEFAULT '',
              `fieldname` varchar(71) NOT NULL,
              `column` varchar(190) NOT NULL,
              `data` text,
              `ownertype` ENUM('object','fieldcollection','localizedfield','objectbrick') NOT NULL DEFAULT 'object',
              `ownername` VARCHAR(70) NOT NULL DEFAULT '',
              `position` VARCHAR(70) NOT NULL DEFAULT '0',
              PRIMARY KEY (`o_id`, `dest_id`, `type`, `fieldname`, `column`, `ownertype`, `ownername`, `position`),
              INDEX `o_id` (`o_id`),
              INDEX `dest_id` (`dest_id`),
              INDEX `fieldname` (`fieldname`),
              INDEX `column` (`column`),
              INDEX `ownertype` (`ownertype`),
              INDEX `ownername` (`ownername`),
              INDEX `position` (`position`)
		) DEFAULT CHARSET=utf8mb4;

/*--NEXT--*/

