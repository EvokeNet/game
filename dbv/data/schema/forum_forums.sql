CREATE TABLE `forum_forums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(115) NOT NULL,
  `description` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `orderNo` smallint(6) NOT NULL DEFAULT '0',
  `autoLock` tinyint(1) NOT NULL DEFAULT '1',
  `excerpts` tinyint(1) NOT NULL DEFAULT '0',
  `topic_count` int(11) NOT NULL DEFAULT '0',
  `post_count` int(11) NOT NULL DEFAULT '0',
  `accessRead` int(11) DEFAULT NULL,
  `accessPost` int(11) DEFAULT NULL,
  `accessPoll` int(11) DEFAULT NULL,
  `accessReply` int(11) DEFAULT NULL,
  `lastTopic_id` int(11) DEFAULT NULL,
  `lastPost_id` int(11) DEFAULT NULL,
  `lastUser_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `lastTopic_id` (`lastTopic_id`),
  KEY `lastPost_id` (`lastPost_id`),
  KEY `lastUser_id` (`lastUser_id`),
  KEY `accessRead` (`accessRead`),
  KEY `accessPost` (`accessPost`),
  KEY `accessPoll` (`accessPoll`),
  KEY `accessReply` (`accessReply`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Forum categories to post topics to'