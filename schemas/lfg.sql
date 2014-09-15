CREATE TABLE IF NOT EXISTS `lfg` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `level` int(11) NOT NULL,
  `class` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `mode` varchar(255) DEFAULT NULL,
  `gamerid` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `headset` int(1) NOT NULL DEFAULT '0',
  `enabled` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
);