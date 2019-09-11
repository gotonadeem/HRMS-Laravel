DROP TABLE IF EXISTS attendances;

CREATE TABLE `attendances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL,
  `leave_type_id` int(11) DEFAULT NULL,
  `absent_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO attendances VALUES('1','1234566sss','2019-06-18','1','0','','2019-06-17 05:45:41','2019-06-17 05:45:41');
INSERT INTO attendances VALUES('2','1222222','2019-06-18','1','0','','2019-06-17 05:45:41','2019-06-17 05:45:41');
INSERT INTO attendances VALUES('3','65656','2019-06-18','1','0','','2019-06-17 05:45:41','2019-06-17 05:45:41');
INSERT INTO attendances VALUES('4','1234566sssg','2019-06-18','1','0','','2019-06-17 05:45:41','2019-06-17 05:45:41');
INSERT INTO attendances VALUES('5','558757','2019-06-18','1','0','','2019-06-17 05:45:41','2019-06-17 05:45:41');
INSERT INTO attendances VALUES('6','1234566sss','2019-06-17','0','1','www','2019-06-17 18:13:14','2019-06-17 18:13:14');
INSERT INTO attendances VALUES('7','1222222','2019-06-17','1','0','','2019-06-17 18:13:14','2019-06-17 18:13:14');
INSERT INTO attendances VALUES('8','65656','2019-06-17','0','2','www','2019-06-17 18:13:14','2019-06-17 18:13:14');
INSERT INTO attendances VALUES('9','1234566sssg','2019-06-17','1','0','','2019-06-17 18:13:14','2019-06-17 18:13:14');
INSERT INTO attendances VALUES('10','1234566sss','2019-06-29','0','2','','2019-06-20 21:17:33','2019-06-20 21:17:33');
INSERT INTO attendances VALUES('11','1234566sss','2019-06-22','0','2','','2019-06-20 21:27:46','2019-06-20 21:27:46');
INSERT INTO attendances VALUES('12','1234566sss','2019-06-21','0','2','','2019-06-20 21:27:52','2019-06-20 21:27:52');



DROP TABLE IF EXISTS awards;

CREATE TABLE `awards` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `types_of_award_id` int(11) NOT NULL,
  `gift_item` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cash_price` decimal(8,2) DEFAULT NULL,
  `employee_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO awards VALUES('1','1','yo','8.00','1234566sss','04','2019','Active','','2019-06-19 18:16:18','2019-06-19 20:09:34');
INSERT INTO awards VALUES('2','1','rgg','77.00','1222222','03','2020','Active','','2019-06-19 19:58:49','2019-06-19 20:09:44');



DROP TABLE IF EXISTS bank_details;

CREATE TABLE `bank_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `account_holder_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_identifier_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_location` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS departments;

CREATE TABLE `departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `department` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO departments VALUES('1','PHP','Active','2019-06-04 23:10:33','2019-06-04 23:10:33');
INSERT INTO departments VALUES('2','Designer','Active','2019-06-04 23:11:35','2019-06-13 19:07:25');



DROP TABLE IF EXISTS designations;

