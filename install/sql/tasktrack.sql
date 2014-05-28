SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tasks`
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `caption` text,
  `finished` int(11) DEFAULT '0',
  `is_paused` int(11) DEFAULT '0',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT '0000-00-00 00:00:00',
  `paused` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `time_limit` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;