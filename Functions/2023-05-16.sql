DROP TABLE RFID_card;

CREATE TABLE `RFID_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serial_number` int(11) NOT NULL,
  `employee_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTORFID_card VALUES("2","10525958","95");
INSERT INTORFID_card VALUES("4","12669083","67");
INSERT INTORFID_card VALUES("6","3843696","64");
INSERT INTORFID_card VALUES("7","13858165","0");
INSERT INTORFID_card VALUES("8","3805883","0");
INSERT INTORFID_card VALUES("9","3791137","92");
INSERT INTORFID_card VALUES("10","13849929","0");
INSERT INTORFID_card VALUES("11","10500255","0");
INSERT INTORFID_card VALUES("12","3843412","60");
INSERT INTORFID_card VALUES("13","3843127","58");
INSERT INTORFID_card VALUES("14","8775429","0");
INSERT INTORFID_card VALUES("15","1665055","0");
INSERT INTORFID_card VALUES("16","12643892","88");
INSERT INTORFID_card VALUES("17","1241903","0");
INSERT INTORFID_card VALUES("18","9047579","0");
INSERT INTORFID_card VALUES("19","1251671","60");
INSERT INTORFID_card VALUES("20","10527113","73");
INSERT INTORFID_card VALUES("21","1234131","0");
INSERT INTORFID_card VALUES("22","1234122","87");
INSERT INTORFID_card VALUES("23","8730901","0");



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
) ENGINE=InnoDB AUTO_INCREMENT=1070 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




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

INSERT INTOcustomer VALUES("SBIT-3G(AO50)","gawa","gawa","gawa","09123456789");
INSERT INTOcustomer VALUES("SBIT-3G(5NEX)","asd","asd","asd","09658745959");
INSERT INTOcustomer VALUES("SBIT-3G(K8EF)","asd","asd","asd","09658745959");
INSERT INTOcustomer VALUES("SBIT-3G(NUST)","asd","asd","asd","09658745959");
INSERT INTOcustomer VALUES("SBIT-3G(LJWP)","sample1","sample1","asdasd","09123456789");
INSERT INTOcustomer VALUES("SBIT-3G(CQ08)","NAME","NAME","123123","09123456789");
INSERT INTOcustomer VALUES("SBIT-3G(0YB9)","name","name","name","09123458758");
INSERT INTOcustomer VALUES("SBIT-3G(9ZW7)","aljhon","aljhon","aljhon","09123468745");
INSERT INTOcustomer VALUES("SBIT-3G(689F)","asdasdasdas","asdasd","asdasd","09123458741");
INSERT INTOcustomer VALUES("SBIT-3G(8TFL)","number","number","number","09123456789");
INSERT INTOcustomer VALUES("SBIT-3G(LCXY)","AHAHHAHA","HAHAHAHA","HAHHAAHAHA","09123456789");
INSERT INTOcustomer VALUES("SBIT-3G(5RZO)","Customer Firstname","Lastname Firstname","sample address","09123456712");
INSERT INTOcustomer VALUES("SBIT-3G(6B0Q)","okayna","okayna","okayna","09123456789");
INSERT INTOcustomer VALUES("SBIT-3G(AB3M)","Amount","Amount","Amount","09123456789");
INSERT INTOcustomer VALUES("SBIT-3G(EKHP)","Dhel ","Cabahug","AS","09123456789");
INSERT INTOcustomer VALUES("SBIT-3G(RA7D)","Ronnie","Gatdula","QCU","09123456789");
INSERT INTOcustomer VALUES("SBIT-3G(4XLC)","SIA","102","Novaliches","09123456789");
INSERT INTOcustomer VALUES("SBIT-3G(O5FY)","a","b","13","09111111111");



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
) ENGINE=InnoDB AUTO_INCREMENT=493 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




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
) ENGINE=InnoDB AUTO_INCREMENT=539 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTOemployee_details VALUES("1","Jason Yecyec_2023-03-20 - payslip","644729c2a56993.53986227.pdf","645cf4e6a26220.24286954.png","1","1","1","","183","","human-resource","2023-04-25 09:15:46","2023-04-25 09:24:08","57","admin","HR Assistant","regular","cubao","7.3499999999999694","0","15","60","90","7","1","1","1500","1500");
INSERT INTOemployee_details VALUES("2","Crisostomo-John-Renzo-M","64472be4806e75.27781835.pdf","645e42dad72834.01145559.png","1","1","1","","1071","","human-resource","2023-04-25 09:24:52","2023-04-25 09:26:58","58","admin","HR Director","regular","Tandang sora","0.133333333333333","0","15","60","90","7","1","1","1500","1500");
INSERT INTOemployee_details VALUES("4","De Vera Aldrin A","64472efb58c707.37536470.pdf","64472efb58c7f3.42500892.jpg","1","1","1","","425","","human-resource","2023-04-25 09:38:03","2023-04-25 09:40:11","60","employee","Safety Manager","regular","Tandang sora","0","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("5","CV-AgathaCyrilMedina ","64473629c6fc91.81145681.pdf","64473629c6fde8.43477056.jpg","1","1","1","","248","","human-resource","2023-04-25 10:08:41","2023-04-25 10:49:45","61","employee","Personal Manager","regular","Tandang sora","0","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("6","Pareja, Alexandra Marie C","64473fee200f61.12600524.pdf","64473fee201060.86200887.jpg","1","1","1","","253","","human-resource","2023-04-25 10:50:22","2023-04-26 07:30:23","62","employee","Recruiter","regular","Tandang sora","8","0","7","60","32","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("7","Work-Resume","6447414e3f8117.66087626.pdf","6447414e3f8212.62638490.jpg","1","1","1","","227","","human-resource","2023-04-25 10:56:14","2023-04-26 07:29:46","63","employee","Staffing Specialist","regular","Tandang sora","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("8","Tacsiat_Resume","644744b79e8787.22034854.pdf","644744b79e8889.52627334.jpeg","1","1","1","","211","","human-resource","2023-04-25 11:10:47","2023-04-26 07:32:08","64","employee","Staffing Coordinator","regular","Tandang sora","0","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("9","Dave Flourenz Amit - Virtual Resume","644867971a8d98.92525580.pdf","644867971a8e62.63838010.jpg","1","1","1","","200","","human-resource","2023-04-26 07:51:51","2023-04-26 07:54:47","65","admin","HR Administrator","regular","Quezon City","8","0","15","60","90","7","1","1","1500","1500");
INSERT INTOemployee_details VALUES("10","Resume","644895ec40ceb3.83514037.pdf","644895ec40d016.98558532.jpg","1","1","1","","265","","human-resource","2023-04-26 11:09:32","2023-04-26 16:26:52","66","employee","HR Analyst","regular","Quezon City","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("11","Food Delivery App","6448ed500a4213.31085415.pdf","6448ed500a4382.64248858.jpg","1","1","1","","443","","human-resource","2023-04-26 17:22:24","2023-04-26 17:23:44","67","admin","HR Manager","regular","Quezon City","44","0","15","60","90","7","1","1","1500","1500");
INSERT INTOemployee_details VALUES("12","Resume","6448ed59570d35.45697019.pdf","6448ed59570da0.70641690.jpg","1","1","1","","200","","human-resource","2023-04-26 17:22:33","2023-04-26 17:24:02","68","employee","HR Associate","regular","Tandang sora","0","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("13","Adrales_ResumeM","6448f1a4a7ab55.07738147.pdf","6448f1a4a7acb1.96135722.jpg","1","1","1","","701","","human-resource","2023-04-26 17:40:52","2023-04-26 18:03:58","69","employee","Employee Relations Manager","regular","Tandang sora","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("14","Macatiag-Resume","6448f3ead94312.67569726.pdf","6448f3ead944c1.33149894.jpg","1","1","1","","196","","human-resource","2023-04-26 17:50:34","2023-04-26 18:04:32","70","employee","HR Representative","regular","Tandang sora","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("15","Custodio,Czernest_Resume","64490eaf1e8cb4.11030610.pdf","64490eaf1e8de4.57525585.jpg","1","1","1","","83","","sales","2023-04-26 19:44:47","2023-04-26 23:17:24","71","admin","Sales Manager","regular","Tandang sora","8","0","15","60","90","7","1","1","1500","1500");
INSERT INTOemployee_details VALUES("17","Resume","644a31d96d0553.09414568.pdf","644a31d96d0652.44024112.png","1","1","1","","500","","purchaser","2023-04-27 16:27:05","2023-04-29 09:34:18","73","admin","Program Manager","regular","Tandang sora","8","0","15","60","90","7","1","1","1500","1500");
INSERT INTOemployee_details VALUES("19","Villafuerte_Resume","644b7f9c80b568.97015417.pdf","644b7f9c80b6c7.74345810.jpg","1","1","1","","45","","sales","2023-04-28 16:11:08","2023-04-29 09:36:58","75","employee","Cash Registry Operator 1","regular","Tandang sora","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("20","inbound5940579721925016665","644bc0774a9550.31455269.pdf","644bc0774a9757.16812142.png","1","1","1","","45","","sales","2023-04-28 20:47:51","2023-04-29 09:37:44","76","employee","Cash Registry Operator 2","regular","Tandang sora","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("21","Cabahug, Dhel O","644bc8051dded6.42521876.pdf","644bc8051de008.31860462.jpg","1","1","1","","45","","sales","2023-04-28 21:20:05","2023-04-29 09:42:40","77","employee","Customer Service Representative 1","regular","Tandang sora","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("22","Baja-Kristine-Resume","644bd497a43379.83805714.pdf","644bd497a43468.29815625.jpg","1","1","1","","45","","sales","2023-04-28 22:13:43","2023-04-29 09:39:01","78","employee","Cash Registry Operator 4","regular","Tandang sora","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("23","Julla-resume","644bd7dd5c64a6.78909585.pdf","644bd7dd5c65d2.57887336.jpg","1","1","1","","45","","sales","2023-04-28 22:27:41","2023-04-29 09:38:28","79","employee","Cash Registry Operator 3","regular","Tandang sora","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("24","Resume","644cc5960d2047.43136475.pdf","644cc5960d2142.41115166.jpg","1","1","1","","150","","sales","2023-04-29 15:21:58","2023-04-30 10:00:30","80","admin","Data Analyst 1","regular","Tandang sora","8","0","15","60","90","7","1","1","1500","1500");
INSERT INTOemployee_details VALUES("25","nadine_pimentel_resume_samp - Google Docs","644e4032334581.20169722.pdf","644e4032334650.26173711.jpeg","1","1","1","","150","","sales","2023-04-30 18:17:22","2023-05-01 09:25:26","81","admin","Data Analyst 2","regular","Tandang sora","8","0","15","60","90","7","1","1","1500","1500");
INSERT INTOemployee_details VALUES("26","UY, MILANDRO - RESUME ","644fc9e0b1beb8.61484566.pdf","644fc9e0b1c0e0.71559027.jpeg","1","1","","","100","","purchaser","2023-05-01 22:17:04","2023-05-02 21:55:54","82","employee","Purchasing Agent","regular","Quezon City","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("28","Coballes-Shyrell-Patricia-P","64506715d6ef30.97820682.pdf","64506715d6f038.14110149.jpg","1","","1","","45","","sales","2023-05-02 09:27:49","2023-05-15 16:11:13","84","employee","Customer Service Representative 3","regular","Tandang sora","0","0","15","60","0","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("29","ACILO_RESUME","645067fdd8c0e9.20337963.pdf","645067fdd8c253.17433243.jpg","1","1","1","","100","","purchaser","2023-05-02 09:31:41","2023-05-02 21:57:14","85","employee","Purchasing Assistant","regular","Quezon City","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("30","inbound8603274645162337488","645068b0da38a4.28304263.pdf","645068b0da3980.05338366.jpg","1","1","1","","75","","purchaser","2023-05-02 09:34:40","2023-05-02 21:58:16","86","employee","Purchasing Clerk","regular","Quezon City","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("31","NARISMA_RESUME","645068c8385350.23090488.pdf","645068c8385462.52758247.jpg","1","1","1","","100","","purchaser","2023-05-02 09:35:04","2023-05-02 21:59:28","87","employee","Purchasing Associate","regular","Quezon City","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("32","Ramiscal-Cristian-S","64506954080320.56450444.pdf","645069540803b2.69597753.png","1","1","1","","443","","purchaser","2023-05-02 09:37:24","2023-05-02 22:00:00","88","admin","Procurement Manager","regular","Quezon City","8","0","15","60","90","7","1","1","1500","1500");
INSERT INTOemployee_details VALUES("33","Vincent-Aristorenas-Resume","645069e335c977.68377822.pdf","645069e335ca86.44981137.jpeg","1","1","1","","75","","purchaser","2023-05-02 09:39:47","2023-05-02 22:00:46","89","employee","Purchasing Clerk","regular","Quezon City","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("34","Delos-Reyes-Resume","64506a0a489aa0.80765103.pdf","64506a0a489bc5.50281338.jpg","1","1","1","","100","","purchaser","2023-05-02 09:40:26","2023-05-02 22:01:32","90","employee","Procurement Clerk","regular","Quezon City","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("35","Resume - Shaira_22","6450d2157fe947.57525665.pdf","6450d2157fea92.21509639.png","1","1","1","","100","","purchaser","2023-05-02 17:04:21","2023-05-02 22:02:12","91","employee","Purchasing Associate","regular","Quezon City","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("36","Daniel-Resume","64511de4798dd2.89999852.pdf","64511de4798ef9.32861985.jpg","1","1","1","","600","","purchaser","2023-05-02 22:27:48","2023-05-03 00:21:21","92","admin","Operations Manager","regular","Quezon City","8","0","15","60","90","7","1","1","1500","1500");
INSERT INTOemployee_details VALUES("37","RESUME","6451b161e45533.62306177.pdf","6451b161e45664.56792786.png","1","1","1","","550","","warehouse","2023-05-03 08:57:05","2023-05-03 09:05:08","93","admin","Warehouse manager","regular","Quezon City","8","0","15","60","90","7","1","1","1500","1500");
INSERT INTOemployee_details VALUES("38","Resume_Sumpay","6451b35346ee60.92307199.pdf","6451b35346efc2.81485127.jpg","1","","1","","220","","warehouse","2023-05-03 09:05:23","2023-05-03 14:29:33","94","employee","Stocker","regular","Quezon City","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("39","resume","6451b6a4e80968.25026939.pdf","6451b6a4e80a82.85359361.jpg","1","1","1","","550","","warehouse","2023-05-03 09:19:32","2023-05-03 14:30:46","95","admin","Warehouse specialist","regular","Quezon City","8","0","15","60","90","7","1","1","1500","1500");
INSERT INTOemployee_details VALUES("40","inbound5597482440900809149","6451bd87abb2b5.42920609.pdf","6451bd87abb489.86450025.jpg","1","1","1","","550","","warehouse","2023-05-03 09:48:55","2023-05-03 14:31:47","96","admin","Forklift operator","regular","Quezon City","8","0","15","60","90","7","1","1","1500","1500");
INSERT INTOemployee_details VALUES("41","CABATO_RESUME","6451c6f8295545.17850872.pdf","6451c6f82956e1.14354696.jpg","1","1","1","","550","","warehouse","2023-05-03 10:29:12","2023-05-05 16:08:12","97","admin","Forklift operator","regular","Tandang sora","8","0","15","60","90","7","1","1","1500","1500");
INSERT INTOemployee_details VALUES("42","RESUME","6451c91dcfb8e3.44495983.pdf","6451c91dcfba55.08449366.jpg","1","","1","","220","","warehouse","2023-05-03 10:38:21","2023-05-03 14:33:08","98","employee","Warehouse worker","regular","Quezon City","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("44","Borrinaga, Jayron R","6451caf2c8e882.80369722.pdf","6451caf2c8e9e6.55360385.jpg","1","","1","","270","","warehouse","2023-05-03 10:46:10","2023-05-03 14:35:03","100","employee","Shipping and receiving clerk","regular","Quezon City","8","0","15","60","0","0","1","1","1000","1000");
INSERT INTOemployee_details VALUES("45","Resume","6451d20245e585.68611744.pdf","6451d20245e6c1.57379435.jpg","1","","1","","270","","warehouse","2023-05-03 11:16:18","2023-05-03 14:36:38","101","employee","Loader","regular","Quezon City","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("46","Resume","6451d31a6ca772.08503592.pdf","6451d31a6ca906.99288828.jpg","1","","1","","250","","warehouse","2023-05-03 11:20:58","2023-05-03 14:43:01","102","employee","Receiving associate","regular","Quezon City","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("47","Athena Renevieve M","6451d42c08ce26.23799508.pdf","6451d42c08cfa4.87985575.jpg","1","","1","","220","","warehouse","2023-05-03 11:25:32","2023-05-03 14:43:51","103","employee","Stocking associate","regular","Quezon City","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("48","Ramos, Jasper P_Resume","6451dc00d2b357.33756496.pdf","6451dc00d2b590.42749539.jpg","1","","1","","250","","warehouse","2023-05-03 11:58:56","2023-05-03 14:44:46","104","employee","Warehouse clerk","regular","Quezon City","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("49","Fiecas, May Lee C","6451dd65b79668.35249518.pdf","6451dd65b79781.57758168.png","1","","1","","270","","warehouse","2023-05-03 12:04:53","2023-05-03 14:46:16","105","employee","Receiver","regular","Quezon City","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("50","RESUME","6451e0fe096f30.25525414.pdf","6451e0fe097045.87298199.jpg","1","","1","","220","","warehouse","2023-05-03 12:20:14","2023-05-03 14:47:04","106","employee","Laborer","regular","Quezon City","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("51","Sta","64529fc803c2f7.92916383.pdf","64529fc803c3e3.64840381.jpg","1","1","1","","100","","purchaser","2023-05-04 01:54:16","2023-05-04 19:25:08","107","employee","Procurement Clerk","non-regular","Quezon City","8","0","15","60","90","7","0","0","0","0");
INSERT INTOemployee_details VALUES("52","CODE OF SYSTEM","64532e87013849.75668040.pdf","64532e870139c8.13139341.jpg","","","1","","45","","sales","2023-05-04 12:03:19","2023-05-04 19:38:22","108","employee","Customer Service Representative 2","regular","Quezon City","8","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("53","John Mark Eli V","645456d4804ef9.23120326.pdf","645456d4805107.42388362.jpg","1","","1","","45","","sales","2023-05-05 09:07:32","2023-05-12 11:53:11","109","employee","Cash Registry Operator 4","regular","Quezon City","0","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("55","CAILO_RESUME","645cb7eb3e1292.51624684.pdf","645cb7eb3e1490.14731233.jpeg","1","","1","","45","","sales","2023-05-11 17:39:55","2023-05-11 17:42:44","111","employee","Customer Service Representative 2","regular","Tandang sora","0","0","-5","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("56","Resume","645ceb184980c6.66858837.pdf","645ceb18498233.91926926.png","1","1","1","","45","","sales","2023-05-11 21:18:16","2023-05-12 11:53:33","112","employee","Customer Service Representative 3","regular","Quezon City","0","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("57","JOHN RENZO M","645e3cc3b32a54.69488795.pdf","645e3cc3b32c65.76099555.jpeg","","","","","253","","human-resource","2023-05-12 21:18:59","2023-05-12 09:36:26","113","employee","Recruiter","regular","Quezon City","0","0","15","60","90","7","1","1","1000","1000");
INSERT INTOemployee_details VALUES("58","Jason Yecyec_payslip","645e4bbd34c4d8.70409280.pdf","645e4bbd34c618.38498054.jpg","1","1","1","","200","","human-resource","2023-05-12 22:22:53","2023-05-12 22:23:40","114","employee","HR Associate","regular","Cubao","0","0","15","60","90","7","1","1","1000","1000");



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
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTOemployee_login VALUES("1","3396YECYEC","$2y$10$V6w7jwmnKqGL293VljRkTOGOotLt3bcsfvdB57JG/ra2.BUsO.Rji","57","","admin");
INSERT INTOemployee_login VALUES("2","5872CRISOSTOMO","$2y$10$zB0kn9j33vxHPh2dCelUquDdh7P5rZ55HHO4r6166OySXKsetfKrC","58","","admin");
INSERT INTOemployee_login VALUES("3","7814DE VERA","$2y$10$sOBjDnksaNaFzZKwv4GWYeiqlDKYuKHsATf7LmLbmP3mBcLOTHEvu","60","","employee");
INSERT INTOemployee_login VALUES("4","5013MEDINA","$2y$10$ZcjGU/5NGnS5tzpHwHGnTOk17MRraasl47YSk/DaxyfUWdxj4U9Cu","61","","employee");
INSERT INTOemployee_login VALUES("5","1256DELA CRUZ","$2y$10$1tQWXFYO49wKetEfCHmUneHmbOP2nUnQ8.0ujEG73BFLQ6/pr/Fmm","63","","employee");
INSERT INTOemployee_login VALUES("6","7908PAREJA","$2y$10$NQNoZ6.MJ25z0c9M6BG8P.z9Fas.XJoITNOCwUCReaYl5q/kDVjmG","62","","employee");
INSERT INTOemployee_login VALUES("7","2927PAREJA","$2y$10$yDKB3P.hhracmXxIYeQNf.9J.cJlCfU2D3Dq/YDDkIz/CO4Zw.XYK","62","","employee");
INSERT INTOemployee_login VALUES("8","6459TACSIAT","$2y$10$zxWUOd4vSbulvzdxGeR9OeW.1jPDxZ07onJgcFZIp4S7PGM6ySZLm","64","","employee");
INSERT INTOemployee_login VALUES("9","2620AMIT","$2y$10$J1mmzUta4M/Wkaqtdr4Or.XiiQ6c7gcbYixzZsVJ6IzbDzDfJPB/q","65","","admin");
INSERT INTOemployee_login VALUES("10","9013GUIYAB","$2y$10$cg7TfNzsekUDCGvUA4NPHe7Bi5imPS6LWDZhx5ppJVpgCK0H/8UW6","66","","employee");
INSERT INTOemployee_login VALUES("11","1637CHUA","$2y$10$GcK7eL3xj8IVpS8q5sMefusfKMXos81Unn1eTkO3q8TB8Yl.Yr1Fu","67","","admin");
INSERT INTOemployee_login VALUES("12","9024MALIWAT","$2y$10$of3nVNW3G8I.culfG9psuO0hgXt.fNL3ep1MxajNxIQkncwOL7eJm","68","","employee");
INSERT INTOemployee_login VALUES("13","7231ADRALES","$2y$10$exr25vRbIxuMlAzSG.p7j.YlF2H5.m2wsIJkLHDmgulIMgn4dHHem","69","","employee");
INSERT INTOemployee_login VALUES("14","1718MACATIAG","$2y$10$3woF5I74YBRt2uynT7iXnexOQbeIeuavk0QbHtBC5gXXpRt9CudiC","70","","employee");
INSERT INTOemployee_login VALUES("16","9479CUSTODIO","$2y$10$ikGgXEns9oLkY7dbCt/TUuSiD4n5Z7Cq6R48X0NBLo.r8huo.B7Yu","71","","admin");
INSERT INTOemployee_login VALUES("21","5979OGHAYON","$2y$10$M72m/EtJT20Gj05dEj57OepVsXQ8Q8GCrJKOJ/PcyZhX5Y6TS/qWS","73","","admin");
INSERT INTOemployee_login VALUES("22","3078VILLAFUERTE","$2y$10$cqJp1gdo.DSPS1yuC4U1le1vgohXa4w5Vu/vKNl4/xmdb.nHZXlg2","75","","employee");
INSERT INTOemployee_login VALUES("23","1416MORALLOS","$2y$10$zOuZ4UzqYJIItRgdR9lEv.zJOarKRPnb/XaZXA9FwWTLGIqRiCnsO","76","","employee");
INSERT INTOemployee_login VALUES("24","9602FALLARIA","$2y$10$J0EAjzanAcAi/km37B4R..Cqkl2iJp.B4PBEa0q8J1/ew2QthHXkG","79","","employee");
INSERT INTOemployee_login VALUES("25","5958BAJA","$2y$10$O5DaRswqfLG/07vQPoOH/uCeD2JTuT7Sc3j1GKHTDGjYwgZy1koiG","78","","employee");
INSERT INTOemployee_login VALUES("26","2264CABAHUG","$2y$10$2CuQHDcqNzVBaHCWMWUyEuXIDMhKre5fbNtmNopp9HZ3OC9JZvYWi","77","","employee");
INSERT INTOemployee_login VALUES("27","9717BITOON","$2y$10$iHMXJCJmwv98G.prf2ckNOP75Ea1x4BGi9Odi61.qtINfFGTn50ma","80","","admin");
INSERT INTOemployee_login VALUES("28","6008PIMENTEL","$2y$10$63vvjF3iW1dPoZdfQPxiDuWCTiq2VgJ5UEAcTPcC43g9xq9DOlC9K","81","","admin");
INSERT INTOemployee_login VALUES("29","2675UY","$2y$10$JGbwFLEDktO6GFvWtodT9.M0fh3Gg.PZKZHrEXuYKfeK5guCjuJM.","82","","employee");
INSERT INTOemployee_login VALUES("30","7825ACILO","$2y$10$Zc1KnShn/HDNpSdksS4.quo3jHglYuOOevoro1etx8DeiMfsYES8i","85","","employee");
INSERT INTOemployee_login VALUES("31","7409BALUBAL","$2y$10$MA.oRkupuHwk2ttIFaHEJe6P8.3tDOxTk0GjMPZ8Lmyn4AYKFE8Pm","86","","employee");
INSERT INTOemployee_login VALUES("32","8652BALUBAL","$2y$10$woYTklrWnYqSIT0mlHEBqeOq8He7i4Mx6U6F7sOIjF/s8mQ8HikrC","86","","employee");
INSERT INTOemployee_login VALUES("33","3683NARISMA","$2y$10$gNKhbCc3YUfJt4568JvKe.WSmMZrpC.n.jw5Uo9wrSTCJYYf6sRYS","87","","employee");
INSERT INTOemployee_login VALUES("34","8336RAMISCAL","$2y$10$xkNvxkK7ivBAR6kIDIbu5uzrSHm/n9uNhyOuxtL7I1kqH2E5zj72i","88","","admin");
INSERT INTOemployee_login VALUES("35","4282ARISTORENAS","$2y$10$BUbFbXaedXRWwiR3nQnZF.A0Bgb8V4p6Zblqbnnecf1xTwy06jhVi","89","","employee");
INSERT INTOemployee_login VALUES("36","2951DELOS REYES","$2y$10$8LTgy8SxR2bCR/L7ms57a.HrAPvNUI54m8X2cBg5qas6LLgJR/3Wu","90","","employee");
INSERT INTOemployee_login VALUES("37","2125BALOSA","$2y$10$YYz6wlV9N6JqjJiSSA2Iku3ryX5HLIym/U/6HN2apl/u147Srz/Aa","91","","employee");
INSERT INTOemployee_login VALUES("38","4184DE JESUS","$2y$10$4oW40VF3h2RacGZEUERz7O9adlKgfg8WfWH.nagVT2qlPSKJAxlpO","92","","admin");
INSERT INTOemployee_login VALUES("40","1014ROJAS","$2y$10$5K6Xvayr6s1j7SsJICKozOd49FwT9dgka2F4YxZWToySK5Qp9KRku","93","","admin");
INSERT INTOemployee_login VALUES("41","6023SUMPAY","$2y$10$AJCDBVfKGcFIRjSbBvvD..zsqL1.wJ6GX7/wsxW3xqAthi6TpR.Pq","94","","employee");
INSERT INTOemployee_login VALUES("42","4182BARES","$2y$10$rsFRd2QbCsFjM1SGkEQYSOmhwzO2GN4yh5MMjXvo4zFwxLFlNNJ1e","95","","admin");
INSERT INTOemployee_login VALUES("43","1363ACERDANO","$2y$10$oc3CQDLq8UCVuKzrzYqS3uWrTd4TvRz/Zc7KeBVUsZQbJD0z.mF7S","96","","admin");
INSERT INTOemployee_login VALUES("44","5076BAYLON","$2y$10$p7vRLt3aaxpmf/lqrzMoYecYV.T288mZIaDTEoXj2vmwiwofg1TI2","98","","employee");
INSERT INTOemployee_login VALUES("45","7984BORRINAGA","$2y$10$UXcmmRZopEdiDpy6WT4hQegGR7uUURYNNSirGtxrk8gAIG4pPIzQC","100","","employee");
INSERT INTOemployee_login VALUES("46","1562IBAY","$2y$10$y0VCfbR/35aBtoc78RlSiuRCN1mKl8Wb1hfqcpgvXIF9yPJbgrUf.","101","","employee");
INSERT INTOemployee_login VALUES("47","6798CUNANAN","$2y$10$Bns9ZipTWvKyJNJn9WmbRuAclKReq1F8893XVHuTVptLbbvhI.Kb.","102","","employee");
INSERT INTOemployee_login VALUES("48","8107LORENO","$2y$10$bq4GIgHlAZmO/hau9pr0heKtOvhCSF7QV./5vXbdfM5pu5097JBLK","103","","employee");
INSERT INTOemployee_login VALUES("49","7607RAMOS","$2y$10$z9s/WIXkY74SU34hZSE5t.APEVKjp1AEl22ECQIPVWAtq/uKWP6iK","104","","employee");
INSERT INTOemployee_login VALUES("50","8527FIECAS","$2y$10$PKyx88j8mfSnt9ZKM6QwnObmJTvApkgVGwAHS0tVVuEtmGyCT0ik.","105","","employee");
INSERT INTOemployee_login VALUES("51","7548ALONZO","$2y$10$huuQPmagaN/l5Q7U30mhleTqKy2z9jBtb3d98mhizqn8BBe7UtdZG","106","","employee");
INSERT INTOemployee_login VALUES("52","7284STA. MARIA","$2y$10$wTQSjYbBEGhw6cLlSG0R5Ozu4mziCugtc/yzxxbp0IZFriTxGkM1e","107","","employee");
INSERT INTOemployee_login VALUES("53","5586EXAMPLE","$2y$10$XPD52LvCFTSGXJaH19f4Vub5.oXodPh3hpz9govWl7/UPh.aF.QoS","108","","employee");
INSERT INTOemployee_login VALUES("54","7442CABATO","$2y$10$NUz2pAyE2YdKD3lacbMzJul/M/5OuWOiWr9dyxwYUg4vYgPPlF.bi","97","","admin");
INSERT INTOemployee_login VALUES("56","4995CAILO","$2y$10$/TpfzJf5V0Idh1F8cf6KY.aWfaKZRMZk7XBZY9wD5l9uhit8SRMiS","111","","employee");
INSERT INTOemployee_login VALUES("57","5238SAGISI","$2y$10$jORVa/Lg6rkj3F31yQPjve/Fhoba2e5axIBPrgO9o894jiHI737Oa","109","","employee");
INSERT INTOemployee_login VALUES("58","1411SAGUILOT","$2y$10$43dpl76PKZzmDajBi2re0OHmXZ7Kvr5rVdjjHnD01nUMfcAdu6W/a","112","","employee");
INSERT INTOemployee_login VALUES("59","4184YECYEC","$2y$10$b03ZghzbR6PbZk/fyievcOeJPv0wkGLgE2jrCTQxA6XfvV4txGpO6","114","","employee");
INSERT INTOemployee_login VALUES("60","5774COBALLES","$2y$10$t5uNNsxHSNk.ee1wSw.lAO81M7e7.5W9GmU7sbAgoC0ZqdHl9BvB2","84","","employee");



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
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTOemployee_payslip VALUES("113","2023-05-11 21:04:03","Whacky Maliwat","2000","Whacky Maliwat_2023-06-01-1683810477.pdf","33","0","68");
INSERT INTOemployee_payslip VALUES("124","2023-05-12 01:00:52","Jason Yecyec","3000","Yecyec_2023-04-24-1684198592.pdf","34","0","57");
INSERT INTOemployee_payslip VALUES("145","2023-05-12 01:36:49","Jason Yecyec","699","Yecyec_2023-04-24-1684198592.pdf","31","0","57");
INSERT INTOemployee_payslip VALUES("146","2023-05-12 01:51:32","Alexandra Marie Pareja","2000","Pareja_2023-06-01-1683827509.pdf","34","0","62");
INSERT INTOemployee_payslip VALUES("147","2023-05-12 08:30:37","Dave Flourenz Amit","3000","Amit_2023-05-11-1684142155.pdf","29","0","65");
INSERT INTOemployee_payslip VALUES("148","2023-05-12 22:03:00","Jason Yecyec","3605","Yecyec_2023-04-24-1684198592.pdf","30","0","57");
INSERT INTOemployee_payslip VALUES("149","2023-05-12 22:03:09","John Renzo Crisostomo","3000","John Renzo Crisostomo_2023-05-11-1683900284.pdf","30","0","58");
INSERT INTOemployee_payslip VALUES("151","2023-05-15 17:15:52","Dave Flourenz Amit","3000","Amit_2023-05-11-1684142155.pdf","36","0","65");
INSERT INTOemployee_payslip VALUES("152","2023-05-15 17:18:33","Angelica Guiyab","2000","Guiyab_2023-05-01-1684142316.pdf","36","0","66");
INSERT INTOemployee_payslip VALUES("153","2023-05-16 08:56:26","Jason Yecyec","4230","Yecyec_2023-04-24-1684198592.pdf","36","0","57");



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
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTOemployee_payslip_form VALUES("113","Whacky Maliwat","employee","Tandang sora","human-resource","2023-06-01","2023-06-30","0","0","0","1","1","1","1000","1000","113","68");
INSERT INTOemployee_payslip_form VALUES("145","Jason Yecyec","admin","cubao","human-resource","2023-04-24","2023-05-11","5","0","833","1","1","1","0","0","153","57");
INSERT INTOemployee_payslip_form VALUES("146","Alexandra Marie Pareja","employee","Tandang sora","human-resource","2023-06-01","2023-06-30","0","0","0","1","1","1","1000","1000","146","62");
INSERT INTOemployee_payslip_form VALUES("147","Dave Flourenz Amit","admin","Quezon City","human-resource","2023-05-11","2023-05-23","0","0","0","1","1","1","1500","1500","151","65");
INSERT INTOemployee_payslip_form VALUES("148","Jason Yecyec","admin","cubao","human-resource","2023-05-11","2023-06-11","4","0","720","1","1","1","1500","1500","153","57");
INSERT INTOemployee_payslip_form VALUES("149","John Renzo Crisostomo","admin","Tandang sora","human-resource","2023-05-11","2023-06-11","0","0","0","1","1","1","1500","1500","149","58");
INSERT INTOemployee_payslip_form VALUES("151","Dave Flourenz Amit","admin","Quezon City","human-resource","2023-05-01","2023-05-30","0","0","0","1","1","1","1500","1500","151","65");
INSERT INTOemployee_payslip_form VALUES("152","Angelica Guiyab","employee","Quezon City","human-resource","2023-05-01","2023-05-30","0","0","0","1","1","1","1000","1000","152","66");
INSERT INTOemployee_payslip_form VALUES("153","Jason Yecyec","admin","cubao","human-resource","2023-05-01","2023-05-30","8","0","1464","1","1","1","1500","1500","153","57");



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
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOemployees VALUES("57","Jason","Yecyec","jasonyecyec@gmail.com","male","5 BigHorseshoe Drive, Cubao","09216732715","1","1","0000-00-00");
INSERT INTOemployees VALUES("58","John Renzo","Crisostomo","johnrenzo.crisostomo07@gmail.com","male","#20 B. Carnation St. Torres Subd. Banlat Rd.","09086447418","2","1","0000-00-00");
INSERT INTOemployees VALUES("60","Aldrin","De Vera","aldrindevera412@gmail.com","male","sitio looban duhat st. greenfields 1","09193371115","1","1","0000-00-00");
INSERT INTOemployees VALUES("61","Agatha Cyril","Medina","agathacyril.medina24@gmail.com","female","99 Nawasa Road Veterans Village, Pasong Tamo Quezon City","09615409788","1","1","0000-00-00");
INSERT INTOemployees VALUES("62","Alexandra Marie","Pareja","alexmarie0513@gmail.com","female","Sauyo, Novaliches, Quezon City","09566119147","1","1","0000-00-00");
INSERT INTOemployees VALUES("63","Christian Amiel","Dela Cruz","christianamiel17@gmail.com","male","Santol, Malolos, Bulacan","09184912085","1","1","0000-00-00");
INSERT INTOemployees VALUES("64","Shine","Tacsiat","shine.tacsiat09@gmail.com","female","Novaliches, Quezon City","09123456789","1","1","0000-00-00");
INSERT INTOemployees VALUES("65","Dave Flourenz","Amit","daveflourenz.amit23@gmail.com","male","Pasong Tamo, Quezon City","09269987023","1","1","0000-00-00");
INSERT INTOemployees VALUES("66","Angelica","Guiyab","angelica.guiyab023@gmail.com","female","Novaliches, QC","09558603891","1","1","0000-00-00");
INSERT INTOemployees VALUES("67","Jerome","Chua","jerome.chua06@gmail.com","male","C5 Quezon City","09380533018","1","1","0000-00-00");
INSERT INTOemployees VALUES("68","Whacky","Maliwat","Maliwatwhacky01@gmail.com","male","Bl7 lot 13 YALONG ST. (MARIHIT DR.) MALIGAYA capitol parklan","09453371027","1","1","0000-00-00");
INSERT INTOemployees VALUES("69","Alfie Lindon","Adrales","alfielindon.adrales@gmail.com","male","23 USAFFE Road, Veterans Village, Holy Spirit Q.C.","09973007793","1","1","0000-00-00");
INSERT INTOemployees VALUES("70","Rochelle","Macatiag","rochelle.pabilane30@gmail.com","female","318 Nawasa Road, Veterans Village Pasong Tamo Q.C.","09192149003","1","1","0000-00-00");
INSERT INTOemployees VALUES("71","Czernest","Custodio","czernestcustodio@gmail.com","male","Blk 45 Lot 32 Tatlong Hari St. Lagro Subd. Q.C","09293547044","2","1","0000-00-00");
INSERT INTOemployees VALUES("73","Johny","Oghayon","johny.oghayon14@gmail.com","male","Blk 54 Lot 15 SRCC-Magic Circle Housing, Pingkian 2, Pasong ","09707951615","1","1","0000-00-00");
INSERT INTOemployees VALUES("75","Stephanie Grace","Villafuerte","stephaniegrace.villafuerte16@gmail.com","female","#114 Orchids St. Payatas A. Quezon City","09156771405","1","1","0000-00-00");
INSERT INTOemployees VALUES("76","Shiela Mae","Morallos","shielamorallos429@gmail.com","female","Pasong Tamo, Quezon City","09128477653","1","1","0000-00-00");
INSERT INTOemployees VALUES("77","Dhel","Cabahug","dhelcabahug123@gmail.com","male","21Verbena Street West Fairview Quezon City","09517559797","2","1","0000-00-00");
INSERT INTOemployees VALUES("78","Kristine","Baja","baja.kristine19@gmail.com","female","Holy Spirit, Quezon City","09463549761","1","1","0000-00-00");
INSERT INTOemployees VALUES("79","Princess Julla","Fallaria","princessjulla.fallaria@gmail.com","female","Kapalaran St. Litex Barangay Commonwealth","09051876373","1","1","0000-00-00");
INSERT INTOemployees VALUES("80","John Kenneth","Bitoon","johnkenneth.bitoon5@gmail.com","male","3349 MRB Compound Brgy. Commonwealth, Quezon City","09462605117","1","1","0000-00-00");
INSERT INTOemployees VALUES("81","Nadine","Pimentel","nadine.pimentel3002@gmail.com","female","17 Wagner st, Quezon City","09951703362","1","1","0000-00-00");
INSERT INTOemployees VALUES("82","Milandro","Uy","milandro.uy0108@gmail.com","male","Blk. 4 Lot 13  Natividad St. Brgy. Sta. Lucia Novaliches Que","09957256429","2","1","0000-00-00");
INSERT INTOemployees VALUES("84","Shyrell Patricia","Coballes","coballesshyrell@gmail.com","female","13 Sampaloc St. Old Cabuyao Brgy. Sauyo Quezon City","09104145293","1","1","0000-00-00");
INSERT INTOemployees VALUES("85","Melchor","Acilo","acilo.melchor021@gmail.com","male","13 blk a sto nino brgy. san antonio sfdm q.c","09083265512","2","1","0000-00-00");
INSERT INTOemployees VALUES("86","Johnny Frey","Balubal","johnnyfreybalubal02@gmail.com","male","Bocaue Bulacan","09069619957","2","1","0000-00-00");
INSERT INTOemployees VALUES("87","Quenie Elaiza","Narisma","quenieelaiza.narisma08@gmail.com","female","blk2 lot36 talisayan st. maligaya park qc","09158886125","2","1","0000-00-00");
INSERT INTOemployees VALUES("88","Cristian","Ramiscal","cristian.ramiscal67@gmail.com","male","31 Commodore St Veterans Village Brgy Holy Spirit QC","09707085729","2","1","0000-00-00");
INSERT INTOemployees VALUES("89","Jan Michael Vincent","Aristorenas","jan.michael.aristorenas@gmail.com","male","346 Ramoy Compound Sangandaan Qc","09614502252","2","1","0000-00-00");
INSERT INTOemployees VALUES("90","Eric Johnes","Delos Reyes","ericjohnesdelosreyes@gmail.com","male","B12 L29 Poinsenttia St. Bf Homes 3 Deparo","09358376997","2","1","0000-00-00");
INSERT INTOemployees VALUES("91","Shaira","Balosa","shairalyn.balosa024@gmail.com","female","#31 Mabituan Street Barangay Masambong","09568707568","2","1","0000-00-00");
INSERT INTOemployees VALUES("92","Justin Daniel","de Jesus","justindanieldejesus4@gmail.com","male","Bgy. Kaligayahan, Q.C.","09365374128","2","1","0000-00-00");
INSERT INTOemployees VALUES("93","Cedrick John","Rojas","rojas.cedrickjohn05@gmail.com","male","B5 L10 Champaca St. Maligaya Subd, QC","09494036643","1","1","0000-00-00");
INSERT INTOemployees VALUES("94","Rowell","Sumpay","rowellsumpay2@gmail.com","male","212 Pacamara Street. Barangay Commonwealth Quezon City","639564687851","1","1","0000-00-00");
INSERT INTOemployees VALUES("95","Mark jay","Bares","bares.markjay01@gmail.com","male","Kapalaran","09125412189","2","1","0000-00-00");
INSERT INTOemployees VALUES("96","John Lester","Acerdano","johnlester.acerdano@gmail.com","male","17 Aloevera Street Payatas A. Quezon City","09074489981","2","1","0000-00-00");
INSERT INTOemployees VALUES("97","John Red","Cabato","johnred.cabato18@gmail.com","male","#10 Everlasting Street, Brgy. Batasan Hills, Quezon City","09460743379","2","1","0000-00-00");
INSERT INTOemployees VALUES("98","Precious","Baylon","baylon.precios.pentinio@gmail.com","female","#22H. Saint Joseph Street, Brgy. Holy Spirit Quezon City","09763711084","2","1","0000-00-00");
INSERT INTOemployees VALUES("100","Jayron","Borrinaga","jayron.borrinaga013@gmail.com","male","Bulacan St. Group 3, Area B, Brgy. Payatas Quezon City.","09958315356","2","1","0000-00-00");
INSERT INTOemployees VALUES("101","Javez Xavier","Ibay","ibayjavezxavier@gmail.com","male","149. P. Dela Cruz St. San Bartolome Novaliches  Quezon City","09510194303","1","1","0000-00-00");
INSERT INTOemployees VALUES("102","Jesse","Cunanan","jesse.cunanan182@gmail.com","female","Block 11 Lot 36 Sugartowne Batasan Hills Quezon City","09260266594","1","1","0000-00-00");
INSERT INTOemployees VALUES("103","Athena Renevieve","Loreno","athena.loreno023@gmail.com","female","B5 L1 Junji St. Rolling Hills Subd. Brgy. Kaligayahan, Nova.","09635995060","1","1","0000-00-00");
INSERT INTOemployees VALUES("104","Jasper","Ramos","jasperramos023@gmail.com","male","1252 flora vista. commonwealth, Quezon City","09270883870","1","1","0000-00-00");
INSERT INTOemployees VALUES("105","May Lee","Fiecas","maylee.fiecas177@gmail.com","female","#31 Kalayaan C Ext. Libis Compound","09615911906","1","1","0000-00-00");
INSERT INTOemployees VALUES("106","Marence Dainiel","Alonzo","marencedainielalonzo@gmail.com","male","B7 L9 Princess Anne St. Nagkaisang Nayon Q.C","09773622259","1","1","0000-00-00");
INSERT INTOemployees VALUES("107","Ronald","Sta. Maria","ronald.stamaria18@gmail.com","male","3237 Ninada St. Brgy. Commonwealth Quezon City","09070151112","1","1","0000-00-00");
INSERT INTOemployees VALUES("108","example","example","riemazoey14@gmail.com","male","QC","12312978","1","3","2023-05-16");
INSERT INTOemployees VALUES("109","John Mark Eli V.","Sagisi","johnmarkeli.vallozo.sagisi@gmail.com","male","Blk 4 Lot 6 Woodpeaker St. Zabarte Q.C.","09166856691","1","1","0000-00-00");
INSERT INTOemployees VALUES("111","Jhon Lenart","Cailo","jhonlenartcailo31@gmail.com","male","40 rosas street Batasan Hills Quezon City","09989053709","1","1","0000-00-00");
INSERT INTOemployees VALUES("112","Andrew","Saguilot","andrew.saguilot2@gmail.com","male","North Fairview Quezon City","09309044148","2","1","0000-00-00");
INSERT INTOemployees VALUES("113","Edmarie Mae","Calderon","calderonedmariemae@gmail.com","female","Quezon City","09355200151","1","3","2023-05-16");
INSERT INTOemployees VALUES("114","Jason","Yecyec","samueloyecyec@gmail.com","male","5 BigHorseshoe Drive, Cubao","12312412412312","1","3","2023-05-16");



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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOguest VALUES("27","","asd asd","0","0","2023-04-03 21:04:53","");



DROP TABLE holiday;

CREATE TABLE `holiday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `holiday_name` varchar(50) NOT NULL,
  `holiday_date` date NOT NULL,
  `percentage` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTOholiday VALUES("22","Araw ng Kagitingan","2023-04-09","2");
