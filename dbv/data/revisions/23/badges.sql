ALTER TABLE  `badges` ADD  `name_es` VARCHAR( 120 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER  `name`, ALTER TABLE  `badges` ADD  `description_es` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER  `description`;