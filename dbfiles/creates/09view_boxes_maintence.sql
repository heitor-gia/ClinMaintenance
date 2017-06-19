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