INSERT INTOholiday VALUES("23","Labor Day","2023-05-01","2");
INSERT INTOholiday VALUES("24","Independence Day","2023-06-12","2");
INSERT INTOholiday VALUES("25","National Heroes Day","2023-08-28","2");
INSERT INTOholiday VALUES("26","Bonifacio Day","2023-11-30","2");
INSERT INTOholiday VALUES("27","Christmas Day","2023-12-25","2");
INSERT INTOholiday VALUES("28","Rizal Day","2023-12-30","2");
INSERT INTOholiday VALUES("29","Day after New Year Day","2023-01-02","1.3");
INSERT INTOholiday VALUES("30","EDSA People Power Revolution","2023-01-25","1.3");
INSERT INTOholiday VALUES("31","Ninoy Aquino Day","2023-08-21","1.3");
INSERT INTOholiday VALUES("32","All Saints Day","2023-11-01","1.3");
INSERT INTOholiday VALUES("33","All Souls Day","2023-11-02","1.3");
INSERT INTOholiday VALUES("34","Feast of the Immaculate","2023-12-08","1.3");
INSERT INTOholiday VALUES("35","Last Day of the Year","2023-12-31","1.3");



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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOhr_dept VALUES("1","admin@gmail.com","admin123","Admin","Admin","","0");
INSERT INTOhr_dept VALUES("2","5872CRISOSTOMO","Crisostomo","John Renzo","Crisostomo","64472be4806f52.46398511.png","58");
INSERT INTOhr_dept VALUES("3","3396YECYEC","Yecyec","Jason","Yecyec","644729c2a56a72.73255356.jpg","57");



