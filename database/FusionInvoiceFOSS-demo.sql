-- CREATE DATABASE  IF NOT EXISTS `FusionInvoiceFOSS-demo` /*!40100 DEFAULT CHARACTER SET latin1 */;
-- USE `FusionInvoiceFOSS-demo`;
-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: demo    Database: FusionInvoiceFOSS-demo
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `audit_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `audit_id` int(11) NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activities_parent_id_index` (`audit_id`),
  KEY `activities_object_index` (`audit_type`),
  KEY `activities_activity_index` (`activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addons`
--

DROP TABLE IF EXISTS `addons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `navigation_menu` longtext COLLATE utf8mb4_unicode_ci,
  `system_menu` longtext COLLATE utf8mb4_unicode_ci,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '0',
  `navigation_reports` longtext COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addons`
--

LOCK TABLES `addons` WRITE;
/*!40000 ALTER TABLE `addons` DISABLE KEYS */;
/*!40000 ALTER TABLE `addons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attachments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `attachable_id` int(11) NOT NULL,
  `attachable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mimetype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `url_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_visibility` int(11) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_attachments_users1_idx` (`user_id`),
  CONSTRAINT `fk_attachments_users1_idx` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachments`
--

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unique_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_unique_name_index` (`unique_name`),
  KEY `clients_active_index` (`active`),
  KEY `clients_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Gabrielle Batz','829 Emmalee Square','Funkshire','RI','11479-3994',NULL,'(867) 148-6115',NULL,NULL,'barton59@example.org',NULL,'rliDFilyPkrpsaGMq3bPzE6Vvy0IVABm',1,'USD','Gabrielle Batz','en',NULL,'2018-11-25 15:44:15','2018-11-25 15:44:15'),(2,'Matilda Waters','3720 Darby Avenue','Lake Allenestad','HI','60485-8943',NULL,'(863) 100-9278',NULL,NULL,'thessel@example.com',NULL,'Zgw8kLuBht0Ryrc9hvFJLbbctoKsphom',1,'USD','Matilda Waters','en',NULL,'2018-11-25 15:44:15','2018-11-25 15:44:15'),(3,'Betty Wilderman','82863 Fritsch Field Suite 133','East Royal','CT','79927-6478',NULL,'(916) 442-2921',NULL,NULL,'marcelina64@example.com',NULL,'uPZX2DRAGZxIi9OgVd7FooZ0Kc6zdU2b',1,'USD','Betty Wilderman','en',NULL,'2018-11-25 15:44:15','2018-11-25 15:44:15'),(4,'Darius Pouros','155 Chandler Circle','Schoenburgh','VA','62180',NULL,'(080) 491-7807',NULL,NULL,'narciso.mraz@example.net',NULL,'EymKnBTAtjnbiPGjWlujM3ygvFPUHPpR',1,'USD','Darius Pouros','en',NULL,'2018-11-25 15:44:15','2018-11-25 15:44:15'),(5,'Jermey Connelly','14305 Grady Points Suite 715','New Kathleenhaven','MI','75921-1943',NULL,'(329) 443-8122',NULL,NULL,'iberge@example.com',NULL,'e2Gh5gd1GUq5a1xAqsA2p2Q86E8KPlOH',1,'USD','Jermey Connelly','en',NULL,'2018-11-25 15:44:15','2018-11-25 15:44:15'),(6,'Emmanuel Keeling','178 Payton Knolls','Cordeliaview','LA','93201',NULL,'(680) 506-0091',NULL,NULL,'jett.murphy@example.org',NULL,'VU4PVGYhOCsciNyHHlQ8mXWqOB0N3je9',1,'USD','Emmanuel Keeling','en',NULL,'2018-11-25 15:44:15','2018-11-25 15:44:15'),(7,'Muhammad Jerde','39059 Pagac Estate Apt. 909','New Nova','AZ','76297',NULL,'(910) 094-4877',NULL,NULL,'mary85@example.org',NULL,'yccCJDYXeca6TXNeCMPptKZz94lvscWj',1,'USD','Muhammad Jerde','en',NULL,'2018-11-25 15:44:15','2018-11-25 15:44:15'),(8,'Rubye Kassulke','4523 Kohler Rue','Mayertmouth','MS','08963-9875',NULL,'(485) 535-6808',NULL,NULL,'alexandre96@example.org',NULL,'Dyi5tnLrOCt4zotoOClRflcNFLIVPRRF',1,'USD','Rubye Kassulke','en',NULL,'2018-11-25 15:44:15','2018-11-25 15:44:15'),(9,'Demetrius O\'Connell','68316 O\'Reilly Streets','Rauburgh','IA','28854-9624',NULL,'(625) 681-2700',NULL,NULL,'kstrosin@example.net',NULL,'FeCtgV8xAJnwY3JkAiveSZpsqXNTk5m7',1,'USD','Demetrius O\'Connell','en',NULL,'2018-11-25 15:44:15','2018-11-25 15:44:15'),(10,'Mikayla Wintheiser','24037 Crona Station Apt. 767','West Ubaldo','VT','51232-9837',NULL,'(521) 770-5682',NULL,NULL,'sheila89@example.net',NULL,'o3HNPdYH2EzI0twTzWHr1oDMBkAQnXxS',1,'USD','Mikayla Wintheiser','en',NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(11,'Clyde Hill','409 Strosin Gardens Apt. 858','Port Bethel','AL','79947',NULL,'(596) 039-5284',NULL,NULL,'hermann.maureen@example.com',NULL,'AwrytbqK6zsTs6L4aZDBohvsdwSwyL08',1,'USD','Clyde Hill','en',NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(12,'Eulah Bergstrom','30188 Beer River Apt. 602','Port Gussie','CA','28700-8269',NULL,'(884) 979-0823',NULL,NULL,'johnathan76@example.com',NULL,'MEXlY1ZmxaTtEzcdDyCPdtzT5JI45DUO',1,'USD','Eulah Bergstrom','en',NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(13,'Bailee Runolfsdottir','2522 Farrell Key','Keaganport','TN','86833-9968',NULL,'(999) 396-8834',NULL,NULL,'lulu.labadie@example.com',NULL,'7OEYK4z3CmQdOjtPo9XUiYkfwkYh158C',1,'USD','Bailee Runolfsdottir','en',NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(14,'Dorcas Crooks','412 Lula Brooks Apt. 294','Port Jordy','NV','65937-5682',NULL,'(250) 881-5288',NULL,NULL,'mateo54@example.org',NULL,'ASCsaqIUEgIlM891zKFJOQ5YtTgzJ0gk',1,'USD','Dorcas Crooks','en',NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(15,'Shyann Koss','457 Kling Groves Suite 016','New Benton','DE','41625',NULL,'(869) 172-5883',NULL,NULL,'monahan.sabryna@example.com',NULL,'52bIBGwQNxu3oYIwEGAw453rvydViuqB',1,'USD','Shyann Koss','en',NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(16,'Flavio Robel','914 Emely View Suite 616','North Easter','MS','06081-8985',NULL,'(426) 990-7094',NULL,NULL,'ebert.shanel@example.com',NULL,'sOyjRUiGsk9OwkZtOFMmYYWMyNp1QhRb',1,'USD','Flavio Robel','en',NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(17,'Corene Schulist','624 Shea Ports','Randyhaven','LA','41029',NULL,'(306) 131-3828',NULL,NULL,'sophie.white@example.org',NULL,'oudc1WZgBJCMfKPHj8fsjmbdMzp5aGTl',1,'USD','Corene Schulist','en',NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(18,'Presley Robel','41007 Walker Viaduct Suite 319','Juliethaven','SD','28694',NULL,'(971) 420-0690',NULL,NULL,'cooper.lehner@example.org',NULL,'NgyBQgBeTwkIcZCdAVRIkKAb6YGW23P0',1,'USD','Presley Robel','en',NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(19,'Colleen Olson','421 Becker Drives','North Barbarashire','WY','22658',NULL,'(887) 336-2087',NULL,NULL,'sarai81@example.net',NULL,'r2Cj5hTFC7yUvHVyfdvOGn8RFzccWtzK',1,'USD','Colleen Olson','en',NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(20,'Jany Marvin','5789 Orpha Walks Suite 973','Port Fernstad','FL','38131-8244',NULL,'(231) 211-7849',NULL,NULL,'claude17@example.net',NULL,'0iPBLnaJTn8JmGhYhxu7xp9CQUKpVgVp',1,'USD','Jany Marvin','en',NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(21,'Petra Schaden','126 Little Run Apt. 534','Gladysland','MA','57191-8129',NULL,'(273) 120-3022',NULL,NULL,'katrina.lowe@example.org',NULL,'vX2sLyTy5h6wgjXkN8dt0ls6wYzrBgP9',1,'USD','Petra Schaden','en',NULL,'2018-11-25 15:44:17','2018-11-25 15:44:17'),(22,'Colt Bergstrom','525 Bailey Rapid Apt. 227','New Shanebury','MA','70473',NULL,'(386) 091-8739',NULL,NULL,'franz.johns@example.com',NULL,'7P0lPYMsYa8zzfkn0MWu67JRbyS1prxz',1,'USD','Colt Bergstrom','en',NULL,'2018-11-25 15:44:17','2018-11-25 15:44:17'),(23,'Bianka Swaniawski','958 Rosetta Haven','Tremblayshire','SD','86287',NULL,'(140) 953-1605',NULL,NULL,'vrunte@example.net',NULL,'h1epC3XXAAKia5162rvSi3dDwIkxJN0u',1,'USD','Bianka Swaniawski','en',NULL,'2018-11-25 15:44:17','2018-11-25 15:44:17'),(24,'Tad Bartoletti','6436 Karl Underpass Apt. 912','Paxtonmouth','SC','76167-1219',NULL,'(752) 042-0720',NULL,NULL,'connor.oconnell@example.net',NULL,'7s3mmzD2htq2y6EukUNKSQiov4HseWZA',1,'USD','Tad Bartoletti','en',NULL,'2018-11-25 15:44:17','2018-11-25 15:44:17'),(25,'Elza Senger','2936 Emery Branch','Waelchimouth','WI','95676',NULL,'(448) 648-1789',NULL,NULL,'junior64@example.org',NULL,'LTRrLDrbWQpJfEzVhlvxNcIFvH9HSOkB',1,'USD','Elza Senger','en',NULL,'2018-11-25 15:44:17','2018-11-25 15:44:17'),(26,'Kemmer-Tillman','71219 Gerson Meadows Suite 041','Reichelchester','NE','28276-6080',NULL,'(096) 616-2784',NULL,NULL,'godfrey.kohler@example.org',NULL,'TA5SO4MXEY5EkayPHxY01oJkpBmwDPvC',1,'USD','Kemmer-Tillman','en',NULL,'2018-11-25 15:44:36','2018-11-25 15:44:36'),(27,'Stoltenberg-Sporer','974 Natalie Creek Apt. 286','New Angelabury','NE','02536',NULL,'(084) 878-0754',NULL,NULL,'arthur66@example.com',NULL,'IqAtTBoFfF4MexP1n7ch6GhM4k1k5rqG',1,'USD','Stoltenberg-Sporer','en',NULL,'2018-11-25 15:44:36','2018-11-25 15:44:36'),(28,'McClure, Kuhlman and Breitenberg','4674 Gordon Turnpike','North Haileeview','WA','70973',NULL,'(218) 296-6065',NULL,NULL,'mozelle24@example.com',NULL,'IOVuCQXow6tlAQdZR9ifEj05JKdHIReA',1,'USD','McClure, Kuhlman and Breitenberg','en',NULL,'2018-11-25 15:44:36','2018-11-25 15:44:36'),(29,'Stanton-Roob','61985 Hamill Grove','North Madelinetown','AK','97817',NULL,'(167) 612-0547',NULL,NULL,'domenick.koelpin@example.net',NULL,'bn3z45V0UCOmSQzaaAuwADalsK3CL5Lw',1,'USD','Stanton-Roob','en',NULL,'2018-11-25 15:44:36','2018-11-25 15:44:36'),(30,'Homenick, Kautzer and Littel','9837 Joseph Port','Goodwinside','MI','61088',NULL,'(878) 166-5567',NULL,NULL,'citlalli28@example.org',NULL,'ufl5N2LQAZ5SM93qxekX6bIJgzGKEFO2',1,'USD','Homenick, Kautzer and Littel','en',NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(31,'Doyle-Beahan','41915 Vandervort Brook Apt. 575','Lucileport','IL','63794',NULL,'(520) 575-3125',NULL,NULL,'uschamberger@example.net',NULL,'EVkiRfwJH3qLkxaTwNTTDH20pXHUl5vd',1,'USD','Doyle-Beahan','en',NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(32,'Prohaska-Beer','510 Jaden Cape','South Sunny','NC','14749',NULL,'(442) 078-9112',NULL,NULL,'hahn.darian@example.org',NULL,'jhXRaRbnzlqAA2nQYSBaxbV0FUClusTz',1,'USD','Prohaska-Beer','en',NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(33,'Huels-Wintheiser','9191 Vernice Plain','South Russelhaven','ME','44912',NULL,'(529) 169-3663',NULL,NULL,'dock.rippin@example.org',NULL,'hcf2s64f55a1Yin9UEa43OOIvROxXHpO',1,'USD','Huels-Wintheiser','en',NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(34,'Hegmann-Keebler','4125 Lubowitz Point Apt. 477','Quigleymouth','PA','36884',NULL,'(734) 347-3206',NULL,NULL,'bhermann@example.org',NULL,'o8LkjYhjUKFm77WxoS9GGJUlnzgRuz3K',1,'USD','Hegmann-Keebler','en',NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(35,'Wilderman, Hermiston and Monahan','8827 Weissnat Divide','East Norris','DC','06779',NULL,'(886) 736-5508',NULL,NULL,'elangworth@example.com',NULL,'IQjpLc4yoyIguwcMXcw6GH6Ud2XtarOh',1,'USD','Wilderman, Hermiston and Monahan','en',NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(36,'Barrows-Denesik','502 Cartwright Forges Apt. 322','East Chelseyport','TN','11001',NULL,'(985) 147-1184',NULL,NULL,'domenica.reichel@example.com',NULL,'ERIbrX5MfZAUCwBULRf7y72CnmpkD7us',1,'USD','Barrows-Denesik','en',NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(37,'Zieme-Barrows','65835 Pagac Branch Apt. 445','South Harrisonmouth','NV','61642',NULL,'(681) 939-9323',NULL,NULL,'bruen.osvaldo@example.com',NULL,'xRS89lf6zRpTUUvIz7jOyV09hEhcmbS8',1,'USD','Zieme-Barrows','en',NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(38,'Bartell, Schinner and Hirthe','318 Haley Glen Suite 960','Port Curt','NC','40191',NULL,'(548) 229-9746',NULL,NULL,'zreinger@example.org',NULL,'J7AE8BH1PcZLM3M6i25rSsnZUgEYHA7L',1,'USD','Bartell, Schinner and Hirthe','en',NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(39,'Osinski, Stiedemann and Swift','2874 Bashirian Ports','Adellmouth','HI','34632-1598',NULL,'(950) 106-2314',NULL,NULL,'zrogahn@example.com',NULL,'2cF14gZNxgxeNq5tgjJas7uiXB85ofYV',1,'USD','Osinski, Stiedemann and Swift','en',NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(40,'Olson PLC','857 Waelchi Shore Apt. 510','Zariaburgh','HI','26841-7875',NULL,'(180) 587-0592',NULL,NULL,'rschaefer@example.com',NULL,'BfKDtrTB0jd6c29C2yMBr3zeXj9GkaDZ',1,'USD','Olson PLC','en',NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(41,'Waelchi Ltd','7929 Syble Plaza','Mozellfurt','IA','03801-4398',NULL,'(401) 667-0856',NULL,NULL,'bhane@example.net',NULL,'uowSH2eybEyTuhuRhxdqn8EroaNQNmBs',1,'USD','Waelchi Ltd','en',NULL,'2018-11-25 15:44:38','2018-11-25 15:44:38'),(42,'Graham Inc','428 Schoen Haven','West Elyssa','TX','70472-5195',NULL,'(833) 143-3522',NULL,NULL,'abby.morar@example.net',NULL,'otEESbjf7X7PUMyegTwurxdl5YMGw4cp',1,'USD','Graham Inc','en',NULL,'2018-11-25 15:44:38','2018-11-25 15:44:38'),(43,'Nader Inc','7331 Lorenz Corners','New Maria','MD','70447-8391',NULL,'(439) 920-5454',NULL,NULL,'ludwig.bechtelar@example.org',NULL,'LCtisczNx9jrStOuO6Wwa35QxyRUr1FE',1,'USD','Nader Inc','en',NULL,'2018-11-25 15:44:38','2018-11-25 15:44:38'),(44,'Wolf LLC','762 Eileen Village Apt. 670','Austenmouth','NJ','49459-9377',NULL,'(929) 672-1847',NULL,NULL,'arturo46@example.net',NULL,'FycXucOIdFmy20JhsHtQo0f3KUv5onyo',1,'USD','Wolf LLC','en',NULL,'2018-11-25 15:44:38','2018-11-25 15:44:38'),(45,'Moore-Vandervort','8918 Schoen Rapids','Doyleshire','AR','49338',NULL,'(723) 903-4961',NULL,NULL,'wreilly@example.net',NULL,'2BWO7BL2lwr54iiWE6li8CgkhzcbCMDt',1,'USD','Moore-Vandervort','en',NULL,'2018-11-25 15:44:38','2018-11-25 15:44:38'),(46,'Feil PLC','1971 Morton Port','North Allene','MI','60987',NULL,'(399) 339-2979',NULL,NULL,'garret.dickinson@example.net',NULL,'gbhy0Pi0uQ4m6XHgCsOkdtAeHB69SeZ6',1,'USD','Feil PLC','en',NULL,'2018-11-25 15:44:38','2018-11-25 15:44:38'),(47,'Leuschke-Lebsack','39641 Rusty Lane Apt. 236','West Ryannshire','OH','96506',NULL,'(391) 390-1878',NULL,NULL,'ramon06@example.net',NULL,'af5uQ1O017rX03GIScDBME221uOSpGGp',1,'USD','Leuschke-Lebsack','en',NULL,'2018-11-25 15:44:38','2018-11-25 15:44:38'),(48,'Huel-Walter','67691 Bogan Brooks','Woodrowhaven','MD','17484',NULL,'(528) 634-3812',NULL,NULL,'ladarius99@example.org',NULL,'2EhxpOloukJ9OBDCzBd6G5QZPOmdHjn6',1,'USD','Huel-Walter','en',NULL,'2018-11-25 15:44:38','2018-11-25 15:44:38'),(49,'Schroeder-Turcotte','2439 Reginald Trail','East Sylvan','IA','36986-1421',NULL,'(485) 723-2569',NULL,NULL,'marlin65@example.net',NULL,'DI3EWPJGuiyhOY7C6jGRLnpafBWGooEr',1,'USD','Schroeder-Turcotte','en',NULL,'2018-11-25 15:44:38','2018-11-25 15:44:38'),(50,'Braun PLC','752 Madge Spur Apt. 892','Bodeland','OK','84557-2729',NULL,'(881) 056-8980',NULL,NULL,'vzieme@example.net',NULL,'9Hyu3L8KcJXzhSTNbydSYyP88ju6RMNR',1,'USD','Braun PLC','en',NULL,'2018-11-25 15:44:38','2018-11-25 15:44:38');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients_custom`
--

DROP TABLE IF EXISTS `clients_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients_custom` (
  `client_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`client_id`),
  CONSTRAINT `clients_custom_client_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients_custom`
--

LOCK TABLES `clients_custom` WRITE;
/*!40000 ALTER TABLE `clients_custom` DISABLE KEYS */;
INSERT INTO `clients_custom` VALUES (1,NULL,'2018-11-25 15:44:15','2018-11-25 15:44:15'),(2,NULL,'2018-11-25 15:44:15','2018-11-25 15:44:15'),(3,NULL,'2018-11-25 15:44:15','2018-11-25 15:44:15'),(4,NULL,'2018-11-25 15:44:15','2018-11-25 15:44:15'),(5,NULL,'2018-11-25 15:44:15','2018-11-25 15:44:15'),(6,NULL,'2018-11-25 15:44:15','2018-11-25 15:44:15'),(7,NULL,'2018-11-25 15:44:15','2018-11-25 15:44:15'),(8,NULL,'2018-11-25 15:44:15','2018-11-25 15:44:15'),(9,NULL,'2018-11-25 15:44:15','2018-11-25 15:44:15'),(10,NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(11,NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(12,NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(13,NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(14,NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(15,NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(16,NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(17,NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(18,NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(19,NULL,'2018-11-25 15:44:16','2018-11-25 15:44:16'),(20,NULL,'2018-11-25 15:44:17','2018-11-25 15:44:17'),(21,NULL,'2018-11-25 15:44:17','2018-11-25 15:44:17'),(22,NULL,'2018-11-25 15:44:17','2018-11-25 15:44:17'),(23,NULL,'2018-11-25 15:44:17','2018-11-25 15:44:17'),(24,NULL,'2018-11-25 15:44:17','2018-11-25 15:44:17'),(25,NULL,'2018-11-25 15:44:17','2018-11-25 15:44:17'),(26,NULL,'2018-11-25 15:44:36','2018-11-25 15:44:36'),(27,NULL,'2018-11-25 15:44:36','2018-11-25 15:44:36'),(28,NULL,'2018-11-25 15:44:36','2018-11-25 15:44:36'),(29,NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(30,NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(31,NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(32,NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(33,NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(34,NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(35,NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(36,NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(37,NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(38,NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(39,NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(40,NULL,'2018-11-25 15:44:37','2018-11-25 15:44:37'),(41,NULL,'2018-11-25 15:44:38','2018-11-25 15:44:38'),(42,NULL,'2018-11-25 15:44:38','2018-11-25 15:44:38'),(43,NULL,'2018-11-25 15:44:38','2018-11-25 15:44:38'),(44,NULL,'2018-11-25 15:44:38','2018-11-25 15:44:38'),(45,NULL,'2018-11-25 15:44:38','2018-11-25 15:44:38'),(46,NULL,'2018-11-25 15:44:38','2018-11-25 15:44:38'),(47,NULL,'2018-11-25 15:44:38','2018-11-25 15:44:38'),(48,NULL,'2018-11-25 15:44:38','2018-11-25 15:44:38'),(49,NULL,'2018-11-25 15:44:38','2018-11-25 15:44:38'),(50,NULL,'2018-11-25 15:44:38','2018-11-25 15:44:38');
/*!40000 ALTER TABLE `clients_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_profiles`
--

DROP TABLE IF EXISTS `company_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quote_template` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.blade.php',
  `workorder_template` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.blade.php',
  `invoice_template` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.blade.php',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_profiles`
--

LOCK TABLES `company_profiles` WRITE;
/*!40000 ALTER TABLE `company_profiles` DISABLE KEYS */;
INSERT INTO `company_profiles` VALUES (1,'Soylent Corp','123 4th St.','Anywhere','AZ','85555','USA','(520) 555-5555','(520) 555-5557','(520) 555-5556','',NULL,'default.blade.php','default.blade.php','default.blade.php',NULL,'2018-11-25 15:36:02','2018-11-25 15:36:02');
/*!40000 ALTER TABLE `company_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_profiles_custom`
--

DROP TABLE IF EXISTS `company_profiles_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_profiles_custom` (
  `company_profile_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`company_profile_id`),
  CONSTRAINT `company_profiles_custom_company_profile_id` FOREIGN KEY (`company_profile_id`) REFERENCES `company_profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_profiles_custom`
--

LOCK TABLES `company_profiles_custom` WRITE;
/*!40000 ALTER TABLE `company_profiles_custom` DISABLE KEYS */;
INSERT INTO `company_profiles_custom` VALUES (1,NULL,'2018-11-25 15:36:02','2018-11-25 15:36:02');
/*!40000 ALTER TABLE `company_profiles_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_to` tinyint(4) NOT NULL DEFAULT '0',
  `default_cc` tinyint(4) NOT NULL DEFAULT '0',
  `default_bcc` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contacts_client_id_index` (`client_id`),
  CONSTRAINT `contacts_client_id_index` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `placement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `decimal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thousands` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `currencies_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'AUD','Australian Dollar','$','before','.',',',NULL,NULL,NULL),(2,'CAD','Canadian Dollar','$','before','.',',',NULL,NULL,NULL),(3,'EUR','Euro','€','before','.',',',NULL,NULL,NULL),(4,'GBP','Pound Sterling','£','before','.',',',NULL,NULL,NULL),(5,'USD','US Dollar','$','before','.',',',NULL,NULL,NULL);
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_fields`
--

DROP TABLE IF EXISTS `custom_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custom_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tbl_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_meta` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `custom_fields_table_name_index` (`tbl_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_fields`
--

LOCK TABLES `custom_fields` WRITE;
/*!40000 ALTER TABLE `custom_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `first_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_rate` decimal(15,2) NOT NULL DEFAULT '0.00',
  `schedule` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `driver` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,829,'Alexis','Gibson','Alexis Gibson','Alexis G.','Worker',20.00,1,1,1,NULL,'2018-11-25 15:45:18','2018-11-25 15:45:18'),(2,78,'Cara','Dooley','Cara Dooley','Cara D.','Worker',20.00,1,1,0,NULL,'2018-11-25 15:45:18','2018-11-25 15:45:18'),(3,171,'Adella','Jacobson','Adella Jacobson','Adella J.','Worker',20.00,1,1,0,NULL,'2018-11-25 15:45:18','2018-11-25 15:45:18'),(4,51,'Juliet','Keebler','Juliet Keebler','Juliet K.','Worker',20.00,1,1,0,NULL,'2018-11-25 15:45:18','2018-11-25 15:45:18'),(5,762,'Marshall','Kassulke','Marshall Kassulke','Marshall K.','Worker',20.00,1,1,1,NULL,'2018-11-25 15:45:18','2018-11-25 15:45:18'),(6,337,'Ari','Lindgren','Ari Lindgren','Ari L.','Worker',20.00,1,1,0,NULL,'2018-11-25 15:45:18','2018-11-25 15:45:18'),(7,735,'Maurine','Parker','Maurine Parker','Maurine P.','Worker',20.00,1,1,1,NULL,'2018-11-25 15:45:18','2018-11-25 15:45:18'),(8,759,'Garfield','Hirthe','Garfield Hirthe','Garfield H.','Worker',20.00,1,1,1,NULL,'2018-11-25 15:45:18','2018-11-25 15:45:18'),(9,820,'Henderson','Altenwerth','Henderson Altenwerth','Henderson A.','Worker',20.00,1,1,0,NULL,'2018-11-25 15:45:18','2018-11-25 15:45:18'),(10,976,'Antwan','Crist','Antwan Crist','Antwan C.','Worker',20.00,1,1,1,NULL,'2018-11-25 15:45:18','2018-11-25 15:45:18');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_categories`
--

DROP TABLE IF EXISTS `expense_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_categories`
--

LOCK TABLES `expense_categories` WRITE;
/*!40000 ALTER TABLE `expense_categories` DISABLE KEYS */;
INSERT INTO `expense_categories` VALUES (1,'Landscaping',NULL,'2018-11-25 16:03:29','2018-11-25 16:03:29');
/*!40000 ALTER TABLE `expense_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_vendors`
--

DROP TABLE IF EXISTS `expense_vendors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_vendors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_vendors`
--

LOCK TABLES `expense_vendors` WRITE;
/*!40000 ALTER TABLE `expense_vendors` DISABLE KEYS */;
INSERT INTO `expense_vendors` VALUES (1,'Acme Bricks',NULL,'2018-11-25 16:03:29','2018-11-25 16:03:29');
/*!40000 ALTER TABLE `expense_vendors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expense_date` date NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `client_id` int(10) unsigned NOT NULL DEFAULT '0',
  `vendor_id` int(10) unsigned NOT NULL DEFAULT '0',
  `invoice_id` int(10) unsigned DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `tax` decimal(20,4) NOT NULL,
  `company_profile_id` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_category_id_index` (`category_id`),
  KEY `fk_expenses_invoices1_idx` (`invoice_id`),
  KEY `expenses_company_profile_id_index` (`company_profile_id`),
  KEY `fk_expenses_users1_idx` (`user_id`),
  CONSTRAINT `expenses_category_id_index` FOREIGN KEY (`category_id`) REFERENCES `expense_categories` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `expenses_company_profile_id_index` FOREIGN KEY (`company_profile_id`) REFERENCES `company_profiles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_expenses_invoices1_idx` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_expenses_users1_idx` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` VALUES (1,'2018-11-25',1,1,41,1,NULL,'Bricks for pathway',132.99,0.0000,1,NULL,'2018-11-25 16:03:29','2018-11-25 16:03:29');
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses_custom`
--

DROP TABLE IF EXISTS `expenses_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses_custom` (
  `expense_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`expense_id`),
  CONSTRAINT `expenses_custom_expense_id` FOREIGN KEY (`expense_id`) REFERENCES `expenses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses_custom`
--

LOCK TABLES `expenses_custom` WRITE;
/*!40000 ALTER TABLE `expenses_custom` DISABLE KEYS */;
INSERT INTO `expenses_custom` VALUES (1,NULL,'2018-11-25 16:03:29','2018-11-25 16:03:29');
/*!40000 ALTER TABLE `expenses_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `next_id` int(11) NOT NULL DEFAULT '1',
  `left_pad` int(11) NOT NULL DEFAULT '0',
  `format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reset_number` int(11) NOT NULL,
  `last_id` int(11) NOT NULL,
  `last_year` int(11) NOT NULL,
  `last_month` int(11) NOT NULL,
  `last_week` int(11) NOT NULL,
  `last_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Invoice Default',6,0,'INV{NUMBER}',0,5,2018,11,47,'INV5',NULL,NULL,'2018-11-25 16:05:40'),(2,'Quote Default',8,0,'QUO{NUMBER}',0,7,2018,11,47,'QUO7',NULL,NULL,'2018-11-25 15:53:32'),(3,'Workorder Default',4,0,'WO{NUMBER}',0,3,2018,11,47,'WO3',NULL,NULL,'2018-11-25 15:56:47');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_amounts`
--

DROP TABLE IF EXISTS `invoice_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_amounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(10) unsigned NOT NULL,
  `subtotal` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `discount` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `paid` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `balance` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_amounts_invoice_id_index` (`invoice_id`),
  CONSTRAINT `invoice_amounts_invoice_id_index` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_amounts`
--

LOCK TABLES `invoice_amounts` WRITE;
/*!40000 ALTER TABLE `invoice_amounts` DISABLE KEYS */;
INSERT INTO `invoice_amounts` VALUES (1,1,228.3800,0.0000,0.0000,228.3800,0.0000,228.3800,NULL,'2018-11-25 15:54:43','2018-11-25 15:54:44'),(2,2,134.5800,0.0000,0.0000,134.5800,0.0000,134.5800,NULL,'2018-11-25 15:58:17','2018-11-25 15:58:19'),(3,3,268.0300,0.0000,25.7310,293.7610,0.0000,293.7600,NULL,'2018-11-25 15:58:58','2018-11-25 15:59:44'),(4,4,337.5600,0.0000,18.6350,356.1950,356.2000,0.0000,NULL,'2018-11-25 16:00:24','2018-11-25 16:01:09'),(5,5,400.0000,0.0000,24.4000,424.4000,0.0000,424.4000,NULL,'2018-11-25 16:05:40','2018-11-25 16:05:55');
/*!40000 ALTER TABLE `invoice_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_item_amounts`
--

DROP TABLE IF EXISTS `invoice_item_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_item_amounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `subtotal` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax_1` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax_2` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_item_amounts_item_id_index` (`item_id`),
  CONSTRAINT `invoice_item_amounts_item_id_index` FOREIGN KEY (`item_id`) REFERENCES `invoice_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_item_amounts`
--

LOCK TABLES `invoice_item_amounts` WRITE;
/*!40000 ALTER TABLE `invoice_item_amounts` DISABLE KEYS */;
INSERT INTO `invoice_item_amounts` VALUES (1,1,106.8100,0.0000,0.0000,0.0000,106.8100,NULL,'2018-11-25 15:54:43','2018-11-25 15:54:44'),(2,2,41.5700,0.0000,0.0000,0.0000,41.5700,NULL,'2018-11-25 15:54:43','2018-11-25 15:54:44'),(3,3,80.0000,0.0000,0.0000,0.0000,80.0000,NULL,'2018-11-25 15:54:43','2018-11-25 15:54:44'),(4,4,134.5800,0.0000,0.0000,0.0000,134.5800,NULL,'2018-11-25 15:58:18','2018-11-25 15:58:19'),(5,5,0.0000,0.0000,0.0000,0.0000,0.0000,NULL,'2018-11-25 15:58:18','2018-11-25 15:58:19'),(6,6,0.0000,0.0000,0.0000,0.0000,0.0000,NULL,'2018-11-25 15:58:18','2018-11-25 15:58:19'),(7,7,0.0000,0.0000,0.0000,0.0000,0.0000,NULL,'2018-11-25 15:58:19','2018-11-25 15:58:19'),(8,8,120.8500,11.6020,0.0000,11.6020,132.4520,NULL,'2018-11-25 15:59:43','2018-11-25 15:59:43'),(9,9,73.9200,7.0960,0.0000,7.0960,81.0160,NULL,'2018-11-25 15:59:43','2018-11-25 15:59:43'),(10,10,73.2600,7.0330,0.0000,7.0330,80.2930,NULL,'2018-11-25 15:59:44','2018-11-25 15:59:44'),(11,11,120.8500,11.6020,0.0000,11.6020,132.4520,NULL,'2018-11-25 16:00:24','2018-11-25 16:01:09'),(12,12,73.9200,7.0960,0.0000,7.0960,81.0160,'2018-11-25 16:00:33','2018-11-25 16:00:24','2018-11-25 16:00:33'),(13,13,73.2600,7.0330,0.0000,7.0330,80.2930,NULL,'2018-11-25 16:00:25','2018-11-25 16:01:09'),(14,14,143.4500,0.0000,0.0000,0.0000,143.4500,NULL,'2018-11-25 16:00:47','2018-11-25 16:01:09'),(15,15,400.0000,24.4000,0.0000,24.4000,424.4000,NULL,'2018-11-25 16:05:40','2018-11-25 16:05:55');
/*!40000 ALTER TABLE `invoice_item_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_items`
--

DROP TABLE IF EXISTS `invoice_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(10) unsigned NOT NULL,
  `tax_rate_id` int(10) unsigned NOT NULL,
  `tax_rate_2_id` int(10) unsigned NOT NULL DEFAULT '0',
  `resource_table` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resource_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `display_order` int(11) NOT NULL DEFAULT '0',
  `price` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_items_display_order_index` (`display_order`),
  KEY `invoice_items_invoice_id_index` (`invoice_id`),
  CONSTRAINT `invoice_items_invoice_id_index` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_items`
--

LOCK TABLES `invoice_items` WRITE;
/*!40000 ALTER TABLE `invoice_items` DISABLE KEYS */;
INSERT INTO `invoice_items` VALUES (1,1,0,0,'products',2,'Incredible Copper Knife','Non veritatis occaecati modi rerum dolor.',1.0000,1,106.8100,NULL,'2018-11-25 15:54:43','2018-11-25 15:54:43'),(2,1,0,0,'products',8,'Aerodynamic Linen Table','Consectetur omnis ratione molestias enim at.',1.0000,2,41.5700,NULL,'2018-11-25 15:54:43','2018-11-25 15:54:43'),(3,1,0,0,'employees',3,'Adella J.','Worker-171',4.0000,3,20.0000,NULL,'2018-11-25 15:54:43','2018-11-25 15:54:43'),(4,2,0,0,'products',18,'Heavy Duty Cotton Bench','Qui commodi et laudantium corporis velit.',2.0000,1,67.2900,NULL,'2018-11-25 15:58:18','2018-11-25 15:58:18'),(5,2,0,0,'employees',9,'Henderson A.','Worker-820',0.0000,2,20.0000,NULL,'2018-11-25 15:58:18','2018-11-25 15:58:18'),(6,2,0,0,'employees',6,'Ari L.','Worker-337',0.0000,3,20.0000,NULL,'2018-11-25 15:58:18','2018-11-25 15:58:18'),(7,2,0,0,'employees',8,'Garfield H.','Worker-759',0.0000,4,20.0000,NULL,'2018-11-25 15:58:19','2018-11-25 15:58:19'),(8,3,2,0,'products',3,'Practical Marble Gloves','Et cum minus inventore repellat culpa.',1.0000,1,120.8500,NULL,'2018-11-25 15:59:43','2018-11-25 15:59:43'),(9,3,2,0,'products',4,'Durable Bronze Coat','Sed mollitia odit debitis magni deleniti.',2.0000,2,36.9600,NULL,'2018-11-25 15:59:43','2018-11-25 15:59:43'),(10,3,2,0,'products',6,'Gorgeous Cotton Shoes','Ipsum veniam natus dolore cupiditate quod.',3.0000,3,24.4200,NULL,'2018-11-25 15:59:43','2018-11-25 15:59:43'),(11,4,2,0,'products',3,'Practical Marble Gloves','Et cum minus inventore repellat culpa.',1.0000,1,120.8500,NULL,'2018-11-25 16:00:24','2018-11-25 16:00:46'),(12,4,2,0,'products',4,'Durable Bronze Coat','Sed mollitia odit debitis magni deleniti.',2.0000,2,36.9600,'2018-11-25 16:00:33','2018-11-25 16:00:24','2018-11-25 16:00:33'),(13,4,2,0,'products',6,'Gorgeous Cotton Shoes','Ipsum veniam natus dolore cupiditate quod.',3.0000,2,24.4200,NULL,'2018-11-25 16:00:25','2018-11-25 16:00:46'),(14,4,0,0,'products',5,'Mediocre Aluminum Wallet','Voluptatem aut eum ipsam perspiciatis nam.',1.0000,3,143.4500,NULL,'2018-11-25 16:00:47','2018-11-25 16:00:47'),(15,5,1,0,'',0,'Hourly Charge','Prep',10.0000,1,40.0000,NULL,'2018-11-25 16:05:40','2018-11-25 16:05:55');
/*!40000 ALTER TABLE `invoice_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_transactions`
--

DROP TABLE IF EXISTS `invoice_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(10) unsigned NOT NULL,
  `is_successful` tinyint(4) NOT NULL,
  `transaction_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoice_transactions_invoices1_idx` (`invoice_id`),
  CONSTRAINT `fk_invoice_transactions_invoices1_idx` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_transactions`
--

LOCK TABLES `invoice_transactions` WRITE;
/*!40000 ALTER TABLE `invoice_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_date` date NOT NULL,
  `invoice_id_ref` int(11) DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned DEFAULT NULL,
  `invoice_type_id` tinyint(4) NOT NULL DEFAULT '1',
  `invoice_status_id` int(11) NOT NULL,
  `due_at` date NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `terms` text COLLATE utf8mb4_unicode_ci,
  `footer` text COLLATE utf8mb4_unicode_ci,
  `url_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exchange_rate` decimal(10,7) NOT NULL DEFAULT '1.0000000',
  `template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viewed` tinyint(4) NOT NULL DEFAULT '0',
  `discount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `company_profile_id` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_user_id_index` (`user_id`),
  KEY `invoices_invoice_group_id_index` (`group_id`),
  KEY `invoices_client_id_index` (`client_id`),
  KEY `invoices_company_profile_id_index` (`company_profile_id`),
  KEY `invoices_invoice_status_id_index` (`invoice_status_id`),
  CONSTRAINT `invoices_client_id_index` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `invoices_company_profile_id_index` FOREIGN KEY (`company_profile_id`) REFERENCES `company_profiles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `invoices_invoice_group_id_index` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `invoices_user_id_index` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (1,'2018-11-25',NULL,1,25,1,1,2,'2018-12-25','INV1','50% down, balance on completion','Thank you for your business !','NSsKiQlaonD4hNBZimbK2GGgFb7RMMNf','USD',1.0000000,'default.blade.php','Test Quote',0,0.00,1,NULL,'2018-11-25 15:54:43','2018-11-25 15:58:41'),(2,'2018-11-25',NULL,1,16,1,1,2,'2018-12-25','INV2','50% down, balance on completion','Thank you for your business !','ogKd72lDZnxLP1Iq7jXMthF5pyhn5Qav','USD',1.0000000,'default.blade.php','Test Workorder',0,0.00,1,NULL,'2018-11-25 15:58:17','2018-11-25 15:58:41'),(3,'2018-11-10',NULL,1,21,1,1,2,'2018-12-10','INV3','Due upon receipt','Thank you for your business !','Yi2oKx4me8aS1Ya547sKBAD7PwuUfymG','USD',1.0000000,'default.blade.php','Test Invoice',0,0.00,1,NULL,'2018-11-25 15:58:58','2018-11-25 15:59:43'),(4,'2018-11-20',NULL,1,49,1,1,3,'2018-12-20','INV4','Due upon receipt','Thank you for your business !','Hzi3O3UNzZHJD0R0SDA9rdMQyCAsSbhm','USD',1.0000000,'default.blade.php','Test Invoice',0,0.00,1,NULL,'2018-11-25 16:00:24','2018-11-25 16:01:09'),(5,'2018-11-25',NULL,1,40,1,1,1,'2018-12-25','INV5','Due upon receipt','Thank you for your business !','EAjsWwIqew4nqsYL89GXFNGAaXNNV06h','USD',1.0000000,'default.blade.php','',0,0.00,1,NULL,'2018-11-25 16:05:40','2018-11-25 16:05:54');
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices_custom`
--

DROP TABLE IF EXISTS `invoices_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices_custom` (
  `invoice_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`invoice_id`),
  CONSTRAINT `invoices_custom_invoice_id` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices_custom`
--

LOCK TABLES `invoices_custom` WRITE;
/*!40000 ALTER TABLE `invoices_custom` DISABLE KEYS */;
INSERT INTO `invoices_custom` VALUES (1,NULL,'2018-11-25 15:54:43','2018-11-25 15:54:43'),(2,NULL,'2018-11-25 15:58:18','2018-11-25 15:58:18'),(3,NULL,'2018-11-25 15:58:58','2018-11-25 15:58:58'),(4,NULL,'2018-11-25 15:58:58','2018-11-25 15:58:58'),(5,NULL,'2018-11-25 16:05:40','2018-11-25 16:05:40');
/*!40000 ALTER TABLE `invoices_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_lookups`
--

DROP TABLE IF EXISTS `item_lookups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_lookups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax_rate_id` int(11) NOT NULL DEFAULT '0',
  `tax_rate_2_id` int(11) NOT NULL DEFAULT '0',
  `resource_table` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resource_id` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_lookups_tax_rate_id_index` (`tax_rate_id`),
  KEY `item_lookups_tax_rate_2_id_index` (`tax_rate_2_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_lookups`
--

LOCK TABLES `item_lookups` WRITE;
/*!40000 ALTER TABLE `item_lookups` DISABLE KEYS */;
INSERT INTO `item_lookups` VALUES (1,'Fantastic Iron Gloves','Cum ex et et ut ut.',32.7700,0,0,'products',1,NULL,'2018-11-25 15:47:10','2018-11-25 15:47:10'),(2,'Incredible Copper Knife','Non veritatis occaecati modi rerum dolor.',106.8100,0,0,'products',2,NULL,'2018-11-25 15:47:10','2018-11-25 15:47:10'),(3,'Practical Marble Gloves','Et cum minus inventore repellat culpa.',120.8500,0,0,'products',3,NULL,'2018-11-25 15:47:10','2018-11-25 15:47:10'),(4,'Durable Bronze Coat','Sed mollitia odit debitis magni deleniti.',36.9600,0,0,'products',4,NULL,'2018-11-25 15:47:10','2018-11-25 15:47:10'),(5,'Mediocre Aluminum Wallet','Voluptatem aut eum ipsam perspiciatis nam.',143.4500,0,0,'products',5,NULL,'2018-11-25 15:47:10','2018-11-25 15:47:10'),(6,'Gorgeous Cotton Shoes','Ipsum veniam natus dolore cupiditate quod.',24.4200,0,0,'products',6,NULL,'2018-11-25 15:47:10','2018-11-25 15:47:10'),(7,'Sleek Concrete Hat','Pariatur sed sed et porro sunt.',110.2400,0,0,'products',7,NULL,'2018-11-25 15:47:10','2018-11-25 15:47:10'),(8,'Aerodynamic Linen Table','Consectetur omnis ratione molestias enim at.',41.5700,0,0,'products',8,NULL,'2018-11-25 15:47:10','2018-11-25 15:47:10'),(9,'Aerodynamic Wool Table','Nemo deleniti harum ipsum voluptatem dolorem.',80.7700,0,0,'products',9,NULL,'2018-11-25 15:47:10','2018-11-25 15:47:10'),(10,'Aerodynamic Cotton Keyboard','Ut quasi delectus saepe illum ipsam.',34.7800,0,0,'products',10,NULL,'2018-11-25 15:47:11','2018-11-25 15:47:11'),(11,'Gorgeous Linen Car','Laudantium neque ad quasi est dolore.',134.0000,0,0,'products',11,NULL,'2018-11-25 15:47:11','2018-11-25 15:47:11'),(12,'Fantastic Aluminum Shirt','Qui deserunt odio voluptas in eius.',42.3100,0,0,'products',12,NULL,'2018-11-25 15:47:11','2018-11-25 15:47:11'),(13,'Synergistic Granite Wallet','Dolorem omnis in et minima expedita.',146.0900,0,0,'products',13,NULL,'2018-11-25 15:47:11','2018-11-25 15:47:11'),(14,'Ergonomic Marble Coat','Doloremque quia nemo aut placeat totam.',97.5500,0,0,'products',14,NULL,'2018-11-25 15:47:11','2018-11-25 15:47:11'),(15,'Lightweight Steel Clock','Possimus labore minima pariatur reprehenderit harum.',146.4500,0,0,'products',15,NULL,'2018-11-25 15:47:11','2018-11-25 15:47:11'),(16,'Fantastic Aluminum Coat','Nihil dolores cupiditate rerum voluptatem voluptas.',32.7100,0,0,'products',16,NULL,'2018-11-25 15:47:11','2018-11-25 15:47:11'),(17,'Rustic Linen Table','Sed officia sint unde eum itaque.',44.1100,0,0,'products',17,NULL,'2018-11-25 15:47:11','2018-11-25 15:47:11'),(18,'Heavy Duty Cotton Bench','Qui commodi et laudantium corporis velit.',67.2900,0,0,'products',18,NULL,'2018-11-25 15:47:11','2018-11-25 15:47:11'),(19,'Awesome Bronze Clock','Voluptatem in voluptatum et esse quisquam.',78.6500,0,0,'products',19,NULL,'2018-11-25 15:47:11','2018-11-25 15:47:11'),(20,'Awesome Granite Knife','Aperiam aliquam ab iure adipisci aspernatur.',125.0300,0,0,'products',20,NULL,'2018-11-25 15:47:11','2018-11-25 15:47:11'),(21,'Alexis G.','Worker-829',20.0000,0,0,'employees',1,NULL,'2018-11-25 15:47:31','2018-11-25 15:47:31'),(22,'Cara D.','Worker-78',20.0000,0,0,'employees',2,NULL,'2018-11-25 15:47:31','2018-11-25 15:47:31'),(23,'Adella J.','Worker-171',20.0000,0,0,'employees',3,NULL,'2018-11-25 15:47:31','2018-11-25 15:47:31'),(24,'Juliet K.','Worker-51',20.0000,0,0,'employees',4,NULL,'2018-11-25 15:47:31','2018-11-25 15:47:31'),(25,'Marshall K.','Worker-762',20.0000,0,0,'employees',5,NULL,'2018-11-25 15:47:31','2018-11-25 15:47:31'),(26,'Ari L.','Worker-337',20.0000,0,0,'employees',6,NULL,'2018-11-25 15:47:31','2018-11-25 15:47:31'),(27,'Maurine P.','Worker-735',20.0000,0,0,'employees',7,NULL,'2018-11-25 15:47:31','2018-11-25 15:47:31'),(28,'Garfield H.','Worker-759',20.0000,0,0,'employees',8,NULL,'2018-11-25 15:47:31','2018-11-25 15:47:31'),(29,'Henderson A.','Worker-820',20.0000,0,0,'employees',9,NULL,'2018-11-25 15:47:31','2018-11-25 15:47:31'),(30,'Antwan C.','Worker-976',20.0000,0,0,'employees',10,NULL,'2018-11-25 15:47:31','2018-11-25 15:47:31');
/*!40000 ALTER TABLE `item_lookups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mail_queue`
--

DROP TABLE IF EXISTS `mail_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mail_queue` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mailable_id` int(11) NOT NULL,
  `mailable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bcc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attach_pdf` tinyint(4) NOT NULL,
  `sent` tinyint(4) NOT NULL DEFAULT '0',
  `error` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mail_queue`
--

LOCK TABLES `mail_queue` WRITE;
/*!40000 ALTER TABLE `mail_queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `mail_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `merchant_clients`
--

DROP TABLE IF EXISTS `merchant_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `merchant_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `driver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `merchant_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merchant_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `merchant_clients_merchant_key_index` (`merchant_key`),
  KEY `merchant_clients_client_id_index` (`client_id`),
  KEY `merchant_clients_driver_index` (`driver`),
  CONSTRAINT `merchant_clients_client_id_index` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `merchant_clients`
--

LOCK TABLES `merchant_clients` WRITE;
/*!40000 ALTER TABLE `merchant_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `merchant_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `merchant_payments`
--

DROP TABLE IF EXISTS `merchant_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `merchant_payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `driver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_id` int(10) unsigned NOT NULL,
  `merchant_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merchant_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `merchant_payments_merchant_key_index` (`merchant_key`),
  KEY `merchant_payments_payment_id_index` (`payment_id`),
  KEY `merchant_payments_driver_index` (`driver`),
  CONSTRAINT `merchant_payments_payment_id_index` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `merchant_payments`
--

LOCK TABLES `merchant_payments` WRITE;
/*!40000 ALTER TABLE `merchant_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `merchant_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2018_08_17_000000_create_activities_table',1),(2,'2018_08_17_000001_create_currencies_table',1),(3,'2018_08_17_000002_create_users_table',1),(4,'2018_08_17_000003_create_workorders_table',1),(5,'2018_08_17_000004_create_mail_queue_table',1),(6,'2018_08_17_000005_create_products_table',1),(7,'2018_08_17_000006_create_item_lookups_table',1),(8,'2018_08_17_000007_create_employees_table',1),(9,'2018_08_17_000008_create_expense_vendors_table',1),(10,'2018_08_17_000009_create_company_profiles_table',1),(11,'2018_08_17_000011_create_payment_methods_table',1),(12,'2018_08_17_000012_create_schedule_categories_table',1),(13,'2018_08_17_000013_create_clients_table',1),(14,'2018_08_17_000014_create_tax_rates_table',1),(15,'2018_08_17_000015_create_groups_table',1),(16,'2018_08_17_000016_create_expense_categories_table',1),(17,'2018_08_17_000017_create_addons_table',1),(18,'2018_08_17_000018_create_settings_table',1),(19,'2018_08_17_000019_create_custom_fields_table',1),(20,'2018_08_17_000020_create_clients_custom_table',1),(21,'2018_08_17_000021_create_workorder_items_table',1),(22,'2018_08_17_000022_create_attachments_table',1),(23,'2018_08_17_000023_create_contacts_table',1),(24,'2018_08_17_000024_create_invoices_table',1),(25,'2018_08_17_000025_create_notes_table',1),(26,'2018_08_17_000026_create_schedule_table',1),(27,'2018_08_17_000027_create_users_custom_table',1),(28,'2018_08_17_000028_create_time_tracking_projects_table',1),(29,'2018_08_17_000029_create_quotes_table',1),(30,'2018_08_17_000030_create_recurring_invoices_table',1),(31,'2018_08_17_000031_create_company_profiles_custom_table',1),(32,'2018_08_17_000032_create_merchant_clients_table',1),(33,'2018_08_17_000033_create_workorder_amounts_table',1),(34,'2018_08_17_000034_create_workorders_custom_table',1),(35,'2018_08_17_000035_create_invoice_items_table',1),(36,'2018_08_17_000036_create_recurring_invoice_amounts_table',1),(37,'2018_08_17_000037_create_quote_amounts_table',1),(38,'2018_08_17_000038_create_time_tracking_tasks_table',1),(39,'2018_08_17_000039_create_quote_items_table',1),(40,'2018_08_17_000040_create_invoice_transactions_table',1),(41,'2018_08_17_000041_create_invoices_custom_table',1),(42,'2018_08_17_000042_create_expenses_table',1),(43,'2018_08_17_000043_create_schedule_occurrences_table',1),(44,'2018_08_17_000044_create_invoice_amounts_table',1),(45,'2018_08_17_000045_create_payments_table',1),(46,'2018_08_17_000046_create_schedule_reminders_table',1),(47,'2018_08_17_000047_create_recurring_invoice_items_table',1),(48,'2018_08_17_000048_create_workorder_item_amounts_table',1),(49,'2018_08_17_000049_create_quotes_custom_table',1),(50,'2018_08_17_000050_create_recurring_invoices_custom_table',1),(51,'2018_08_17_000051_create_schedule_resources_table',1),(52,'2018_08_17_000052_create_expenses_custom_table',1),(53,'2018_08_17_000053_create_merchant_payments_table',1),(54,'2018_08_17_000054_create_time_tracking_timers_table',1),(55,'2018_08_17_000055_create_invoice_item_amounts_table',1),(56,'2018_08_17_000056_create_quote_item_amounts_table',1),(57,'2018_08_17_000057_create_recurring_invoice_item_amounts_table',1),(58,'2018_08_17_000058_create_payments_custom_table',1),(59,'2018_08_17_000100_version_400',1),(60,'2018_09_07_000100_version_401',1),(61,'2018_10_17_000100_version_402',1),(62,'2018_11_08_000100_version_410',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `notable_id` int(11) NOT NULL,
  `notable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `private` tinyint(4) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notes_users1_idx` (`user_id`),
  CONSTRAINT `fk_notes_users1_idx` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_methods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_methods`
--

LOCK TABLES `payment_methods` WRITE;
/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;
INSERT INTO `payment_methods` VALUES (1,'Cash',NULL,NULL,NULL),(2,'Check',NULL,NULL,NULL),(3,'Credit Card',NULL,NULL,NULL),(4,'Online Payment',NULL,NULL,NULL);
/*!40000 ALTER TABLE `payment_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL DEFAULT '0',
  `invoice_id` int(10) unsigned NOT NULL,
  `payment_method_id` int(10) unsigned DEFAULT NULL,
  `paid_at` date NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payments_clients1_idx` (`client_id`),
  KEY `payments_invoice_id_index` (`invoice_id`),
  KEY `payments_payment_method_id_index` (`payment_method_id`),
  CONSTRAINT `fk_payments_clients1_idx` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payments_invoice_id_index` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_payment_method_id_index` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,49,4,2,'2018-11-25','#1234',356.2000,NULL,'2018-11-25 16:01:09','2018-11-25 16:01:09');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments_custom`
--

DROP TABLE IF EXISTS `payments_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments_custom` (
  `payment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  CONSTRAINT `payments_custom_payment_id` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments_custom`
--

LOCK TABLES `payments_custom` WRITE;
/*!40000 ALTER TABLE `payments_custom` DISABLE KEYS */;
INSERT INTO `payments_custom` VALUES (1,NULL,'2018-11-25 16:01:09','2018-11-25 16:01:09');
/*!40000 ALTER TABLE `payments_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(85) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(7,2) DEFAULT NULL,
  `tax_rate_id` int(10) unsigned DEFAULT NULL,
  `tax_rate_2_id` int(10) unsigned DEFAULT NULL,
  `serialnum` varchar(85) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `vendor_id` int(10) unsigned DEFAULT NULL,
  `cost` decimal(7,2) DEFAULT NULL,
  `category` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numstock` tinyint(3) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Fantastic Iron Gloves','Cum ex et et ut ut.',NULL,NULL,NULL,'330344301',1,NULL,32.77,'Product','Product Type',6,NULL,'2018-11-25 15:45:52','2018-11-25 15:45:52'),(2,'Incredible Copper Knife','Non veritatis occaecati modi rerum dolor.',NULL,NULL,NULL,'902496844',1,NULL,106.81,'Product','Product Type',6,NULL,'2018-11-25 15:45:52','2018-11-25 15:45:52'),(3,'Practical Marble Gloves','Et cum minus inventore repellat culpa.',NULL,NULL,NULL,'594406904',1,NULL,120.85,'Product','Product Type',7,NULL,'2018-11-25 15:45:52','2018-11-25 15:45:52'),(4,'Durable Bronze Coat','Sed mollitia odit debitis magni deleniti.',NULL,NULL,NULL,'950539095',1,NULL,36.96,'Product','Product Type',6,NULL,'2018-11-25 15:45:52','2018-11-25 15:45:52'),(5,'Mediocre Aluminum Wallet','Voluptatem aut eum ipsam perspiciatis nam.',NULL,NULL,NULL,'709015859',1,NULL,143.45,'Product','Product Type',8,NULL,'2018-11-25 15:45:52','2018-11-25 15:45:52'),(6,'Gorgeous Cotton Shoes','Ipsum veniam natus dolore cupiditate quod.',NULL,NULL,NULL,'946668496',1,NULL,24.42,'Product','Product Type',6,NULL,'2018-11-25 15:45:52','2018-11-25 15:45:52'),(7,'Sleek Concrete Hat','Pariatur sed sed et porro sunt.',NULL,NULL,NULL,'739575562',1,NULL,110.24,'Product','Product Type',2,NULL,'2018-11-25 15:45:52','2018-11-25 15:45:52'),(8,'Aerodynamic Linen Table','Consectetur omnis ratione molestias enim at.',NULL,NULL,NULL,'847946761',1,NULL,41.57,'Product','Product Type',2,NULL,'2018-11-25 15:45:52','2018-11-25 15:45:52'),(9,'Aerodynamic Wool Table','Nemo deleniti harum ipsum voluptatem dolorem.',NULL,NULL,NULL,'103673148',1,NULL,80.77,'Product','Product Type',5,NULL,'2018-11-25 15:45:52','2018-11-25 15:45:52'),(10,'Aerodynamic Cotton Keyboard','Ut quasi delectus saepe illum ipsam.',NULL,NULL,NULL,'294158149',1,NULL,34.78,'Product','Product Type',4,NULL,'2018-11-25 15:45:52','2018-11-25 15:45:52'),(11,'Gorgeous Linen Car','Laudantium neque ad quasi est dolore.',NULL,NULL,NULL,'566263958',1,NULL,134.00,'Product','Product Type',6,NULL,'2018-11-25 15:45:52','2018-11-25 15:45:52'),(12,'Fantastic Aluminum Shirt','Qui deserunt odio voluptas in eius.',NULL,NULL,NULL,'809217616',1,NULL,42.31,'Product','Product Type',5,NULL,'2018-11-25 15:45:52','2018-11-25 15:45:52'),(13,'Synergistic Granite Wallet','Dolorem omnis in et minima expedita.',NULL,NULL,NULL,'147168967',1,NULL,146.09,'Product','Product Type',6,NULL,'2018-11-25 15:45:52','2018-11-25 15:45:52'),(14,'Ergonomic Marble Coat','Doloremque quia nemo aut placeat totam.',NULL,NULL,NULL,'293016411',1,NULL,97.55,'Product','Product Type',10,NULL,'2018-11-25 15:45:52','2018-11-25 15:45:52'),(15,'Lightweight Steel Clock','Possimus labore minima pariatur reprehenderit harum.',NULL,NULL,NULL,'642886924',1,NULL,146.45,'Product','Product Type',10,NULL,'2018-11-25 15:45:52','2018-11-25 15:45:52'),(16,'Fantastic Aluminum Coat','Nihil dolores cupiditate rerum voluptatem voluptas.',NULL,NULL,NULL,'920523134',1,NULL,32.71,'Product','Product Type',7,NULL,'2018-11-25 15:45:53','2018-11-25 15:45:53'),(17,'Rustic Linen Table','Sed officia sint unde eum itaque.',NULL,NULL,NULL,'688207170',1,NULL,44.11,'Product','Product Type',9,NULL,'2018-11-25 15:45:53','2018-11-25 15:45:53'),(18,'Heavy Duty Cotton Bench','Qui commodi et laudantium corporis velit.',NULL,NULL,NULL,'624824220',1,NULL,67.29,'Product','Product Type',10,NULL,'2018-11-25 15:45:53','2018-11-25 15:45:53'),(19,'Awesome Bronze Clock','Voluptatem in voluptatum et esse quisquam.',NULL,NULL,NULL,'326857107',1,NULL,78.65,'Product','Product Type',1,NULL,'2018-11-25 15:45:53','2018-11-25 15:45:53'),(20,'Awesome Granite Knife','Aperiam aliquam ab iure adipisci aspernatur.',NULL,NULL,NULL,'498260789',1,NULL,125.03,'Product','Product Type',3,NULL,'2018-11-25 15:45:53','2018-11-25 15:45:53');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote_amounts`
--

DROP TABLE IF EXISTS `quote_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quote_amounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quote_id` int(10) unsigned NOT NULL,
  `subtotal` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `discount` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quote_amounts_quote_id_index` (`quote_id`),
  CONSTRAINT `quote_amounts_quote_id_index` FOREIGN KEY (`quote_id`) REFERENCES `quotes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quote_amounts`
--

LOCK TABLES `quote_amounts` WRITE;
/*!40000 ALTER TABLE `quote_amounts` DISABLE KEYS */;
INSERT INTO `quote_amounts` VALUES (1,1,228.3800,0.0000,0.0000,228.3800,NULL,'2018-11-25 15:49:55','2018-11-25 15:51:13'),(2,2,228.3800,0.0000,0.0000,228.3800,NULL,'2018-11-25 15:51:36','2018-11-25 15:51:37'),(3,3,228.3800,0.0000,0.0000,228.3800,NULL,'2018-11-25 15:51:57','2018-11-25 15:51:58'),(4,4,228.3800,0.0000,0.0000,228.3800,NULL,'2018-11-25 15:52:13','2018-11-25 15:52:14'),(5,5,228.3800,0.0000,0.0000,228.3800,NULL,'2018-11-25 15:52:31','2018-11-25 15:52:32'),(6,6,228.3800,0.0000,0.0000,228.3800,NULL,'2018-11-25 15:53:13','2018-11-25 15:53:14'),(7,7,228.3800,0.0000,0.0000,228.3800,NULL,'2018-11-25 15:53:32','2018-11-25 15:53:33');
/*!40000 ALTER TABLE `quote_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote_item_amounts`
--

DROP TABLE IF EXISTS `quote_item_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quote_item_amounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `subtotal` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax_1` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax_2` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quote_item_amounts_item_id_index` (`item_id`),
  CONSTRAINT `quote_item_amounts_item_id_index` FOREIGN KEY (`item_id`) REFERENCES `quote_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quote_item_amounts`
--

LOCK TABLES `quote_item_amounts` WRITE;
/*!40000 ALTER TABLE `quote_item_amounts` DISABLE KEYS */;
INSERT INTO `quote_item_amounts` VALUES (1,1,106.8100,0.0000,0.0000,0.0000,106.8100,NULL,'2018-11-25 15:51:12','2018-11-25 15:51:13'),(2,2,41.5700,0.0000,0.0000,0.0000,41.5700,NULL,'2018-11-25 15:51:12','2018-11-25 15:51:13'),(3,3,80.0000,0.0000,0.0000,0.0000,80.0000,NULL,'2018-11-25 15:51:13','2018-11-25 15:51:13'),(4,4,106.8100,0.0000,0.0000,0.0000,106.8100,NULL,'2018-11-25 15:51:36','2018-11-25 15:51:37'),(5,5,41.5700,0.0000,0.0000,0.0000,41.5700,NULL,'2018-11-25 15:51:36','2018-11-25 15:51:37'),(6,6,80.0000,0.0000,0.0000,0.0000,80.0000,NULL,'2018-11-25 15:51:37','2018-11-25 15:51:37'),(7,7,106.8100,0.0000,0.0000,0.0000,106.8100,NULL,'2018-11-25 15:51:57','2018-11-25 15:51:58'),(8,8,41.5700,0.0000,0.0000,0.0000,41.5700,NULL,'2018-11-25 15:51:57','2018-11-25 15:51:58'),(9,9,80.0000,0.0000,0.0000,0.0000,80.0000,NULL,'2018-11-25 15:51:58','2018-11-25 15:51:58'),(10,10,106.8100,0.0000,0.0000,0.0000,106.8100,NULL,'2018-11-25 15:52:14','2018-11-25 15:52:14'),(11,11,41.5700,0.0000,0.0000,0.0000,41.5700,NULL,'2018-11-25 15:52:14','2018-11-25 15:52:14'),(12,12,80.0000,0.0000,0.0000,0.0000,80.0000,NULL,'2018-11-25 15:52:14','2018-11-25 15:52:14'),(13,13,106.8100,0.0000,0.0000,0.0000,106.8100,NULL,'2018-11-25 15:52:32','2018-11-25 15:52:32'),(14,14,41.5700,0.0000,0.0000,0.0000,41.5700,NULL,'2018-11-25 15:52:32','2018-11-25 15:52:32'),(15,15,80.0000,0.0000,0.0000,0.0000,80.0000,NULL,'2018-11-25 15:52:32','2018-11-25 15:52:32'),(16,16,106.8100,0.0000,0.0000,0.0000,106.8100,NULL,'2018-11-25 15:53:13','2018-11-25 15:53:14'),(17,17,41.5700,0.0000,0.0000,0.0000,41.5700,NULL,'2018-11-25 15:53:13','2018-11-25 15:53:14'),(18,18,80.0000,0.0000,0.0000,0.0000,80.0000,NULL,'2018-11-25 15:53:14','2018-11-25 15:53:14'),(19,19,106.8100,0.0000,0.0000,0.0000,106.8100,NULL,'2018-11-25 15:53:32','2018-11-25 15:53:33'),(20,20,41.5700,0.0000,0.0000,0.0000,41.5700,NULL,'2018-11-25 15:53:33','2018-11-25 15:53:33'),(21,21,80.0000,0.0000,0.0000,0.0000,80.0000,NULL,'2018-11-25 15:53:33','2018-11-25 15:53:33');
/*!40000 ALTER TABLE `quote_item_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote_items`
--

DROP TABLE IF EXISTS `quote_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quote_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quote_id` int(10) unsigned NOT NULL,
  `tax_rate_id` int(10) unsigned NOT NULL,
  `tax_rate_2_id` int(10) unsigned NOT NULL DEFAULT '0',
  `resource_table` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resource_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `display_order` int(11) NOT NULL,
  `price` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quote_items_quote_id_index` (`quote_id`),
  KEY `quote_items_display_order_index` (`display_order`),
  CONSTRAINT `quote_items_quote_id_index` FOREIGN KEY (`quote_id`) REFERENCES `quotes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quote_items`
--

LOCK TABLES `quote_items` WRITE;
/*!40000 ALTER TABLE `quote_items` DISABLE KEYS */;
INSERT INTO `quote_items` VALUES (1,1,0,0,'products',2,'Incredible Copper Knife','Non veritatis occaecati modi rerum dolor.',1.0000,1,106.8100,NULL,'2018-11-25 15:51:12','2018-11-25 15:51:12'),(2,1,0,0,'products',8,'Aerodynamic Linen Table','Consectetur omnis ratione molestias enim at.',1.0000,2,41.5700,NULL,'2018-11-25 15:51:12','2018-11-25 15:51:12'),(3,1,0,0,'employees',3,'Adella J.','Worker-171',4.0000,3,20.0000,NULL,'2018-11-25 15:51:12','2018-11-25 15:51:12'),(4,2,0,0,'products',2,'Incredible Copper Knife','Non veritatis occaecati modi rerum dolor.',1.0000,1,106.8100,NULL,'2018-11-25 15:51:36','2018-11-25 15:51:36'),(5,2,0,0,'products',8,'Aerodynamic Linen Table','Consectetur omnis ratione molestias enim at.',1.0000,2,41.5700,NULL,'2018-11-25 15:51:36','2018-11-25 15:51:36'),(6,2,0,0,'employees',3,'Adella J.','Worker-171',4.0000,3,20.0000,NULL,'2018-11-25 15:51:36','2018-11-25 15:51:36'),(7,3,0,0,'products',2,'Incredible Copper Knife','Non veritatis occaecati modi rerum dolor.',1.0000,1,106.8100,NULL,'2018-11-25 15:51:57','2018-11-25 15:51:57'),(8,3,0,0,'products',8,'Aerodynamic Linen Table','Consectetur omnis ratione molestias enim at.',1.0000,2,41.5700,NULL,'2018-11-25 15:51:57','2018-11-25 15:51:57'),(9,3,0,0,'employees',3,'Adella J.','Worker-171',4.0000,3,20.0000,NULL,'2018-11-25 15:51:58','2018-11-25 15:51:58'),(10,4,0,0,'products',2,'Incredible Copper Knife','Non veritatis occaecati modi rerum dolor.',1.0000,1,106.8100,NULL,'2018-11-25 15:52:13','2018-11-25 15:52:13'),(11,4,0,0,'products',8,'Aerodynamic Linen Table','Consectetur omnis ratione molestias enim at.',1.0000,2,41.5700,NULL,'2018-11-25 15:52:14','2018-11-25 15:52:14'),(12,4,0,0,'employees',3,'Adella J.','Worker-171',4.0000,3,20.0000,NULL,'2018-11-25 15:52:14','2018-11-25 15:52:14'),(13,5,0,0,'products',2,'Incredible Copper Knife','Non veritatis occaecati modi rerum dolor.',1.0000,1,106.8100,NULL,'2018-11-25 15:52:32','2018-11-25 15:52:32'),(14,5,0,0,'products',8,'Aerodynamic Linen Table','Consectetur omnis ratione molestias enim at.',1.0000,2,41.5700,NULL,'2018-11-25 15:52:32','2018-11-25 15:52:32'),(15,5,0,0,'employees',3,'Adella J.','Worker-171',4.0000,3,20.0000,NULL,'2018-11-25 15:52:32','2018-11-25 15:52:32'),(16,6,0,0,'products',2,'Incredible Copper Knife','Non veritatis occaecati modi rerum dolor.',1.0000,1,106.8100,NULL,'2018-11-25 15:53:13','2018-11-25 15:53:13'),(17,6,0,0,'products',8,'Aerodynamic Linen Table','Consectetur omnis ratione molestias enim at.',1.0000,2,41.5700,NULL,'2018-11-25 15:53:13','2018-11-25 15:53:13'),(18,6,0,0,'employees',3,'Adella J.','Worker-171',4.0000,3,20.0000,NULL,'2018-11-25 15:53:13','2018-11-25 15:53:13'),(19,7,0,0,'products',2,'Incredible Copper Knife','Non veritatis occaecati modi rerum dolor.',1.0000,1,106.8100,NULL,'2018-11-25 15:53:32','2018-11-25 15:53:32'),(20,7,0,0,'products',8,'Aerodynamic Linen Table','Consectetur omnis ratione molestias enim at.',1.0000,2,41.5700,NULL,'2018-11-25 15:53:32','2018-11-25 15:53:32'),(21,7,0,0,'employees',3,'Adella J.','Worker-171',4.0000,3,20.0000,NULL,'2018-11-25 15:53:33','2018-11-25 15:53:33');
/*!40000 ALTER TABLE `quote_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotes`
--

DROP TABLE IF EXISTS `quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quote_date` date NOT NULL,
  `workorder_id` int(10) unsigned NOT NULL DEFAULT '0',
  `invoice_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned DEFAULT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned DEFAULT NULL,
  `quote_status_id` int(11) NOT NULL,
  `expires_at` date NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer` text COLLATE utf8mb4_unicode_ci,
  `url_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exchange_rate` decimal(10,7) NOT NULL DEFAULT '1.0000000',
  `terms` text COLLATE utf8mb4_unicode_ci,
  `template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viewed` tinyint(4) NOT NULL DEFAULT '0',
  `discount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `company_profile_id` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quotes_user_id_index` (`user_id`),
  KEY `quotes_invoice_group_id_index` (`group_id`),
  KEY `quotes_number_index` (`number`),
  KEY `quotes_company_profile_id_index` (`company_profile_id`),
  KEY `quotes_client_id_index` (`client_id`),
  CONSTRAINT `quotes_client_id_index` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `quotes_company_profile_id_index` FOREIGN KEY (`company_profile_id`) REFERENCES `company_profiles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `quotes_invoice_group_id_index` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `quotes_user_id_index` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotes`
--

LOCK TABLES `quotes` WRITE;
/*!40000 ALTER TABLE `quotes` DISABLE KEYS */;
INSERT INTO `quotes` VALUES (1,'2018-11-08',0,0,1,4,2,4,'2018-11-23','QUO1','Thank you for your business !','pbkCXYzTJr3pjaY62j9Arnvoss72Cza8','USD',1.0000000,'50% down, balance on completion','default.blade.php','Test Quote',0,0.00,1,NULL,'2018-11-25 15:49:54','2018-11-25 15:54:02'),(2,'2018-11-12',0,0,1,30,2,3,'2018-11-27','QUO2','Thank you for your business !','A46So7gKs5FepaTSOZJGzq01DYn4RBOn','USD',1.0000000,'50% down, balance on completion','default.blade.php','Test Quote',0,0.00,1,NULL,'2018-11-25 15:51:36','2018-11-25 15:53:53'),(3,'2018-11-06',0,0,1,22,2,5,'2018-11-21','QUO3','Thank you for your business !','RNTIqxV4J7wdIhuFvhW8n2Ik3kGEVRVe','USD',1.0000000,'50% down, balance on completion','default.blade.php','Test Quote',0,0.00,1,NULL,'2018-11-25 15:51:57','2018-11-25 15:54:10'),(4,'2018-11-15',0,0,1,20,2,2,'2018-11-30','QUO4','Thank you for your business !','mBO1nUGwUXPLKxlc0jsBo1mPZjz7Bnt9','USD',1.0000000,'50% down, balance on completion','default.blade.php','Test Quote',0,0.00,1,NULL,'2018-11-25 15:52:13','2018-11-25 15:53:45'),(5,'2018-10-29',1,0,1,35,2,3,'2018-11-13','QUO5','Thank you for your business !','Ws2UCcV2U1fMSzT2LtVus5ZY7e7PF9VO','USD',1.0000000,'50% down, balance on completion','default.blade.php','Test Quote',0,0.00,1,NULL,'2018-11-25 15:52:31','2018-11-25 15:54:28'),(6,'2018-10-18',0,1,1,25,2,3,'2018-11-02','QUO6','Thank you for your business !','uvSbCcOtIErd3idpbpcyTDRh4elEt07a','USD',1.0000000,'50% down, balance on completion','default.blade.php','Test Quote',0,0.00,1,NULL,'2018-11-25 15:53:13','2018-11-25 15:54:43'),(7,'2018-12-06',0,0,1,24,2,1,'2018-12-21','QUO7','Thank you for your business !','ZRUUApw7CO7wVjGHWJU9ABtGkJRQSRyS','USD',1.0000000,'50% down, balance on completion','default.blade.php','Test Quote',0,0.00,1,NULL,'2018-11-25 15:53:32','2018-11-25 15:53:32');
/*!40000 ALTER TABLE `quotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotes_custom`
--

DROP TABLE IF EXISTS `quotes_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes_custom` (
  `quote_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`quote_id`),
  CONSTRAINT `quotes_custom_quote_id` FOREIGN KEY (`quote_id`) REFERENCES `quotes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotes_custom`
--

LOCK TABLES `quotes_custom` WRITE;
/*!40000 ALTER TABLE `quotes_custom` DISABLE KEYS */;
INSERT INTO `quotes_custom` VALUES (1,NULL,'2018-11-25 15:49:55','2018-11-25 15:49:55'),(2,NULL,'2018-11-25 15:49:55','2018-11-25 15:49:55'),(3,NULL,'2018-11-25 15:49:55','2018-11-25 15:49:55'),(4,NULL,'2018-11-25 15:49:55','2018-11-25 15:49:55'),(5,NULL,'2018-11-25 15:49:55','2018-11-25 15:49:55'),(6,NULL,'2018-11-25 15:49:55','2018-11-25 15:49:55'),(7,NULL,'2018-11-25 15:49:55','2018-11-25 15:49:55');
/*!40000 ALTER TABLE `quotes_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recurring_invoice_amounts`
--

DROP TABLE IF EXISTS `recurring_invoice_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recurring_invoice_amounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `recurring_invoice_id` int(10) unsigned NOT NULL,
  `subtotal` decimal(20,4) NOT NULL,
  `discount` decimal(20,4) NOT NULL,
  `tax` decimal(20,4) NOT NULL,
  `total` decimal(20,4) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recurring_invoice_amounts_recurring_invoice_id_index` (`recurring_invoice_id`),
  CONSTRAINT `recurring_invoice_amounts_recurring_invoice_id_index` FOREIGN KEY (`recurring_invoice_id`) REFERENCES `recurring_invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recurring_invoice_amounts`
--

LOCK TABLES `recurring_invoice_amounts` WRITE;
/*!40000 ALTER TABLE `recurring_invoice_amounts` DISABLE KEYS */;
INSERT INTO `recurring_invoice_amounts` VALUES (1,1,80.0000,0.0000,0.0000,80.0000,NULL,'2018-11-25 16:01:39','2018-11-25 16:02:25');
/*!40000 ALTER TABLE `recurring_invoice_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recurring_invoice_item_amounts`
--

DROP TABLE IF EXISTS `recurring_invoice_item_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recurring_invoice_item_amounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `subtotal` decimal(20,4) NOT NULL,
  `tax_1` decimal(20,4) NOT NULL,
  `tax_2` decimal(20,4) NOT NULL,
  `tax` decimal(20,4) NOT NULL,
  `total` decimal(20,4) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recurring_invoice_item_amounts_item_id_index` (`item_id`),
  CONSTRAINT `recurring_invoice_item_amounts_item_id_index` FOREIGN KEY (`item_id`) REFERENCES `recurring_invoice_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recurring_invoice_item_amounts`
--

LOCK TABLES `recurring_invoice_item_amounts` WRITE;
/*!40000 ALTER TABLE `recurring_invoice_item_amounts` DISABLE KEYS */;
INSERT INTO `recurring_invoice_item_amounts` VALUES (1,1,80.0000,0.0000,0.0000,0.0000,80.0000,NULL,'2018-11-25 16:02:25','2018-11-25 16:02:25');
/*!40000 ALTER TABLE `recurring_invoice_item_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recurring_invoice_items`
--

DROP TABLE IF EXISTS `recurring_invoice_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recurring_invoice_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `recurring_invoice_id` int(10) unsigned NOT NULL,
  `tax_rate_id` int(10) unsigned NOT NULL DEFAULT '0',
  `tax_rate_2_id` int(10) unsigned NOT NULL DEFAULT '0',
  `resource_table` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resource_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` decimal(20,4) NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT '0',
  `price` decimal(20,4) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recurring_invoice_items_display_order_index` (`display_order`),
  KEY `recurring_invoice_items_recurring_invoice_id_index` (`recurring_invoice_id`),
  CONSTRAINT `recurring_invoice_items_recurring_invoice_id_index` FOREIGN KEY (`recurring_invoice_id`) REFERENCES `recurring_invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recurring_invoice_items`
--

LOCK TABLES `recurring_invoice_items` WRITE;
/*!40000 ALTER TABLE `recurring_invoice_items` DISABLE KEYS */;
INSERT INTO `recurring_invoice_items` VALUES (1,1,0,0,'employees',3,'Adella J.','Worker-171 - Database updates',4.0000,1,20.0000,NULL,'2018-11-25 16:02:25','2018-11-25 16:02:25');
/*!40000 ALTER TABLE `recurring_invoice_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recurring_invoices`
--

DROP TABLE IF EXISTS `recurring_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recurring_invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned DEFAULT NULL,
  `company_profile_id` int(10) unsigned DEFAULT NULL,
  `terms` text COLLATE utf8mb4_unicode_ci,
  `footer` text COLLATE utf8mb4_unicode_ci,
  `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_rate` decimal(10,7) NOT NULL,
  `template` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `recurring_frequency` int(11) NOT NULL,
  `recurring_period` int(11) NOT NULL,
  `next_date` date NOT NULL,
  `stop_date` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recurring_invoices_client_id_index` (`client_id`),
  KEY `fk_recurring_invoices_groups1_idx` (`group_id`),
  KEY `recurring_invoices_company_profile_id_index` (`company_profile_id`),
  KEY `recurring_invoices_user_id_index` (`user_id`),
  CONSTRAINT `fk_recurring_invoices_groups1_idx` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `recurring_invoices_client_id_index` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `recurring_invoices_company_profile_id_index` FOREIGN KEY (`company_profile_id`) REFERENCES `company_profiles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `recurring_invoices_user_id_index` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recurring_invoices`
--

LOCK TABLES `recurring_invoices` WRITE;
/*!40000 ALTER TABLE `recurring_invoices` DISABLE KEYS */;
INSERT INTO `recurring_invoices` VALUES (1,1,47,1,1,'Due upon receipt','Thank you for your business !','USD',1.0000000,'default.blade.php','Test Recurring Invoice',0.00,1,3,'2018-11-25','2018-12-28',NULL,'2018-11-25 16:01:39','2018-11-25 16:02:25');
/*!40000 ALTER TABLE `recurring_invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recurring_invoices_custom`
--

DROP TABLE IF EXISTS `recurring_invoices_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recurring_invoices_custom` (
  `recurring_invoice_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`recurring_invoice_id`),
  CONSTRAINT `recurring_invoices_custom_recurring_invoice_id` FOREIGN KEY (`recurring_invoice_id`) REFERENCES `recurring_invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recurring_invoices_custom`
--

LOCK TABLES `recurring_invoices_custom` WRITE;
/*!40000 ALTER TABLE `recurring_invoices_custom` DISABLE KEYS */;
INSERT INTO `recurring_invoices_custom` VALUES (1,NULL,'2018-11-25 16:01:39','2018-11-25 16:01:39');
/*!40000 ALTER TABLE `recurring_invoices_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `isRecurring` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `rrule` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL DEFAULT '1',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `will_call` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_schedule_schedule_categories1_idx` (`category_id`),
  KEY `fk_schedule_users1_idx` (`user_id`),
  CONSTRAINT `fk_schedule_schedule_categories1_idx` FOREIGN KEY (`category_id`) REFERENCES `schedule_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_schedule_users1_idx` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule`
--

LOCK TABLES `schedule` WRITE;
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
INSERT INTO `schedule` VALUES (1,'Cara D.','Dentist',0,NULL,1,3,NULL,0,NULL,'2018-11-25 16:08:32','2018-11-25 16:08:32'),(2,'Board Meeting','Conference Room',0,NULL,1,2,NULL,0,NULL,'2018-11-25 16:09:28','2018-11-25 16:09:28'),(3,'Staff Meeting','Conference Room',1,'FREQ=WEEKLY;UNTIL=20181229T160000;DTSTART=20181005T080000;DTEND=20181005T090000;BYDAY=FR;WKST=MO',1,2,NULL,0,NULL,'2018-11-25 16:10:53','2018-11-25 16:10:53');
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule_categories`
--

DROP TABLE IF EXISTS `schedule_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedule_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_color` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bg_color` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule_categories`
--

LOCK TABLES `schedule_categories` WRITE;
/*!40000 ALTER TABLE `schedule_categories` DISABLE KEYS */;
INSERT INTO `schedule_categories` VALUES (1,'Worker Schedule','#000000','#aaffaa',NULL,NULL,NULL),(2,'General Appointment','#000000','#5656ff',NULL,NULL,NULL),(3,'Employee Appointment','#000000','#d4aaff',NULL,NULL,NULL),(4,'Quote','#ffffff','#716cb1',NULL,NULL,NULL),(5,'Workorder','#000000','#aaffaa',NULL,NULL,NULL),(6,'Invoice','#ffffff','#377eb8',NULL,NULL,NULL),(7,'Payment','#ffffff','#5fa213',NULL,NULL,NULL),(8,'Expense','#ffffff','#d95d02',NULL,NULL,NULL),(9,'Project','#ffffff','#676767',NULL,NULL,NULL),(10,'Task','#ffffff','#a87821',NULL,NULL,NULL);
/*!40000 ALTER TABLE `schedule_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule_occurrences`
--

DROP TABLE IF EXISTS `schedule_occurrences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedule_occurrences` (
  `oid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `schedule_id` int(10) unsigned NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`oid`),
  KEY `schedule_occurrence_event_id_foreign` (`schedule_id`),
  CONSTRAINT `schedule_occurrence_event_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule_occurrences`
--

LOCK TABLES `schedule_occurrences` WRITE;
/*!40000 ALTER TABLE `schedule_occurrences` DISABLE KEYS */;
INSERT INTO `schedule_occurrences` VALUES (1,1,'2018-11-08 10:00:00','2018-11-08 13:00:00',NULL,'2018-11-25 16:08:32','2018-11-25 16:08:32'),(2,2,'2018-11-05 09:30:00','2018-11-05 11:00:00',NULL,'2018-11-25 16:09:28','2018-11-25 16:09:28'),(3,3,'2018-10-05 08:00:00','2018-10-05 09:00:00',NULL,'2018-11-25 16:10:53','2018-11-25 16:10:53'),(4,3,'2018-10-12 08:00:00','2018-10-12 09:00:00',NULL,'2018-11-25 16:10:53','2018-11-25 16:10:53'),(5,3,'2018-10-19 08:00:00','2018-10-19 09:00:00',NULL,'2018-11-25 16:10:53','2018-11-25 16:10:53'),(6,3,'2018-10-26 08:00:00','2018-10-26 09:00:00',NULL,'2018-11-25 16:10:54','2018-11-25 16:10:54'),(7,3,'2018-11-02 08:00:00','2018-11-02 09:00:00',NULL,'2018-11-25 16:10:54','2018-11-25 16:10:54'),(8,3,'2018-11-09 08:00:00','2018-11-09 09:00:00',NULL,'2018-11-25 16:10:54','2018-11-25 16:10:54'),(9,3,'2018-11-16 08:00:00','2018-11-16 09:00:00',NULL,'2018-11-25 16:10:54','2018-11-25 16:10:54'),(10,3,'2018-11-23 08:00:00','2018-11-23 09:00:00',NULL,'2018-11-25 16:10:54','2018-11-25 16:10:54'),(11,3,'2018-11-30 08:00:00','2018-11-30 09:00:00',NULL,'2018-11-25 16:10:54','2018-11-25 16:10:54'),(12,3,'2018-12-07 08:00:00','2018-12-07 09:00:00',NULL,'2018-11-25 16:10:54','2018-11-25 16:10:54'),(13,3,'2018-12-14 08:00:00','2018-12-14 09:00:00',NULL,'2018-11-25 16:10:54','2018-11-25 16:10:54'),(14,3,'2018-12-21 08:00:00','2018-12-21 09:00:00',NULL,'2018-11-25 16:10:54','2018-11-25 16:10:54'),(15,3,'2018-12-28 08:00:00','2018-12-28 09:00:00',NULL,'2018-11-25 16:10:54','2018-11-25 16:10:54');
/*!40000 ALTER TABLE `schedule_occurrences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule_reminders`
--

DROP TABLE IF EXISTS `schedule_reminders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedule_reminders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `schedule_id` int(10) unsigned NOT NULL,
  `reminder_date` timestamp NULL DEFAULT NULL,
  `reminder_location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reminder_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedule_reminder_schedule_id_foreign` (`schedule_id`),
  CONSTRAINT `schedule_reminder_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule_reminders`
--

LOCK TABLES `schedule_reminders` WRITE;
/*!40000 ALTER TABLE `schedule_reminders` DISABLE KEYS */;
INSERT INTO `schedule_reminders` VALUES (1,1,'2018-11-05 16:00:00','here','there',NULL,'2018-11-25 16:08:32','2018-11-25 16:08:32'),(2,2,'2018-11-02 16:00:00','here','there',NULL,'2018-11-25 16:09:28','2018-11-25 16:09:28');
/*!40000 ALTER TABLE `schedule_reminders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule_resources`
--

DROP TABLE IF EXISTS `schedule_resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedule_resources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `schedule_id` int(10) unsigned NOT NULL,
  `resource_table` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resource_id` int(11) DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedule_resource_schedule_id_foreign` (`schedule_id`),
  CONSTRAINT `schedule_resource_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule_resources`
--

LOCK TABLES `schedule_resources` WRITE;
/*!40000 ALTER TABLE `schedule_resources` DISABLE KEYS */;
INSERT INTO `schedule_resources` VALUES (1,1,'employees',2,'Cara D.',1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `schedule_resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `settings_setting_key_index` (`setting_key`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'addressFormat','{{ address }}\r\n{{ city }}, {{ state }} {{ postal_code }}',NULL,NULL,NULL),(2,'allowPaymentsWithoutBalance','0',NULL,NULL,NULL),(3,'amountDecimals','2',NULL,NULL,NULL),(4,'attachPdf','1',NULL,NULL,NULL),(5,'automaticEmailOnRecur','0',NULL,NULL,'2018-11-25 15:41:01'),(6,'baseCurrency','USD',NULL,NULL,NULL),(7,'convertQuoteTerms','quote',NULL,NULL,NULL),(8,'convertQuoteWhenApproved','1',NULL,NULL,NULL),(9,'currencyConversionDriver','FixerIOCurrencyConverter',NULL,NULL,NULL),(10,'dashboardTotals','year_to_date',NULL,NULL,NULL),(11,'dateFormat','m/d/Y',NULL,NULL,NULL),(12,'defaultCompanyProfile','1',NULL,NULL,NULL),(13,'displayClientUniqueName','0',NULL,NULL,NULL),(14,'displayProfileImage','0',NULL,NULL,'2018-11-25 15:40:59'),(15,'exchangeRateMode','automatic',NULL,NULL,NULL),(16,'headerTitleText','FusionInvoiceFOSS',NULL,NULL,NULL),(17,'invoiceEmailBody','<p>To view your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }}, click the link below:</p>\r\n\r\n<p><a href=\"{{ $invoice->public_url }}\">{{ $invoice->public_url }}</a></p>',NULL,NULL,NULL),(18,'invoiceEmailSubject','Invoice #{{ $invoice->number }}',NULL,NULL,NULL),(19,'invoiceGroup','1',NULL,NULL,NULL),(20,'invoicesDueAfter','30',NULL,NULL,NULL),(21,'invoiceStatusFilter','all_statuses',NULL,NULL,NULL),(22,'invoiceTemplate','default.blade.php',NULL,NULL,NULL),(23,'language','en',NULL,NULL,NULL),(24,'markInvoicesSentPdf','0',NULL,NULL,NULL),(25,'markQuotesSentPdf','0',NULL,NULL,NULL),(26,'merchant','{\"PayPalExpress\":{\"enabled\":0,\"username\":\"\",\"password\":\"\",\"signature\":\"\",\"testMode\":0,\"paymentButtonText\":\"Pay with PayPal\"},\"Stripe\":{\"enabled\":0,\"secretKey\":\"\",\"publishableKey\":\"\",\"requireBillingName\":0,\"requireBillingAddress\":0,\"requireBillingCity\":0,\"requireBillingState\":0,\"requireBillingZip\":0,\"paymentButtonText\":\"Pay with Stripe\"},\"Mollie\":{\"enabled\":0,\"apiKey\":\"\",\"paymentButtonText\":\"Pay with Mollie\"}}',NULL,NULL,NULL),(27,'merchant_Mollie_apiKey','',NULL,NULL,NULL),(28,'merchant_Mollie_enabled','0',NULL,NULL,NULL),(29,'merchant_Mollie_paymentButtonText','Pay with Mollie',NULL,NULL,NULL),(30,'merchant_PayPal_paymentButtonText','Pay with PayPal',NULL,NULL,NULL),(31,'merchant_Stripe_enableBitcoinPayments','0',NULL,NULL,NULL),(32,'merchant_Stripe_enabled','0',NULL,NULL,NULL),(33,'merchant_Stripe_paymentButtonText','Pay with Stripe',NULL,NULL,NULL),(34,'merchant_Stripe_publishableKey','',NULL,NULL,NULL),(35,'merchant_Stripe_secretKey','',NULL,NULL,NULL),(36,'overdueInvoiceEmailBody','<p>This is a reminder to let you know your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }} is overdue. Click the link below to view the invoice:</p>\r\n\r\n<p><a href=\"{{ $invoice->public_url }}\">{{ $invoice->public_url }}</a></p>',NULL,NULL,NULL),(37,'overdueInvoiceEmailSubject','Overdue Invoice Reminder: Invoice #{{ $invoice->number }}',NULL,NULL,NULL),(38,'paperOrientation','portrait',NULL,NULL,NULL),(39,'paperSize','letter',NULL,NULL,NULL),(40,'paymentReceiptBody','<p>Thank you! Your payment of {{ $payment->formatted_amount }} has been applied to Invoice #{{ $payment->invoice->number }}.</p>',NULL,NULL,NULL),(41,'paymentReceiptEmailSubject','Payment Receipt for Invoice #{{ $payment->invoice->number }}',NULL,NULL,NULL),(42,'pdfDriver','domPDF',NULL,NULL,NULL),(43,'profileImageDriver','Gravatar',NULL,NULL,NULL),(44,'quoteApprovedEmailBody','<p><a href=\"{{ $quote->public_url }}\">Quote #{{ $quote->number }}</a> has been APPROVED.</p>',NULL,NULL,NULL),(45,'quoteEmailBody','<p>To view your quote from {{ $quote->user->name }} for {{ $quote->amount->formatted_total }}, click the link below:</p>\r\n\r\n<p><a href=\"{{ $quote->public_url }}\">{{ $quote->public_url }}</a></p>',NULL,NULL,NULL),(46,'quoteEmailSubject','Quote #{{ $quote->number }}',NULL,NULL,NULL),(47,'quoteGroup','2',NULL,NULL,NULL),(48,'quoteRejectedEmailBody','<p><a href=\"{{ $quote->public_url }}\">Quote #{{ $quote->number }}</a> has been REJECTED.</p>',NULL,NULL,NULL),(49,'quotesExpireAfter','15',NULL,NULL,NULL),(50,'quoteStatusFilter','all_statuses',NULL,NULL,NULL),(51,'quoteTemplate','default.blade.php',NULL,NULL,NULL),(52,'resultsPerPage','10',NULL,NULL,'2018-11-25 22:31:10'),(53,'roundTaxDecimals','3',NULL,NULL,NULL),(54,'skin','{\"headBackground\":\"purple\",\"headClass\":\"dark\",\"sidebarBackground\":\"white\",\"sidebarClass\":\"light\"}',NULL,NULL,'2018-11-25 22:31:10'),(55,'timezone','America/Phoenix',NULL,NULL,NULL),(56,'upcomingPaymentNoticeEmailBody','<p>This is a notice to let you know your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }} is due on {{ $invoice->formatted_due_at }}. Click the link below to view the invoice:</p>\r\n\r\n<p><a href=\"{{ $invoice->public_url }}\">{{ $invoice->public_url }}</a></p>',NULL,NULL,NULL),(57,'upcomingPaymentNoticeEmailSubject','Upcoming Payment Due Notice: Invoice #{{ $invoice->number }}',NULL,NULL,NULL),(58,'version','4.1.0',NULL,NULL,'2018-11-25 22:31:10'),(59,'widgetColumnWidthClientActivity','4',NULL,NULL,NULL),(60,'widgetColumnWidthInvoiceSummary','6',NULL,NULL,NULL),(61,'widgetColumnWidthQuoteSummary','6',NULL,NULL,NULL),(62,'widgetDisplayOrderClientActivity','3',NULL,NULL,NULL),(63,'widgetDisplayOrderInvoiceSummary','3',NULL,NULL,'2018-11-25 15:40:59'),(64,'widgetDisplayOrderQuoteSummary','1',NULL,NULL,'2018-11-25 15:41:00'),(65,'widgetEnabledClientActivity','0',NULL,NULL,NULL),(66,'widgetEnabledInvoiceSummary','1',NULL,NULL,NULL),(67,'widgetEnabledQuoteSummary','1',NULL,NULL,NULL),(68,'widgetInvoiceSummaryDashboardTotals','year_to_date',NULL,NULL,NULL),(69,'widgetQuoteSummaryDashboardTotals','year_to_date',NULL,NULL,NULL),(70,'restolup','0',NULL,NULL,NULL),(71,'emptolup','0',NULL,NULL,NULL),(72,'workorderTemplate','default.blade.php',NULL,NULL,NULL),(73,'workorderGroup','3',NULL,NULL,NULL),(74,'workordersExpireAfter','15',NULL,NULL,NULL),(75,'workorderTerms','50% down, balance on completion',NULL,NULL,'2018-11-25 15:41:01'),(76,'workorderFooter','Thank you for your business !',NULL,NULL,'2018-11-25 15:41:01'),(77,'convertWorkorderTerms','workorder',NULL,NULL,NULL),(78,'tsCompanyName','YOURQBCOMPANYNAME',NULL,NULL,NULL),(79,'tsCompanyCreate','YOURQBCOMPANYCREATETIME',NULL,NULL,NULL),(80,'workorderStatusFilter','all_statuses',NULL,NULL,NULL),(81,'schedulerPastdays','60',NULL,NULL,NULL),(82,'schedulerEventLimit','5',NULL,NULL,NULL),(83,'schedulerCreateWorkorder','1',NULL,NULL,'2018-11-25 15:41:03'),(84,'schedulerFcThemeSystem','jquery-ui',NULL,NULL,'2018-11-25 15:41:03'),(85,'schedulerFcAspectRatio','1.75',NULL,NULL,'2018-11-25 15:41:03'),(86,'schedulerTimestep','30',NULL,NULL,'2018-11-25 15:41:03'),(87,'schedulerEnabledCoreEvents','15',NULL,NULL,NULL),(88,'schedulerDisplayInvoiced','0',NULL,NULL,NULL),(89,'pdfDisposition','inline',NULL,NULL,NULL),(90,'jquiTheme','cupertino',NULL,'2018-11-25 22:31:10','2018-11-25 22:31:10'),(91,'enabledModules','63',NULL,'2018-11-25 22:31:10','2018-11-25 22:31:10'),(92,'use24HourTimeFormat','0',NULL,'2018-11-25 15:40:59','2018-11-25 15:40:59'),(93,'forceHttps','0',NULL,'2018-11-25 15:40:59','2018-11-25 15:40:59'),(94,'widgetInvoiceSummaryDashboardTotalsFromDate','',NULL,'2018-11-25 15:40:59','2018-11-25 15:40:59'),(95,'widgetInvoiceSummaryDashboardTotalsToDate','',NULL,'2018-11-25 15:41:00','2018-11-25 15:41:00'),(96,'widgetQuoteSummaryDashboardTotalsFromDate','',NULL,'2018-11-25 15:41:00','2018-11-25 15:41:00'),(97,'widgetQuoteSummaryDashboardTotalsToDate','',NULL,'2018-11-25 15:41:00','2018-11-25 15:41:00'),(98,'widgetEnabledRecentPayments','0',NULL,'2018-11-25 15:41:00','2018-11-25 15:41:00'),(99,'widgetDisplayOrderRecentPayments','1',NULL,'2018-11-25 15:41:00','2018-11-25 15:41:00'),(100,'widgetColumnWidthRecentPayments','1',NULL,'2018-11-25 15:41:00','2018-11-25 15:41:00'),(101,'widgetEnabledSchedulerSummary','1',NULL,'2018-11-25 15:41:00','2018-11-25 15:41:00'),(102,'widgetDisplayOrderSchedulerSummary','4',NULL,'2018-11-25 15:41:00','2018-11-25 15:41:00'),(103,'widgetColumnWidthSchedulerSummary','6',NULL,'2018-11-25 15:41:00','2018-11-25 15:41:00'),(104,'widgetEnabledTodaysWorkorders','0',NULL,'2018-11-25 15:41:00','2018-11-25 15:41:00'),(105,'widgetDisplayOrderTodaysWorkorders','1',NULL,'2018-11-25 15:41:00','2018-11-25 15:41:00'),(106,'widgetColumnWidthTodaysWorkorders','1',NULL,'2018-11-25 15:41:00','2018-11-25 15:41:00'),(107,'widgetEnabledWorkorderSummary','1',NULL,'2018-11-25 15:41:00','2018-11-25 15:41:00'),(108,'widgetDisplayOrderWorkorderSummary','2',NULL,'2018-11-25 15:41:00','2018-11-25 15:41:00'),(109,'widgetColumnWidthWorkorderSummary','6',NULL,'2018-11-25 15:41:00','2018-11-25 15:41:00'),(110,'widgetWorkorderSummaryDashboardTotals','year_to_date',NULL,'2018-11-25 15:41:00','2018-11-25 15:41:00'),(111,'widgetWorkorderSummaryDashboardTotalsFromDate','',NULL,'2018-11-25 15:41:01','2018-11-25 15:41:01'),(112,'invoiceTerms','Due upon receipt',NULL,'2018-11-25 15:41:01','2018-11-25 15:41:01'),(113,'invoiceFooter','Thank you for your business !',NULL,'2018-11-25 15:41:01','2018-11-25 15:41:01'),(114,'automaticEmailPaymentReceipts','0',NULL,'2018-11-25 15:41:01','2018-11-25 15:41:01'),(115,'onlinePaymentMethod','1',NULL,'2018-11-25 15:41:01','2018-11-25 15:41:01'),(116,'resetInvoiceDateEmailDraft','0',NULL,'2018-11-25 15:41:01','2018-11-25 15:41:01'),(117,'convertWorkorderWhenApproved','0',NULL,'2018-11-25 15:41:01','2018-11-25 15:41:01'),(118,'resetWorkorderDateEmailDraft','0',NULL,'2018-11-25 15:41:01','2018-11-25 15:41:01'),(119,'quoteTerms','50% down, balance on completion',NULL,'2018-11-25 15:41:02','2018-11-25 15:41:02'),(120,'quoteFooter','Thank you for your business !',NULL,'2018-11-25 15:41:02','2018-11-25 15:41:02'),(121,'resetQuoteDateEmailDraft','0',NULL,'2018-11-25 15:41:02','2018-11-25 15:41:02'),(122,'itemTaxRate','1',NULL,'2018-11-25 15:41:02','2018-11-25 15:42:51'),(123,'itemTax2Rate','0',NULL,'2018-11-25 15:41:02','2018-11-25 15:41:02'),(124,'mailDriver','',NULL,'2018-11-25 15:41:02','2018-11-25 15:41:02'),(125,'mailHost','',NULL,'2018-11-25 15:41:02','2018-11-25 15:41:02'),(126,'mailPort','',NULL,'2018-11-25 15:41:02','2018-11-25 15:41:02'),(127,'mailUsername','admin@example.com',NULL,'2018-11-25 15:41:02','2018-11-25 15:41:02'),(128,'mailPassword','eyJpdiI6IldOTStmQXVLdTlFNFJ3enBoYWRvbVE9PSIsInZhbHVlIjoiK0VxVnZWenJDdnNzYmUrODRMbUpxdz09IiwibWFjIjoiMjAwMmRlZjAzNzc0NjBlMTgzMjQ0NTRkM2RkY2UwZjExNGMxYmRkMTVjMjcxN2NkNzU5ZGY4ZmZkMjY0Yjk5NyJ9',NULL,'2018-11-25 15:41:02','2018-11-25 15:42:51'),(129,'mailEncryption','0',NULL,'2018-11-25 15:41:02','2018-11-25 15:41:02'),(130,'mailAllowSelfSignedCertificate','0',NULL,'2018-11-25 15:41:02','2018-11-25 15:41:02'),(131,'mailSendmail','',NULL,'2018-11-25 15:41:02','2018-11-25 15:41:02'),(132,'mailReplyToAddress','',NULL,'2018-11-25 15:41:02','2018-11-25 15:41:02'),(133,'mailDefaultCc','',NULL,'2018-11-25 15:41:02','2018-11-25 15:41:02'),(134,'mailDefaultBcc','',NULL,'2018-11-25 15:41:02','2018-11-25 15:41:02'),(135,'overdueInvoiceReminderFrequency','',NULL,'2018-11-25 15:41:03','2018-11-25 15:41:03'),(136,'upcomingPaymentNoticeFrequency','',NULL,'2018-11-25 15:41:03','2018-11-25 15:41:03'),(137,'workorderApprovedEmailBody','',NULL,'2018-11-25 15:41:03','2018-11-25 15:41:03'),(138,'workorderRejectedEmailBody','',NULL,'2018-11-25 15:41:03','2018-11-25 15:41:03'),(139,'pdfBinaryPath','',NULL,'2018-11-25 15:41:03','2018-11-25 15:41:03'),(140,'merchant_PayPal_enabled','0',NULL,'2018-11-25 15:41:03','2018-11-25 15:41:03'),(141,'merchant_PayPal_clientId','',NULL,'2018-11-25 15:41:03','2018-11-25 15:41:03'),(142,'merchant_PayPal_clientSecret','',NULL,'2018-11-25 15:41:03','2018-11-25 15:41:03'),(143,'merchant_PayPal_mode','sandbox',NULL,'2018-11-25 15:41:03','2018-11-25 15:41:03');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_rates`
--

DROP TABLE IF EXISTS `tax_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tax_rates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percent` decimal(5,3) NOT NULL DEFAULT '0.000',
  `is_compound` tinyint(4) NOT NULL DEFAULT '0',
  `calculate_vat` tinyint(4) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax_rates`
--

LOCK TABLES `tax_rates` WRITE;
/*!40000 ALTER TABLE `tax_rates` DISABLE KEYS */;
INSERT INTO `tax_rates` VALUES (1,'County',6.100,0,0,NULL,'2018-11-25 15:41:38','2018-11-25 15:42:19'),(2,'City+County',9.600,0,0,NULL,'2018-11-25 15:42:06','2018-11-25 15:42:28');
/*!40000 ALTER TABLE `tax_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `time_tracking_projects`
--

DROP TABLE IF EXISTS `time_tracking_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `time_tracking_projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_profile_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `client_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_at` timestamp NULL DEFAULT NULL,
  `hourly_rate` decimal(8,2) NOT NULL,
  `status_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `time_tracking_projects_user_id_index` (`user_id`),
  KEY `time_tracking_projects_company_profile_id_index` (`company_profile_id`),
  KEY `time_tracking_projects_client_id_index` (`client_id`),
  CONSTRAINT `time_tracking_projects_client_id_index` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `time_tracking_projects_company_profile_id_index` FOREIGN KEY (`company_profile_id`) REFERENCES `company_profiles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `time_tracking_projects_user_id_index` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `time_tracking_projects`
--

LOCK TABLES `time_tracking_projects` WRITE;
/*!40000 ALTER TABLE `time_tracking_projects` DISABLE KEYS */;
INSERT INTO `time_tracking_projects` VALUES (1,1,1,40,'Database Upgrade','2018-12-31 07:00:00',40.00,1,NULL,'2018-11-25 16:04:03','2018-11-25 16:04:03');
/*!40000 ALTER TABLE `time_tracking_projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `time_tracking_tasks`
--

DROP TABLE IF EXISTS `time_tracking_tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `time_tracking_tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time_tracking_project_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_order` tinyint(4) NOT NULL,
  `billed` tinyint(4) NOT NULL DEFAULT '0',
  `invoice_id` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `time_tracking_tasks_time_tracking_project_id_index` (`time_tracking_project_id`),
  KEY `time_tracking_tasks_invoice_id_index` (`invoice_id`),
  CONSTRAINT `time_tracking_tasks_invoice_id_index` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE SET NULL,
  CONSTRAINT `time_tracking_tasks_time_tracking_project_id_index` FOREIGN KEY (`time_tracking_project_id`) REFERENCES `time_tracking_projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `time_tracking_tasks`
--

LOCK TABLES `time_tracking_tasks` WRITE;
/*!40000 ALTER TABLE `time_tracking_tasks` DISABLE KEYS */;
INSERT INTO `time_tracking_tasks` VALUES (1,1,'Prep',1,1,5,NULL,'2018-11-25 16:04:18','2018-11-25 16:05:40'),(2,1,'Convert',2,0,NULL,NULL,'2018-11-25 16:04:24','2018-11-25 16:04:24');
/*!40000 ALTER TABLE `time_tracking_tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `time_tracking_timers`
--

DROP TABLE IF EXISTS `time_tracking_timers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `time_tracking_timers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time_tracking_task_id` int(10) unsigned NOT NULL,
  `start_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `hours` decimal(8,2) NOT NULL DEFAULT '0.00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `time_tracking_timers_time_tracking_task_id_index` (`time_tracking_task_id`),
  CONSTRAINT `time_tracking_timers_time_tracking_task_id_index` FOREIGN KEY (`time_tracking_task_id`) REFERENCES `time_tracking_tasks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `time_tracking_timers`
--

LOCK TABLES `time_tracking_timers` WRITE;
/*!40000 ALTER TABLE `time_tracking_timers` DISABLE KEYS */;
INSERT INTO `time_tracking_timers` VALUES (1,1,'2018-11-15 15:00:00','2018-11-16 01:00:00',10.00,NULL,'2018-11-25 16:04:49','2018-11-25 16:04:49'),(2,2,'2018-11-22 15:00:00','2018-11-23 04:00:00',13.00,NULL,'2018-11-25 16:05:19','2018-11-25 16:05:19');
/*!40000 ALTER TABLE `time_tracking_timers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_public_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_secret_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@example.com','$2y$10$jbvoe/DW84VrdFl8kf4LLei/JGdQ0BRwFZDFsxyHHD1PyoNOLiXtW','admin','9SLObmMWKzlymJk2k372Rhnew3kG5t4n1ztFER48pzXRlc9hR2cz9VjLnoUe',NULL,NULL,NULL,NULL,'2018-11-25 15:36:02','2018-11-25 15:36:02');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_custom`
--

DROP TABLE IF EXISTS `users_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_custom` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `users_custom_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_custom`
--

LOCK TABLES `users_custom` WRITE;
/*!40000 ALTER TABLE `users_custom` DISABLE KEYS */;
INSERT INTO `users_custom` VALUES (1,NULL,'2018-11-25 15:36:02','2018-11-25 15:36:02');
/*!40000 ALTER TABLE `users_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workorder_amounts`
--

DROP TABLE IF EXISTS `workorder_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workorder_amounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `workorder_id` int(10) unsigned NOT NULL,
  `subtotal` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `discount` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `workorder_amounts_workorder_id_index` (`workorder_id`),
  CONSTRAINT `workorder_amounts_workorder_id_index` FOREIGN KEY (`workorder_id`) REFERENCES `workorders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workorder_amounts`
--

LOCK TABLES `workorder_amounts` WRITE;
/*!40000 ALTER TABLE `workorder_amounts` DISABLE KEYS */;
INSERT INTO `workorder_amounts` VALUES (1,1,228.3800,0.0000,0.0000,228.3800,NULL,'2018-11-25 15:54:28','2018-11-25 15:54:29'),(2,2,268.0000,0.0000,0.0000,268.0000,NULL,'2018-11-25 15:55:24','2018-11-25 15:56:30'),(3,3,134.5800,0.0000,0.0000,134.5800,NULL,'2018-11-25 15:56:47','2018-11-25 15:57:56');
/*!40000 ALTER TABLE `workorder_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workorder_item_amounts`
--

DROP TABLE IF EXISTS `workorder_item_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workorder_item_amounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `subtotal` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax_1` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax_2` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `workorder_item_amounts_item_id_index` (`item_id`),
  CONSTRAINT `workorder_item_amounts_item_id_index` FOREIGN KEY (`item_id`) REFERENCES `workorder_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workorder_item_amounts`
--

LOCK TABLES `workorder_item_amounts` WRITE;
/*!40000 ALTER TABLE `workorder_item_amounts` DISABLE KEYS */;
INSERT INTO `workorder_item_amounts` VALUES (1,1,106.8100,0.0000,0.0000,0.0000,106.8100,NULL,'2018-11-25 15:54:28','2018-11-25 15:54:29'),(2,2,41.5700,0.0000,0.0000,0.0000,41.5700,NULL,'2018-11-25 15:54:28','2018-11-25 15:54:29'),(3,3,80.0000,0.0000,0.0000,0.0000,80.0000,NULL,'2018-11-25 15:54:29','2018-11-25 15:54:29'),(4,4,268.0000,0.0000,0.0000,0.0000,268.0000,NULL,'2018-11-25 15:56:29','2018-11-25 15:56:30'),(5,5,0.0000,0.0000,0.0000,0.0000,0.0000,NULL,'2018-11-25 15:56:29','2018-11-25 15:56:30'),(6,6,0.0000,0.0000,0.0000,0.0000,0.0000,NULL,'2018-11-25 15:56:30','2018-11-25 15:56:30'),(7,7,268.0000,0.0000,0.0000,0.0000,268.0000,'2018-11-25 15:56:52','2018-11-25 15:56:47','2018-11-25 15:56:52'),(8,8,0.0000,0.0000,0.0000,0.0000,0.0000,'2018-11-25 15:56:55','2018-11-25 15:56:47','2018-11-25 15:56:55'),(9,9,0.0000,0.0000,0.0000,0.0000,0.0000,'2018-11-25 15:56:58','2018-11-25 15:56:48','2018-11-25 15:56:58'),(10,10,134.5800,0.0000,0.0000,0.0000,134.5800,NULL,'2018-11-25 15:57:25','2018-11-25 15:57:56'),(11,11,0.0000,0.0000,0.0000,0.0000,0.0000,NULL,'2018-11-25 15:57:26','2018-11-25 15:57:56'),(12,12,0.0000,0.0000,0.0000,0.0000,0.0000,NULL,'2018-11-25 15:57:26','2018-11-25 15:57:56'),(13,13,0.0000,0.0000,0.0000,0.0000,0.0000,NULL,'2018-11-25 15:57:26','2018-11-25 15:57:56');
/*!40000 ALTER TABLE `workorder_item_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workorder_items`
--

DROP TABLE IF EXISTS `workorder_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workorder_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `workorder_id` int(10) unsigned NOT NULL,
  `tax_rate_id` int(11) NOT NULL,
  `tax_rate_2_id` int(11) NOT NULL DEFAULT '0',
  `resource_table` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resource_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `display_order` int(11) NOT NULL,
  `price` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `workorder_items_tax_rate_2_id_index` (`tax_rate_2_id`),
  KEY `workorder_items_display_order_index` (`display_order`),
  KEY `workorder_items_tax_rate_id_index` (`tax_rate_id`),
  KEY `workorder_items_workorder_id_index` (`workorder_id`),
  CONSTRAINT `workorder_items_workorder_id_index` FOREIGN KEY (`workorder_id`) REFERENCES `workorders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workorder_items`
--

LOCK TABLES `workorder_items` WRITE;
/*!40000 ALTER TABLE `workorder_items` DISABLE KEYS */;
INSERT INTO `workorder_items` VALUES (1,1,0,0,'products',2,'Incredible Copper Knife','Non veritatis occaecati modi rerum dolor.',1.0000,1,106.8100,NULL,'2018-11-25 15:54:28','2018-11-25 15:54:28'),(2,1,0,0,'products',8,'Aerodynamic Linen Table','Consectetur omnis ratione molestias enim at.',1.0000,2,41.5700,NULL,'2018-11-25 15:54:28','2018-11-25 15:54:28'),(3,1,0,0,'employees',3,'Adella J.','Worker-171',4.0000,3,20.0000,NULL,'2018-11-25 15:54:29','2018-11-25 15:54:29'),(4,2,0,0,'products',11,'Gorgeous Linen Car','Laudantium neque ad quasi est dolore.',2.0000,1,134.0000,NULL,'2018-11-25 15:56:29','2018-11-25 15:56:29'),(5,2,0,0,'employees',3,'Adella J.','Worker-171',0.0000,2,20.0000,NULL,'2018-11-25 15:56:29','2018-11-25 15:56:29'),(6,2,0,0,'employees',6,'Ari L.','Worker-337',0.0000,3,20.0000,NULL,'2018-11-25 15:56:30','2018-11-25 15:56:30'),(7,3,0,0,'products',11,'Gorgeous Linen Car','Laudantium neque ad quasi est dolore.',2.0000,1,134.0000,'2018-11-25 15:56:52','2018-11-25 15:56:47','2018-11-25 15:56:52'),(8,3,0,0,'employees',3,'Adella J.','Worker-171',0.0000,2,20.0000,'2018-11-25 15:56:55','2018-11-25 15:56:47','2018-11-25 15:56:55'),(9,3,0,0,'employees',6,'Ari L.','Worker-337',0.0000,3,20.0000,'2018-11-25 15:56:58','2018-11-25 15:56:47','2018-11-25 15:56:58'),(10,3,0,0,'products',18,'Heavy Duty Cotton Bench','Qui commodi et laudantium corporis velit.',2.0000,1,67.2900,NULL,'2018-11-25 15:57:25','2018-11-25 15:57:55'),(11,3,0,0,'employees',9,'Henderson A.','Worker-820',0.0000,2,20.0000,NULL,'2018-11-25 15:57:25','2018-11-25 15:57:56'),(12,3,0,0,'employees',6,'Ari L.','Worker-337',0.0000,3,20.0000,NULL,'2018-11-25 15:57:26','2018-11-25 15:57:56'),(13,3,0,0,'employees',8,'Garfield H.','Worker-759',0.0000,4,20.0000,NULL,'2018-11-25 15:57:26','2018-11-25 15:57:56');
/*!40000 ALTER TABLE `workorder_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workorders`
--

DROP TABLE IF EXISTS `workorders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workorders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `workorder_date` date NOT NULL,
  `invoice_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `workorder_status_id` int(11) NOT NULL,
  `expires_at` date NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer` text COLLATE utf8mb4_unicode_ci,
  `url_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exchange_rate` decimal(10,7) NOT NULL DEFAULT '1.0000000',
  `terms` text COLLATE utf8mb4_unicode_ci,
  `template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viewed` tinyint(4) NOT NULL DEFAULT '0',
  `discount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `job_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `will_call` tinyint(4) NOT NULL DEFAULT '0',
  `company_profile_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `workorders_group_id_index` (`group_id`),
  KEY `workorders_company_profile_id_index` (`company_profile_id`),
  KEY `workorders_number_index` (`number`),
  KEY `workorders_user_id_index` (`user_id`),
  KEY `workorders_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workorders`
--

LOCK TABLES `workorders` WRITE;
/*!40000 ALTER TABLE `workorders` DISABLE KEYS */;
INSERT INTO `workorders` VALUES (1,'2018-11-25',0,1,35,3,1,'2018-12-10','WO1','Thank you for your business !','xSefXQrndbs0pTnwcSls77Vcx795gS5V','USD',1.0000000,'50% down, balance on completion','default.blade.php','Test Quote',0,0.00,'2018-11-25','08:00:00','09:00:00',0,1,NULL,'2018-11-25 15:54:28','2018-11-25 15:54:28'),(2,'2018-11-23',0,1,26,3,2,'2018-12-08','WO2','Thank you for your business !','aPTXo09RcbCcnOKZCwXO9BFvGJIyJlCT','USD',1.0000000,'50% down, balance on completion','default.blade.php','Test Workorder',0,0.00,'2018-11-25','10:00:00','14:00:00',1,1,NULL,'2018-11-25 15:55:24','2018-11-25 15:56:29'),(3,'2018-11-28',2,1,16,3,3,'2018-12-13','WO3','Thank you for your business !','Ftm1oORM6WlYgajMjSrlg7l4RtAQRhMa','USD',1.0000000,'50% down, balance on completion','default.blade.php','Test Workorder',0,0.00,'2018-11-25','10:00:00','14:00:00',1,1,NULL,'2018-11-25 15:56:47','2018-11-25 15:58:18');
/*!40000 ALTER TABLE `workorders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workorders_custom`
--

DROP TABLE IF EXISTS `workorders_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workorders_custom` (
  `workorder_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`workorder_id`),
  CONSTRAINT `workorders_custom_workorder_id` FOREIGN KEY (`workorder_id`) REFERENCES `workorders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workorders_custom`
--

LOCK TABLES `workorders_custom` WRITE;
/*!40000 ALTER TABLE `workorders_custom` DISABLE KEYS */;
INSERT INTO `workorders_custom` VALUES (1,NULL,'2018-11-25 15:54:28','2018-11-25 15:54:28'),(2,NULL,'2018-11-25 15:55:24','2018-11-25 15:55:24'),(3,NULL,'2018-11-25 15:55:24','2018-11-25 15:55:24');
/*!40000 ALTER TABLE `workorders_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'FusionInvoiceFOSS-demo'
--

--
-- Dumping routines for database 'FusionInvoiceFOSS-demo'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-25  9:12:17
