﻿-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2014 at 03:44 PM
-- Server version: 5.5.35-0ubuntu0.13.10.1
-- PHP Version: 5.5.3-1ubuntu2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `evoke`
--

-- --------------------------------------------------------

--
-- Table structure for table `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=386 ;

--
-- Dumping data for table `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(192, NULL, NULL, NULL, 'controllers', 1, 388),
(193, 192, NULL, NULL, 'Badges', 2, 23),
(194, 193, NULL, NULL, 'index', 3, 4),
(195, 193, NULL, NULL, 'view', 5, 6),
(196, 193, NULL, NULL, 'add', 7, 8),
(197, 193, NULL, NULL, 'edit', 9, 10),
(198, 193, NULL, NULL, 'delete', 11, 12),
(199, 193, NULL, NULL, 'admin_index', 13, 14),
(200, 193, NULL, NULL, 'admin_view', 15, 16),
(201, 193, NULL, NULL, 'admin_add', 17, 18),
(202, 193, NULL, NULL, 'admin_edit', 19, 20),
(203, 193, NULL, NULL, 'admin_delete', 21, 22),
(204, 192, NULL, NULL, 'Comments', 24, 47),
(205, 204, NULL, NULL, 'index', 25, 26),
(206, 204, NULL, NULL, 'view', 27, 28),
(207, 204, NULL, NULL, 'add', 29, 30),
(208, 204, NULL, NULL, 'edit', 31, 32),
(209, 204, NULL, NULL, 'delete', 33, 34),
(210, 204, NULL, NULL, 'getUserById', 35, 36),
(211, 204, NULL, NULL, 'admin_index', 37, 38),
(212, 204, NULL, NULL, 'admin_view', 39, 40),
(213, 204, NULL, NULL, 'admin_add', 41, 42),
(214, 204, NULL, NULL, 'admin_edit', 43, 44),
(215, 204, NULL, NULL, 'admin_delete', 45, 46),
(216, 192, NULL, NULL, 'Evidences', 48, 69),
(217, 216, NULL, NULL, 'index', 49, 50),
(218, 216, NULL, NULL, 'view', 51, 52),
(219, 216, NULL, NULL, 'add', 53, 54),
(220, 216, NULL, NULL, 'edit', 55, 56),
(221, 216, NULL, NULL, 'delete', 57, 58),
(222, 216, NULL, NULL, 'admin_index', 59, 60),
(223, 216, NULL, NULL, 'admin_view', 61, 62),
(224, 216, NULL, NULL, 'admin_add', 63, 64),
(225, 216, NULL, NULL, 'admin_edit', 65, 66),
(226, 216, NULL, NULL, 'admin_delete', 67, 68),
(227, 192, NULL, NULL, 'Evokations', 70, 91),
(228, 227, NULL, NULL, 'index', 71, 72),
(229, 227, NULL, NULL, 'view', 73, 74),
(230, 227, NULL, NULL, 'add', 75, 76),
(231, 227, NULL, NULL, 'edit', 77, 78),
(232, 227, NULL, NULL, 'delete', 79, 80),
(233, 227, NULL, NULL, 'admin_index', 81, 82),
(234, 227, NULL, NULL, 'admin_view', 83, 84),
(235, 227, NULL, NULL, 'admin_add', 85, 86),
(236, 227, NULL, NULL, 'admin_edit', 87, 88),
(237, 227, NULL, NULL, 'admin_delete', 89, 90),
(238, 192, NULL, NULL, 'Groups', 92, 113),
(239, 238, NULL, NULL, 'index', 93, 94),
(240, 238, NULL, NULL, 'view', 95, 96),
(241, 238, NULL, NULL, 'add', 97, 98),
(242, 238, NULL, NULL, 'edit', 99, 100),
(243, 238, NULL, NULL, 'delete', 101, 102),
(244, 238, NULL, NULL, 'admin_index', 103, 104),
(245, 238, NULL, NULL, 'admin_view', 105, 106),
(246, 238, NULL, NULL, 'admin_add', 107, 108),
(247, 238, NULL, NULL, 'admin_edit', 109, 110),
(248, 238, NULL, NULL, 'admin_delete', 111, 112),
(249, 192, NULL, NULL, 'GroupsUsers', 114, 137),
(250, 249, NULL, NULL, 'index', 115, 116),
(251, 249, NULL, NULL, 'view', 117, 118),
(252, 249, NULL, NULL, 'storeFileInfo', 119, 120),
(253, 249, NULL, NULL, 'add', 121, 122),
(254, 249, NULL, NULL, 'edit', 123, 124),
(255, 249, NULL, NULL, 'delete', 125, 126),
(256, 249, NULL, NULL, 'admin_index', 127, 128),
(257, 249, NULL, NULL, 'admin_view', 129, 130),
(258, 249, NULL, NULL, 'admin_add', 131, 132),
(259, 249, NULL, NULL, 'admin_edit', 133, 134),
(260, 249, NULL, NULL, 'admin_delete', 135, 136),
(261, 192, NULL, NULL, 'Issues', 138, 159),
(262, 261, NULL, NULL, 'index', 139, 140),
(263, 261, NULL, NULL, 'view', 141, 142),
(264, 261, NULL, NULL, 'add', 143, 144),
(265, 261, NULL, NULL, 'edit', 145, 146),
(266, 261, NULL, NULL, 'delete', 147, 148),
(267, 261, NULL, NULL, 'admin_index', 149, 150),
(268, 261, NULL, NULL, 'admin_view', 151, 152),
(269, 261, NULL, NULL, 'admin_add', 153, 154),
(270, 261, NULL, NULL, 'admin_edit', 155, 156),
(271, 261, NULL, NULL, 'admin_delete', 157, 158),
(272, 192, NULL, NULL, 'MissionIssues', 160, 181),
(273, 272, NULL, NULL, 'index', 161, 162),
(274, 272, NULL, NULL, 'view', 163, 164),
(275, 272, NULL, NULL, 'add', 165, 166),
(276, 272, NULL, NULL, 'edit', 167, 168),
(277, 272, NULL, NULL, 'delete', 169, 170),
(278, 272, NULL, NULL, 'admin_index', 171, 172),
(279, 272, NULL, NULL, 'admin_view', 173, 174),
(280, 272, NULL, NULL, 'admin_add', 175, 176),
(281, 272, NULL, NULL, 'admin_edit', 177, 178),
(282, 272, NULL, NULL, 'admin_delete', 179, 180),
(283, 192, NULL, NULL, 'Missions', 182, 211),
(284, 283, NULL, NULL, 'index', 183, 184),
(285, 283, NULL, NULL, 'view', 185, 186),
(286, 283, NULL, NULL, 'add', 187, 188),
(287, 283, NULL, NULL, 'learn', 189, 190),
(288, 283, NULL, NULL, 'act', 191, 192),
(289, 283, NULL, NULL, 'imagine', 193, 194),
(290, 283, NULL, NULL, 'evoke', 195, 196),
(291, 283, NULL, NULL, 'edit', 197, 198),
(292, 283, NULL, NULL, 'delete', 199, 200),
(293, 283, NULL, NULL, 'admin_index', 201, 202),
(294, 283, NULL, NULL, 'admin_view', 203, 204),
(295, 283, NULL, NULL, 'admin_add', 205, 206),
(296, 283, NULL, NULL, 'admin_edit', 207, 208),
(297, 283, NULL, NULL, 'admin_delete', 209, 210),
(298, 192, NULL, NULL, 'Organizations', 212, 233),
(299, 298, NULL, NULL, 'index', 213, 214),
(300, 298, NULL, NULL, 'view', 215, 216),
(301, 298, NULL, NULL, 'add', 217, 218),
(302, 298, NULL, NULL, 'edit', 219, 220),
(303, 298, NULL, NULL, 'delete', 221, 222),
(304, 298, NULL, NULL, 'admin_index', 223, 224),
(305, 298, NULL, NULL, 'admin_view', 225, 226),
(306, 298, NULL, NULL, 'admin_add', 227, 228),
(307, 298, NULL, NULL, 'admin_edit', 229, 230),
(308, 298, NULL, NULL, 'admin_delete', 231, 232),
(309, 192, NULL, NULL, 'Pages', 234, 237),
(310, 309, NULL, NULL, 'display', 235, 236),
(311, 192, NULL, NULL, 'Panels', 238, 259),
(312, 311, NULL, NULL, 'index', 239, 240),
(313, 311, NULL, NULL, 'loadInfo', 241, 242),
(314, 311, NULL, NULL, 'groups', 243, 244),
(315, 311, NULL, NULL, 'roles', 245, 246),
(316, 311, NULL, NULL, 'users', 247, 248),
(317, 311, NULL, NULL, 'usersRole', 249, 250),
(318, 311, NULL, NULL, 'missionsIssues', 251, 252),
(319, 311, NULL, NULL, 'organizations', 253, 254),
(320, 311, NULL, NULL, 'issues', 255, 256),
(321, 311, NULL, NULL, 'badges', 257, 258),
(322, 192, NULL, NULL, 'Quests', 260, 281),
(323, 322, NULL, NULL, 'index', 261, 262),
(324, 322, NULL, NULL, 'view', 263, 264),
(325, 322, NULL, NULL, 'add', 265, 266),
(326, 322, NULL, NULL, 'edit', 267, 268),
(327, 322, NULL, NULL, 'delete', 269, 270),
(328, 322, NULL, NULL, 'admin_index', 271, 272),
(329, 322, NULL, NULL, 'admin_view', 273, 274),
(330, 322, NULL, NULL, 'admin_add', 275, 276),
(331, 322, NULL, NULL, 'admin_edit', 277, 278),
(332, 322, NULL, NULL, 'admin_delete', 279, 280),
(333, 192, NULL, NULL, 'Roles', 282, 293),
(334, 333, NULL, NULL, 'index', 283, 284),
(335, 333, NULL, NULL, 'view', 285, 286),
(336, 333, NULL, NULL, 'add', 287, 288),
(337, 333, NULL, NULL, 'edit', 289, 290),
(338, 333, NULL, NULL, 'delete', 291, 292),
(339, 192, NULL, NULL, 'UserIssues', 294, 315),
(340, 339, NULL, NULL, 'index', 295, 296),
(341, 339, NULL, NULL, 'view', 297, 298),
(342, 339, NULL, NULL, 'add', 299, 300),
(343, 339, NULL, NULL, 'edit', 301, 302),
(344, 339, NULL, NULL, 'delete', 303, 304),
(345, 339, NULL, NULL, 'admin_index', 305, 306),
(346, 339, NULL, NULL, 'admin_view', 307, 308),
(347, 339, NULL, NULL, 'admin_add', 309, 310),
(348, 339, NULL, NULL, 'admin_edit', 311, 312),
(349, 339, NULL, NULL, 'admin_delete', 313, 314),
(350, 192, NULL, NULL, 'Users', 316, 353),
(351, 350, NULL, NULL, 'login', 317, 318),
(352, 350, NULL, NULL, 'logout', 319, 320),
(353, 350, NULL, NULL, 'index', 321, 322),
(354, 350, NULL, NULL, 'register', 323, 324),
(355, 350, NULL, NULL, 'dashboard', 325, 326),
(356, 350, NULL, NULL, 'dashboardByIssue', 327, 328),
(357, 350, NULL, NULL, 'leaderboard', 329, 330),
(358, 350, NULL, NULL, 'add_friend', 331, 332),
(359, 350, NULL, NULL, 'remove_friend', 333, 334),
(360, 350, NULL, NULL, 'view', 335, 336),
(361, 350, NULL, NULL, 'add', 337, 338),
(362, 350, NULL, NULL, 'edit', 339, 340),
(363, 350, NULL, NULL, 'delete', 341, 342),
(364, 350, NULL, NULL, 'admin_index', 343, 344),
(365, 350, NULL, NULL, 'admin_view', 345, 346),
(366, 350, NULL, NULL, 'admin_add', 347, 348),
(367, 350, NULL, NULL, 'admin_edit', 349, 350),
(368, 350, NULL, NULL, 'admin_delete', 351, 352),
(369, 192, NULL, NULL, 'Votes', 354, 375),
(370, 369, NULL, NULL, 'index', 355, 356),
(371, 369, NULL, NULL, 'view', 357, 358),
(372, 369, NULL, NULL, 'add', 359, 360),
(373, 369, NULL, NULL, 'edit', 361, 362),
(374, 369, NULL, NULL, 'delete', 363, 364),
(375, 369, NULL, NULL, 'admin_index', 365, 366),
(376, 369, NULL, NULL, 'admin_view', 367, 368),
(377, 369, NULL, NULL, 'admin_add', 369, 370),
(378, 369, NULL, NULL, 'admin_edit', 371, 372),
(379, 369, NULL, NULL, 'admin_delete', 373, 374),
(380, 192, NULL, NULL, 'AclExtras', 376, 377),
(381, 192, NULL, NULL, 'DebugKit', 378, 385),
(382, 381, NULL, NULL, 'ToolbarAccess', 379, 384),
(383, 382, NULL, NULL, 'history_state', 380, 381),
(384, 382, NULL, NULL, 'sql_explain', 382, 383),
(385, 192, NULL, NULL, 'Upload', 386, 387);