DROP TABLE hr_year;

CREATE TABLE `hr_year` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year_now` year(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTOhr_year VALUES("1","2023");



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
) ENGINE=InnoDB AUTO_INCREMENT=584 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOitem_list VALUES("2","","Sundresses","damit","0","Dress","900","Acorn Shoes Company","Unavailable","2021-09-08 10:21:42");
INSERT INTOitem_list VALUES("3","","Shorts","Casual Wear","0","Armani","600","Acorn Shoes Company","Available","2021-09-08 10:22:10");
INSERT INTOitem_list VALUES("6","","Polo Shirts","","0","Cotton","7000","Acorn Shoes Company","1","2023-02-21 13:36:26");
INSERT INTOitem_list VALUES("9","","Jeans","Casual Wear","0","Colorful","350","Apparel Productions Inc.","1","2023-02-24 12:17:56");
INSERT INTOitem_list VALUES("10","","Parkas","","0","Wool","7000","B2B Griffati","1","2023-02-25 16:07:24");
INSERT INTOitem_list VALUES("11","","T-Shirt","Casual Wear","0","Cotton","800000","Apparel Productions Inc.","1","2023-03-31 17:36:28");
INSERT INTOitem_list VALUES("12","","Windbreakers","","0","Dri-fit","900","B2B Griffati","1","2023-04-19 11:05:36");
INSERT INTOitem_list VALUES("13","","Dress Shirt","Business Wear","0","Nice","700","Billoomi Fashion","1","2023-05-11 23:10:39");
INSERT INTOitem_list VALUES("14","","Tank Tops","","0","Cotton","750","Billoomi Fashion","1","2023-05-11 23:11:04");
INSERT INTOitem_list VALUES("15","","Camisole","Sleep Wear","0","Cool","900","Brands Gateway","1","2023-05-11 23:11:55");
INSERT INTOitem_list VALUES("17","","Ski Suits","Sports Wear","0","Floral","750","Dewhirst","1","2023-05-11 23:12:33");
INSERT INTOitem_list VALUES("18","","Blouse","Business Attire","0","Cool","650","Dewhirst","0","2023-05-11 23:13:01");
INSERT INTOitem_list VALUES("19","","Round Neck Tank Top","","0","Cotton","500","Dewhirst","1","2023-05-11 23:13:37");
INSERT INTOitem_list VALUES("20","","Trousers","Business Attire","0","Cotton","950","Dresslily","1","2023-05-11 23:14:29");
INSERT INTOitem_list VALUES("21","","Tank Tops","Casual Wear","0","Cotton","600","DSA Manufacturing","1","2023-05-11 23:14:47");
INSERT INTOitem_list VALUES("22","","Suit","Business Attire","0","Cotton","800","DSA Manufacturing","1","2023-05-11 23:15:05");
INSERT INTOitem_list VALUES("23","","Button-up collared shirt","Formal Wear","0","Nice","750","Euphoric Colors","1","2023-05-11 23:15:26");
INSERT INTOitem_list VALUES("24","","Dress Shirts","Formal Wear","0","Cotton","750","Euphoric Colors","1","2023-05-11 23:15:48");
INSERT INTOitem_list VALUES("25","","Three-piece suit","Formal Wear","0","Knitted","700","Good Clothing Company","1","2023-05-11 23:20:36");
INSERT INTOitem_list VALUES("26","","Dress skirt","Formal Wear","0","Long","800","Good Clothing Company","1","2023-05-11 23:21:01");
INSERT INTOitem_list VALUES("27","","Track suit","Sports Wear","0","Cotton","1000","Guess Supplier Corporation","1","2023-05-11 23:21:47");
INSERT INTOitem_list VALUES("28","","Leotards","Sports Wear","0","Nice","600","Guess Supplier Corporation","1","2023-05-11 23:24:27");
INSERT INTOitem_list VALUES("29","","Swim Suits","Sports Wear","0","Cotton","800","H&M Manufacturing Corp.","1","2023-05-11 23:25:06");
INSERT INTOitem_list VALUES("30","","Pajamas","Sleep Wear","0","Cool","800","H&M Manufacturing Corp.","1","2023-05-11 23:34:29");
INSERT INTOitem_list VALUES("31","","Hoodie","Casual Wear","0","Cotton","400","Handshake","1","2023-05-11 23:36:12");
INSERT INTOitem_list VALUES("32","","Off the shoulder top","Street Fashion","0","Spandex","300","Handshake","1","2023-05-11 23:36:39");
INSERT INTOitem_list VALUES("33","","Peplum Top","","0","Cotton","750","Indie Source","1","2023-05-11 23:36:57");
INSERT INTOitem_list VALUES("34","","Peter Pan Collar Top","","0","Cotton","870","Indie Source","1","2023-05-11 23:37:21");
INSERT INTOitem_list VALUES("35","","Turtle Neck","","0","Cotton","950","Indie Source","1","2023-05-11 23:37:53");
INSERT INTOitem_list VALUES("36","","Tie-Dye Sweatshirts","","0","Cotton","500","Kakaclo","1","2023-05-11 23:38:54");
INSERT INTOitem_list VALUES("37","","Oversized Denim Jackets","","0","Jean","850","Kakaclo","1","2023-05-11 23:39:21");
INSERT INTOitem_list VALUES("38","","Statement T-Shirts","","0","Very Statement","700","ModeShe","1","2023-05-11 23:39:51");
INSERT INTOitem_list VALUES("39","","Wide Leg Pants","","0","Cotton","700","ModeShe","1","2023-05-11 23:40:13");
INSERT INTOitem_list VALUES("40","","Teddy Bear Coats","","0","Cotton","750","Pineapple Clothing","1","2023-05-11 23:40:43");
INSERT INTOitem_list VALUES("41","","Leather Jackets","Street Fashion","0","Leather","1100","Portland Garment Factory","1","2023-05-11 23:41:16");
INSERT INTOitem_list VALUES("42","","Dress Pants","Formal Wear","0","Cotton","800","Printful","1","2023-05-11 23:41:37");
INSERT INTOitem_list VALUES("43","","Wet Suits","Sports Wear","0","Jeans","750","Printful","1","2023-05-11 23:42:24");
INSERT INTOitem_list VALUES("44","","Daster","Sleep Wear","0","Cute","750","Printify","1","2023-05-11 23:42:58");
INSERT INTOitem_list VALUES("45","","Sheer Tops","","0","Cotton","400","Shop Baby Botiques","1","2023-05-11 23:43:19");
INSERT INTOitem_list VALUES("46","","Robes","Sleep Wear","0","Very High","350","Silverts","1","2023-05-11 23:43:46");
INSERT INTOitem_list VALUES("47","","Slacks","Business Attire","0","Cotton","850","Trendsi","1","2023-05-11 23:44:16");
INSERT INTOitem_list VALUES("48","","Turtle Skirts","","0","Animalistic","800","Trendsi","1","2023-05-11 23:45:23");
INSERT INTOitem_list VALUES("51","","Night Gown","Sleep wear","0","Cold","350","Zega Apparel","1","2023-05-11 23:47:03");



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
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTOleave_p VALUES("36","CHua jerome","Sick Leave","2023-05-10","2023-05-17","67","1","human-resource","AIfsdadfsa");
INSERT INTOleave_p VALUES("37","CHua jerome","Vacation Leave","2023-05-10","2023-05-17","67","1","human-resource","Ligo lang ako sa mars");
INSERT INTOleave_p VALUES("38","John Renzo Crisostomo","Vacation Leave","2023-05-10","2023-05-12","58","1","Human Resource","Gusto ko magkape");
INSERT INTOleave_p VALUES("39","CHua jerome","Other","2023-05-10","2023-05-17","67","1","human-resource","Natatae");
INSERT INTOleave_p VALUES("40","Jason Yecyec","Vacation Leave","2023-05-10","2023-05-14","57","1","Human Resource","Natate");
INSERT INTOleave_p VALUES("41","Crisostomo, John Renzo M.","Sick Leave","2023-05-10","2023-05-15","58","1","human-resource","Gusto ko magkape");
INSERT INTOleave_p VALUES("42","AMit","Vacation Leave","2023-05-10","2023-05-16","65","1","","");
INSERT INTOleave_p VALUES("43","Crisostomo, John Renzo M.","Sick Leave","2023-05-10","2023-05-17","58","1","human-resource","Natatae");
INSERT INTOleave_p VALUES("44","Chua, Jerome","Vacation Leave","2023-05-01","2023-05-07","67","1","human-resource","fdsfvsdfsdvf");
INSERT INTOleave_p VALUES("45","Crisostomo, John Renzo M.","Vacation Leave","2023-05-10","2023-05-12","58","1","Human Resource","Vacation in Korea");
INSERT INTOleave_p VALUES("46","Crisostomo, John Renzo M.","Other","2023-05-10","2023-05-17","58","1","Human Resource","Nagkasakit ako ");
INSERT INTOleave_p VALUES("47","Crisostomo, John Renzo M.","Vacation Leave","2023-05-13","2023-05-16","58","1","Human Resource","");
INSERT INTOleave_p VALUES("48","MALIWAT","Vacation Leave","2023-05-18","2023-05-21","68","1","Sales","Vacation Sa Korea");
INSERT INTOleave_p VALUES("49","Crisostomo, John Renzo M.","Paternity Leave","2023-05-15","2023-05-23","58","1","Human Resource","Nagkasakit ako ");
INSERT INTOleave_p VALUES("50","dsada","Maternity Leave","2023-05-11","2023-05-31","62","1","Human Resource","Vacation in Korea");
INSERT INTOleave_p VALUES("51","Pareja","Maternity Leave","2023-05-11","2023-05-30","62","1","Human Resource","Vacation in Korea");
INSERT INTOleave_p VALUES("52","Pareja","Maternity Leave","2023-05-11","2023-05-30","62","1","Human Resource","Vacation in Korea");
INSERT INTOleave_p VALUES("53","Jhon Lenart Cailo","Vacation Leave","2023-05-11","2023-05-18","111","1","Sales","NATATAE AKO");
INSERT INTOleave_p VALUES("54","Jhon Lenart Cailo","Vacation Leave","2023-05-11","2023-05-24","111","1","Sales","NATATAE AKO");
INSERT INTOleave_p VALUES("55","cailo","Vacation Leave","2023-05-11","2023-05-25","111","0","Sales","Gusto ko magkape");
INSERT INTOleave_p VALUES("56","cq","Vacation Leave","2023-05-11","2023-05-15","111","0","Sales","Vacation in Korea");
INSERT INTOleave_p VALUES("57","Pareja","Vacation Leave","2023-05-14","2023-05-22","62","1","Human Resource","Ligo lang ako sa mars");
INSERT INTOleave_p VALUES("58","Jason Yecyec","Other","2023-05-25","2023-05-26","67","1","Human Resource","Gusto ko magkape");
INSERT INTOleave_p VALUES("59","Jason Yecyec","Other","2023-05-13","2023-05-15","58","0","Human Resource","Vacation in Korea");
INSERT INTOleave_p VALUES("62","Crisostomo","Vacation Leave","2023-05-19","2023-05-23","58","0","HR Department","Vacation");



DROP TABLE manual_attendance;

CREATE TABLE `manual_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE notifications;

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `type` text NOT NULL,
  `message` text NOT NULL,
  `status` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTOnotifications VALUES("40","","comment","Okayy na","read","2023-04-09 14:33:58");