CREATE TABLE `designations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO designations VALUES('1','1','Frontend','2019-06-04 23:10:33','2019-06-04 23:10:33');
INSERT INTO designations VALUES('2','1','Backend','2019-06-04 23:10:33','2019-06-04 23:10:33');
INSERT INTO designations VALUES('3','2','Graphic Designer','2019-06-04 23:11:35','2019-06-04 23:11:35');
INSERT INTO designations VALUES('4','2','Web Designer','2019-06-04 23:11:35','2019-06-04 23:11:35');



DROP TABLE IF EXISTS documents;

CREATE TABLE `documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `resume` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_letter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_card` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS employees;

CREATE TABLE `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `employee_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `joining_date` date NOT NULL,
  `exit_date` date DEFAULT NULL,
  `joining_salary` decimal(8,2) NOT NULL,
  `current_salary` decimal(8,2) NOT NULL,
  `account_holder_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_identifier_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_location` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_letter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_card` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_employee_id_unique` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO employees VALUES('1','6','1234566sss','dddf','rrrr','2019-06-07','35555555555','Dhaka','Dhaka','1322','Bangladesh','2','3','2019-06-01','0000-00-00','5000.00','6000.00','fhfhfh','rtrttr','dddww','wwdfwfw','tyytty','files/1336462615.docx','files/1250397488.docx','files/228933161.docx','2019-06-04 23:31:25','2019-06-05 10:37:19');
INSERT INTO employees VALUES('2','7','1222222','','','0000-00-00','','ffsdsfd','sfsfdfsg','444','Afghanistan','2','3','2019-06-27','0000-00-00','50.00','5000.00','','','','','','files/762782961.docx','files/2063924452.docx','files/242613064.docx','2019-06-04 23:46:42','2019-06-17 11:02:37');
INSERT INTO employees VALUES('3','8','65656','','','0000-00-00','','ytyy','tyt','ytyt','Albania','2','3','2019-06-05','0000-00-00','0.00','0.00','','','','','','','','','2019-06-04 23:49:27','2019-06-05 13:15:26');
INSERT INTO employees VALUES('4','9','1234566sssg','','','0000-00-00','','dffd','dd','343','American Samoa','1','1','2019-06-25','0000-00-00','0.00','0.00','','','','','','files/470495105.doc','','','2019-06-05 12:55:48','2019-06-17 11:02:24');
INSERT INTO employees VALUES('5','10','558757','','','0000-00-00','','yt','tyi','7656','Afghanistan','1','1','2019-06-05','2019-06-17','0.00','0.00','','','','','','','','','2019-06-05 13:01:20','2019-06-17 18:08:27');



DROP TABLE IF EXISTS expenses;

CREATE TABLE `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_from` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `date` date NOT NULL,
  `bill` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO expenses VALUES('2','erre','rere','666.00','2019-06-29','','2019-06-16 05:43:03','2019-06-16 05:43:03');
INSERT INTO expenses VALUES('3','dd','ddd','55.00','2019-06-16','files/1411962505.docx','2019-06-16 05:43:25','2019-06-16 05:43:25');
INSERT INTO expenses VALUES('4','43','3443','4.00','2019-06-05','files/2048986583.pdf','2019-06-16 15:46:28','2019-06-16 15:46:40');



DROP TABLE IF EXISTS holidays;

CREATE TABLE `holidays` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO holidays VALUES('1','jjjjj','2019-06-15','2019-06-14 08:47:15','2019-06-14 08:47:15');
INSERT INTO holidays VALUES('2','ppp','2019-07-02','2019-06-14 09:21:58','2019-06-14 09:21:58');
INSERT INTO holidays VALUES('3','Weekend Holiday','2019-01-06','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('4','Weekend Holiday','2019-01-13','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('5','Weekend Holiday','2019-01-20','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('6','Weekend Holiday','2019-01-27','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('7','Weekend Holiday','2019-02-03','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('8','Weekend Holiday','2019-02-10','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('9','Weekend Holiday','2019-02-17','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('10','Weekend Holiday','2019-02-24','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('11','Weekend Holiday','2019-03-03','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('12','Weekend Holiday','2019-03-10','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('13','Weekend Holiday','2019-03-17','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('14','Weekend Holiday','2019-03-24','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('15','Weekend Holiday','2019-03-31','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('16','Weekend Holiday','2019-04-07','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('17','Weekend Holiday','2019-04-14','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('18','Weekend Holiday','2019-04-21','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('19','Weekend Holiday','2019-04-28','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('20','Weekend Holiday','2019-05-05','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('21','Weekend Holiday','2019-05-12','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('22','Weekend Holiday','2019-05-19','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('23','Weekend Holiday','2019-05-26','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('24','Weekend Holiday','2019-06-02','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('25','Weekend Holiday','2019-06-09','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('26','Weekend Holiday','2019-06-16','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('27','Weekend Holiday','2019-06-23','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('28','Weekend Holiday','2019-06-30','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('29','Weekend Holiday','2019-07-07','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('30','Weekend Holiday','2019-07-14','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('31','Weekend Holiday','2019-07-21','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('32','Weekend Holiday','2019-07-28','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('33','Weekend Holiday','2019-08-04','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('34','Weekend Holiday','2019-08-11','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('35','Weekend Holiday','2019-08-18','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('36','Weekend Holiday','2019-08-25','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('37','Weekend Holiday','2019-09-01','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('38','Weekend Holiday','2019-09-08','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('39','Weekend Holiday','2019-09-15','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('40','Weekend Holiday','2019-09-22','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('41','Weekend Holiday','2019-09-29','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('42','Weekend Holiday','2019-10-06','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('43','Weekend Holiday','2019-10-13','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('44','Weekend Holiday','2019-10-20','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('45','Weekend Holiday','2019-10-27','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('46','Weekend Holiday','2019-11-03','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('47','Weekend Holiday','2019-11-10','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('48','Weekend Holiday','2019-11-17','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('49','Weekend Holiday','2019-11-24','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('50','Weekend Holiday','2019-12-01','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('51','Weekend Holiday','2019-12-08','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('52','Weekend Holiday','2019-12-15','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('53','Weekend Holiday','2019-12-22','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO holidays VALUES('54','Weekend Holiday','2019-12-29','2019-06-14 09:22:35','2019-06-14 09:22:35');



DROP TABLE IF EXISTS leave_applications;

CREATE TABLE `leave_applications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `absent_reason` varchar(140) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO leave_applications VALUES('1','1234566sss','2019-06-21','2','','1','2019-06-19 22:19:40','2019-06-20 21:27:52');
INSERT INTO leave_applications VALUES('2','1234566sss','2019-06-22','2','','1','2019-06-19 22:21:19','2019-06-20 21:27:46');
INSERT INTO leave_applications VALUES('3','1234566sss','2019-06-20','2','','2','2019-06-19 22:26:27','2019-06-20 21:25:47');
INSERT INTO leave_applications VALUES('4','1234566sss','2019-06-29','2','','1','2019-06-19 22:26:27','2019-06-20 21:17:33');



