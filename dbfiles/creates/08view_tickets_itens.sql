CREATE VIEW tickets_item as 
        (SELECT COUNT(*) AS `tickets`,`id_item`,`id_box`
        FROM `tickets` WHERE `close_ticket` IS NULL
        GROUP BY `id_item` , `id_box`)

        UNION 

        (SELECT 0 AS `tickets`,`id_item`,`id_box`
        FROM `boxes_itens`
        WHERE (`id_item`,`id_box`) NOT IN (SELECT `id_item`,`id_box` FROM `tickets` WHERE `close_ticket` IS NULL))

        ORDER BY `id_box` ASC, `id_item` ASC;