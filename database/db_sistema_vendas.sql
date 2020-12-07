CREATE DATABASE IF NOT EXISTS `sistema_vendas` DEFAULT CHARACTER SET utf8 ;
use sistema_vendas;


CREATE TABLE IF NOT EXISTS `sistema_vendas`.`produtos` (
  id INT NOT NULL AUTO_INCREMENT,
  referencia CHAR(8) NOT NULL UNIQUE,
  nome VARCHAR(45) NOT NULL,
  preco FLOAT(16,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `sistema_vendas`.`fornecedores` (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `sistema_vendas`.`merge_prod_forn` (
  id_produto INT NOT NULL,
  id_fornecedor INT NOT NULL,
  FOREIGN KEY (id_produto) REFERENCES produtos(id),
  FOREIGN KEY (id_fornecedor) REFERENCES fornecedores(id)
) ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `sistema_vendas`.`vendas` (
  id INT NOT NULL AUTO_INCREMENT,
  total FLOAT(16,2) NOT NULL,
  cep CHAR(9) NOT NULL,
  date_create DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  date_venda DATE NOT NULL DEFAULT CURRENT_DATE,
  uf CHAR(2) NOT NULL,
  bairro VARCHAR(45) NOT NULL,
  cidade VARCHAR(45) NOT NULL,
  rua VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `sistema_vendas`.`merge_prod_vend` (
  id_venda INT NOT NULL,
  id_produto INT NOT NULL,
  preco FLOAT(16,2) NOT NULL,
  FOREIGN KEY (id_venda) REFERENCES vendas(id),
  FOREIGN KEY (id_produto) REFERENCES produtos(id)
) ENGINE = InnoDB;


-- INSERT's
INSERT INTO fornecedores (nome) VALUES ('Nativas Kubuke'),
('Jovens Madeiras'),
('Garboso decorações'),
('Decorações laico'),
('Seletos Eletronica'),
('Universal Pight'),
('Belo Lomus'),
('Cebis Digital'),
('Multimídia Folor'),
('Randit Austy'),
('Repis');


INSERT INTO produtos(nome, preco, referencia) VALUES ('Motorola G8 play', 900.30, LEFT(UUID(), 8)),
('Iphone 11', 4499.99, LEFT(UUID(), 8)),
('Samsung Galaxy A21s', 1499, LEFT(UUID(), 8)),
('LG k22 Titan', 830.00, LEFT(UUID(), 8)),
('Motorola G9 Play', 1440.00, LEFT(UUID(), 8)),
('Samsung Galaxy Note 10', 2400, LEFT(UUID(), 8)),
('Tv Samsung 50TU8000', 2590.20, LEFT(UUID(), 8)),
('Tv Samsung 58TU7000', 1900.20, LEFT(UUID(), 8)),
('Notebook Positivo Quad Core 4GB 64GB SSD', 1700.00, LEFT(UUID(), 8)),
('Notebook Dell Core i5-8265U 8GB 1TB', 4200.50, LEFT(UUID(), 8)),
('SmartWatch A1 Bluetooth', 80.00, LEFT(UUID(), 8)),
('Smartwatch D13 Smartband Bluetooth', 85.20, LEFT(UUID(), 8)),
('Smartwatch Galaxy Fit E com Bluetooth', 280.50, LEFT(UUID(), 8)),
('Mi band 4', 120.00, LEFT(UUID(), 8)),
('Travesseiro Ortobom Casadinho', 40.95, LEFT(UUID(), 8)),
('Colcha Casal Camesa Loft', 109.09, LEFT(UUID(), 8)),
('Jogo de Banho Santista Royal Knut', 79.90, LEFT(UUID(), 8)),
('Carrinho de Controle Remoto', 84.99, LEFT(UUID(), 8)),
('Xbox 360', 1220.00, LEFT(UUID(), 8)),
('Ventilador de Coluna Mondial Black Premium', 179.19, LEFT(UUID(), 8)),
('Cafeteira Nespresso Essenza', 490.00, LEFT(UUID(), 8)),
('Quarda Roupa Casal', 1560.00, LEFT(UUID(), 8)),
('Lavadora de Roupas Electrolux Automática', 1920.00, LEFT(UUID(), 8)),
('Sanduicheira e Grill Mondial Premium S-07', 89.90, LEFT(UUID(), 8)),
('Purificador de Água Electrolux PE11B Bivolt', 390.90, LEFT(UUID(), 8)),
('Refrigerador Consul CRD37EB', 1820.00, LEFT(UUID(), 8)),
('Forno de Micro-ondas Electrolux MI41S', 659.90, LEFT(UUID(), 8)),
('Aspirador de Pó Vertical', 149.87, LEFT(UUID(), 8)),
('Liquidificador Mondial Turbo Inox L-1000', 120.00, LEFT(UUID(), 8)),
('Controle Remoto para Tv', 70.20, LEFT(UUID(), 8));

INSERT INTO merge_prod_forn VALUES(1, 1),
(1, 5),
(1, 6),
(1, 9),
(1, 11),
(2, 1),
(2, 6),
(2, 9),
(3, 1),
(3, 11),
(3, 5),
(4, 1),
(4, 9),
(5, 1),
(6, 1),
(6, 5),
(6, 6),
(6, 9),
(6, 11),
(7, 8),
(7, 10),
(8, 8),
(8, 10),
(8, 1),
(9, 1),
(9, 5),
(9, 6),
(9, 11),
(10, 1),
(10, 5),
(10, 6),
(10, 11),
(11, 7),
(12, 7),
(13, 7),
(14, 7),
(15, 3),
(15, 4),
(16, 3),
(16, 4),
(16, 10),
(17, 3),
(17, 4),
(17, 10),
(18, 2),
(18, 9),
(19, 1),
(19, 5),
(19, 6),
(20, 2),
(21, 7),
(22, 2),
(23, 2),
(23, 9),
(24, 2),
(25, 2),
(26, 2),
(27, 1),
(27, 2),
(27, 3),
(28, 1),
(28, 2),
(28, 3),
(29, 1),
(29, 2),
(29, 3),
(30, 11);