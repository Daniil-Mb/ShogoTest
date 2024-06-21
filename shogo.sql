CREATE TABLE `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position` int(11) DEFAULT '0',
  `url` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `articul` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `currency_id` int(10) unsigned DEFAULT NULL,
  `price_old` decimal(10,2) NOT NULL,
  `notice` text,
  `content` text,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`),
  KEY `currency_id` (`currency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `product_section` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position` int(11) DEFAULT '0',
  `url` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `notice` text,
  `visible` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `product_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position` int(11) DEFAULT '0',
  `url` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `notice` text,
  `visible` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
CREATE TABLE `product_param_name` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position` int(11) DEFAULT '0',
  `visible` tinyint(1) NOT NULL,
  `name` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `product_param_variant` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `param_id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `position` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `value` (`param_id`,`name`(64)),
  KEY `param_id` (`param_id`),
  CONSTRAINT `fk_product_param_variant_param` FOREIGN KEY (`param_id`) REFERENCES `product_param_name`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `product_assignment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `section_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `section_id` (`section_id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `fk_product_assignment_product` FOREIGN KEY (`product_id`) REFERENCES `product`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_product_assignment_section` FOREIGN KEY (`section_id`) REFERENCES `product_section`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_product_assignment_type` FOREIGN KEY (`type_id`) REFERENCES `product_type`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `product_section` (`id`, `position`, `url`, `name`, `notice`, `visible`) VALUES
(1, 1, 'section-1', 'Раздел 1', 'Описание раздела 1', 1),
(2, 2, 'section-2', 'Раздел 2', 'Описание раздела 2', 1);

INSERT INTO `product_type` (`id`, `position`, `url`, `name`, `notice`, `visible`) VALUES
(1, 1, 'type-1', 'Тип 1', 'Описание типа 1', 1),
(2, 2, 'type-2', 'Тип 2', 'Описание типа 2', 1);

INSERT INTO `product_param_name` (`id`, `position`, `visible`, `name`) VALUES
(1, 1, 1, 'Цвет'),
(2, 2, 1, 'Размер');

INSERT INTO `product_param_variant` (`id`, `param_id`, `name`, `position`) VALUES
(1, 1, 'Красный', 1),
(2, 1, 'Синий', 2),
(3, 2, 'Маленький', 1),
(4, 2, 'Большой', 2);

INSERT INTO `product` (`id`, `position`, `url`, `name`, `articul`, `price`, `currency_id`, `price_old`, `notice`, `content`, `visible`) VALUES
(1, 1, 'product-1', 'Товар 1', 'A001', 100.00, NULL, 120.00, 'Заметка к товару 1', 'Описание товара 1', 1),
(2, 2, 'product-2', 'Товар 2', 'A002', 200.00, NULL, 220.00, 'Заметка к товару 2', 'Описание товара 2', 1),
(3, 3, 'product-3', 'Товар 3', 'A003', 300.00, NULL, 320.00, 'Заметка к товару 3', 'Описание товара 3', 1),
(4, 4, 'product-4', 'Товар 4', 'A004', 400.00, NULL, 420.00, 'Заметка к товару 4', 'Описание товара 4', 1),
(5, 5, 'product-5', 'Товар 5', 'A005', 500.00, NULL, 520.00, 'Заметка к товару 5', 'Описание товара 5', 1),
(6, 6, 'product-6', 'Товар 6', 'A006', 600.00, NULL, 620.00, 'Заметка к товару 6', 'Описание товара 6', 1),
(7, 7, 'product-7', 'Товар 7', 'A007', 700.00, NULL, 720.00, 'Заметка к товару 7', 'Описание товара 7', 1),
(8, 8, 'product-8', 'Товар 8', 'A008', 800.00, NULL, 820.00, 'Заметка к товару 8', 'Описание товара 8', 1),
(9, 9, 'product-9', 'Товар 9', 'A009', 900.00, NULL, 920.00, 'Заметка к товару 9', 'Описание товара 9', 1),
(10, 10, 'product-10', 'Товар 10', 'A010', 1000.00, NULL, 1020.00, 'Заметка к товару 10', 'Описание товара 10', 1);

INSERT INTO `product_assignment` (`id`, `product_id`, `section_id`, `type_id`, `visible`) VALUES
(1, 1, 1, 1, 1),
(2, 2, 2, 1, 1),
(3, 3, 1, 2, 1),
(4, 4, 2, 2, 1),
(5, 5, 1, 1, 1),
(6, 6, 2, 1, 1),
(7, 7, 1, 2, 1),
(8, 8, 2, 2, 1),
(9, 9, 1, 1, 1),
(10, 10, 2, 1, 1);

CREATE VIEW `product_view` AS
SELECT 
    p.id AS product_id,
    p.name AS product_name,
    p.url AS product_url,
    p.price AS product_price,
    p.price_old AS product_price_old,
    p.notice AS product_notice,
    p.content AS product_content,
    ps.name AS section_name,
    pt.name AS type_name,
    GROUP_CONCAT(CONCAT(ppn.name, ':', ppv.name) SEPARATOR ', ') AS product_params
FROM 
    product p
    JOIN product_assignment pa ON p.id = pa.product_id
    JOIN product_section ps ON pa.section_id = ps.id
    JOIN product_type pt ON pa.type_id = pt.id
    LEFT JOIN product_param_variant ppv ON ppv.param_id IN (
        SELECT ppn.id
        FROM product_param_name ppn
    )
    LEFT JOIN product_param_name ppn ON ppv.param_id = ppn.id
GROUP BY
    p.id, p.name, p.url, p.price, p.price_old, p.notice, p.content, ps.name, pt.name;

CREATE TABLE `users` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `username` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
