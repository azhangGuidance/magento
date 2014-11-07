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

-- DROP TABLE IF EXISTS {$this->getTable('friend/invite')};
CREATE TABLE {$this->getTable('friend/invite')} (
  `friend_invite_id` int(10) unsigned NOT NULL auto_increment,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `inviter_id` int(10),
  `target_id` int(10),
  `status` smallint(5) unsigned default 0,
  PRIMARY KEY  (`friend_invite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Invite Friend';
-- DROP TABLE IF EXISTS {$this->getTable('friend/relation')};
CREATE TABLE {$this->getTable('friend/relation')} (
  `friend_relation_id` int(10) unsigned NOT NULL auto_increment,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `inviter_id` int(10),
  `target_id` int(10),
  `status` smallint(5) unsigned default 0,
  PRIMARY KEY  (`friend_relation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Friend Relation';

  ");

$installer->endSetup();