CREATE TABLE itens (
  id_item INT(11) NOT NULL AUTO_INCREMENT,
  name_item VARCHAR(45) NOT NULL,
  description_item VARCHAR(45) NOT NULL,
  PRIMARY KEY (id_item),
  UNIQUE(`name_item`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;