-- --------------------------------------------------------

--
-- Table structure for table `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(9, NULL, 'User', 9, NULL, 1, 2),
(10, NULL, 'User', 10, NULL, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `aros_acos`
--

CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(20) NOT NULL,
  `foreign_key` int(16) NOT NULL,
  `name` varchar(32) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT '0',
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

CREATE TABLE IF NOT EXISTS `badges` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `trigger` varchar(120) NOT NULL,
  `language` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `chatrooms`
--

CREATE TABLE IF NOT EXISTS `chatrooms` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `chatroom_messages`
--

CREATE TABLE IF NOT EXISTS `chatroom_messages` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `chatroom_user_id` int(16) unsigned NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `chatroom_users`
--

CREATE TABLE IF NOT EXISTS `chatroom_users` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `chatroom_id` int(16) unsigned NOT NULL,
  `user_id` int(16) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `evidence_id` int(16) unsigned NOT NULL,
  `user_id` int(16) unsigned NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `is_system` tinyint(1) NOT NULL COMMENT 'Flag to determine wether an event is created by users or by system.',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `evidences`
--

CREATE TABLE IF NOT EXISTS `evidences` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `user_id` int(16) unsigned NOT NULL,
  `quest_id` int(16) unsigned DEFAULT NULL,
  `mission_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `evokations`
