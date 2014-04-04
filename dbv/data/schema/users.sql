CREATE TABLE `users` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `role_id` int(16) unsigned NOT NULL DEFAULT '3',
  `facebook_id` varchar(120) DEFAULT NULL,
  `facebook_token` text,
  `name` varchar(120) CHARACTER SET utf8 NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `sex` tinyint(1) NOT NULL,
  `biography` text CHARACTER SET utf8 NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `facebook` varchar(120) DEFAULT NULL,
  `twitter` varchar(120) DEFAULT NULL,
  `instagram` varchar(120) DEFAULT NULL,
  `website` varchar(120) DEFAULT NULL,
  `blog` varchar(120) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1