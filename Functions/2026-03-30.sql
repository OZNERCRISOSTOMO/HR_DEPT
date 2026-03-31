DROP TABLE RFID_card;

CREATE TABLE `RFID_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serial_number` int(11) NOT NULL,
  `employee_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE attendance;

CREATE TABLE `attendance` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `employee_id` int(15) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `status` varchar(100) NOT NULL,
  `time_out` time NOT NULL,
  `num_hr` double NOT NULL,
  `over_time` double NOT NULL,
  `schedule_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTOattendance VALUES("1","Admin","1","2026-03-30","18:04:21","ONTIME","00:00:00","0","0","1");



DROP TABLE backup_itemlist;

CREATE TABLE `backup_itemlist` (
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `price` int(15) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE customer;

CREATE TABLE `customer` (
  `id` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE defect;

CREATE TABLE `defect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) NOT NULL,
  `productcode` varchar(255) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `category` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `supplier` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `requestqty` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE defect_log;

CREATE TABLE `defect_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) NOT NULL,
  `productcode` varchar(255) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `requestqty` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE employee_details;

CREATE TABLE `employee_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resume_name` varchar(60) NOT NULL,
  `resume_path` varchar(60) NOT NULL,
  `picture_path` varchar(100) NOT NULL,
  `sss` enum('0','1') DEFAULT NULL,
  `pagibig` enum('0','1') DEFAULT NULL,
  `philhealth` enum('0','1') DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `rate_per_hour` int(11) DEFAULT NULL,
  `overtime_hours` int(11) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `date_applied` datetime DEFAULT NULL,
  `date_hired` datetime DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `position` varchar(50) NOT NULL,
  `department_position` varchar(60) NOT NULL,
  `employee_type` varchar(60) NOT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `num_hr` double NOT NULL,
  `over_time` double NOT NULL,
  `vacation_leave` int(11) NOT NULL,
  `sick_leave` int(60) NOT NULL,
  `maternity_leave` int(60) NOT NULL,
  `paternity_leave` int(60) NOT NULL,
  `health_insurance` varchar(60) NOT NULL,
  `christmas_bonus` varchar(60) NOT NULL,
  `food_allowance` varchar(60) NOT NULL,
  `transpo_allowance` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_id` (`employee_id`),
  CONSTRAINT `employee_details_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTOemployee_details VALUES("1","N/A","N/A.pdf","default.png","0","0","0","0.00","0","0","human-resource","2026-03-30 18:04:21","2026-03-30 18:04:21","1","admin","Admin","regular","HQ","0","0","15","60","90","7","0","0","0","0");



DROP TABLE employee_login;

CREATE TABLE `employee_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_id` varchar(60) NOT NULL,
  `login_password` char(60) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `serial_id` int(11) DEFAULT NULL,
  `position` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_id` (`employee_id`),
  KEY `RFID_card` (`serial_id`),
  CONSTRAINT `RFID_card` FOREIGN KEY (`serial_id`) REFERENCES `RFID_card` (`id`),
  CONSTRAINT `employee_login_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTOemployee_login VALUES("1","Admin","$2y$10$FG9OAa/Camw4y8OHf6bMKu.ZFfuOSyFtabo8ZuK3x1b.DCyWvi.RO","1","","admin");



DROP TABLE employee_payslip;

CREATE TABLE `employee_payslip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_added` datetime NOT NULL,
  `employee` varchar(50) NOT NULL,
  `net` int(11) NOT NULL,
  `file_path` varchar(50) NOT NULL,
  `prlist_id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_prlist_id` (`prlist_id`),
  CONSTRAINT `fk_prlist_id` FOREIGN KEY (`prlist_id`) REFERENCES `prlist` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE employee_payslip_form;

CREATE TABLE `employee_payslip_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(30) NOT NULL,
  `position` varchar(30) NOT NULL,
  `branch` varchar(30) NOT NULL,
  `department` varchar(30) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `number_present` int(11) NOT NULL,
  `number_overtime` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `sss` varchar(5) NOT NULL,
  `pagibig` varchar(5) NOT NULL,
  `philhealth` varchar(5) NOT NULL,
  `food_allowance` int(11) NOT NULL,
  `transpo_allowance` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE employees;

CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `gender` varchar(60) NOT NULL,
  `address` varchar(60) NOT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `schedule_id` int(5) NOT NULL,
  `status` enum('0','1','2','3') NOT NULL COMMENT '0=pending,1=approved,2=reject/delete, 3=resign\r\n',
  `date_resign` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOemployees VALUES("1","admin","Admin","admin@gmail.com","male","N/A","09170000000","1","1","0000-00-00");



DROP TABLE guest;

CREATE TABLE `guest` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `g_ornumber` varchar(20) DEFAULT NULL,
  `guest_name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `amount` int(11) NOT NULL DEFAULT 0,
  `date_order` datetime NOT NULL DEFAULT current_timestamp(),
  `latest_order` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE holiday;

CREATE TABLE `holiday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `holiday_name` varchar(50) NOT NULL,
  `holiday_date` date NOT NULL,
  `percentage` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE hr_dept;

CREATE TABLE `hr_dept` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `password` char(60) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `picture_path` varchar(60) NOT NULL,
  `employee_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE hr_year;

CREATE TABLE `hr_year` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year_now` year(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE item_list;

CREATE TABLE `item_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `productcode` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `name` varchar(250) NOT NULL,
  `category` varchar(250) NOT NULL,
  `quantity` int(50) NOT NULL,
  `description` text NOT NULL,
  `price` int(15) NOT NULL,
  `supplier` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL COMMENT ' 1 = Active, 0 = Inactive',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE leave_p;

CREATE TABLE `leave_p` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `date_started` date NOT NULL,
  `date_ended` date NOT NULL,
  `employee_id` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE manual_attendance;

CREATE TABLE `manual_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE notifications;

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `type` text NOT NULL,
  `message` text NOT NULL,
  `status` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE order_items;

CREATE TABLE `order_items` (
  `po_id` int(30) NOT NULL,
  `item_id` int(11) NOT NULL,
  `supplier` varchar(50) NOT NULL,
  `quantity` float NOT NULL,
  `item` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` int(250) NOT NULL,
  KEY `po_id` (`po_id`),
  KEY `item_no` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE overTime;

CREATE TABLE `overTime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `over_time` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE payment;

CREATE TABLE `payment` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_or` varchar(20) NOT NULL,
  `discount` varchar(20) DEFAULT NULL,
  `payment` varchar(20) NOT NULL,
  `pay_amount` varchar(20) NOT NULL,
  `guest_name` varchar(50) DEFAULT NULL,
  `cus_name` varchar(50) DEFAULT NULL,
  `pay_change` varchar(20) NOT NULL DEFAULT '0',
  `date_order` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE payment_history;

CREATE TABLE `payment_history` (
  `pay_hist` int(11) NOT NULL AUTO_INCREMENT,
  `pay_id` int(11) NOT NULL DEFAULT 0,
  `receipt_or` varchar(20) NOT NULL,
  `discount` varchar(20) DEFAULT NULL,
  `payment` varchar(20) NOT NULL,
  `pay_amount` varchar(20) NOT NULL,
  `guest_name` varchar(50) DEFAULT NULL,
  `cus_name` varchar(50) DEFAULT NULL,
  `pay_change` varchar(20) NOT NULL DEFAULT '0',
  `date_order` varchar(30) NOT NULL,
  PRIMARY KEY (`pay_hist`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE po_list;

CREATE TABLE `po_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `po_no` varchar(100) NOT NULL,
  `supplier_id` int(30) NOT NULL,
  `discount_percentage` float NOT NULL,
  `discount_amount` float NOT NULL,
  `tax_percentage` float NOT NULL,
  `tax_amount` float NOT NULL,
  `notes` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1= Approved, 2 = Denied',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `po_list_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE prlist;

CREATE TABLE `prlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `code` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `type` varchar(25) NOT NULL,
  `Status` int(11) NOT NULL COMMENT '1=Active and 0=Archive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE product;

CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productcode` varchar(100) NOT NULL,
  `productname` varchar(100) NOT NULL,
  `category` varchar(250) NOT NULL,
  `supplier` varchar(250) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `size` varchar(100) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `details` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




DROP TABLE products;

CREATE TABLE `products` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int(15) NOT NULL,
  `supplier` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE receipt;

CREATE TABLE `receipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ornum` varchar(20) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `productname` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `subtotal` varchar(100) NOT NULL,
  `date_order` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE receipts;

CREATE TABLE `receipts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ornum` varchar(20) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_id_to` int(11) NOT NULL,
  `productname` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `subtotal` varchar(100) NOT NULL,
  `date_order` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE request;

CREATE TABLE `request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) NOT NULL,
  `productcode` varchar(255) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `requestqty` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE request_log;

CREATE TABLE `request_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) NOT NULL,
  `productcode` varchar(255) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `requestqty` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE schedule;

CREATE TABLE `schedule` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE supplier_list;

CREATE TABLE `supplier_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `contact_person` text NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `bir` text DEFAULT NULL,
  `mayor` text DEFAULT NULL,
  `brgy` text DEFAULT NULL,
  `dti` text DEFAULT NULL,
  `business` text DEFAULT NULL,
  `ocular` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE system_info;

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




