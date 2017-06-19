CREATE DATABASE IF NOT EXISTS clinica  DEFAULT CHARACTER SET UTF8;

START TRANSACTION;

USE clinica;

CREATE TABLE IF NOT EXISTS boxes(
  id_box int(11) NOT NULL AUTO_INCREMENT,
  num_box int(11) NOT NULL,
  setor_box char(1) NOT NULL,
  PRIMARY KEY (id_box)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS itens(
  id_item int(11) NOT NULL AUTO_INCREMENT,
  nome_item varchar(45) NOT NULL,
  descricao_item varchar(45) NOT NULL,
  PRIMARY KEY (id_item)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS boxes_itens(
  id_item int(11) NOT NULL,
  id_box int(11) NOT NULL,
  operando tinyint(1) NOT NULL DEFAULT  1,
  PRIMARY KEY (id_item,id_box),
  FOREIGN KEY (id_item) REFERENCES itens(id_item) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (id_box) REFERENCES boxes(id_box) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS users(
  id_user int(11) NOT NULL AUTO_INCREMENT,
  name_user varchar(50) NOT NULL,
  password_user varchar(32) NOT NULL,
  PRIMARY KEY (id_user)
  )ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE VIEW full_itens AS 
  select bi.id_item AS id,
         i.nome_item AS item,
         bi.id_box AS id_box,
         b.num_box AS num_box,
         b.setor_box AS setor_box,
         bi.operando AS operando 
    from boxes b 
        inner join boxes_itens bi 
            on b.id_box = bi.id_box 
        inner join itens i 
            on bi.id_item = i.id_item;



CREATE VIEW boxes_danger AS 
  select bi.id_box AS id_box,
         b.num_box as num_box,
         5-sum(bi.operando) AS chamados,
         b.setor_box AS setor_box
    from boxes b 
        inner join boxes_itens bi 
            on b.id_box = bi.id_box
    group by bi.id_box;
                                



COMMIT;
