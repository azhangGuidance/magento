<?php

/**
 * @author      Andu Zhang
 * @category    Guidance
 * @package     Brand
 * @copyright   Copyright (c) 2012 Guidance Solutions (http://www.guidance.com)
 */

$installer = $this;
$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('message/message')};
CREATE TABLE {$this->getTable('message/message')} (
  `message_id` int(10) unsigned NOT NULL auto_increment,
  `created_at` datetime default NULL,
  `from` int(10),
  `to` int(10),
  `title` text,
  `content` text,
  `status` smallint(5) unsigned default 0,
  PRIMARY KEY  (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Invite Friend';
  ");

$installer->endSetup();