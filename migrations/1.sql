CREATE DATABASE IF NOT EXISTS `my_eshop`
DEFAULT CHARACTER SET utf8mb4; 

USE `my_eshop`;
CREATE TABLE IF NOT EXISTS `customer` (
`id` INT NOT NULL AUTO_INCREMENT, 
`email` VARCHAR (255) NOT NULL,
`password` CHAR (60),
PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `attribute` (
`name` VARCHAR(20) NOT NULL,
PRIMARY KEY (`name`));

CREATE TABLE IF NOT EXISTS `product` (
`id` INT NOT NULL AUTO_INCREMENT, 
`name` VARCHAR(40) NOT NULL,
`description` TEXT NULL,
`price` DECIMAL(10,2) NOT NULL,
PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `product_attribute` (
`value` VARCHAR(30) NOT NULL,
`product_id` INT NOT NULL,
`attribute` VARCHAR(20) NOT NULL,
PRIMARY KEY (product_id, attribute),
FOREIGN KEY (product_id)  REFERENCES product (id) ON DELETE CASCADE,
FOREIGN KEY (attribute)  REFERENCES attribute (`name`) ON DELETE CASCADE);

CREATE TABLE IF NOT EXISTS `product_image` (
`id` INT NOT NULL AUTO_INCREMENT, 
`image_url` TEXT NOT NULL,
`product_id` INT NOT NULL,
FOREIGN KEY (product_id)  REFERENCES product (id),
PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `cart` (
`id` INT NOT NULL AUTO_INCREMENT, 
`sum` DECIMAL(10,2) NOT NULL,
`customer_id` INT NOT NULL,
FOREIGN KEY (customer_id)  REFERENCES customer (id),
PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `cart_items` (
`id` INT NOT NULL AUTO_INCREMENT, 
`quantity` INT(4) NOT NULL,
`price` DECIMAL(10,2) NOT NULL,
`prod_id` INT NOT NULL,
`cart_id` INT NOT NULL,
`customer_id` INT NOT NULL,
FOREIGN KEY (prod_id)  REFERENCES product (id),
FOREIGN KEY (cart_id)  REFERENCES cart (id),
FOREIGN KEY (customer_id)  REFERENCES customer (id),
PRIMARY KEY (`id`));

