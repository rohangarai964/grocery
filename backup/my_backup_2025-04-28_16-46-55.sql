#
# TABLE STRUCTURE FOR: customer_ledger
#

DROP TABLE IF EXISTS `customer_ledger`;

CREATE TABLE `customer_ledger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `type` enum('debit','credit') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO `customer_ledger` (`id`, `customer_id`, `invoice_id`, `type`, `amount`, `description`, `created_at`) VALUES (1, 2, 14, 'credit', '100.00', NULL, '2025-04-28 11:56:11');
INSERT INTO `customer_ledger` (`id`, `customer_id`, `invoice_id`, `type`, `amount`, `description`, `created_at`) VALUES (2, 2, 14, 'debit', '68.00', NULL, '2025-04-28 11:56:11');
INSERT INTO `customer_ledger` (`id`, `customer_id`, `invoice_id`, `type`, `amount`, `description`, `created_at`) VALUES (3, 2, 15, 'credit', '100.00', NULL, '2025-04-28 12:16:00');
INSERT INTO `customer_ledger` (`id`, `customer_id`, `invoice_id`, `type`, `amount`, `description`, `created_at`) VALUES (4, 2, 15, 'debit', '60.00', NULL, '2025-04-28 12:16:00');
INSERT INTO `customer_ledger` (`id`, `customer_id`, `invoice_id`, `type`, `amount`, `description`, `created_at`) VALUES (5, 2, NULL, 'debit', '70.00', 'Customer Payment', '2025-04-28 13:00:21');
INSERT INTO `customer_ledger` (`id`, `customer_id`, `invoice_id`, `type`, `amount`, `description`, `created_at`) VALUES (8, 1, 17, 'credit', '200.00', NULL, '2025-04-28 16:23:48');
INSERT INTO `customer_ledger` (`id`, `customer_id`, `invoice_id`, `type`, `amount`, `description`, `created_at`) VALUES (9, 1, 17, 'debit', '180.00', NULL, '2025-04-28 16:23:48');


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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

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
INSERT INTO `invoice_master` (`id`, `invoice_number`, `customer_id`, `purchase_date`, `paid_amount`, `due_amount`, `total_amount`, `last_updated`) VALUES ('14', 'inv_2_2025-04-28 11:56:11', 2, '2025-04-28 11:56:11', '100', '68', '168', '2025-04-28 11:56:11');
INSERT INTO `invoice_master` (`id`, `invoice_number`, `customer_id`, `purchase_date`, `paid_amount`, `due_amount`, `total_amount`, `last_updated`) VALUES ('15', 'inv_2_2025-04-28 12:16:00', 2, '2025-04-28 12:16:00', '100', '60', '160', '2025-04-28 12:16:00');
INSERT INTO `invoice_master` (`id`, `invoice_number`, `customer_id`, `purchase_date`, `paid_amount`, `due_amount`, `total_amount`, `last_updated`) VALUES ('17', 'inv_1_2025-04-28 16:23:48', 1, '2025-04-28 16:23:48', '200', '180', '380', '2025-04-28 16:23:48');


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
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

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
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('19', '14', 7, 1, 44, '44', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('20', '14', 8, 2, 62, '124', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('21', '15', 10, 3, 20, '60', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('22', '15', 11, 1, 110, '100', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('23', '17', 7, 3, 44, '132', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('24', '17', 8, 4, 62, '248', '');


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
  `stock` int(11) NOT NULL,
  `MRP` int(11) NOT NULL,
  `purchase_rate` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO `products` (`id`, `title`, `description`, `rate_per_unit`, `unit`, `stock`, `MRP`, `purchase_rate`, `created_at`, `updated_at`) VALUES (7, 'sugar', 'sugar', 44, 'kg', 47, 49, 42, '2025-04-23 07:00:56', '2025-04-23 07:00:56');
INSERT INTO `products` (`id`, `title`, `description`, `rate_per_unit`, `unit`, `stock`, `MRP`, `purchase_rate`, `created_at`, `updated_at`) VALUES (8, 'rice', '', 62, 'kg', 16, 68, 60, '2025-04-23 07:01:33', '2025-04-23 07:01:33');
INSERT INTO `products` (`id`, `title`, `description`, `rate_per_unit`, `unit`, `stock`, `MRP`, `purchase_rate`, `created_at`, `updated_at`) VALUES (9, 'brash', '', 20, 'pc', 40, 22, 19, '2025-04-23 07:02:16', '2025-04-23 07:02:16');
INSERT INTO `products` (`id`, `title`, `description`, `rate_per_unit`, `unit`, `stock`, `MRP`, `purchase_rate`, `created_at`, `updated_at`) VALUES (10, 'salt', 'salt', 20, 'kg', 100, 21, 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `products` (`id`, `title`, `description`, `rate_per_unit`, `unit`, `stock`, `MRP`, `purchase_rate`, `created_at`, `updated_at`) VALUES (11, 'Legumes', 'Musur dal', 110, 'kg', 100, 115, 100, '0000-00-00 00:00:00', '0000-00-00 00:00:00');