DROP TABLE IF EXISTS leave_types;

CREATE TABLE `leave_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `off_type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO leave_types VALUES('1','Sick','Full Day','Active','2019-06-08 21:58:34','2019-06-09 14:21:09');
INSERT INTO leave_types VALUES('2','Others','Half Day','In-Active','2019-06-08 21:58:48','2019-06-10 21:38:50');



DROP TABLE IF EXISTS migrations;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES('4','2014_10_12_000000_create_users_table','1');
INSERT INTO migrations VALUES('5','2014_10_12_100000_create_password_resets_table','1');
INSERT INTO migrations VALUES('6','2018_06_01_080940_create_settings_table','1');
INSERT INTO migrations VALUES('21','2019_06_04_211110_create_bank_details_table','2');
INSERT INTO migrations VALUES('22','2019_06_04_220019_create_documents_table','2');
INSERT INTO migrations VALUES('23','2019_05_31_377724_create_departments_table','3');
INSERT INTO migrations VALUES('24','2019_05_31_391262_create_notices_table','3');
INSERT INTO migrations VALUES('25','2019_06_01_222458_create_designations_table','3');
INSERT INTO migrations VALUES('28','2019_06_03_412130_create_employees_table','4');
INSERT INTO migrations VALUES('29','2019_06_06_843050_create_holidays_table','5');
INSERT INTO migrations VALUES('31','2019_06_07_161133_create_attendances_table','6');
INSERT INTO migrations VALUES('36','2019_06_08_601146_create_leave_types_table','7');
INSERT INTO migrations VALUES('38','2019_06_13_072011_create_expenses_table','8');
INSERT INTO migrations VALUES('39','2019_06_17_371962_create_leave_applications_table','9');
INSERT INTO migrations VALUES('46','2019_06_16_184935_create_awards_table','10');
INSERT INTO migrations VALUES('47','2019_06_18_280067_create_types_of_awards_table','10');
INSERT INTO migrations VALUES('49','2019_06_20_195244_create_notifications_table','11');



DROP TABLE IF EXISTS notices;

