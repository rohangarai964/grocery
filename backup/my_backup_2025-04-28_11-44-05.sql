#
# TABLE STRUCTURE FOR: customers
#

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(50) NOT NULL,
  `address` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`) VALUES (1, 'Rohan Garai', 'rohan@gmail.com', 899877665, 'Bardhaman\r\n');
INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`) VALUES (2, 'Subhrangsu', 'subhgrangsu@gmail.com', 98789, '');


#
# TABLE STRUCTURE FOR: invoice_master
#

DROP TABLE IF EXISTS `invoice_master`;

CREATE TABLE `invoice_master` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `purchase_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paid_amount` bigint(20) NOT NULL,
  `due_amount` bigint(20) NOT NULL,
  `total_amount` bigint(20) NOT NULL,
  `last_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO `invoice_master` (`id`, `invoice_number`, `customer_id`, `purchase_date`, `paid_amount`, `due_amount`, `total_amount`, `last_updated`) VALUES ('1', 'inv20250423', 1, '2025-04-23 15:07:22', '400', '100', '500', '2025-04-23 18:42:57');
INSERT INTO `invoice_master` (`id`, `invoice_number`, `customer_id`, `purchase_date`, `paid_amount`, `due_amount`, `total_amount`, `last_updated`) VALUES ('5', 'inv_1_2025-04-23 17:22:58', 1, '2025-04-23 17:22:58', '104', '0', '104', '2025-04-23 18:41:22');
INSERT INTO `invoice_master` (`id`, `invoice_number`, `customer_id`, `purchase_date`, `paid_amount`, `due_amount`, `total_amount`, `last_updated`) VALUES ('6', 'inv_2_2025-04-23 18:10:49', 2, '2025-04-23 18:10:49', '200', '48', '248', '2025-04-23 18:41:22');
INSERT INTO `invoice_master` (`id`, `invoice_number`, `customer_id`, `purchase_date`, `paid_amount`, `due_amount`, `total_amount`, `last_updated`) VALUES ('7', 'inv_1_2025-04-23 18:11:24', 1, '2025-04-23 18:11:24', '206', '0', '206', '2025-04-23 18:41:22');
INSERT INTO `invoice_master` (`id`, `invoice_number`, `customer_id`, `purchase_date`, `paid_amount`, `due_amount`, `total_amount`, `last_updated`) VALUES ('8', 'inv_1_2025-04-23 18:11:49', 1, '2025-04-23 18:11:49', '206', '0', '206', '2025-04-23 18:41:22');
INSERT INTO `invoice_master` (`id`, `invoice_number`, `customer_id`, `purchase_date`, `paid_amount`, `due_amount`, `total_amount`, `last_updated`) VALUES ('9', 'inv_1_2025-04-23 18:15:38', 1, '2025-04-23 18:15:38', '42', '0', '42', '2025-04-23 18:41:22');
INSERT INTO `invoice_master` (`id`, `invoice_number`, `customer_id`, `purchase_date`, `paid_amount`, `due_amount`, `total_amount`, `last_updated`) VALUES ('10', 'inv_2_2025-04-23 18:16:35', 2, '2025-04-23 18:16:35', '20', '42', '62', '2025-04-23 18:41:22');
INSERT INTO `invoice_master` (`id`, `invoice_number`, `customer_id`, `purchase_date`, `paid_amount`, `due_amount`, `total_amount`, `last_updated`) VALUES ('11', 'inv_1_2025-04-23 18:16:52', 1, '2025-04-23 18:16:52', '20', '22', '42', '2025-04-23 18:41:22');
INSERT INTO `invoice_master` (`id`, `invoice_number`, `customer_id`, `purchase_date`, `paid_amount`, `due_amount`, `total_amount`, `last_updated`) VALUES ('12', 'inv_1_2025-04-25 10:43:52', 1, '2025-04-25 10:43:52', '954', '0', '954', '2025-04-25 10:45:53');
INSERT INTO `invoice_master` (`id`, `invoice_number`, `customer_id`, `purchase_date`, `paid_amount`, `due_amount`, `total_amount`, `last_updated`) VALUES ('13', 'inv_1_2025-04-28 11:00:44', 1, '2025-04-28 11:00:44', '300', '100', '400', '2025-04-28 11:00:44');


#
# TABLE STRUCTURE FOR: invoice_transaction
#

DROP TABLE IF EXISTS `invoice_transaction`;

CREATE TABLE `invoice_transaction` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint(20) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `selling_price_rate` int(11) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('5', '6', 8, 3, 62, '186', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('3', '5', 7, 1, 42, '42', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('4', '5', 8, 1, 62, '62', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('6', '6', 8, 1, 62, '62', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('7', '7', 8, 3, 62, '186', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('8', '7', 9, 1, 20, '20', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('9', '8', 8, 3, 62, '186', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('10', '8', 9, 1, 20, '20', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('11', '9', 7, 1, 42, '42', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('12', '10', 8, 1, 62, '62', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('13', '11', 7, 1, 42, '42', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('14', '12', 11, 8, 109, '872', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('15', '12', 8, 1, 62, '62', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('16', '12', 7, 0, 42, '20', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('17', '13', 8, 2, 60, '100', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('18', '13', 11, 3, 110, '300', '');


#
# TABLE STRUCTURE FOR: products
#

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `rate_per_unit` int(11) NOT NULL,
  `unit` enum('kg','pc','gm') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO `products` (`id`, `title`, `description`, `rate_per_unit`, `unit`, `created_at`, `updated_at`) VALUES (7, 'sugar', 'sugar', 44, 'kg', '2025-04-23 07:00:56', '2025-04-23 07:00:56');
INSERT INTO `products` (`id`, `title`, `description`, `rate_per_unit`, `unit`, `created_at`, `updated_at`) VALUES (8, 'rice', '', 62, 'kg', '2025-04-23 07:01:33', '2025-04-23 07:01:33');
INSERT INTO `products` (`id`, `title`, `description`, `rate_per_unit`, `unit`, `created_at`, `updated_at`) VALUES (9, 'brash', '', 20, 'pc', '2025-04-23 07:02:16', '2025-04-23 07:02:16');
INSERT INTO `products` (`id`, `title`, `description`, `rate_per_unit`, `unit`, `created_at`, `updated_at`) VALUES (10, 'salt', 'salt', 20, 'kg', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `products` (`id`, `title`, `description`, `rate_per_unit`, `unit`, `created_at`, `updated_at`) VALUES (11, 'Legumes', 'Musur dal', 110, 'kg', '0000-00-00 00:00:00', '0000-00-00 00:00:00');