INSERT INTOnotifications VALUES("41","sample","sample","sample","sample","2023-05-14 11:54:55");



DROP TABLE order_items;

CREATE TABLE `order_items` (
  `po_id` int(30) NOT NULL,
  `item_id` int(11) NOT NULL,
  `supplier` varchar(50) NOT NULL,
  `quantity` float NOT NULL,
  `item` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` int(250) NOT NULL,
  `total` int(250) NOT NULL,
  KEY `po_id` (`po_id`),
  KEY `item_no` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOorder_items VALUES("2","1","pcs","10","","","0","0");
INSERT INTOorder_items VALUES("1","1","boxes","10","","","0","0");
INSERT INTOorder_items VALUES("1","2","pcs","6","","","0","0");
INSERT INTOorder_items VALUES("3","9","23","14","","","0","0");
INSERT INTOorder_items VALUES("0","0","supplier1","2","medyas","mabango","100","200");
INSERT INTOorder_items VALUES("0","0","supplier1","2","medyas","mabango","100","200");



DROP TABLE overTime;

CREATE TABLE `overTime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `over_time` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTOoverTime VALUES("44","Jason Yecyec","57","Over Time","2023-05-15","1.4166666666667");
INSERT INTOoverTime VALUES("45","Jason Yecyec","57","Over Time","2023-05-15","1.4166666666667");
INSERT INTOoverTime VALUES("48","John Renzo Crisostomo","58","Over Time","2023-05-15","0");
INSERT INTOoverTime VALUES("49","John Renzo Crisostomo","58","Over Time","2023-05-15","0");



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
) ENGINE=InnoDB AUTO_INCREMENT=478 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOpayment VALUES("477","CLO-84832356","10","50","50.00",""," "," 5.00","2023-05-16 00:00:12");



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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOpo_list VALUES("1","PO-94619964639","1","2","5159.99","12","30959.9","Sample Purchase Order Only","1","2021-09-08 15:20:57","2021-09-08 15:59:56");
INSERT INTOpo_list VALUES("2","PO-92093417806","2","1","378.899","12","4546.79","Sample","0","2021-09-08 15:49:55","2021-09-08 16:03:16");
INSERT INTOpo_list VALUES("3","PO-51168934287","28","10","1400","5","700","","1","2023-05-01 16:51:57","2023-05-01 16:52:37");
INSERT INTOpo_list VALUES("4","PO-53049435710","32","0","0","0","0","","0","2023-05-11 18:55:23","");
INSERT INTOpo_list VALUES("5","PO-20244600141","25","0","0","0","0","","0","2023-05-11 19:01:19","");



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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTOprlist VALUES("26","2023-05-11","test semi","2023-05-11","2023-05-24","","0");
INSERT INTOprlist VALUES("27","2023-05-11","test other","0000-00-00","0000-00-00","resignation","0");
INSERT INTOprlist VALUES("28","2023-05-11","test month","2023-05-11","2023-06-11","","0");
INSERT INTOprlist VALUES("29","2023-05-11","1234514","2023-05-11","2023-05-23","semimonthly","0");
INSERT INTOprlist VALUES("30","2023-05-11","1231233","2023-05-11","2023-06-11","monthly","1");
INSERT INTOprlist VALUES("31","2023-05-11","12412193102","0000-00-00","0000-00-00","resignation","1");
INSERT INTOprlist VALUES("32","2023-05-11","123128681263","0000-00-00","0000-00-00","termination","0");
INSERT INTOprlist VALUES("33","2023-05-11","SAMPLE","2023-06-01","2023-06-30","monthly","1");
INSERT INTOprlist VALUES("34","2023-05-11","SAMPLE","2023-06-01","2023-06-30","monthly","1");
INSERT INTOprlist VALUES("35","2023-05-15","","0000-00-00","0000-00-00","","0");
INSERT INTOprlist VALUES("36","2023-05-15","","2023-05-01","2023-05-30","monthly","1");



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
) ENGINE=InnoDB AUTO_INCREMENT=9223372036854775807 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTOproducts VALUES("1","","","","0","","2023-05-15 17:30:28");
INSERT INTOproducts VALUES("2","","sample","Dress","200","sample","2023-05-16 02:47:08");
INSERT INTOproducts VALUES("3","","","Armani","0","","2023-05-15 17:30:51");
INSERT INTOproducts VALUES("9","","","Colorful","0","","2023-05-16 00:00:09");
INSERT INTOproducts VALUES("10","Parkas","asd","Wool","7000","B2B Griffati","2023-05-16 00:05:20");
INSERT INTOproducts VALUES("11","T-Shirt","Casual Wear","Cotton","800000","Apparel Productions Inc.","2023-05-16 01:59:15");
INSERT INTOproducts VALUES("12","Windbreakers","asd","Dri-fit","900","B2B Griffati","2023-05-16 01:59:38");
INSERT INTOproducts VALUES("14","","sample","Cotton","123","sample","2023-05-16 02:33:35");
INSERT INTOproducts VALUES("15","","sample","Cool","123","sample","2023-05-16 02:34:08");
INSERT INTOproducts VALUES("17","Ski Suits","sample","Floral","123","sample","2023-05-16 02:35:28");
INSERT INTOproducts VALUES("18","","sample","Cool","123","sample","2023-05-16 02:36:45");
INSERT INTOproducts VALUES("19","","sample","Cotton","123","sample","2023-05-16 02:37:35");
INSERT INTOproducts VALUES("21","CUS2","sample","Cotton","123","sample","2023-05-16 02:38:17");



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
) ENGINE=InnoDB AUTO_INCREMENT=688 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




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
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




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
) ENGINE=InnoDB AUTO_INCREMENT=432 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




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
) ENGINE=InnoDB AUTO_INCREMENT=509 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOrequest_log VALUES("461","","1","Brand","8","123.00","1","2023-05-13 18:15:56");
INSERT INTOrequest_log VALUES("462","","1","Brand","8","123.00","0","2023-05-13 18:16:49");
INSERT INTOrequest_log VALUES("463","","1","Brand","8","123.00","1","2023-05-13 18:23:38");
INSERT INTOrequest_log VALUES("464","","1","Brand","8","123.00","1","2023-05-13 18:24:15");
INSERT INTOrequest_log VALUES("465","","1","Brand","8","123.00","1","2023-05-13 18:24:46");
INSERT INTOrequest_log VALUES("466","","1","Brand","8","123.00","1","2023-05-13 18:25:23");
INSERT INTOrequest_log VALUES("467","","1","Brand","8","123.00","1","2023-05-13 18:25:47");
INSERT INTOrequest_log VALUES("468","","1","Brand","8","123.00","1","2023-05-13 18:26:33");
INSERT INTOrequest_log VALUES("469","","1","Brand","8","123.00","1","2023-05-13 18:28:10");
INSERT INTOrequest_log VALUES("470","","1","Brand","8","123.00","1","2023-05-13 18:29:03");
INSERT INTOrequest_log VALUES("471","","1","Brand","8","123.00","1","2023-05-13 18:32:15");
INSERT INTOrequest_log VALUES("472","","1","Brand","8","123.00","1","2023-05-13 18:32:50");
INSERT INTOrequest_log VALUES("473","","1","Brand","8","123.00","1","2023-05-13 18:33:19");
INSERT INTOrequest_log VALUES("474","","1","Brand","8","123.00","1","2023-05-14 05:36:24");
INSERT INTOrequest_log VALUES("475","","1","Brand","8","123.00","1","2023-05-14 05:37:00");
INSERT INTOrequest_log VALUES("476","","1","Brand","8","123.00","1","2023-05-14 05:38:10");
INSERT INTOrequest_log VALUES("477","","1","Brand","8","123.00","1","2023-05-14 05:40:47");
INSERT INTOrequest_log VALUES("478","","1","Brand","8","123.00","1","2023-05-14 05:41:29");
INSERT INTOrequest_log VALUES("479","","1","Brand","8","123.00","1","2023-05-14 05:42:43");
INSERT INTOrequest_log VALUES("480","","1","Brand","8","123.00","1","2023-05-14 05:47:00");
INSERT INTOrequest_log VALUES("481","","1","Brand","8","123.00","1","2023-05-14 05:49:24");
INSERT INTOrequest_log VALUES("482","","1","Brand","8","123.00","1","2023-05-14 05:50:30");
INSERT INTOrequest_log VALUES("483","","1","Brand","8","123.00","1","2023-05-14 05:51:44");
INSERT INTOrequest_log VALUES("484","","1","Brand","8","123.00","1","2023-05-14 05:52:04");
INSERT INTOrequest_log VALUES("485","","1","Brand","8","123.00","1","2023-05-14 05:52:48");
INSERT INTOrequest_log VALUES("486","","1","Brand","8","123.00","1","2023-05-14 05:53:57");
INSERT INTOrequest_log VALUES("487","","1","Brand","8","123.00","1","2023-05-14 05:54:22");
INSERT INTOrequest_log VALUES("488","","1","Brand","8","123.00","0","2023-05-14 06:00:11");
INSERT INTOrequest_log VALUES("489","","1","Brand","8","123.00","0","2023-05-14 06:00:34");
INSERT INTOrequest_log VALUES("490","","1","Brand","8","123.00","0","2023-05-14 06:01:09");
INSERT INTOrequest_log VALUES("491","","1","Brand","8","123.00","0","2023-05-14 06:01:33");
INSERT INTOrequest_log VALUES("492","","1","Brand","8","123.00","0","2023-05-14 06:01:58");
INSERT INTOrequest_log VALUES("493","","1","Brand","8","123.00","0","2023-05-14 06:02:15");
INSERT INTOrequest_log VALUES("494","","1","Brand","8","123.00","0","2023-05-14 06:02:50");
INSERT INTOrequest_log VALUES("495","","1","Brand","8","123.00","0","2023-05-14 06:03:22");
INSERT INTOrequest_log VALUES("496","","1","Brand","8","123.00","0","2023-05-14 06:03:51");
INSERT INTOrequest_log VALUES("497","","1","Brand","8","123.00","0","2023-05-14 06:04:26");
INSERT INTOrequest_log VALUES("498","","1","Brand","8","123.00","0","2023-05-14 06:04:47");
INSERT INTOrequest_log VALUES("499","","1","Brand","8","123.00","0","2023-05-14 06:05:12");
INSERT INTOrequest_log VALUES("500","","1","Brand","8","123.00","0","2023-05-14 06:05:21");
INSERT INTOrequest_log VALUES("501","","1","Brand","8","123.00","0","2023-05-14 06:07:31");
INSERT INTOrequest_log VALUES("502","","1","Brand","8","123.00","0","2023-05-14 06:08:01");
INSERT INTOrequest_log VALUES("503","","1","Brand","8","123.00","0","2023-05-14 06:08:29");
INSERT INTOrequest_log VALUES("504","","1","Brand","8","123.00","0","2023-05-14 06:09:03");
INSERT INTOrequest_log VALUES("505","","1","Brand","8","123.00","0","2023-05-14 06:18:54");
INSERT INTOrequest_log VALUES("506","","1","Brand","8","123.00","0","2023-05-14 06:21:34");
INSERT INTOrequest_log VALUES("507","","1","Brand","8","123.00","0","2023-05-14 06:24:10");
INSERT INTOrequest_log VALUES("508","","1","Brand","8","123.00","0","2023-05-14 06:29:21");



