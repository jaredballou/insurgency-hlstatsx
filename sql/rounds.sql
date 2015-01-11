CREATE TABLE IF NOT EXISTS `hlstats_Events_Rounds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eventTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `serverId` int(10) unsigned NOT NULL DEFAULT '0',
  `map` varchar(64) NOT NULL DEFAULT '',
  `type` varchar(64) NOT NULL DEFAULT '',
  `priority` int(10) unsigned DEFAULT '0',
  `timelimit` int(10) unsigned DEFAULT '0',
  `lives` int(10) unsigned DEFAULT '0',
  `gametype` int(10) unsigned DEFAULT '0',
  `reason` int(10) unsigned DEFAULT '0',
  `winner` int(10) unsigned DEFAULT '0',
  `message` varchar(255) DEFAULT '',
  `message_string` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
