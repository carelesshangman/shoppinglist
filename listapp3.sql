-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: listapp
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2024_03_24_011102_create_shopping_items_table',1),(2,'2024_03_24_013026_create_sessions_table',2),(3,'2014_10_12_100000_create_password_resets_table',3),(11,'2024_03_28_161557_create_users_table',4),(12,'2024_03_28_232634_reposition_list_id_and_add_foreign_key_to_shopping_items_table',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('HOC9hXuVbHRMQT63B8UBVWYL6gg7fTh7aZph7jKY',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVlpkc05ET1dlWG9lMDFOeGRYM29wT1JHYm80aHpad1FOcW0yWkFTaiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9saXN0cy9RclFLIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9',1711730747),('qVikTgy2UBw0mSaJDoNGH0yyJpVYCLCVHYbha0Su',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 OPR/107.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQUhFQXVmYmk3WmRlV0V3emxrVE03QUNEczNqRmZzakxZakZNdWVxSSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbGlzdHMvUXJRSyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1711730749);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shopping_items`
--

DROP TABLE IF EXISTS `shopping_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shopping_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `list_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `purchased` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `list_id` (`list_id`),
  CONSTRAINT `shopping_items_ibfk_1` FOREIGN KEY (`list_id`) REFERENCES `shopping_lists` (`share_code`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shopping_items`
--