DROP TABLE schedule;

CREATE TABLE `schedule` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTOschedule VALUES("1","07:00:00","15:00:00");
INSERT INTOschedule VALUES("2","15:00:00","23:00:00");



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
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOsupplier_list VALUES("1","Shop Baby Botiques","California, USA","George Wilson","09123459879","Wilson_Boutiques@gmail.com","They have a large collection of girls’ and boys’ outfits from 6 months to 14 years old.","2021-09-08 09:46:45","uploads/1683849900_6_tax.jpg","uploads/1683849900_4_mayorpermit.jpg","uploads/1683849900_3_brgy permit.png","uploads/1683849900_3_dti.jpg","uploads/1683849900_6_business permit.jpg","1");
INSERT INTOsupplier_list VALUES("2","Kakaclo","Berlin, Germany","Samantha Lou","09332145889","sSou@supplier102.com","Kakaclo is an apparel clothing manufacturer, that also doubles as a clothing supplier,","2021-09-08 10:25:12","uploads/1683849660_6_tax.jpg","uploads/1683849660_5_mayorpermit.jpg","uploads/1683849660_3_brgy permit.png","uploads/1683849660_6_dti.jpg","uploads/1683849660_6_business permit.jpg","1");
INSERT INTOsupplier_list VALUES("5","Acorn Shoes Company","San Antonio  Laguna","Joshua Arago","09729464748","Aragon@gmail.com","Legit kami","2023-03-18 09:00:36","uploads/1683850140_8_tax.jpg","uploads/1683850140_4_mayorpermit.jpg","uploads/1683850140_3_brgy permit.png","uploads/1683850140_6_dti.jpg","uploads/1683850140__business permit.jpg","1");
INSERT INTOsupplier_list VALUES("6","Wool supplies","Taguig","Christian Ramiscal","8567635","Ramiscal@yahoo.com","Wool supplier company","2023-04-01 09:48:19","uploads/1683850020_7_tax.jpg","uploads/1683850020_4_mayorpermit.jpg","uploads/1683850020_3_brgy permit.png","uploads/1683850020_4_dti.jpg","uploads/1683850020_4_brgy business permit.jpg","1");
INSERT INTOsupplier_list VALUES("7","Guess Supplier Corporation","BGC","Ronald Sta. Maria","55345145","Sta.Maria@yahoo.com","Apparel Supplier","2023-04-01 10:11:46","uploads/1683849480_6_tax.jpg","uploads/1683849480_4_mayorpermit.jpg","uploads/1683849480_3_brgy permit.png","uploads/1683849480_5_dti.jpg","uploads/1683849480_4_brgy business permit.jpg","1");
INSERT INTOsupplier_list VALUES("8","Indie Source","Los Angeles","Angelo","098373476345","Angelo_Indie@gmail.com","Indie Source is full-service clothing development and manufacturing consultancy, based in Los Angeles.","2023-04-01 13:51:32","uploads/1683849600_6_tax.jpg","uploads/1683849600_4_mayorpermit.jpg","uploads/1683849600_4_brgy business permit.jpg","uploads/1683849600_4_dti.jpg","uploads/1683849600__business permit.jpg","1");
INSERT INTOsupplier_list VALUES("12","Billoomi Fashion","New Delhi","Patel","5426546465462","Patel_Billoomi@yahoo.com","Billoomi Fashion is an India-based private label clothing manufacturer of ready-to-wear woven and knitted garments for men, women, and children.","2023-04-01 14:13:26","","uploads/1683849240_4_mayorpermit.jpg","uploads/1683849240_6_brgy.jpg","uploads/1683849240_5_dti.jpg","uploads/1683849240__business permit.jpg","1");
INSERT INTOsupplier_list VALUES("19","Euphoric Colors","Los Angeles","Ufora","092382327623","Ufora_Euphoric@gmail.com","Euphoric Color is a full-service clothing manufacturer based in Los Angeles.","2023-04-01 15:08:10","uploads/1683849420_8_tax.jpg","uploads/1683849420_4_mayorpermit.jpg","uploads/1683849420_5_brgy business permit.jpg","uploads/1683849420_3_dti.jpg","uploads/1683849420_5_brgy business permit.jpg","1");
INSERT INTOsupplier_list VALUES("20","ModeShe","Perth, Australlia","Shein Dela Cruz","09438345867","Dela_Cruz@gmail.com","ModeShe is a clothing vendor that caters to retailers, wholesalers, and dropshippers.","2023-04-01 15:24:15","uploads/1683849720_6_tax.jpg","uploads/1683849720_4_mayorpermit.jpg","uploads/1683849720_3_brgy permit.png","uploads/1683849720_4_dti.jpg","uploads/1683849720__business permit.jpg","1");
INSERT INTOsupplier_list VALUES("21","DSA Manufacturing","Londo, United Kingdom","Kadita","093734873436","Kadita_DSA@yahoo.com","DSA manufacturing is based in the UK and offers a range of high quality clothing manufacturing.","2023-04-01 15:27:12","uploads/1683849360_3_tax.jpg","uploads/1683849360_6_mayorpermit.jpg","uploads/1683849360_3_brgy permit.png","uploads/1683849360_5_dti.jpg","uploads/1683849360_4_brgy business permit.jpg","1");
INSERT INTOsupplier_list VALUES("22","Portland Garment Factory","Portland, Oregon","Uragon","43263234","Uragon_Garment@yahoo.com","Portland Garment Factory is a full-service creative design and fabrication studio, based in Portland, Oregon.","2023-04-01 15:30:18","uploads/1683849780_6_tax.jpg","uploads/1683849780_5_mayorpermit.jpg","uploads/1683849780_3_brgy permit.png","uploads/1683849780_3_dti.jpg","uploads/1683849780_5_brgy business permit.jpg","1");
INSERT INTOsupplier_list VALUES("23","H&M Manufacturing Corp.","Makati City","Albert Dela Cruz","092137623","delacruz@gmail.com","Apparel Supplier","2023-04-01 15:32:01","uploads/1683849540_6_tax.jpg","uploads/1683849540_5_mayorpermit.jpg","uploads/1683849540_5_brgy business permit.jpg","uploads/1683849540_3_dti.jpg","uploads/1683849540_4_brgy business permit.jpg","1");
INSERT INTOsupplier_list VALUES("24","Trendsi","Los Angeles","Wayn Sta. Maria","098746353","Wayn_Trendsi@yahoo.com","Trendsi is a dropshipping clothing store tailored for women.","2023-04-01 15:55:46","uploads/1683850020_5_tax.jpg","uploads/1683850020_5_mayorpermit.jpg","uploads/1683850020_3_brgy permit.png","uploads/1683850020_6_dti.jpg","uploads/1683850020_4_brgy business permit.jpg","1");
INSERT INTOsupplier_list VALUES("25","Dewhirst","Geneva, Switzerland","Dewy","09877654321","Dewy_dewhirst@gmail.com","Dewhirst design, develop and manufacture a wide range of men’s, women’s, and children’s clothing.","2023-04-26 14:35:20","uploads/1683849300_8_tax.jpg","uploads/1683849300_5_mayorpermit.jpg","uploads/1683849300_6_brgy.jpg","uploads/1683849300_3_dti.jpg","uploads/1683849300_5_brgy business permit.jpg","1");
INSERT INTOsupplier_list VALUES("26","Apparel Productions Inc.","New York","Ronald","09746352437","Ronald_mabait@gmail.com","Apparel Production Incorporated is a distinguished and highly experienced garment manufacturer in New York","2023-04-27 04:36:09","uploads/1683849180_7_tax.jpg","uploads/1683849180_4_mayorpermit.jpg","uploads/1683849180_6_brgy.jpg","uploads/1683849180_4_dti.jpg","uploads/1683849180_4_brgy business permit.jpg","1");
INSERT INTOsupplier_list VALUES("27","Pineapple Clothing","Texas, USA","Trixie Marcelo","09735241","Marcelo_marketing@gmail.com","Pineapple Clothing is a US-based clothing supplier and manufacturer of women’s and children’s apparel.","2023-04-27 04:57:52","uploads/1683849720_7_tax.jpg","uploads/1683849720_5_mayorpermit.jpg","uploads/1683849720_3_brgy permit.png","uploads/1683849720_6_dti.jpg","uploads/1683849720_6_business permit.jpg","1");
INSERT INTOsupplier_list VALUES("28","Good Clothing Company","Oregon, USA","Narisma Racal","098731748393","Racal_procurement@gmail.com","The company prides itself on using environmentally sustainable production/","2023-04-27 04:59:22","uploads/1683849480_3_tax.jpg","uploads/1683849480_4_mayorpermit.jpg","uploads/1683849480_5_brgy business permit.jpg","uploads/1683849480_4_dti.jpg","uploads/1683849480_6_business permit.jpg","1");
INSERT INTOsupplier_list VALUES("29","Zega Apparel","Karachi, Pakistan","Sriracha","0982723662384","Sriracha_Karachi@gmail.com","Zega Apparel is one of the full-service apparel manufacturers.","2023-04-27 05:34:37","uploads/1683850080_7_tax.jpg","uploads/1683850080_5_mayorpermit.jpg","uploads/1683850080_3_brgy permit.png","uploads/1683850080_6_dti.jpg","uploads/1683850080_4_brgy business permit.jpg","1");
INSERT INTOsupplier_list VALUES("30","Brands Gateway","USA","Rona Balubal","098373653","Ronal_Brands@gmail.com","BrandsGateway is a clothing marketplace that specializes in selling luxury fashion items and has over 100 popular brands such as Gucci, Dolce $ Gabbana, Jimmy Choo, Emporio Armani, Michael Kors, and the list goes on.","2023-05-05 07:46:38","uploads/1683849300_8_tax.jpg","uploads/1683849300_4_mayorpermit.jpg","uploads/1683849300_5_brgy business permit.jpg","uploads/1683849300_4_dti.jpg","uploads/1683849300_6_business permit.jpg","1");
INSERT INTOsupplier_list VALUES("31","Silverts","New Delhi, India","Dhel_Delhi@gmail.com","0983736243","Dhel_Silverts@gmail.com","Silverts is one of the most popular clothing suppliers for Shopify you can source men’s and women’s products for the elderly, disabled, or the sick.","2023-05-05 07:56:39","uploads/1683849960_3_tax.jpg","uploads/1683849960_5_mayorpermit.jpg","uploads/1683849960_6_brgy.jpg","uploads/1683849960_5_dti.jpg","uploads/1683849960__business permit.jpg","1");
INSERT INTOsupplier_list VALUES("32","B2B Griffati","London, United Kingdom","EJ Renejay","098476453647","Renejay_B2B@gmail.com","B2B Griffati is your best bet if you are looking for a clothing supplier that offers wholesale and dropshipping services on branded wear and ships worldwide.","2023-05-05 08:22:54","uploads/1683849180_6_tax.jpg","uploads/1683849180_5_mayorpermit.jpg","uploads/1683849180_3_brgy permit.png","uploads/1683849180_3_dti.jpg","uploads/1683849180_6_business permit.jpg","1");
INSERT INTOsupplier_list VALUES("33","Handshake","New York, USA","Shake Shack","Handy_Shake@gmail.com","Shake_Hand@gmail.com","Handshake is a US-based, all-in-one wholesale marketplace by Shopify.","2023-05-05 08:24:22","uploads/1683849600_8_tax.jpg","uploads/1683849600_5_mayorpermit.jpg","uploads/1683849600_3_brgy permit.png","uploads/1683849600_4_dti.jpg","uploads/1683849600__business permit.jpg","1");
INSERT INTOsupplier_list VALUES("34","Dresslily","New York, USA","Lily Beth","09876452436","Lily_Dress@gmail.com","Dresslily is another excellent choice if you are looking for the best place to source male and female wear.","2023-05-05 16:31:42","uploads/1683849360_3_tax.jpg","uploads/1683849360_5_mayorpermit.jpg","uploads/1683849360_6_brgy.jpg","uploads/1683849360_6_dti.jpg","uploads/1683849360_4_brgy business permit.jpg","1");
INSERT INTOsupplier_list VALUES("35","Printify","Abu Dhabi, UAE","Print Pa","Aguy@gmail.com","Print_tify@gmail.com","Printify is a print-on-demand platform that connects you with multiple e-commerce platforms and marketplaces.","2023-05-05 16:50:05","","uploads/1683849900_5_mayorpermit.jpg","uploads/1683849900_3_brgy permit.png","uploads/1683849900_3_dti.jpg","uploads/1683849900_6_business permit.jpg","1");
INSERT INTOsupplier_list VALUES("36","Printful","Texas, USA","Shaira Oghayon","0974746597","Oghayon_Print@gmail.com","Printful is yet another print-on-demand platform for e-commerce business owners.","2023-05-05 16:51:52","uploads/1683849840_4_tax.jpg","uploads/1683849840_5_mayorpermit.jpg","uploads/1683849840_6_brgy.jpg","uploads/1683849840_6_dti.jpg","uploads/1683849840_4_brgy business permit.jpg","1");



DROP TABLE system_info;

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOsystem_info VALUES("1","name","Purchasing Order Management System");
INSERT INTOsystem_info VALUES("6","short_name","POMS");
INSERT INTOsystem_info VALUES("11","logo","uploads/1677313620_1435864.jpg");
INSERT INTOsystem_info VALUES("13","user_avatar","uploads/user_avatar.jpg");
INSERT INTOsystem_info VALUES("14","cover","uploads/1677313620_𝘞𝘌 𝘉𝘌 𝘚𝘖 𝘊𝘖𝘔𝘗𝘓𝘐𝘊𝘈𝘛𝘌𝘋 __ 𝐄_ 𝐘𝐀𝐄𝐆𝐄𝐑.jpg");
INSERT INTOsystem_info VALUES("15","company_name","Gene");
INSERT INTOsystem_info VALUES("16","company_email","Gene@gmail.com");
INSERT INTOsystem_info VALUES("17","company_address","Abacus St. Pasay City");



