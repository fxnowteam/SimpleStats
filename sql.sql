CREATE TABLE IF NOT EXISTS `contador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` text,
  `cont` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) 