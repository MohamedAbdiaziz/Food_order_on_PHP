-- Create database db_food

-- create table admin
CREATE TABLE `tbl_admin` (
 `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `Full_name` varchar(100) NOT NULL,
 `Username` varchar(100) NOT NULL,
 `Password` varchar(255) NOT NULL,
 PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8

-- create table category
CREATE TABLE `tbl_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

-- create table food
CREATE TABLE `tbl_food` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `title` varchar(150) NOT NULL,
 `description` varchar(255) NOT NULL,
 `price` decimal(10,2) NOT NULL,
 `image_name` varchar(255) NOT NULL,
 `category_id` int(11) NOT NULL,
 `featured` varchar(10) NOT NULL,
 `active` varchar(10) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

-- create table order
CREATE TABLE `tbl_order` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `food` varchar(150) NOT NULL,
 `price` decimal(10,2) NOT NULL,
 `qty` int(11) NOT NULL,
 `total` decimal(10,2) NOT NULL,
 `order_date` datetime NOT NULL,
 `status` varchar(50) NOT NULL,
 `customer_name` varchar(150) NOT NULL,
 `customer_contact` varchar(20) NOT NULL,
 `customer_email` varchar(150) NOT NULL,
 `customer_address` varchar(255) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8