--

CREATE TABLE IF NOT EXISTS `evokations` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(16) unsigned NOT NULL,
  `gdrive_file_id` text,
  `title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `abstract` text CHARACTER SET utf8 NOT NULL,
  `language` varchar(120) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `evokations`
--

INSERT INTO `evokations` (`id`, `group_id`, `gdrive_file_id`, `title`, `abstract`, `language`, `created`, `modified`) VALUES
(18, 3, '0B9uWvehaHYz2aWdjdmRfZWZLR0E', 'tmp_title', 'tmp_abstract', NULL, '2014-02-28 19:36:00', '2014-02-28 19:36:00'),
(19, 3, '0B9uWvehaHYz2NUVrVHNSSUV4WjA', 'tmp_title', 'tmp_abstract', NULL, '2014-02-28 19:47:42', '2014-02-28 19:47:42');

-- --------------------------------------------------------

--
-- Table structure for table `friends_users`
--

CREATE TABLE IF NOT EXISTS `friends_users` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_from` int(16) unsigned NOT NULL,
  `user_to` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_from` (`user_from`),
  UNIQUE KEY `user_to` (`user_to`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `title`, `created`, `modified`) VALUES
(3, 'the prionics', '2014-02-19 06:14:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups_users`
--

CREATE TABLE IF NOT EXISTS `groups_users` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `group_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups_users`
--

