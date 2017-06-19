CREATE TABLE IF NOT EXISTS `clinica`.`tickets` (
  `id_ticket` INT NOT NULL AUTO_INCREMENT,
  `creation_ticket` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `close_ticket` TIMESTAMP NULL,
  `description_ticket` VARCHAR(100) NOT NULL,
  `id_item` INT(11) NOT NULL,
  `id_box` INT(11) NOT NULL,
  PRIMARY KEY (`id_ticket`),
  INDEX `fk_tickets_boxes_itens1_idx` (`id_item` ASC, `id_box` ASC),
  CONSTRAINT `fk_tickets_boxes_itens1`
    FOREIGN KEY (`id_item` , `id_box`)
    REFERENCES `clinica`.`boxes_itens` (`id_item` , `id_box`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;