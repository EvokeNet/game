ALTER TABLE  `quests` ADD  `title_es` VARCHAR( 120 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER  `title`,
ADD  `description_es` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER  `description`;