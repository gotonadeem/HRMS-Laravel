DROP TABLE IF EXISTS migrations;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES('4','2014_10_12_000000_create_users_table','1');
INSERT INTO migrations VALUES('5','2014_10_12_100000_create_password_resets_table','1');
INSERT INTO migrations VALUES('6','2018_06_01_080940_create_settings_table','1');



DROP TABLE IF EXISTS password_resets;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS settings;

CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO settings VALUES('1','company_name','NoName','2019-05-30 22:53:58','2019-05-31 08:03:29');
INSERT INTO settings VALUES('2','site_title','NoName','2019-05-30 22:53:58','2019-05-31 08:03:29');
INSERT INTO settings VALUES('3','phone','+11111111','2019-05-30 22:53:58','2019-05-31 08:03:29');
INSERT INTO settings VALUES('4','email','anthonyprobalgomez@gmail.com','2019-05-30 22:53:58','2019-05-31 08:03:29');
INSERT INTO settings VALUES('5','currency_symbol','$','2019-05-30 22:53:58','2019-05-31 08:03:29');
INSERT INTO settings VALUES('6','timezone','America/Creston','2019-05-30 22:53:58','2019-05-31 08:03:29');
INSERT INTO settings VALUES('7','language','English','2019-05-30 22:53:58','2019-05-31 08:03:29');
INSERT INTO settings VALUES('8','address','yo','2019-05-30 22:53:58','2019-05-31 08:03:29');
INSERT INTO settings VALUES('9','logo','logo.png','2019-05-31 07:47:06','2019-05-31 07:55:06');



DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'users/profile.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES('1','Anthony Probal','Gomez','anthonyprobalgomez@gmail.com','$2y$10$o1rNgekm2q2vi9xwOigSLewRa6d6SpAZW8u.Hj4Xtvpe6R/PnCehe','Admin','users/1559253754.png','','','2019-05-30 22:02:35','2019-05-30 22:02:35');



