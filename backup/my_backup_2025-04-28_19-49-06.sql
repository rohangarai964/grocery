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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `customer_ledger` (`id`, `customer_id`, `invoice_id`, `type`, `amount`, `description`, `created_at`) VALUES (1, 1, 1, 'debit', '508.00', NULL, '2025-04-28 17:00:08');
INSERT INTO `customer_ledger` (`id`, `customer_id`, `invoice_id`, `type`, `amount`, `description`, `created_at`) VALUES (2, 1, 1, 'credit', '200.00', NULL, '2025-04-28 17:00:08');
INSERT INTO `customer_ledger` (`id`, `customer_id`, `invoice_id`, `type`, `amount`, `description`, `created_at`) VALUES (3, 1, NULL, 'credit', '100.00', 'Customer Payment', '2025-04-28 17:08:51');
INSERT INTO `customer_ledger` (`id`, `customer_id`, `invoice_id`, `type`, `amount`, `description`, `created_at`) VALUES (4, 1, 2, 'debit', '288.00', NULL, '2025-04-28 17:09:15');
INSERT INTO `customer_ledger` (`id`, `customer_id`, `invoice_id`, `type`, `amount`, `description`, `created_at`) VALUES (5, 1, NULL, 'credit', '200.00', 'Customer Payment', '2025-04-28 18:41:00');


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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `invoice_master` (`id`, `invoice_number`, `customer_id`, `purchase_date`, `paid_amount`, `due_amount`, `total_amount`, `last_updated`) VALUES ('1', 'inv_1_2025-04-28 17:00:08', 1, '2025-04-28 17:00:08', '200', '308', '508', '2025-04-28 17:00:08');
INSERT INTO `invoice_master` (`id`, `invoice_number`, `customer_id`, `purchase_date`, `paid_amount`, `due_amount`, `total_amount`, `last_updated`) VALUES ('2', 'inv_1_2025-04-28 17:09:15', 1, '2025-04-28 17:09:15', '0', '288', '288', '2025-04-28 17:09:15');


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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('1', '1', 8, 5, 62, '310', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('2', '1', 7, 2, 44, '88', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('3', '1', 11, 1, 110, '110', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('4', '2', 8, 4, 62, '248', '');
INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `item_id`, `quantity`, `selling_price_rate`, `total_price`, `remarks`) VALUES ('5', '2', 9, 2, 20, '40', '');


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

INSERT INTO `products` (`id`, `title`, `description`, `rate_per_unit`, `unit`, `stock`, `MRP`, `purchase_rate`, `created_at`, `updated_at`) VALUES (7, 'sugar', 'sugar', 44, 'kg', 42, 49, 42, '2025-04-23 07:00:56', '2025-04-23 07:00:56');
INSERT INTO `products` (`id`, `title`, `description`, `rate_per_unit`, `unit`, `stock`, `MRP`, `purchase_rate`, `created_at`, `updated_at`) VALUES (8, 'rice', '', 62, 'kg', 6, 68, 60, '2025-04-23 07:01:33', '2025-04-23 07:01:33');
INSERT INTO `products` (`id`, `title`, `description`, `rate_per_unit`, `unit`, `stock`, `MRP`, `purchase_rate`, `created_at`, `updated_at`) VALUES (9, 'brash', '', 20, 'pc', 38, 22, 19, '2025-04-23 07:02:16', '2025-04-23 07:02:16');
INSERT INTO `products` (`id`, `title`, `description`, `rate_per_unit`, `unit`, `stock`, `MRP`, `purchase_rate`, `created_at`, `updated_at`) VALUES (10, 'salt', 'salt', 20, 'kg', 99, 21, 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `products` (`id`, `title`, `description`, `rate_per_unit`, `unit`, `stock`, `MRP`, `purchase_rate`, `created_at`, `updated_at`) VALUES (11, 'Legumes', 'Musur dal', 110, 'kg', 95, 115, 100, '0000-00-00 00:00:00', '0000-00-00 00:00:00');


