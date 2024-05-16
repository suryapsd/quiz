/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.27-MariaDB : Database - u1738950_adm_quiz
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`u1738950_adm_quiz` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `u1738950_adm_quiz`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `instansis` */

DROP TABLE IF EXISTS `instansis`;

CREATE TABLE `instansis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_instansi` varchar(255) DEFAULT NULL,
  `min_tinggi_badan` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `instansis` */

insert  into `instansis`(`id`,`nama_instansi`,`min_tinggi_badan`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'STAN','180',NULL,NULL,NULL),
(2,'POLRI','180',NULL,NULL,NULL),
(3,'STIS','170','2023-12-10 13:56:33','2023-12-10 13:56:23','2023-12-10 13:56:33');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(37,'2014_10_12_000000_create_users_table',1),
(38,'2014_10_12_100000_create_password_reset_tokens_table',1),
(39,'2019_08_19_000000_create_failed_jobs_table',1),
(40,'2019_12_14_000001_create_personal_access_tokens_table',1),
(41,'2023_11_28_022912_create_sekolahs_table',1),
(42,'2023_11_28_022913_create_siswas_table',1),
(43,'2023_11_28_023004_create_instansis_table',1),
(44,'2023_11_28_023122_create_pendidikan_instansis_table',1),
(45,'2023_11_28_024245_create_soal_tes_lanjutans_table',1),
(46,'2023_11_28_024251_create_soal_tes_awals_table',1),
(47,'2023_11_28_065721_create_jenis_soals_table',1),
(48,'2023_11_28_065722_create_soals_table',1);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `pendidikan_instansis` */

DROP TABLE IF EXISTS `pendidikan_instansis`;

CREATE TABLE `pendidikan_instansis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_instansi` bigint(20) unsigned DEFAULT NULL,
  `nama_pendidikan` varchar(255) DEFAULT NULL,
  `min_tinggi_badan` varchar(255) DEFAULT NULL,
  `min_nilai_tes_lanjutan` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pendidikan_instansis_id_instansi_foreign` (`id_instansi`),
  CONSTRAINT `pendidikan_instansis_id_instansi_foreign` FOREIGN KEY (`id_instansi`) REFERENCES `instansis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pendidikan_instansis` */

insert  into `pendidikan_instansis`(`id`,`id_instansi`,`nama_pendidikan`,`min_tinggi_badan`,`min_nilai_tes_lanjutan`,`deleted_at`,`created_at`,`updated_at`) values 
(1,1,'Akuntansi','180','100',NULL,'2023-12-10 12:50:57','2023-12-10 12:50:57'),
(2,2,'Satpam','180','80','2023-12-10 13:56:54','2023-12-10 13:56:50','2023-12-10 13:56:54'),
(3,2,'Coba','180','90',NULL,'2023-12-10 13:57:26','2023-12-10 13:57:36');

/*Table structure for table `jenis_soals` */

DROP TABLE IF EXISTS `jenis_soals`;

CREATE TABLE `jenis_soals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_pendidikan_instansi` bigint(20) unsigned DEFAULT NULL,
  `jumlah_soal` int(50) DEFAULT NULL,
  `nama_jenis_soal` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jenis_soals_id_pendidikan_instansi_foreign` (`id_pendidikan_instansi`),
  CONSTRAINT `jenis_soals_id_pendidikan_instansi_foreign` FOREIGN KEY (`id_pendidikan_instansi`) REFERENCES `pendidikan_instansis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jenis_soals` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `sekolahs` */

DROP TABLE IF EXISTS `sekolahs`;

CREATE TABLE `sekolahs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_sekolah` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sekolahs` */

insert  into `sekolahs`(`id`,`nama_sekolah`,`alamat`,`keterangan`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'Sma 1','Bale Bali 80571, Ubud, Gianyar',NULL,'2023-12-10 13:58:25','2023-12-10 13:57:51','2023-12-10 13:58:25'),
(2,'aa','aa','aa','2023-12-10 13:58:35','2023-12-10 13:58:31','2023-12-10 13:58:35'),
(3,'SMA 1','Ds. Peliatan Jl. Bima, Ubud, Gianyar','aaa',NULL,'2023-12-10 14:00:46','2023-12-10 14:00:46');

/*Table structure for table `soal_tes_awals` */

DROP TABLE IF EXISTS `soal_tes_awals`;

CREATE TABLE `soal_tes_awals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_instansi` bigint(20) unsigned DEFAULT NULL,
  `soal` text DEFAULT NULL,
  `jawaban_a` text DEFAULT NULL,
  `jawaban_b` text DEFAULT NULL,
  `jawaban_c` text DEFAULT NULL,
  `jawaban_d` text DEFAULT NULL,
  `kunci_jawaban` enum('A','B','C','D') DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `soal_tes_awals_id_instansi_foreign` (`id_instansi`),
  CONSTRAINT `soal_tes_awals_id_instansi_foreign` FOREIGN KEY (`id_instansi`) REFERENCES `instansis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `soal_tes_awals` */