INSERT INTO `groups_users` (`id`, `user_id`, `group_id`, `created`, `modified`) VALUES
(1, 5, 3, '2014-02-19 15:52:27', '2014-02-19 15:52:27'),
(2, 7, 3, '2014-02-19 15:52:33', '2014-02-19 15:52:33');

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE IF NOT EXISTS `issues` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(16) unsigned DEFAULT NULL,
  `name` varchar(120) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(120) NOT NULL COMMENT 'This is just the sanitized name',
  `language` varchar(120) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `missions`
--

CREATE TABLE IF NOT EXISTS `missions` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `image` varchar(120) DEFAULT NULL,
  `language` varchar(120) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mission_issues`
--

CREATE TABLE IF NOT EXISTS `mission_issues` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `mission_id` int(16) unsigned NOT NULL,
  `issue_id` int(16) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE IF NOT EXISTS `organizations` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) CHARACTER SET utf8 NOT NULL,
  `birthdate` date DEFAULT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `website` varchar(120) DEFAULT NULL,
  `facerbook` varchar(120) DEFAULT NULL,
  `twitter` varchar(120) DEFAULT NULL,
  `blog` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE IF NOT EXISTS `points` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `value` double NOT NULL,
  `user_id` int(16) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `quests`
--

CREATE TABLE IF NOT EXISTS `quests` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `mission_id` int(16) unsigned NOT NULL,
  `phase` varchar(120) CHARACTER SET utf8 NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(4, 'Administrator'),
(5, 'Manager'),
(6, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `key` varchar(120) CHARACTER SET utf8 NOT NULL,
  `value` text CHARACTER SET utf8 NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created`, `modified`) VALUES
