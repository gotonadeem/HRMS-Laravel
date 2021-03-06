DROP TABLE IF EXISTS departments;

CREATE TABLE `departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `department` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO departments VALUES('1','PHP','Active','2019-06-03 16:22:15','2019-06-03 18:26:20');



DROP TABLE IF EXISTS designations;

CREATE TABLE `designations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO designations VALUES('2','1','frontend','2019-06-03 16:22:15','2019-06-03 18:26:20');
INSERT INTO designations VALUES('5','1','backend','2019-06-03 18:14:43','2019-06-03 18:26:20');



DROP TABLE IF EXISTS employees;

CREATE TABLE `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `father_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` int(11) NOT NULL,
  `designation` int(11) NOT NULL,
  `joining_date` date NOT NULL,
  `exit_date` date DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_employee_id_unique` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS migrations;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES('4','2014_10_12_000000_create_users_table','1');
INSERT INTO migrations VALUES('5','2014_10_12_100000_create_password_resets_table','1');
INSERT INTO migrations VALUES('6','2018_06_01_080940_create_settings_table','1');
INSERT INTO migrations VALUES('11','2019_05_31_377724_create_departments_table','2');
INSERT INTO migrations VALUES('12','2019_05_31_391262_create_notices_table','2');
INSERT INTO migrations VALUES('13','2019_06_01_222458_create_designations_table','2');
INSERT INTO migrations VALUES('15','2019_06_03_412130_create_employees_table','3');



DROP TABLE IF EXISTS notices;

CREATE TABLE `notices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO notices VALUES('1','new news','<p>ddddd<br></p>','In-Active','2019-06-03 10:57:34','2019-06-03 10:57:43');



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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
INSERT INTO settings VALUES('11','from_email','anthonyprobalgomez@gmail.com','2019-05-31 14:40:43','2019-06-02 20:13:43');
INSERT INTO settings VALUES('12','from_name','Anthony','2019-05-31 14:40:43','2019-06-02 20:13:43');
INSERT INTO settings VALUES('13','mail_host','smtp.googlemail.com','2019-05-31 14:40:43','2019-05-31 14:40:43');
INSERT INTO settings VALUES('14','mail_port','465','2019-05-31 14:40:43','2019-05-31 14:40:43');
INSERT INTO settings VALUES('15','mail_username','anthonyprobalgomez@gmail.com','2019-05-31 14:40:43','2019-05-31 14:40:43');
INSERT INTO settings VALUES('16','mail_password','admin11','2019-05-31 14:40:43','2019-05-31 14:40:43');
INSERT INTO settings VALUES('17','mail_encryption','ssl','2019-05-31 14:40:43','2019-05-31 14:40:43');
INSERT INTO settings VALUES('18','mail_type','mail','2019-05-31 14:50:45','2019-06-02 20:13:42');
INSERT INTO settings VALUES('19','smtp_host','smtp.googlemail.com','2019-05-31 14:50:45','2019-05-31 20:57:22');
INSERT INTO settings VALUES('20','smtp_port','465','2019-05-31 14:50:45','2019-05-31 20:57:22');
INSERT INTO settings VALUES('21','smtp_username','anthonyprobalgomez@gmail.com','2019-05-31 14:50:45','2019-05-31 20:57:22');
INSERT INTO settings VALUES('22','smtp_password','admin11','2019-05-31 14:50:45','2019-05-31 20:57:22');
INSERT INTO settings VALUES('23','smtp_encryption','tls','2019-05-31 14:50:45','2019-05-31 20:57:22');



DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'users/profile.png',
  `status` int(11) DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES('1','Anthony Probal','Gomez','anthonyprobalgomez@gmail.com','$2y$10$omBbaKdnGUWzwwUxuj.1pOFqLa54EU/VHkmI.EZ6lZyRxOvoiU7qu','Admin','users/1559253754.png','1','','H8Kbmxoj33w4o0TGKp7hbBlh5yo6LC0IUQBNXQ49ys9bTUd3RBKsFihrJw4T','2019-05-30 22:02:35','2019-05-31 19:57:59');



