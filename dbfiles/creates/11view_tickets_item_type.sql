CREATE VIEW tickets_item_type AS SELECT i . * , COUNT( t.id_item ) as tickets
FROM tickets t
RIGHT JOIN itens i ON i.id_item = t.id_item
GROUP BY id_item