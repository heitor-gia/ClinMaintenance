
CREATE PROCEDURE `sp_add_item_to_boxes`(IN `id_item` INT)
BEGIN 
  DECLARE `done` INT DEFAULT 0;
  DECLARE `box` INT;
  DECLARE mycur CURSOR FOR SELECT id_box FROM boxes;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1; 


  OPEN mycur;

  WHILE done!=1 DO

    FETCH mycur INTO box;
    IF done!=1 THEN INSERT INTO boxes_itens (id_item,id_box) VALUES (id_item,box);  
    END IF;
    
  END WHILE;

  CLOSE mycur; 

END;
