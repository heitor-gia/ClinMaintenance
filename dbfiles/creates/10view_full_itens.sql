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