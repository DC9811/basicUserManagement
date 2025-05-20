-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table management_system.migrations: ~2 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2025_05_10_051232_create_users_table', 1),
	(2, '2025_05_10_052931_create_roles_table', 1);

-- Dumping data for table management_system.roles: ~2 rows (approximately)
INSERT INTO `roles` (`role_id`, `role_name`) VALUES
	(1, 'Admin'),
	(2, 'User');

-- Dumping data for table management_system.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `name`, `role_id`, `email`, `password`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Admin', 1, 'admin@admin.com', '$2y$12$AR2oRdxgLutP2TLONFfnR.mjAsMucyA.3lM4zcnotIlbBAvuLL5qq', NULL, '2025-05-11 22:07:04', NULL, NULL),
	(2, 'User', 2, 'user@user.com', '$2y$12$ja.c11eRNGEV27UhOiOmRuEnQ4h1Wfjxh05NPJpVV.pFEdI9oqUky', NULL, '2025-05-12 16:51:49', NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