(18, 'google_auth_refresh_token', '{"access_token":"ya29.1.AADtN_XZrVOpuli9ZfeMcOz7RA8kVMdVjEOHFzjngx7RI365LVPnFm4wgRFYhY4","token_type":"Bearer","expires_in":3600,"id_token":"eyJhbGciOiJSUzI1NiIsImtpZCI6ImY2MDNhODlhNzQ0OGEyMjM5MDcxZjI4YTk3MzViNjUwNWM2YWJjYTgifQ.eyJpc3MiOiJhY2NvdW50cy5nb29nbGUuY29tIiwiY2lkIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiYXpwIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwidG9rZW5faGFzaCI6ImhYZjJzUVV5c1Zma09GbHpIbmtKMkEiLCJhdF9oYXNoIjoiaFhmMnNRVXlzVmZrT0Zsekhua0oyQSIsImlkIjoiMTAzMDM3NDEwNzcwNjc5MjMzNTYzIiwic3ViIjoiMTAzMDM3NDEwNzcwNjc5MjMzNTYzIiwiYXVkIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiZW1haWwiOiJtc29sZWRhZGVAcXVhbnRpLmNhIiwiaGQiOiJxdWFudGkuY2EiLCJ2ZXJpZmllZF9lbWFpbCI6InRydWUiLCJlbWFpbF92ZXJpZmllZCI6InRydWUiLCJpYXQiOjEzOTM1MjQyNTUsImV4cCI6MTM5MzUyODE1NX0.c9WNn8ubqvqkVxJpcpW_Xs9xWhbZ_HHdP6_ROM7uUi81UvQEQXlmckCluf46GR4MLIrMKyejhgoYp5kD0uRo8zel5lFu7ucaZTCAZHT1C5wMniYPzhuVonlWazwX19MefJhDR67pEa6xKUFpA5IhlnvAvTLRT0-_v2aCiODr-CQ","refresh_token":"1\\/hF_NMUf2qVGOip0lzm15Bluw48dK5-7M4Q4TBXMqYnc","created":1393524537}', '2014-02-27 15:08:57', '2014-02-27 15:08:57'),
(19, 'google_auth_access_token', '{"access_token":"ya29.1.AADtN_XkZEMDx2JYvC66rskr0z2CuWnv84uZ_w87CJpLWadCJ1m9Zj2H0qCncs5v","token_type":"Bearer","expires_in":3600,"id_token":"eyJhbGciOiJSUzI1NiIsImtpZCI6ImY2MDNhODlhNzQ0OGEyMjM5MDcxZjI4YTk3MzViNjUwNWM2YWJjYTgifQ.eyJpc3MiOiJhY2NvdW50cy5nb29nbGUuY29tIiwiY2lkIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiYXpwIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwidG9rZW5faGFzaCI6ImhYZjJzUVV5c1Zma09GbHpIbmtKMkEiLCJhdF9oYXNoIjoiaFhmMnNRVXlzVmZrT0Zsekhua0oyQSIsImlkIjoiMTAzMDM3NDEwNzcwNjc5MjMzNTYzIiwic3ViIjoiMTAzMDM3NDEwNzcwNjc5MjMzNTYzIiwiYXVkIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiZW1haWwiOiJtc29sZWRhZGVAcXVhbnRpLmNhIiwiaGQiOiJxdWFudGkuY2EiLCJ2ZXJpZmllZF9lbWFpbCI6InRydWUiLCJlbWFpbF92ZXJpZmllZCI6InRydWUiLCJpYXQiOjEzOTM1MjQyNTUsImV4cCI6MTM5MzUyODE1NX0.c9WNn8ubqvqkVxJpcpW_Xs9xWhbZ_HHdP6_ROM7uUi81UvQEQXlmckCluf46GR4MLIrMKyejhgoYp5kD0uRo8zel5lFu7ucaZTCAZHT1C5wMniYPzhuVonlWazwX19MefJhDR67pEa6xKUFpA5IhlnvAvTLRT0-_v2aCiODr-CQ","refresh_token":"1\\/hF_NMUf2qVGOip0lzm15Bluw48dK5-7M4Q4TBXMqYnc","created":1393625384}', '2014-02-27 15:08:57', '2014-02-28 19:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `role_id` int(16) unsigned NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `facebook_id`, `facebook_token`, `name`, `birthdate`, `email`, `sex`, `biography`, `username`, `password`, `facebook`, `twitter`, `instagram`, `website`, `blog`, `created`, `modified`) VALUES
(10, 0, '100000218093892', 'CAAJeTV3YsC8BAKaaVsmDVCGZCKXZBiCvKbHbFDH05tFViq2LU5QSwgYrVzRiR5nGjRZBxUCHGyPaBsJKPJCuEJ8ZA7v0YbdC8Fn2SyQY8oeNR0z3gwOnJt8c0xGUcUly29yZCg50lrcDNsXslrZChnXmMc5JqL7Jkp7a7gYSZCW81PorXEPZAZAVXVi65oHfgoEUZD', 'Marcos Soledade Jr.', '0000-00-00', NULL, 1, '', '', '', 'https://www.facebook.com/marcosoledadejr', NULL, NULL, NULL, NULL, '2014-02-28 19:49:55', '2014-02-28 19:49:55');

-- --------------------------------------------------------

--
-- Table structure for table `user_badges`
--

CREATE TABLE IF NOT EXISTS `user_badges` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `badge_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_issues`
--

CREATE TABLE IF NOT EXISTS `user_issues` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `issue_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_organizations`
--

CREATE TABLE IF NOT EXISTS `user_organizations` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `organization_id` int(16) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `evidence_id` int(16) unsigned NOT NULL,
  `user_id` int(16) unsigned NOT NULL,
  `value` tinyint(4) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;