insert  into `soal_tes_awals`(`id`,`id_instansi`,`soal`,`jawaban_a`,`jawaban_b`,`jawaban_c`,`jawaban_d`,`kunci_jawaban`,`deleted_at`,`created_at`,`updated_at`) values 
(2,1,'<p>Pemerintah Uni Eropa telah mencapai kesepakatan awal untuk melarang impor minyak mentah Iran ke Uni Eropa tetapi belum memutuskan kapan embargo akan dilakukan, diplomat Uni Eropa mengatakan pada hari Rabu. Komisioner Energi Uni Eropa Guenther Oettinger telah mengatakan bahwa jika ada larangan impor Iran, pasokan bisa dibeli dari tempat lain, terutama anggota OPEC terkemuka, Arab Saudi.</p>\r\n\r\n<p><img alt=\"\" src=\"http://127.0.0.1:8000/images/image%208_1702188118.png\" /></p>\r\n\r\n<p>perhatikan gambar diatas</p>','<p>a</p>','<p>b</p>','<p>c</p>','<p>d</p>','B',NULL,'2023-12-10 14:05:51','2023-12-10 14:05:51');

/*Table structure for table `soal_tes_lanjutans` */

DROP TABLE IF EXISTS `soal_tes_lanjutans`;

CREATE TABLE `soal_tes_lanjutans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_pendidikan_instansi` bigint(20) unsigned DEFAULT NULL,
  `soal` text DEFAULT NULL,
  `jawaban_a` text DEFAULT NULL,
  `jawaban_b` text DEFAULT NULL,
  `jawaban_c` text DEFAULT NULL,
  `jawaban_d` text DEFAULT NULL,
  `kunci_jawaban` enum('A','B','C','D') DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `soal_tes_lanjutans_id_instansi_foreign` (`id_pendidikan_instansi`),
  CONSTRAINT `soal_tes_lanjutans_id_pendidikan_instansi_foreign` FOREIGN KEY (`id_pendidikan_instansi`) REFERENCES `pendidikan_instansis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `soal_tes_lanjutans` */

insert  into `soal_tes_lanjutans`(`id`,`id_pendidikan_instansi`,`soal`,`jawaban_a`,`jawaban_b`,`jawaban_c`,`jawaban_d`,`kunci_jawaban`,`deleted_at`,`created_at`,`updated_at`) values 
(3,1,'<p>Perhatikan gambar berikut</p>\r\n\r\n<p><img alt=\"\" src=\"http://127.0.0.1:8000/images/image%207_1702188230.png\" /></p>\r\n\r\n<p>Pemerintah Uni Eropa telah mencapai kesepakatan awal untuk melarang impor minyak mentah Iran ke Uni Eropa tetapi belum memutuskan kapan embargo akan dilakukan, diplomat Uni Eropa mengatakan pada hari Rabu. Komisioner Energi Uni Eropa Guenther Oettinger telah mengatakan bahwa jika ada larangan impor Iran, pasokan bisa dibeli dari tempat lain, terutama anggota OPEC terkemuka, Arab Saudi.aaa</p>','<p>a</p>','<p>b</p>','<p>c</p>','<p>d</p>','B',NULL,'2023-12-10 14:04:29','2023-12-10 14:04:29');

/*Table structure for table `soals` */

DROP TABLE IF EXISTS `soals`;

CREATE TABLE `soals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_jenis_soal` bigint(20) unsigned DEFAULT NULL,
  `soal` text DEFAULT NULL,
  `jawaban_a` text DEFAULT NULL,
  `jawaban_b` text DEFAULT NULL,
  `jawaban_c` text DEFAULT NULL,
  `jawaban_d` text DEFAULT NULL,
  `kunci_jawaban` enum('A','B','C','D') DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `soals_id_jenis_soal_foreign` (`id_jenis_soal`),
  CONSTRAINT `soals_id_jenis_soal_foreign` FOREIGN KEY (`id_jenis_soal`) REFERENCES `jenis_soals` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `soals` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`email`,`role`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'admin','admin@gmail.com','admin',NULL,'$2y$12$YxklVcO9eDoeGreoac4LPeAbgY36jJwvm8PbnIDo292VOZABPsttS',NULL,NULL,NULL);

/*Table structure for table `siswas` */

DROP TABLE IF EXISTS `siswas`;

CREATE TABLE `siswas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) unsigned DEFAULT NULL,
  `id_sekolah` bigint(20) unsigned DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_wa` varchar(255) DEFAULT NULL,
  `tinggi_badan` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `siswas_id_user_foreign` (`id_user`),
  KEY `siswas_id_sekolah_foreign` (`id_sekolah`),
  CONSTRAINT `siswas_id_sekolah_foreign` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolahs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `siswas_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `siswas` */

/*Table structure for table `operators` */

DROP TABLE IF EXISTS `operators`;

CREATE TABLE `operators` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) unsigned DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_telepon` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `operators_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `operators` */

insert  into `operators`(`id`,`id_user`,`nama`,`no_telepon`,`alamat`,`updated_at`,`created_at`) values 
(7,1,'admin','08111111111','admin','2023-12-05 12:45:06','2023-12-05 12:45:06');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
