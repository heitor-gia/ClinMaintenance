

-- -----------------------------------------------------
-- Table `clinica`.`boxes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clinica`.`boxes` (
  `id_box` INT(11) NOT NULL AUTO_INCREMENT,
  `num_box` INT(11) NOT NULL,
  `sector_box` CHAR(1) NOT NULL,
  PRIMARY KEY (`id_box`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `clinica`.`itens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clinica`.`itens` (
  `id_item` INT(11) NOT NULL AUTO_INCREMENT,
  `name_item` VARCHAR(45) NOT NULL,
  `description_item` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_item`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `clinica`.`boxes_itens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clinica`.`boxes_itens` (
  `id_item` INT(11) NOT NULL,
  `id_box` INT(11) NOT NULL,
  PRIMARY KEY (`id_item`, `id_box`),
  INDEX `id_box` (`id_box` ASC),
  CONSTRAINT `boxes_itens_ibfk_1`
    FOREIGN KEY (`id_item`)
    REFERENCES `clinica`.`itens` (`id_item`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `boxes_itens_ibfk_2`
    FOREIGN KEY (`id_box`)
    REFERENCES `clinica`.`boxes` (`id_box`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `clinica`.`user_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clinica`.`user_types` (
  `id_user_type` INT NOT NULL AUTO_INCREMENT COMMENT '\n',
  `description_user_type` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_user_type`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clinica`.`users`
-- -----------------------------------------------------
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
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;



-- -----------------------------------------------------
-- Trigger `reset_account`
-- -----------------------------------------------------
DELIMITER $$
CREATE TRIGGER `reset_account` BEFORE UPDATE ON `users`
 FOR EACH ROW 
 IF (NEW.activated_user = 0) THEN SET NEW.password_user = "163ee9847a2b5b7441f33aa23ec31304";
 END IF;
 
$$

DELIMITER ;
	


-- -----------------------------------------------------
-- Table `clinica`.`tickets`
-- -----------------------------------------------------
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
-- -----------------------------------------------------
-- View `clinica`.`tickets_item`
-- -----------------------------------------------------
CREATE VIEW tickets_item as 
        (SELECT COUNT(*) AS `tickets`,`id_item`,`id_box`
        FROM `tickets` WHERE `close_ticket` IS NULL
        GROUP BY `id_item` , `id_box`)

        UNION 

        (SELECT 0 AS `tickets`,`id_item`,`id_box`
        FROM `boxes_itens`
        WHERE (`id_item`,`id_box`) NOT IN (SELECT `id_item`,`id_box` FROM `tickets` WHERE `close_ticket` IS NULL))

        ORDER BY `id_box` ASC, `id_item` ASC;




-- -----------------------------------------------------
-- View `clinica`.`boxes_danger`
-- -----------------------------------------------------

CREATE VIEW boxes_maintence AS
    SELECT 
        `b`.`id_box` AS `id_box`,
        `b`.`num_box` AS `num_box`,
        `b`.`sector_box` AS `sector_box`,
        SUM(`tickets`) AS `tickets`
    FROM
        `boxes` `b`
            INNER JOIN
        `tickets_item` `ti` ON (`ti`.`id_box` = `b`.`id_box`) 
      
    GROUP BY `b`.`id_box`
    ORDER BY `b`.`sector_box` ASC, `b`.`num_box` ASC;

-- -----------------------------------------------------
-- View `clinica`.`full_itens`
-- -----------------------------------------------------


CREATE VIEW full_itens AS
    SELECT 
        `i`.`id_item` AS `id`,
        `i`.`name_item` AS `item`,
        `b`.`id_box` AS `id_box`,
        `b`.`num_box` AS `num_box`,
        `b`.`sector_box` AS `sector_box`,
        IF((`b`.`id_box`,`i`.`id_item`) NOT IN(
                                            SELECT `id_box`,`id_item`
                                            FROM `tickets` 
                                            WHERE `close_ticket` IS NULL),TRUE,FALSE) AS `operating`
    FROM
        `boxes` `b`
 
    INNER JOIN `tickets_item` `t` ON `b`.`id_box` = `t`.`id_box`
    INNER JOIN `itens` `i`    ON `t`.`id_item` = `i`.`id_item`
    ORDER BY `b`.`num_box` ASC, `i`.`id_item` ASC;


-- ----------------------------------------------------
-- PROCEDURES sp_add_item_on_boxes
-- ----------------------------------------------------
DELIMITER $$
CREATE PROCEDURE `sp_add_item_to_boxes`(IN `id_item` INT)
BEGIN 
  DECLARE `done` INT DEFAULT 0;
  DECLARE `box` INT;
  DECLARE mycur CURSOR FOR SELECT id_box FROM boxes;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1; 


  OPEN mycur;

  WHILE done!=1 DO

    FETCH mycur INTO box;
    INSERT INTO boxes_itens (id_item,id_box) VALUES (id_item,box);  

  END WHILE;

  CLOSE mycur; 

END $$

DELIMITER ;


-- -----------------------------------------------------
-- INITIAL INSERTS
-- -----------------------------------------------------

insert into itens(name_item,description_item)
  values ('Lâmpada',''),
       ('Caneta de alta-rotação',''),
       ('Caneta de baixa-rotação',''),
       ('Cadeira odontológica',''),
       ('Sugador','');

insert into boxes(num_box,sector_box)
  values (1,'B'),(2,'B'),(3,'B'),(4,'A'),(5,'A'),
       (6,'B'),(7,'B'),(8,'B'),(9,'B'),(10,'A'),
       (11,'A'),(12,'A'),(13,'D'),(14,'D'),(15,'D'),
       (16,'D'),(17,'C'),(18,'C'),(19,'C'),(20,'D'),
       (21,'D'),(22,'D'),(23,'D'),(24,'C'),(25,'C'),
       (26,'C'),(27,'F'),(28,'F'),(29,'F'),(30,'F'),
       (31,'E'),(32,'E'),(33,'E'),(34,'F'),(35,'F'),
       (36,'F'),(37,'F'),(38,'E'),(39,'E'),(40,'E'),
       (41,'H'),(42,'H'),(43,'H'),(44,'G'),(45,'G'),
       (46,'G'),(47,'H'),(48,'H'),(49,'H'),(50,'H'),
       (51,'J'),(52,'J'),(53,'J'),(54,'J'),(55,'J'),
       (56,'J'),(57,'J'),(58,'J'),(59,'I'),(60,'I'),
       (61,'I'),(62,'M'),(63,'M'),(64,'M'),(65,'M'),
       (66,'L'),(67,'L'),(68,'L'),(69,'M'),(70,'M'),
       (71,'M'),(72,'M'),(73,'L'),(74,'L'),(75,'L'),
       (76,'O'),(77,'O'),(78,'O'),(79,'O'),(80,'N'),
       (81,'N'),(82,'N'),(83,'O'),(84,'O'),(85,'O'),
       (86,'O'),(87,'N'),(88,'N'),(89,'N');

CALL sp_add_item_to_boxes(1);
CALL sp_add_item_to_boxes(2);
CALL sp_add_item_to_boxes(3);
CALL sp_add_item_to_boxes(4);
CALL sp_add_item_to_boxes(5);

INSERT INTO user_types(description_user_type) 
  values ('Administrador'),('Responsável'),('Manutenção');

INSERT INTO users(name_user,password_user,user_type)
  values('admin','21232f297a57a5a743894a0e4a801fc3',1),
        ('resp','bd86bced84fb3aef951fb07de8c533c7',2),
        ('man','39c63ddb96a31b9610cd976b896ad4f0',3);

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