LOCK TABLES `shopping_items` WRITE;
/*!40000 ALTER TABLE `shopping_items` DISABLE KEYS */;
INSERT INTO `shopping_items` VALUES (2,'Z3zo','Milk',2,0,NULL,NULL),(3,'Z3zo','Jaka German',1,0,'2024-03-29 04:06:44','2024-03-29 04:06:44'),(4,'CJMD','Jaka German',1,0,'2024-03-29 04:06:55','2024-03-29 04:06:55'),(5,'CJMD','Jaka German',1,0,'2024-03-29 04:08:45','2024-03-29 04:08:45'),(6,'CJMD','customrpc',1,0,'2024-03-29 04:09:21','2024-03-29 04:09:21'),(7,'CJMD','Jaka German',1,0,'2024-03-29 04:10:37','2024-03-29 04:10:37'),(8,'CJMD','Jaka German',1,0,'2024-03-29 04:11:28','2024-03-29 04:11:28'),(9,'CJMD','Jaka German',1,0,'2024-03-29 04:12:10','2024-03-29 04:12:10'),(10,'CJMD','Jaka German',1,0,'2024-03-29 04:13:05','2024-03-29 04:13:05'),(11,'CJMD','Jaka German',1,0,'2024-03-29 04:14:21','2024-03-29 04:14:21'),(12,'CJMD','Jaka German',1,0,'2024-03-29 04:18:18','2024-03-29 04:18:18'),(13,'CJMD','customrpc',1,0,'2024-03-29 04:21:37','2024-03-29 04:21:37'),(14,'CJMD','Jaka German',1,0,'2024-03-29 04:22:21','2024-03-29 04:22:21'),(15,'Cpuk','awdawd',1,0,'2024-03-29 04:22:36','2024-03-29 04:22:36'),(16,'Cpuk','awdawd',1,0,'2024-03-29 04:24:18','2024-03-29 04:24:18'),(17,'Cpuk','awdawd',1,0,'2024-03-29 04:26:35','2024-03-29 04:26:35'),(18,'Cpuk','Jaka German',1,0,'2024-03-29 04:34:59','2024-03-29 04:34:59'),(19,'Cpuk','Jaka German',1,0,'2024-03-29 04:35:25','2024-03-29 04:35:25'),(20,'Cpuk','Jaka German',1,0,'2024-03-29 04:38:01','2024-03-29 04:38:01'),(23,'ZWV1','customrpc',1,0,'2024-03-29 13:42:52','2024-03-29 13:42:52'),(24,'bkju','test@test.com',1,0,'2024-03-29 14:15:15','2024-03-29 14:15:15'),(25,'ZWV1','test@test.com',1,0,'2024-03-29 14:19:04','2024-03-29 14:19:04'),(26,'CC1t','awd',1,0,'2024-03-29 14:35:38','2024-03-29 14:35:38'),(27,'mSDN','customrpc',1,0,'2024-03-29 14:36:15','2024-03-29 14:39:42'),(30,'QrQK','awdawd',1,0,'2024-03-29 15:41:45','2024-03-29 15:42:40');
/*!40000 ALTER TABLE `shopping_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shopping_lists`
--

DROP TABLE IF EXISTS `shopping_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shopping_lists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `owner` varchar(255) NOT NULL,
  `share_code` varchar(255) NOT NULL,
  `is_shared` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `share_code` (`share_code`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shopping_lists`
--

LOCK TABLES `shopping_lists` WRITE;
/*!40000 ALTER TABLE `shopping_lists` DISABLE KEYS */;
INSERT INTO `shopping_lists` VALUES (1,'doesnt@exist.true','KRoU',0,'2024-03-29 03:22:22','2024-03-29 14:30:23'),(2,'doesnt@exist.true','qj7U',0,'2024-03-29 03:27:00','2024-03-29 14:30:25'),(3,'doesnt@exist.true','5sqL',0,'2024-03-29 03:31:59','2024-03-29 14:30:25'),(4,'doesnt@exist.true','c6Ct',0,'2024-03-29 03:33:21','2024-03-29 14:30:30'),(5,'doesnt@exist.true','R5mw',0,'2024-03-29 03:36:11','2024-03-29 14:30:31'),(6,'doesnt@exist.true','1o4z',0,'2024-03-29 03:36:17','2024-03-29 14:30:32'),(7,'doesnt@exist.true','Z3zo',0,'2024-03-29 03:38:28','2024-03-29 14:30:32'),(8,'doesnt@exist.true','eV3L',0,'2024-03-29 03:41:32','2024-03-29 14:30:33'),(9,'doesnt@exist.true','pwcO',0,'2024-03-29 03:42:27','2024-03-29 14:30:34'),(10,'doesnt@exist.true','Lkrn',0,'2024-03-29 03:45:37','2024-03-29 14:30:35'),(11,'doesnt@exist.true','CJMD',0,'2024-03-29 03:46:50','2024-03-29 14:30:36'),(12,'doesnt@exist.true','Cpuk',0,'2024-03-29 04:22:34','2024-03-29 14:30:36'),(13,'doesnt@exist.true','ZWV1',0,'2024-03-29 04:38:29','2024-03-29 14:30:37'),(14,'doesnt@exist.true','mSDN',0,'2024-03-29 13:43:01','2024-03-29 15:39:56'),(15,'test@test.com','bkju',0,'2024-03-29 14:15:12','2024-03-29 14:15:12'),(16,'doesnt@exist.true','zPv4',0,'2024-03-29 14:31:21','2024-03-29 15:39:56'),(17,'doesnt@exist.true','CC1t',0,'2024-03-29 14:33:11','2024-03-29 15:39:57'),(18,'doesnt@exist.true','8LUf',0,'2024-03-29 14:33:15','2024-03-29 15:39:58'),(19,'jaka.german@gmail.com','QrQK',0,'2024-03-29 15:40:20','2024-03-29 15:40:20');
/*!40000 ALTER TABLE `shopping_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Jaka German','jaka.german@gmail.com',NULL,'$2y$12$sFldG.YRriwChYggwtDq7eGKhFi6BSSHIJwrExZrudHNUoqETjrB6',NULL,'2024-03-28 22:30:33','2024-03-28 22:30:33'),(2,'test@test.com','test@test.com',NULL,'$2y$12$R2Srw7Ssh16.1MXjm/oXsOQiUywkLOUG/dF7fheBi2ieY6g5PggTa',NULL,'2024-03-29 14:15:02','2024-03-29 14:15:02');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-29 17:55:38
