ALTER TABLE  `missions` ADD  `description_es` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER  `description`,
ALTER TABLE  `missions` ADD  `title_es` VARCHAR(120) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `title`;