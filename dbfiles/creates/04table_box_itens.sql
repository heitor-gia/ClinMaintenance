CREATE TABLE IF NOT EXISTS `boxes_itens` (
  `id_item` INT(11) NOT NULL,
  `id_box` INT(11) NOT NULL,
  PRIMARY KEY (`id_item`, `id_box`),
  INDEX `id_box` (`id_box` ASC),
  CONSTRAINT `boxes_itens_ibfk_1`
    FOREIGN KEY (`id_item`)
    REFERENCES `itens` (`id_item`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `boxes_itens_ibfk_2`
    FOREIGN KEY (`id_box`)
    REFERENCES `boxes` (`id_box`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;