CREATE TABLE `notices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO notices VALUES('1','f','<p>f<br></p>','Active','2019-06-18 20:51:21','2019-06-18 20:51:21');
INSERT INTO notices VALUES('2','f','<p>f<br></p>','Active','2019-06-18 20:51:35','2019-06-18 20:51:35');



DROP TABLE IF EXISTS notifications;

CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO notifications VALUES('1','Leave request has been Approved.','1','0','2019-06-20 21:17:33','2019-06-20 21:17:33');
INSERT INTO notifications VALUES('2','Leave request has been Rejected.','6','0','2019-06-20 21:25:47','2019-06-20 21:25:47');
INSERT INTO notifications VALUES('3','Leave request has been Approved.','6','0','2019-06-20 21:27:46','2019-06-20 21:27:46');
INSERT INTO notifications VALUES('4','Leave request has been Approved.','6','0','2019-06-20 21:27:52','2019-06-20 21:27:52');



DROP TABLE IF EXISTS password_resets;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO password_resets VALUES('anthonyprobalgomez@gmail.com','$2y$10$6tYwQn4H3ifMzUHc9pJmfuUud6i/HcaM8DNpn.09BodBAjO8gNAwa','2019-05-31 21:06:41');



DROP TABLE IF EXISTS settings;

CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO settings VALUES('1','company_name','NoName','2019-05-30 22:53:58','2019-05-31 14:11:19');
INSERT INTO settings VALUES('2','site_title','NoName','2019-05-30 22:53:58','2019-05-31 14:11:19');
INSERT INTO settings VALUES('3','phone','+11111111','2019-05-30 22:53:58','2019-05-31 14:11:19');
INSERT INTO settings VALUES('4','email','anthonyprobalgomez@gmail.com','2019-05-30 22:53:58','2019-05-31 14:11:19');
INSERT INTO settings VALUES('5','currency_symbol','$','2019-05-30 22:53:58','2019-05-31 14:11:19');
INSERT INTO settings VALUES('6','timezone','America/Creston','2019-05-30 22:53:58','2019-05-31 14:11:19');
INSERT INTO settings VALUES('7','language','English','2019-05-30 22:53:58','2019-05-31 14:11:19');
INSERT INTO settings VALUES('8','address','yo','2019-05-30 22:53:58','2019-05-31 14:11:19');
INSERT INTO settings VALUES('9','logo','logo.png','2019-05-31 07:47:06','2019-05-31 08:08:21');
INSERT INTO settings VALUES('10','mail_driver','smtp','2019-05-31 14:40:43','2019-05-31 14:40:43');
INSERT INTO settings VALUES('11','from_email','anthonyprobalgomez@gmail.com','2019-05-31 14:40:43','2019-06-19 22:40:59');
INSERT INTO settings VALUES('12','from_name','Anthony','2019-05-31 14:40:43','2019-06-19 22:40:59');
INSERT INTO settings VALUES('13','mail_host','smtp.googlemail.com','2019-05-31 14:40:43','2019-05-31 14:40:43');
INSERT INTO settings VALUES('14','mail_port','465','2019-05-31 14:40:43','2019-05-31 14:40:43');
INSERT INTO settings VALUES('15','mail_username','anthonyprobalgomez@gmail.com','2019-05-31 14:40:43','2019-05-31 14:40:43');
INSERT INTO settings VALUES('16','mail_password','admin11','2019-05-31 14:40:43','2019-05-31 14:40:43');
INSERT INTO settings VALUES('17','mail_encryption','ssl','2019-05-31 14:40:43','2019-05-31 14:40:43');
INSERT INTO settings VALUES('18','mail_type','smtp','2019-05-31 14:50:45','2019-06-19 22:40:59');
INSERT INTO settings VALUES('19','smtp_host','smtp.googlemail.com','2019-05-31 14:50:45','2019-06-19 22:40:59');
INSERT INTO settings VALUES('20','smtp_port','465','2019-05-31 14:50:45','2019-06-19 22:40:59');
INSERT INTO settings VALUES('21','smtp_username','anthonyprobalgomez@gmail.com','2019-05-31 14:50:45','2019-06-19 22:40:59');
INSERT INTO settings VALUES('22','smtp_password','admin11','2019-05-31 14:50:45','2019-06-19 22:40:59');
INSERT INTO settings VALUES('23','smtp_encryption','tls','2019-05-31 14:50:45','2019-06-19 22:40:59');
INSERT INTO settings VALUES('26','weekend_holiday','0','2019-06-14 09:22:35','2019-06-14 09:22:35');
INSERT INTO settings VALUES('27','company_name','NoName','2019-06-22 06:40:38','2019-06-22 06:40:38');
INSERT INTO settings VALUES('28','site_title','NoName','2019-06-22 06:40:38','2019-06-22 06:40:38');
INSERT INTO settings VALUES('29','phone','+11111111','2019-06-22 06:40:38','2019-06-22 06:40:38');
INSERT INTO settings VALUES('30','email','anthonyprobalgomez@gmail.com','2019-06-22 06:40:38','2019-06-22 06:40:38');
INSERT INTO settings VALUES('31','address','yo','2019-06-22 06:40:38','2019-06-22 06:40:38');
INSERT INTO settings VALUES('32','currency_symbol','$','2019-06-22 06:40:38','2019-06-22 06:40:38');
INSERT INTO settings VALUES('33','timezone','America/Creston','2019-06-22 06:40:38','2019-06-22 06:40:38');
INSERT INTO settings VALUES('34','language','English','2019-06-22 06:40:38','2019-06-22 06:40:38');
INSERT INTO settings VALUES('35','company_name','NoName','2019-06-22 06:40:51','2019-06-22 06:40:51');
INSERT INTO settings VALUES('36','site_title','NoName','2019-06-22 06:40:51','2019-06-22 06:40:51');
INSERT INTO settings VALUES('37','phone','+111111111','2019-06-22 06:40:51','2019-06-22 06:40:51');
INSERT INTO settings VALUES('38','email','anthonyprobalgomez@gmail.com','2019-06-22 06:40:52','2019-06-22 06:40:52');
INSERT INTO settings VALUES('39','address','yo','2019-06-22 06:40:52','2019-06-22 06:40:52');
INSERT INTO settings VALUES('40','currency_symbol','$','2019-06-22 06:40:52','2019-06-22 06:40:52');
INSERT INTO settings VALUES('41','timezone','America/Creston','2019-06-22 06:40:52','2019-06-22 06:40:52');
INSERT INTO settings VALUES('42','language','English','2019-06-22 06:40:52','2019-06-22 06:40:52');



DROP TABLE IF EXISTS types_of_awards;

CREATE TABLE `types_of_awards` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO types_of_awards VALUES('1','BEST EMPLOYEE OF THE YEAR','Active','2019-06-19 18:15:34','2019-06-19 18:15:34');



DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'users/profile.png',
  `status` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES('1','Anthony Probal','Gomez','anthonyprobalgomez@gmail.com','$2y$10$omBbaKdnGUWzwwUxuj.1pOFqLa54EU/VHkmI.EZ6lZyRxOvoiU7qu','Admin','users/1559938610.png','1','0000-00-00 00:00:00','PYYg8fLWaFde2FILYCLXNwOlGv9dAVJmVuehLHhMPo0suWgEUNBPkMO1GSxt','2019-05-30 22:02:35','2019-06-07 20:16:50');
INSERT INTO users VALUES('4','Anthony Probal','Gomez','anthonyprobalgomes@gmail.com','$2y$10$u3XI1KMAnq4Qg9Ml89XQ7ukSJ/a3pUQxihGetIZwTzW/xQRBa.ZWm','Admin','employees/1559690615.png','1','0000-00-00 00:00:00','','2019-06-04 23:23:35','2019-06-04 23:23:35');
INSERT INTO users VALUES('5','Anthony Probal','Gomez','anthonyprobalgomess@gmail.com','$2y$10$hnL9Vu49RG0c0SFWcSwVdOIe2fw2/Bd/ImhlMz7MJwIaejRRFq1HC','Admin','employees/1559690795.png','In-Active','0000-00-00 00:00:00','','2019-06-04 23:26:35','2019-06-19 21:31:41');
INSERT INTO users VALUES('6','Anthony Probal','Gomezs','anthonyprobalgomessa@gmail.com','$2y$10$TEsvAE2DnYuFnAslANq6P.HPeY627SyNlbeY88LcmpMxa95v7ml6q','Employee','employees/1559691084.png','Active','0000-00-00 00:00:00','','2019-06-04 23:31:25','2019-06-05 10:37:19');
INSERT INTO users VALUES('7','teeee','eerreq','anthonydarpongomez@gmail.com','admin11','Employee','employees/1559692002.png','Active','0000-00-00 00:00:00','','2019-06-04 23:46:42','2019-06-17 11:02:37');
INSERT INTO users VALUES('8','trrtrt','rtr','anthonydarpongomezt@gmail.com','$2y$10$oPi5kSU0ck8aqSph/LPzl.ZPxYvkNakystWu8Q/h7F9zGjSIhszDq','Employee','profile.png','Active','0000-00-00 00:00:00','','2019-06-04 23:49:27','2019-06-05 13:15:26');
INSERT INTO users VALUES('9','dddd','ddddd','anthony@gmail.comw','$2y$10$fvYZG9RnwtufB3Yihg7TbeV8Uxbsig8PzW48..ZWcnHQngSsOfbMS','Employee','employees/1559739348.jpg','Active','0000-00-00 00:00:00','','2019-06-05 12:55:48','2019-06-17 11:02:24');
INSERT INTO users VALUES('10','tyyyyyy','tyyyyyyy','anthonydarpongomez@gmail.comyy','$2y$10$drhL7RmQjTkL2/rgfuRHIeEMYOONWg2OmVGZtoAzdmqn1kLbGwEKm','Employee','profile.png','In-Active','0000-00-00 00:00:00','','2019-06-05 13:01:20','2019-06-17 18:08:27');



