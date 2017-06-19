CREATE TABLE IF NOT EXISTS `clinica`.`user_types` (
  `id_user_type` INT NOT NULL AUTO_INCREMENT COMMENT '\n',
  `description_user_type` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_user_type`))
ENGINE = InnoDB;