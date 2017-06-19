CREATE TABLE IF NOT EXISTS `clinica`.`users` (
  `id_user` INT(11) NOT NULL AUTO_INCREMENT,
  `name_user` VARCHAR(50) NOT NULL,
  `password_user` VARCHAR(32) NOT NULL,
  `date_creation_user` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `user_type` INT NOT NULL,
  `activated_user` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_user`),
  INDEX `fk_users_user_types1_idx` (`user_type` ASC),
  CONSTRAINT `fk_users_user_types1`
    FOREIGN KEY (`user_type`)
    REFERENCES `clinica`.`user_types` (`id_user_type`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  UNIQUE(`name_user`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;