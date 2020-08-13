CREATE DATABASE  IF NOT EXISTS `BillingTrack-dev` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `BillingTrack-dev`;
-- MySQL dump 10.13  Distrib 8.0.16, for Linux (x86_64)
--
-- Host:    Database: BillingTrack-dev
-- username: admin@example.com      password:  secret
-- ------------------------------------------------------
-- Server version	8.0.21-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8 ;
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
SET character_set_client = utf8mb4 ;
CREATE TABLE `activities` (
                              `id` int unsigned NOT NULL AUTO_INCREMENT,
                              `audit_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `activity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `audit_id` int NOT NULL,
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
SET character_set_client = utf8mb4 ;
CREATE TABLE `addons` (
                          `id` int unsigned NOT NULL AUTO_INCREMENT,
                          `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `author_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `author_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `navigation_menu` longtext COLLATE utf8mb4_unicode_ci,
                          `system_menu` longtext COLLATE utf8mb4_unicode_ci,
                          `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `enabled` tinyint NOT NULL DEFAULT '0',
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
SET character_set_client = utf8mb4 ;
CREATE TABLE `attachments` (
                               `id` int unsigned NOT NULL AUTO_INCREMENT,
                               `user_id` int unsigned DEFAULT NULL,
                               `attachable_id` int NOT NULL,
                               `attachable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `mimetype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `size` int NOT NULL,
                               `url_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `client_visibility` int NOT NULL DEFAULT '0',
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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `categories` (
                              `id` int unsigned NOT NULL AUTO_INCREMENT,
                              `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `deleted_at` timestamp NULL DEFAULT NULL,
                              `created_at` timestamp NULL DEFAULT NULL,
                              `updated_at` timestamp NULL DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `clients` (
                           `id` int unsigned NOT NULL AUTO_INCREMENT,
                           `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `address` text COLLATE utf8mb4_unicode_ci,
                           `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `address_2` text COLLATE utf8mb4_unicode_ci,
                           `city_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `state_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `zip_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `country_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `url_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `active` tinyint NOT NULL DEFAULT '1',
                           `is_company` tinyint NOT NULL DEFAULT '0',
                           `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `unique_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `id_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `vat_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `industry_id` int unsigned DEFAULT '1',
                           `size_id` int unsigned DEFAULT '1',
                           `paymentterm_id` int unsigned DEFAULT '1',
                           `deleted_at` timestamp NULL DEFAULT NULL,
                           `created_at` timestamp NULL DEFAULT NULL,
                           `updated_at` timestamp NULL DEFAULT NULL,
                           PRIMARY KEY (`id`),
                           KEY `clients_unique_name_index` (`unique_name`),
                           KEY `clients_active_index` (`active`),
                           KEY `clients_name_index` (`name`),
                           KEY `clients_industry_id_foreign` (`industry_id`),
                           KEY `clients_size_id_foreign` (`size_id`),
                           KEY `clients_paymentterm_id_foreign` (`paymentterm_id`),
                           CONSTRAINT `clients_industry_id_foreign` FOREIGN KEY (`industry_id`) REFERENCES `industries` (`id`),
                           CONSTRAINT `clients_paymentterm_id_foreign` FOREIGN KEY (`paymentterm_id`) REFERENCES `payment_terms` (`id`),
                           CONSTRAINT `clients_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients_custom`
--

DROP TABLE IF EXISTS `clients_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `clients_custom` (
                                  `client_id` int unsigned NOT NULL AUTO_INCREMENT,
                                  `deleted_at` timestamp NULL DEFAULT NULL,
                                  `created_at` timestamp NULL DEFAULT NULL,
                                  `updated_at` timestamp NULL DEFAULT NULL,
                                  PRIMARY KEY (`client_id`),
                                  CONSTRAINT `clients_custom_client_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients_custom`
--

LOCK TABLES `clients_custom` WRITE;
/*!40000 ALTER TABLE `clients_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_profiles`
--

DROP TABLE IF EXISTS `company_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `company_profiles` (
                                    `id` int unsigned NOT NULL AUTO_INCREMENT,
                                    `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `address` text COLLATE utf8mb4_unicode_ci,
                                    `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `address_2` text COLLATE utf8mb4_unicode_ci,
                                    `city_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `state_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `zip_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `country_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `id_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `vat_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `quote_template` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.blade.php',
                                    `workorder_template` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.blade.php',
                                    `invoice_template` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.blade.php',
                                    `purchaseorder_template` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.blade.php',
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
INSERT INTO `company_profiles` VALUES (1,'Soylent Corp.','','','','','',NULL,NULL,NULL,NULL,NULL,'','','',NULL,'','USD','en',NULL,NULL,NULL,'default.blade.php','default.blade.php','default.blade.php','default.blade.php',NULL,'2020-08-04 18:31:28','2020-08-04 18:31:28');
/*!40000 ALTER TABLE `company_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_profiles_custom`
--

DROP TABLE IF EXISTS `company_profiles_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `company_profiles_custom` (
                                           `company_profile_id` int unsigned NOT NULL AUTO_INCREMENT,
                                           `deleted_at` timestamp NULL DEFAULT NULL,
                                           `created_at` timestamp NULL DEFAULT NULL,
                                           `updated_at` timestamp NULL DEFAULT NULL,
                                           PRIMARY KEY (`company_profile_id`),
                                           CONSTRAINT `company_profiles_custom_company_profile_id` FOREIGN KEY (`company_profile_id`) REFERENCES `company_profiles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_profiles_custom`
--

LOCK TABLES `company_profiles_custom` WRITE;
/*!40000 ALTER TABLE `company_profiles_custom` DISABLE KEYS */;
INSERT INTO `company_profiles_custom` VALUES (1,NULL,'2020-08-04 18:31:28','2020-08-04 18:31:28');
/*!40000 ALTER TABLE `company_profiles_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `contacts` (
                            `id` int unsigned NOT NULL AUTO_INCREMENT,
                            `client_id` int unsigned NOT NULL,
                            `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `title_id` int unsigned DEFAULT '1',
                            `default_to` tinyint NOT NULL DEFAULT '0',
                            `default_cc` tinyint NOT NULL DEFAULT '0',
                            `default_bcc` tinyint NOT NULL DEFAULT '0',
                            `is_primary` tinyint NOT NULL DEFAULT '0',
                            `optin` tinyint NOT NULL DEFAULT '1',
                            `deleted_at` timestamp NULL DEFAULT NULL,
                            `created_at` timestamp NULL DEFAULT NULL,
                            `updated_at` timestamp NULL DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            KEY `contacts_client_id_index` (`client_id`),
                            KEY `contacts_title_id_foreign` (`title_id`),
                            CONSTRAINT `contacts_client_id_index` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
                            CONSTRAINT `contacts_title_id_foreign` FOREIGN KEY (`title_id`) REFERENCES `titles` (`id`)
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
SET character_set_client = utf8mb4 ;
CREATE TABLE `currencies` (
                              `id` int unsigned NOT NULL AUTO_INCREMENT,
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
SET character_set_client = utf8mb4 ;
CREATE TABLE `custom_fields` (
                                 `id` int unsigned NOT NULL AUTO_INCREMENT,
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
SET character_set_client = utf8mb4 ;
CREATE TABLE `employees` (
                             `id` int unsigned NOT NULL AUTO_INCREMENT,
                             `number` int NOT NULL,
                             `first_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
                             `last_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
                             `full_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
                             `short_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
                             `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
                             `billing_rate` decimal(15,2) NOT NULL DEFAULT '0.00',
                             `schedule` tinyint NOT NULL DEFAULT '0',
                             `active` tinyint NOT NULL DEFAULT '0',
                             `driver` tinyint NOT NULL DEFAULT '0',
                             `deleted_at` timestamp NULL DEFAULT NULL,
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `expenses` (
                            `id` int unsigned NOT NULL AUTO_INCREMENT,
                            `expense_date` date NOT NULL,
                            `user_id` int unsigned DEFAULT NULL,
                            `category_id` int unsigned NOT NULL,
                            `client_id` int unsigned NOT NULL DEFAULT '0',
                            `vendor_id` int unsigned NOT NULL DEFAULT '0',
                            `invoice_id` int unsigned DEFAULT NULL,
                            `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `amount` decimal(15,2) NOT NULL,
                            `tax` decimal(20,4) NOT NULL,
                            `company_profile_id` int unsigned DEFAULT NULL,
                            `deleted_at` timestamp NULL DEFAULT NULL,
                            `created_at` timestamp NULL DEFAULT NULL,
                            `updated_at` timestamp NULL DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            KEY `expenses_category_id_index` (`category_id`),
                            KEY `fk_expenses_invoices1_idx` (`invoice_id`),
                            KEY `expenses_company_profile_id_index` (`company_profile_id`),
                            KEY `fk_expenses_users1_idx` (`user_id`),
                            CONSTRAINT `expenses_category_id_index` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
                            CONSTRAINT `expenses_company_profile_id_index` FOREIGN KEY (`company_profile_id`) REFERENCES `company_profiles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
                            CONSTRAINT `fk_expenses_invoices1_idx` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
                            CONSTRAINT `fk_expenses_users1_idx` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses_custom`
--

DROP TABLE IF EXISTS `expenses_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `expenses_custom` (
                                   `expense_id` int unsigned NOT NULL AUTO_INCREMENT,
                                   `deleted_at` timestamp NULL DEFAULT NULL,
                                   `created_at` timestamp NULL DEFAULT NULL,
                                   `updated_at` timestamp NULL DEFAULT NULL,
                                   PRIMARY KEY (`expense_id`),
                                   CONSTRAINT `expenses_custom_expense_id` FOREIGN KEY (`expense_id`) REFERENCES `expenses` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses_custom`
--

LOCK TABLES `expenses_custom` WRITE;
/*!40000 ALTER TABLE `expenses_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `groups` (
                          `id` int unsigned NOT NULL AUTO_INCREMENT,
                          `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `next_id` int NOT NULL DEFAULT '1',
                          `left_pad` int NOT NULL DEFAULT '0',
                          `format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `reset_number` int NOT NULL,
                          `last_id` int NOT NULL,
                          `last_year` int NOT NULL,
                          `last_month` int NOT NULL,
                          `last_week` int NOT NULL,
                          `last_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `deleted_at` timestamp NULL DEFAULT NULL,
                          `created_at` timestamp NULL DEFAULT NULL,
                          `updated_at` timestamp NULL DEFAULT NULL,
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Invoice Default',1,0,'INV{NUMBER}',0,0,0,0,0,'0',NULL,NULL,NULL),(2,'Quote Default',1,0,'QUO{NUMBER}',0,0,0,0,0,'0',NULL,NULL,NULL),(3,'Workorder Default',1,0,'WO{NUMBER}',0,0,0,0,0,'0',NULL,NULL,NULL),(4,'Purchaseorder Default',1,0,'PO{NUMBER}',0,0,0,0,0,'',NULL,NULL,NULL);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `industries`
--

DROP TABLE IF EXISTS `industries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `industries` (
                              `id` int unsigned NOT NULL AUTO_INCREMENT,
                              `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `industries`
--

LOCK TABLES `industries` WRITE;
/*!40000 ALTER TABLE `industries` DISABLE KEYS */;
INSERT INTO `industries` VALUES (1,''),(2,'Accounting & Legal'),(3,'Advertising'),(4,'Aerospace'),(5,'Agriculture'),(6,'Automotive'),(7,'Banking & Finance'),(8,'Biotechnology'),(9,'Broadcasting'),(10,'Business Services'),(11,'Commodities & Chemicals'),(12,'Communications'),(13,'Computers & Hightech'),(14,'Construction'),(15,'Defense'),(16,'Energy'),(17,'Entertainment'),(18,'Government'),(19,'Healthcare & Life Sciences'),(20,'Insurance'),(21,'Manufacturing'),(22,'Marketing'),(23,'Media'),(24,'Nonprofit & Higher Ed'),(25,'Pharmaceuticals'),(26,'Photography'),(27,'Professional Services & Consulting'),(28,'Real Estate'),(29,'Restaurant & Catering'),(30,'Retail & Wholesale'),(31,'Sports'),(32,'Transportation'),(33,'Travel & Luxury'),(34,'Other');
/*!40000 ALTER TABLE `industries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_types`
--

DROP TABLE IF EXISTS `inventory_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `inventory_types` (
                                   `id` int unsigned NOT NULL AUTO_INCREMENT,
                                   `name` varchar(85) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                   `tracked` tinyint NOT NULL DEFAULT '0',
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_types`
--

LOCK TABLES `inventory_types` WRITE;
/*!40000 ALTER TABLE `inventory_types` DISABLE KEYS */;
INSERT INTO `inventory_types` VALUES (1,'',0),(2,'Rental',1),(3,'Resale',1),(4,'Labor',0),(5,'Asset',0),(6,'Non-Inventory',0),(7,'Other',0),(8,'Raw Materials',1),(9,'W.I.P.',1),(10,'Finished Goods',1);
/*!40000 ALTER TABLE `inventory_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_amounts`
--

DROP TABLE IF EXISTS `invoice_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `invoice_amounts` (
                                   `id` int unsigned NOT NULL AUTO_INCREMENT,
                                   `invoice_id` int unsigned NOT NULL,
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
                                   CONSTRAINT `invoice_amounts_invoice_id_index` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_amounts`
--

LOCK TABLES `invoice_amounts` WRITE;
/*!40000 ALTER TABLE `invoice_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_item_amounts`
--

DROP TABLE IF EXISTS `invoice_item_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `invoice_item_amounts` (
                                        `id` int unsigned NOT NULL AUTO_INCREMENT,
                                        `item_id` int unsigned NOT NULL,
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
                                        CONSTRAINT `invoice_item_amounts_item_id_index` FOREIGN KEY (`item_id`) REFERENCES `invoice_items` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_item_amounts`
--

LOCK TABLES `invoice_item_amounts` WRITE;
/*!40000 ALTER TABLE `invoice_item_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_item_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_items`
--

DROP TABLE IF EXISTS `invoice_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `invoice_items` (
                                 `id` int unsigned NOT NULL AUTO_INCREMENT,
                                 `invoice_id` int unsigned NOT NULL,
                                 `tax_rate_id` int unsigned NOT NULL,
                                 `tax_rate_2_id` int unsigned NOT NULL DEFAULT '0',
                                 `resource_table` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                 `resource_id` int unsigned DEFAULT NULL,
                                 `is_tracked` tinyint NOT NULL DEFAULT '0',
                                 `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `quantity` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                 `display_order` int NOT NULL DEFAULT '0',
                                 `price` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                 `deleted_at` timestamp NULL DEFAULT NULL,
                                 `created_at` timestamp NULL DEFAULT NULL,
                                 `updated_at` timestamp NULL DEFAULT NULL,
                                 PRIMARY KEY (`id`),
                                 KEY `invoice_items_display_order_index` (`display_order`),
                                 KEY `invoice_items_invoice_id_index` (`invoice_id`),
                                 CONSTRAINT `invoice_items_invoice_id_index` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_items`
--

LOCK TABLES `invoice_items` WRITE;
/*!40000 ALTER TABLE `invoice_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_transactions`
--

DROP TABLE IF EXISTS `invoice_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `invoice_transactions` (
                                        `id` int unsigned NOT NULL AUTO_INCREMENT,
                                        `invoice_id` int unsigned NOT NULL,
                                        `is_successful` tinyint NOT NULL,
                                        `transaction_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                        `deleted_at` timestamp NULL DEFAULT NULL,
                                        `created_at` timestamp NULL DEFAULT NULL,
                                        `updated_at` timestamp NULL DEFAULT NULL,
                                        PRIMARY KEY (`id`),
                                        KEY `fk_invoice_transactions_invoices1_idx` (`invoice_id`),
                                        CONSTRAINT `fk_invoice_transactions_invoices1_idx` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
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
SET character_set_client = utf8mb4 ;
CREATE TABLE `invoices` (
                            `id` int unsigned NOT NULL AUTO_INCREMENT,
                            `invoice_date` date NOT NULL,
                            `invoice_id_ref` int DEFAULT NULL,
                            `user_id` int unsigned DEFAULT NULL,
                            `client_id` int unsigned NOT NULL,
                            `group_id` int unsigned DEFAULT NULL,
                            `invoice_type_id` tinyint NOT NULL DEFAULT '1',
                            `invoice_status_id` int NOT NULL,
                            `due_at` date NOT NULL,
                            `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `terms` text COLLATE utf8mb4_unicode_ci,
                            `footer` text COLLATE utf8mb4_unicode_ci,
                            `url_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `exchange_rate` decimal(10,7) NOT NULL DEFAULT '1.0000000',
                            `template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `summary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `viewed` tinyint NOT NULL DEFAULT '0',
                            `discount` decimal(15,2) NOT NULL DEFAULT '0.00',
                            `company_profile_id` int unsigned DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices_custom`
--

DROP TABLE IF EXISTS `invoices_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `invoices_custom` (
                                   `invoice_id` int unsigned NOT NULL AUTO_INCREMENT,
                                   `deleted_at` timestamp NULL DEFAULT NULL,
                                   `created_at` timestamp NULL DEFAULT NULL,
                                   `updated_at` timestamp NULL DEFAULT NULL,
                                   PRIMARY KEY (`invoice_id`),
                                   CONSTRAINT `invoices_custom_invoice_id` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices_custom`
--

LOCK TABLES `invoices_custom` WRITE;
/*!40000 ALTER TABLE `invoices_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoices_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_lookups`
--

DROP TABLE IF EXISTS `item_lookups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `item_lookups` (
                                `id` int unsigned NOT NULL AUTO_INCREMENT,
                                `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
                                `price` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                `tax_rate_id` int NOT NULL DEFAULT '0',
                                `tax_rate_2_id` int NOT NULL DEFAULT '0',
                                `resource_table` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                `resource_id` int unsigned DEFAULT NULL,
                                `deleted_at` timestamp NULL DEFAULT NULL,
                                `created_at` timestamp NULL DEFAULT NULL,
                                `updated_at` timestamp NULL DEFAULT NULL,
                                PRIMARY KEY (`id`),
                                KEY `item_lookups_tax_rate_id_index` (`tax_rate_id`),
                                KEY `item_lookups_tax_rate_2_id_index` (`tax_rate_2_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_lookups`
--

LOCK TABLES `item_lookups` WRITE;
/*!40000 ALTER TABLE `item_lookups` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_lookups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mail_queue`
--

DROP TABLE IF EXISTS `mail_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `mail_queue` (
                              `id` int unsigned NOT NULL AUTO_INCREMENT,
                              `mailable_id` int NOT NULL,
                              `mailable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `cc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `bcc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                              `attach_pdf` tinyint NOT NULL,
                              `sent` tinyint NOT NULL DEFAULT '0',
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
SET character_set_client = utf8mb4 ;
CREATE TABLE `merchant_clients` (
                                    `id` int unsigned NOT NULL AUTO_INCREMENT,
                                    `driver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                    `client_id` int unsigned NOT NULL,
                                    `merchant_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                    `merchant_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                    `deleted_at` timestamp NULL DEFAULT NULL,
                                    `created_at` timestamp NULL DEFAULT NULL,
                                    `updated_at` timestamp NULL DEFAULT NULL,
                                    PRIMARY KEY (`id`),
                                    KEY `merchant_clients_merchant_key_index` (`merchant_key`),
                                    KEY `merchant_clients_client_id_index` (`client_id`),
                                    KEY `merchant_clients_driver_index` (`driver`),
                                    CONSTRAINT `merchant_clients_client_id_index` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
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
SET character_set_client = utf8mb4 ;
CREATE TABLE `merchant_payments` (
                                     `id` int unsigned NOT NULL AUTO_INCREMENT,
                                     `driver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                     `payment_id` int unsigned NOT NULL,
                                     `merchant_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                     `merchant_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                     `deleted_at` timestamp NULL DEFAULT NULL,
                                     `created_at` timestamp NULL DEFAULT NULL,
                                     `updated_at` timestamp NULL DEFAULT NULL,
                                     PRIMARY KEY (`id`),
                                     KEY `merchant_payments_merchant_key_index` (`merchant_key`),
                                     KEY `merchant_payments_payment_id_index` (`payment_id`),
                                     KEY `merchant_payments_driver_index` (`driver`),
                                     CONSTRAINT `merchant_payments_payment_id_index` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
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
SET character_set_client = utf8mb4 ;
CREATE TABLE `migrations` (
                              `id` int unsigned NOT NULL AUTO_INCREMENT,
                              `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `batch` int NOT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2018_08_17_000000_create_activities_table',1),(2,'2018_08_17_000001_create_currencies_table',1),(3,'2018_08_17_000002_create_users_table',1),(4,'2018_08_17_000003_create_workorders_table',1),(5,'2018_08_17_000004_create_mail_queue_table',1),(6,'2018_08_17_000005_create_products_table',1),(7,'2018_08_17_000006_create_item_lookups_table',1),(8,'2018_08_17_000007_create_employees_table',1),(9,'2018_08_17_000008_create_expense_vendors_table',1),(10,'2018_08_17_000009_create_company_profiles_table',1),(11,'2018_08_17_000011_create_payment_methods_table',1),(12,'2018_08_17_000012_create_schedule_categories_table',1),(13,'2018_08_17_000013_create_clients_table',1),(14,'2018_08_17_000014_create_tax_rates_table',1),(15,'2018_08_17_000015_create_groups_table',1),(16,'2018_08_17_000016_create_expense_categories_table',1),(17,'2018_08_17_000017_create_addons_table',1),(18,'2018_08_17_000018_create_settings_table',1),(19,'2018_08_17_000019_create_custom_fields_table',1),(20,'2018_08_17_000020_create_clients_custom_table',1),(21,'2018_08_17_000021_create_workorder_items_table',1),(22,'2018_08_17_000022_create_attachments_table',1),(23,'2018_08_17_000023_create_contacts_table',1),(24,'2018_08_17_000024_create_invoices_table',1),(25,'2018_08_17_000025_create_notes_table',1),(26,'2018_08_17_000026_create_schedule_table',1),(27,'2018_08_17_000027_create_users_custom_table',1),(28,'2018_08_17_000028_create_time_tracking_projects_table',1),(29,'2018_08_17_000029_create_quotes_table',1),(30,'2018_08_17_000030_create_recurring_invoices_table',1),(31,'2018_08_17_000031_create_company_profiles_custom_table',1),(32,'2018_08_17_000032_create_merchant_clients_table',1),(33,'2018_08_17_000033_create_workorder_amounts_table',1),(34,'2018_08_17_000034_create_workorders_custom_table',1),(35,'2018_08_17_000035_create_invoice_items_table',1),(36,'2018_08_17_000036_create_recurring_invoice_amounts_table',1),(37,'2018_08_17_000037_create_quote_amounts_table',1),(38,'2018_08_17_000038_create_time_tracking_tasks_table',1),(39,'2018_08_17_000039_create_quote_items_table',1),(40,'2018_08_17_000040_create_invoice_transactions_table',1),(41,'2018_08_17_000041_create_invoices_custom_table',1),(42,'2018_08_17_000042_create_expenses_table',1),(43,'2018_08_17_000043_create_schedule_occurrences_table',1),(44,'2018_08_17_000044_create_invoice_amounts_table',1),(45,'2018_08_17_000045_create_payments_table',1),(46,'2018_08_17_000046_create_schedule_reminders_table',1),(47,'2018_08_17_000047_create_recurring_invoice_items_table',1),(48,'2018_08_17_000048_create_workorder_item_amounts_table',1),(49,'2018_08_17_000049_create_quotes_custom_table',1),(50,'2018_08_17_000050_create_recurring_invoices_custom_table',1),(51,'2018_08_17_000051_create_schedule_resources_table',1),(52,'2018_08_17_000052_create_expenses_custom_table',1),(53,'2018_08_17_000053_create_merchant_payments_table',1),(54,'2018_08_17_000054_create_time_tracking_timers_table',1),(55,'2018_08_17_000055_create_invoice_item_amounts_table',1),(56,'2018_08_17_000056_create_quote_item_amounts_table',1),(57,'2018_08_17_000057_create_recurring_invoice_item_amounts_table',1),(58,'2018_08_17_000058_create_payments_custom_table',1),(59,'2018_08_17_000100_version_400',1),(60,'2018_09_07_000100_version_401',1),(61,'2018_10_17_000100_version_402',1),(62,'2018_11_08_000100_version_410',1),(63,'2018_12_16_000100_version_411',1),(64,'2018_12_17_000100_version_412',1),(65,'2019_03_19_000100_version_500',1),(66,'2019_03_25_000100_version_501',1),(67,'2019_05_29_000100_version_510',1),(68,'2019_06_11_000100_version_5102',1),(69,'2019_06_14_000010_create_purchaseorders_table',1),(70,'2019_06_14_000020_create_purchaseorder_items_table',1),(71,'2019_06_14_000040_create_purchaseorders_custom_table',1),(72,'2019_06_14_000050_create_purchaseorder_amounts_table',1),(73,'2019_06_14_000060_create_purchaseorder_item_amounts_table',1),(74,'2019_06_17_000010_version_5103',1),(75,'2020_07_01_000000_version_520',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `notes` (
                         `id` int unsigned NOT NULL AUTO_INCREMENT,
                         `user_id` int unsigned DEFAULT NULL,
                         `notable_id` int NOT NULL,
                         `notable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `note` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                         `private` tinyint NOT NULL,
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
SET character_set_client = utf8mb4 ;
CREATE TABLE `payment_methods` (
                                   `id` int unsigned NOT NULL AUTO_INCREMENT,
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
-- Table structure for table `payment_terms`
--

DROP TABLE IF EXISTS `payment_terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `payment_terms` (
                                 `id` int unsigned NOT NULL AUTO_INCREMENT,
                                 `num_days` int NOT NULL,
                                 `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_terms`
--

LOCK TABLES `payment_terms` WRITE;
/*!40000 ALTER TABLE `payment_terms` DISABLE KEYS */;
INSERT INTO `payment_terms` VALUES (1,0,''),(2,0,'COD'),(3,0,'Due On Receipt'),(4,7,'Net 7'),(5,10,'Net 10'),(6,15,'Net 15'),(7,30,'Net 30'),(8,60,'Net 60'),(9,90,'Net 90');
/*!40000 ALTER TABLE `payment_terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `payments` (
                            `id` int unsigned NOT NULL AUTO_INCREMENT,
                            `client_id` int unsigned NOT NULL DEFAULT '0',
                            `invoice_id` int unsigned NOT NULL,
                            `payment_method_id` int unsigned DEFAULT NULL,
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
                            CONSTRAINT `payments_invoice_id_index` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
                            CONSTRAINT `payments_payment_method_id_index` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments_custom`
--

DROP TABLE IF EXISTS `payments_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `payments_custom` (
                                   `payment_id` int unsigned NOT NULL AUTO_INCREMENT,
                                   `deleted_at` timestamp NULL DEFAULT NULL,
                                   `created_at` timestamp NULL DEFAULT NULL,
                                   `updated_at` timestamp NULL DEFAULT NULL,
                                   PRIMARY KEY (`payment_id`),
                                   CONSTRAINT `payments_custom_payment_id` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments_custom`
--

LOCK TABLES `payments_custom` WRITE;
/*!40000 ALTER TABLE `payments_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `products` (
                            `id` int unsigned NOT NULL AUTO_INCREMENT,
                            `name` varchar(85) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `description` text COLLATE utf8mb4_unicode_ci,
                            `price` decimal(7,2) DEFAULT NULL,
                            `tax_rate_id` int unsigned DEFAULT NULL,
                            `tax_rate_2_id` int unsigned DEFAULT NULL,
                            `serialnum` varchar(85) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `active` tinyint NOT NULL DEFAULT '1',
                            `vendor_id` int unsigned DEFAULT NULL,
                            `cost` decimal(7,2) DEFAULT NULL,
                            `category_id` int unsigned DEFAULT NULL,
                            `inventorytype_id` int unsigned NOT NULL DEFAULT '1',
                            `numstock` decimal(20,4) DEFAULT NULL,
                            `deleted_at` timestamp NULL DEFAULT NULL,
                            `created_at` timestamp NULL DEFAULT NULL,
                            `updated_at` timestamp NULL DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            KEY `products_category_id_index` (`category_id`),
                            KEY `products_inventorytype_id_index` (`inventorytype_id`),
                            CONSTRAINT `products_category_id_index` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
                            CONSTRAINT `products_inventorytype_id_index` FOREIGN KEY (`inventorytype_id`) REFERENCES `inventory_types` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchaseorder_amounts`
--

DROP TABLE IF EXISTS `purchaseorder_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `purchaseorder_amounts` (
                                         `id` int unsigned NOT NULL AUTO_INCREMENT,
                                         `purchaseorder_id` int unsigned NOT NULL,
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
                                         KEY `purchaseorder_amounts_purchaseorder_id_index` (`purchaseorder_id`),
                                         CONSTRAINT `purchaseorder_amounts_purchaseorder_id_index` FOREIGN KEY (`purchaseorder_id`) REFERENCES `purchaseorders` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchaseorder_amounts`
--

LOCK TABLES `purchaseorder_amounts` WRITE;
/*!40000 ALTER TABLE `purchaseorder_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchaseorder_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchaseorder_item_amounts`
--

DROP TABLE IF EXISTS `purchaseorder_item_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `purchaseorder_item_amounts` (
                                              `id` int unsigned NOT NULL AUTO_INCREMENT,
                                              `item_id` int unsigned NOT NULL,
                                              `subtotal` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                              `tax_1` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                              `tax_2` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                              `tax` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                              `total` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                              `deleted_at` timestamp NULL DEFAULT NULL,
                                              `created_at` timestamp NULL DEFAULT NULL,
                                              `updated_at` timestamp NULL DEFAULT NULL,
                                              PRIMARY KEY (`id`),
                                              KEY `purchaseorder_item_amounts_item_id_index` (`item_id`),
                                              CONSTRAINT `purchaseorder_item_amounts_item_id_index` FOREIGN KEY (`item_id`) REFERENCES `purchaseorder_items` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchaseorder_item_amounts`
--

LOCK TABLES `purchaseorder_item_amounts` WRITE;
/*!40000 ALTER TABLE `purchaseorder_item_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchaseorder_item_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchaseorder_items`
--

DROP TABLE IF EXISTS `purchaseorder_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `purchaseorder_items` (
                                       `id` int unsigned NOT NULL AUTO_INCREMENT,
                                       `purchaseorder_id` int unsigned NOT NULL,
                                       `tax_rate_id` int unsigned NOT NULL,
                                       `tax_rate_2_id` int unsigned NOT NULL DEFAULT '0',
                                       `resource_table` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                       `resource_id` int unsigned DEFAULT NULL,
                                       `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                       `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
                                       `quantity` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                       `cost` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                       `rec_qty` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                       `rec_status_id` int NOT NULL,
                                       `display_order` int NOT NULL DEFAULT '0',
                                       `deleted_at` timestamp NULL DEFAULT NULL,
                                       `created_at` timestamp NULL DEFAULT NULL,
                                       `updated_at` timestamp NULL DEFAULT NULL,
                                       PRIMARY KEY (`id`),
                                       KEY `purchaseorder_items_display_order_index` (`display_order`),
                                       KEY `purchaseorder_items_purchaseorder_id_index` (`purchaseorder_id`),
                                       CONSTRAINT `purchaseorder_items_purchaseorder_id_index` FOREIGN KEY (`purchaseorder_id`) REFERENCES `purchaseorders` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchaseorder_items`
--

LOCK TABLES `purchaseorder_items` WRITE;
/*!40000 ALTER TABLE `purchaseorder_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchaseorder_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchaseorders`
--

DROP TABLE IF EXISTS `purchaseorders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `purchaseorders` (
                                  `id` int unsigned NOT NULL AUTO_INCREMENT,
                                  `purchaseorder_date` date NOT NULL,
                                  `purchaseorder_id_ref` int DEFAULT NULL,
                                  `user_id` int unsigned DEFAULT NULL,
                                  `vendor_id` int unsigned NOT NULL,
                                  `group_id` int unsigned DEFAULT NULL,
                                  `purchaseorder_type_id` tinyint NOT NULL DEFAULT '1',
                                  `purchaseorder_status_id` int NOT NULL,
                                  `due_at` date NOT NULL,
                                  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                  `terms` text COLLATE utf8mb4_unicode_ci,
                                  `footer` text COLLATE utf8mb4_unicode_ci,
                                  `url_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                  `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                  `exchange_rate` decimal(10,7) NOT NULL DEFAULT '1.0000000',
                                  `template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                  `summary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                  `viewed` tinyint NOT NULL DEFAULT '0',
                                  `discount` decimal(15,2) NOT NULL DEFAULT '0.00',
                                  `company_profile_id` int unsigned DEFAULT NULL,
                                  `deleted_at` timestamp NULL DEFAULT NULL,
                                  `created_at` timestamp NULL DEFAULT NULL,
                                  `updated_at` timestamp NULL DEFAULT NULL,
                                  PRIMARY KEY (`id`),
                                  KEY `purchaseorders_user_id_index` (`user_id`),
                                  KEY `purchaseorders_purchaseorder_group_id_index` (`group_id`),
                                  KEY `purchaseorders_vendor_id_index` (`vendor_id`),
                                  KEY `purchaseorders_company_profile_id_index` (`company_profile_id`),
                                  KEY `purchaseorders_purchaseorder_status_id_index` (`purchaseorder_status_id`),
                                  CONSTRAINT `purchaseorders_company_profile_id_index` FOREIGN KEY (`company_profile_id`) REFERENCES `company_profiles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
                                  CONSTRAINT `purchaseorders_purchaseorder_group_id_index` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
                                  CONSTRAINT `purchaseorders_user_id_index` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
                                  CONSTRAINT `purchaseorders_vendor_id_index` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchaseorders`
--

LOCK TABLES `purchaseorders` WRITE;
/*!40000 ALTER TABLE `purchaseorders` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchaseorders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchaseorders_custom`
--

DROP TABLE IF EXISTS `purchaseorders_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `purchaseorders_custom` (
                                         `purchaseorder_id` int unsigned NOT NULL AUTO_INCREMENT,
                                         `deleted_at` timestamp NULL DEFAULT NULL,
                                         `created_at` timestamp NULL DEFAULT NULL,
                                         `updated_at` timestamp NULL DEFAULT NULL,
                                         PRIMARY KEY (`purchaseorder_id`),
                                         CONSTRAINT `purchaseorders_custom_purchaseorder_id` FOREIGN KEY (`purchaseorder_id`) REFERENCES `purchaseorders` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchaseorders_custom`
--

LOCK TABLES `purchaseorders_custom` WRITE;
/*!40000 ALTER TABLE `purchaseorders_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchaseorders_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote_amounts`
--

DROP TABLE IF EXISTS `quote_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `quote_amounts` (
                                 `id` int unsigned NOT NULL AUTO_INCREMENT,
                                 `quote_id` int unsigned NOT NULL,
                                 `subtotal` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                 `discount` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                 `tax` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                 `total` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                 `deleted_at` timestamp NULL DEFAULT NULL,
                                 `created_at` timestamp NULL DEFAULT NULL,
                                 `updated_at` timestamp NULL DEFAULT NULL,
                                 PRIMARY KEY (`id`),
                                 KEY `quote_amounts_quote_id_index` (`quote_id`),
                                 CONSTRAINT `quote_amounts_quote_id_index` FOREIGN KEY (`quote_id`) REFERENCES `quotes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quote_amounts`
--

LOCK TABLES `quote_amounts` WRITE;
/*!40000 ALTER TABLE `quote_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `quote_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote_item_amounts`
--

DROP TABLE IF EXISTS `quote_item_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `quote_item_amounts` (
                                      `id` int unsigned NOT NULL AUTO_INCREMENT,
                                      `item_id` int unsigned NOT NULL,
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
                                      CONSTRAINT `quote_item_amounts_item_id_index` FOREIGN KEY (`item_id`) REFERENCES `quote_items` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quote_item_amounts`
--

LOCK TABLES `quote_item_amounts` WRITE;
/*!40000 ALTER TABLE `quote_item_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `quote_item_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote_items`
--

DROP TABLE IF EXISTS `quote_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `quote_items` (
                               `id` int unsigned NOT NULL AUTO_INCREMENT,
                               `quote_id` int unsigned NOT NULL,
                               `tax_rate_id` int unsigned NOT NULL,
                               `tax_rate_2_id` int unsigned NOT NULL DEFAULT '0',
                               `resource_table` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                               `resource_id` int unsigned DEFAULT NULL,
                               `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
                               `quantity` decimal(20,4) NOT NULL DEFAULT '0.0000',
                               `display_order` int NOT NULL,
                               `price` decimal(20,4) NOT NULL DEFAULT '0.0000',
                               `deleted_at` timestamp NULL DEFAULT NULL,
                               `created_at` timestamp NULL DEFAULT NULL,
                               `updated_at` timestamp NULL DEFAULT NULL,
                               PRIMARY KEY (`id`),
                               KEY `quote_items_quote_id_index` (`quote_id`),
                               KEY `quote_items_display_order_index` (`display_order`),
                               CONSTRAINT `quote_items_quote_id_index` FOREIGN KEY (`quote_id`) REFERENCES `quotes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quote_items`
--

LOCK TABLES `quote_items` WRITE;
/*!40000 ALTER TABLE `quote_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `quote_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotes`
--

DROP TABLE IF EXISTS `quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `quotes` (
                          `id` int unsigned NOT NULL AUTO_INCREMENT,
                          `quote_date` date NOT NULL,
                          `workorder_id` int unsigned NOT NULL DEFAULT '0',
                          `invoice_id` int unsigned NOT NULL DEFAULT '0',
                          `user_id` int unsigned DEFAULT NULL,
                          `client_id` int unsigned NOT NULL,
                          `group_id` int unsigned DEFAULT NULL,
                          `quote_status_id` int NOT NULL,
                          `expires_at` date NOT NULL,
                          `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `footer` text COLLATE utf8mb4_unicode_ci,
                          `url_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                          `exchange_rate` decimal(10,7) NOT NULL DEFAULT '1.0000000',
                          `terms` text COLLATE utf8mb4_unicode_ci,
                          `template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                          `summary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                          `viewed` tinyint NOT NULL DEFAULT '0',
                          `discount` decimal(15,2) NOT NULL DEFAULT '0.00',
                          `company_profile_id` int unsigned DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotes`
--

LOCK TABLES `quotes` WRITE;
/*!40000 ALTER TABLE `quotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotes_custom`
--

DROP TABLE IF EXISTS `quotes_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `quotes_custom` (
                                 `quote_id` int unsigned NOT NULL AUTO_INCREMENT,
                                 `deleted_at` timestamp NULL DEFAULT NULL,
                                 `created_at` timestamp NULL DEFAULT NULL,
                                 `updated_at` timestamp NULL DEFAULT NULL,
                                 PRIMARY KEY (`quote_id`),
                                 CONSTRAINT `quotes_custom_quote_id` FOREIGN KEY (`quote_id`) REFERENCES `quotes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotes_custom`
--

LOCK TABLES `quotes_custom` WRITE;
/*!40000 ALTER TABLE `quotes_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotes_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recurring_invoice_amounts`
--

DROP TABLE IF EXISTS `recurring_invoice_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `recurring_invoice_amounts` (
                                             `id` int unsigned NOT NULL AUTO_INCREMENT,
                                             `recurring_invoice_id` int unsigned NOT NULL,
                                             `subtotal` decimal(20,4) NOT NULL,
                                             `discount` decimal(20,4) NOT NULL,
                                             `tax` decimal(20,4) NOT NULL,
                                             `total` decimal(20,4) NOT NULL,
                                             `deleted_at` timestamp NULL DEFAULT NULL,
                                             `created_at` timestamp NULL DEFAULT NULL,
                                             `updated_at` timestamp NULL DEFAULT NULL,
                                             PRIMARY KEY (`id`),
                                             KEY `recurring_invoice_amounts_recurring_invoice_id_index` (`recurring_invoice_id`),
                                             CONSTRAINT `recurring_invoice_amounts_recurring_invoice_id_index` FOREIGN KEY (`recurring_invoice_id`) REFERENCES `recurring_invoices` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recurring_invoice_amounts`
--

LOCK TABLES `recurring_invoice_amounts` WRITE;
/*!40000 ALTER TABLE `recurring_invoice_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `recurring_invoice_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recurring_invoice_item_amounts`
--

DROP TABLE IF EXISTS `recurring_invoice_item_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `recurring_invoice_item_amounts` (
                                                  `id` int unsigned NOT NULL AUTO_INCREMENT,
                                                  `item_id` int unsigned NOT NULL,
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
                                                  CONSTRAINT `recurring_invoice_item_amounts_item_id_index` FOREIGN KEY (`item_id`) REFERENCES `recurring_invoice_items` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recurring_invoice_item_amounts`
--

LOCK TABLES `recurring_invoice_item_amounts` WRITE;
/*!40000 ALTER TABLE `recurring_invoice_item_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `recurring_invoice_item_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recurring_invoice_items`
--

DROP TABLE IF EXISTS `recurring_invoice_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `recurring_invoice_items` (
                                           `id` int unsigned NOT NULL AUTO_INCREMENT,
                                           `recurring_invoice_id` int unsigned NOT NULL,
                                           `tax_rate_id` int unsigned NOT NULL DEFAULT '0',
                                           `tax_rate_2_id` int unsigned NOT NULL DEFAULT '0',
                                           `resource_table` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                           `resource_id` int unsigned DEFAULT NULL,
                                           `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                           `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
                                           `quantity` decimal(20,4) NOT NULL,
                                           `display_order` int NOT NULL DEFAULT '0',
                                           `price` decimal(20,4) NOT NULL,
                                           `deleted_at` timestamp NULL DEFAULT NULL,
                                           `created_at` timestamp NULL DEFAULT NULL,
                                           `updated_at` timestamp NULL DEFAULT NULL,
                                           PRIMARY KEY (`id`),
                                           KEY `recurring_invoice_items_display_order_index` (`display_order`),
                                           KEY `recurring_invoice_items_recurring_invoice_id_index` (`recurring_invoice_id`),
                                           CONSTRAINT `recurring_invoice_items_recurring_invoice_id_index` FOREIGN KEY (`recurring_invoice_id`) REFERENCES `recurring_invoices` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recurring_invoice_items`
--

LOCK TABLES `recurring_invoice_items` WRITE;
/*!40000 ALTER TABLE `recurring_invoice_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `recurring_invoice_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recurring_invoices`
--

DROP TABLE IF EXISTS `recurring_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `recurring_invoices` (
                                      `id` int unsigned NOT NULL AUTO_INCREMENT,
                                      `user_id` int unsigned DEFAULT NULL,
                                      `client_id` int unsigned NOT NULL,
                                      `group_id` int unsigned DEFAULT NULL,
                                      `company_profile_id` int unsigned DEFAULT NULL,
                                      `terms` text COLLATE utf8mb4_unicode_ci,
                                      `footer` text COLLATE utf8mb4_unicode_ci,
                                      `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                      `exchange_rate` decimal(10,7) NOT NULL,
                                      `template` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                      `summary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                      `discount` decimal(15,2) NOT NULL DEFAULT '0.00',
                                      `recurring_frequency` int NOT NULL,
                                      `recurring_period` int NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recurring_invoices`
--

LOCK TABLES `recurring_invoices` WRITE;
/*!40000 ALTER TABLE `recurring_invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `recurring_invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recurring_invoices_custom`
--

DROP TABLE IF EXISTS `recurring_invoices_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `recurring_invoices_custom` (
                                             `recurring_invoice_id` int unsigned NOT NULL AUTO_INCREMENT,
                                             `deleted_at` timestamp NULL DEFAULT NULL,
                                             `created_at` timestamp NULL DEFAULT NULL,
                                             `updated_at` timestamp NULL DEFAULT NULL,
                                             PRIMARY KEY (`recurring_invoice_id`),
                                             CONSTRAINT `recurring_invoices_custom_recurring_invoice_id` FOREIGN KEY (`recurring_invoice_id`) REFERENCES `recurring_invoices` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recurring_invoices_custom`
--

LOCK TABLES `recurring_invoices_custom` WRITE;
/*!40000 ALTER TABLE `recurring_invoices_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `recurring_invoices_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `schedule` (
                            `id` int unsigned NOT NULL AUTO_INCREMENT,
                            `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `description` text COLLATE utf8mb4_unicode_ci,
                            `isRecurring` tinyint unsigned NOT NULL DEFAULT '0',
                            `rrule` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `user_id` int unsigned NOT NULL,
                            `category_id` int unsigned NOT NULL DEFAULT '1',
                            `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `will_call` tinyint NOT NULL DEFAULT '0',
                            `deleted_at` timestamp NULL DEFAULT NULL,
                            `created_at` timestamp NULL DEFAULT NULL,
                            `updated_at` timestamp NULL DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            KEY `fk_schedule_schedule_categories1_idx` (`category_id`),
                            KEY `fk_schedule_users1_idx` (`user_id`),
                            CONSTRAINT `fk_schedule_schedule_categories1_idx` FOREIGN KEY (`category_id`) REFERENCES `schedule_categories` (`id`),
                            CONSTRAINT `fk_schedule_users1_idx` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule`
--

LOCK TABLES `schedule` WRITE;
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule_categories`
--

DROP TABLE IF EXISTS `schedule_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `schedule_categories` (
                                       `id` int unsigned NOT NULL AUTO_INCREMENT,
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
INSERT INTO `schedule_categories` VALUES (1,'Worker Schedule','#000000','#aaffaa',NULL,NULL,NULL),(2,'General Appointment','#000000','#5656ff',NULL,NULL,NULL),(3,'Employee Appointment','#000000','#d4aaff',NULL,NULL,NULL),(4,'Quote','#ffffff','#716cb1',NULL,NULL,NULL),(5,'Workorder','#000000','#aaffaa',NULL,NULL,NULL),(6,'Invoice','#ffffff','#377eb8',NULL,NULL,NULL),(7,'Payment','#ffffff','#5fa213',NULL,NULL,NULL),(8,'Expense and Purchaseorder','#ffffff','#d95d02',NULL,NULL,NULL),(9,'Project','#ffffff','#676767',NULL,NULL,NULL),(10,'Task','#ffffff','#a87821',NULL,NULL,NULL);
/*!40000 ALTER TABLE `schedule_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule_occurrences`
--

DROP TABLE IF EXISTS `schedule_occurrences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `schedule_occurrences` (
                                        `oid` int unsigned NOT NULL AUTO_INCREMENT,
                                        `schedule_id` int unsigned NOT NULL,
                                        `start_date` datetime DEFAULT NULL,
                                        `end_date` datetime DEFAULT NULL,
                                        `deleted_at` timestamp NULL DEFAULT NULL,
                                        `created_at` timestamp NULL DEFAULT NULL,
                                        `updated_at` timestamp NULL DEFAULT NULL,
                                        PRIMARY KEY (`oid`),
                                        KEY `schedule_occurrence_event_id_foreign` (`schedule_id`),
                                        CONSTRAINT `schedule_occurrence_event_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule_occurrences`
--

LOCK TABLES `schedule_occurrences` WRITE;
/*!40000 ALTER TABLE `schedule_occurrences` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedule_occurrences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule_reminders`
--

DROP TABLE IF EXISTS `schedule_reminders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `schedule_reminders` (
                                      `id` int unsigned NOT NULL AUTO_INCREMENT,
                                      `schedule_id` int unsigned NOT NULL,
                                      `reminder_date` timestamp NULL DEFAULT NULL,
                                      `reminder_location` text COLLATE utf8mb4_unicode_ci NOT NULL,
                                      `reminder_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                                      `deleted_at` timestamp NULL DEFAULT NULL,
                                      `created_at` timestamp NULL DEFAULT NULL,
                                      `updated_at` timestamp NULL DEFAULT NULL,
                                      PRIMARY KEY (`id`),
                                      KEY `schedule_reminder_schedule_id_foreign` (`schedule_id`),
                                      CONSTRAINT `schedule_reminder_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule_reminders`
--

LOCK TABLES `schedule_reminders` WRITE;
/*!40000 ALTER TABLE `schedule_reminders` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedule_reminders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule_resources`
--

DROP TABLE IF EXISTS `schedule_resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `schedule_resources` (
                                      `id` int unsigned NOT NULL AUTO_INCREMENT,
                                      `schedule_id` int unsigned NOT NULL,
                                      `resource_table` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                      `resource_id` int DEFAULT NULL,
                                      `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                      `qty` decimal(20,4) DEFAULT NULL,
                                      `deleted_at` timestamp NULL DEFAULT NULL,
                                      `created_at` timestamp NULL DEFAULT NULL,
                                      `updated_at` timestamp NULL DEFAULT NULL,
                                      PRIMARY KEY (`id`),
                                      KEY `schedule_resource_schedule_id_foreign` (`schedule_id`),
                                      CONSTRAINT `schedule_resource_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule_resources`
--

LOCK TABLES `schedule_resources` WRITE;
/*!40000 ALTER TABLE `schedule_resources` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedule_resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `settings` (
                            `id` int unsigned NOT NULL AUTO_INCREMENT,
                            `setting_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `setting_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
                            `deleted_at` timestamp NULL DEFAULT NULL,
                            `created_at` timestamp NULL DEFAULT NULL,
                            `updated_at` timestamp NULL DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            KEY `settings_setting_key_index` (`setting_key`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'addressFormat','{{ address }}\r\n{{ city }}, {{ state }} {{ postal_code }}',NULL,'2020-08-05 01:29:41','2020-08-05 01:29:41'),(2,'allowPaymentsWithoutBalance','0',NULL,'2020-08-05 01:29:41','2020-08-05 01:29:41'),(3,'amountDecimals','2',NULL,'2020-08-05 01:29:41','2020-08-05 01:29:41'),(4,'attachPdf','1',NULL,'2020-08-05 01:29:41','2020-08-05 01:29:41'),(5,'automaticEmailOnRecur','1',NULL,'2020-08-05 01:29:41','2020-08-05 01:29:41'),(6,'baseCurrency','USD',NULL,'2020-08-05 01:29:41','2020-08-05 01:29:41'),(7,'convertQuoteTerms','quote',NULL,'2020-08-05 01:29:41','2020-08-05 01:29:41'),(8,'convertQuoteWhenApproved','1',NULL,'2020-08-05 01:29:42','2020-08-05 01:29:42'),(9,'currencyConversionDriver','FixerIOCurrencyConverter',NULL,'2020-08-05 01:29:42','2020-08-05 01:29:42'),(10,'dashboardTotals','year_to_date',NULL,'2020-08-05 01:29:42','2020-08-05 01:29:42'),(11,'dateFormat','m/d/Y',NULL,'2020-08-05 01:29:42','2020-08-05 01:29:42'),(12,'defaultCompanyProfile','1',NULL,'2020-08-05 01:29:42','2020-08-05 01:29:42'),(13,'displayClientUniqueName','0',NULL,'2020-08-05 01:29:42','2020-08-05 01:29:42'),(14,'displayProfileImage','1',NULL,'2020-08-05 01:29:42','2020-08-05 01:29:42'),(15,'exchangeRateMode','automatic',NULL,'2020-08-05 01:29:42','2020-08-05 01:29:42'),(16,'headerTitleText','BillingTrack',NULL,'2020-08-05 01:29:42','2020-08-05 01:29:42'),(17,'invoiceEmailBody','<p>To view your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }}, click the link below:</p><br><br><p><a href=\"{{ $invoice->public_url }}\">{{ $invoice->public_url }}</a></p>',NULL,'2020-08-05 01:29:42','2020-08-05 01:29:42'),(18,'invoiceEmailSubject','Invoice #{{ $invoice->number }}',NULL,'2020-08-05 01:29:42','2020-08-05 01:29:42'),(19,'invoiceGroup','1',NULL,'2020-08-05 01:29:42','2020-08-05 01:29:42'),(20,'invoicesDueAfter','30',NULL,'2020-08-05 01:29:42','2020-08-05 01:29:42'),(21,'invoiceStatusFilter','all_statuses',NULL,'2020-08-05 01:29:42','2020-08-05 01:29:42'),(22,'invoiceTemplate','default.blade.php',NULL,'2020-08-05 01:29:42','2020-08-05 01:29:42'),(23,'language','en',NULL,'2020-08-05 01:29:42','2020-08-05 01:29:42'),(24,'markInvoicesSentPdf','0',NULL,'2020-08-05 01:29:43','2020-08-05 01:29:43'),(25,'markQuotesSentPdf','0',NULL,'2020-08-05 01:29:43','2020-08-05 01:29:43'),(26,'merchant','{\"PayPalExpress\":{\"enabled\":0,\"username\":\"\",\"password\":\"\",\"signature\":\"\",\"testMode\":0,\"paymentButtonText\":\"Pay with PayPal\"},\"Stripe\":{\"enabled\":0,\"secretKey\":\"\",\"publishableKey\":\"\",\"requireBillingName\":0,\"requireBillingAddress\":0,\"requireBillingCity\":0,\"requireBillingState\":0,\"requireBillingZip\":0,\"paymentButtonText\":\"Pay with Stripe\"},\"Mollie\":{\"enabled\":0,\"apiKey\":\"\",\"paymentButtonText\":\"Pay with Mollie\"}}',NULL,'2020-08-05 01:29:43','2020-08-05 01:29:43'),(27,'merchant_Mollie_apiKey','',NULL,'2020-08-05 01:29:43','2020-08-05 01:29:43'),(28,'merchant_Mollie_enabled','0',NULL,'2020-08-05 01:29:43','2020-08-05 01:29:43'),(29,'merchant_Mollie_paymentButtonText','Pay with Mollie',NULL,'2020-08-05 01:29:43','2020-08-05 01:29:43'),(30,'merchant_PayPal_paymentButtonText','Pay with PayPal',NULL,'2020-08-05 01:29:43','2020-08-05 01:29:43'),(31,'merchant_Stripe_enableBitcoinPayments','0',NULL,'2020-08-05 01:29:43','2020-08-05 01:29:43'),(32,'merchant_Stripe_enabled','0',NULL,'2020-08-05 01:29:43','2020-08-05 01:29:43'),(33,'merchant_Stripe_paymentButtonText','Pay with Stripe',NULL,'2020-08-05 01:29:43','2020-08-05 01:29:43'),(34,'merchant_Stripe_publishableKey','',NULL,'2020-08-05 01:29:43','2020-08-05 01:29:43'),(35,'merchant_Stripe_secretKey','',NULL,'2020-08-05 01:29:43','2020-08-05 01:29:43'),(36,'overdueInvoiceEmailBody','<p>This is a reminder to let you know your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }} is overdue. Click the link below to view the invoice:</p><br><br><p><a href=\"{{ $invoice->public_url }}\">{{ $invoice->public_url }}</a></p>',NULL,'2020-08-05 01:29:44','2020-08-05 01:29:44'),(37,'overdueInvoiceEmailSubject','Overdue Invoice Reminder: Invoice #{{ $invoice->number }}',NULL,'2020-08-05 01:29:44','2020-08-05 01:29:44'),(38,'paperOrientation','portrait',NULL,'2020-08-05 01:29:44','2020-08-05 01:29:44'),(39,'paperSize','letter',NULL,'2020-08-05 01:29:44','2020-08-05 01:29:44'),(40,'paymentReceiptBody','<p>Thank you! Your payment of {{ $payment->formatted_amount }} has been applied to Invoice #{{ $payment->invoice->number }}.</p>',NULL,'2020-08-05 01:29:44','2020-08-05 01:29:44'),(41,'paymentReceiptEmailSubject','Payment Receipt for Invoice #{{ $payment->invoice->number }}',NULL,'2020-08-05 01:29:44','2020-08-05 01:29:44'),(42,'pdfDriver','domPDF',NULL,'2020-08-05 01:29:44','2020-08-05 01:29:44'),(43,'profileImageDriver','Gravatar',NULL,'2020-08-05 01:29:44','2020-08-05 01:29:44'),(44,'quoteApprovedEmailBody','<p><a href=\"{{ $quote->public_url }}\">Quote #{{ $quote->number }}</a> has been APPROVED.</p>',NULL,'2020-08-05 01:29:44','2020-08-05 01:29:44'),(45,'quoteEmailBody','<p>To view your quote from {{ $quote->user->name }} for {{ $quote->amount->formatted_total }}, click the link below:</p><br><br><p><a href=\"{{ $quote->public_url }}\">{{ $quote->public_url }}</a></p>',NULL,'2020-08-05 01:29:44','2020-08-05 01:29:44'),(46,'quoteEmailSubject','Quote #{{ $quote->number }}',NULL,'2020-08-05 01:29:44','2020-08-05 01:29:44'),(47,'quoteGroup','2',NULL,'2020-08-05 01:29:44','2020-08-05 01:29:44'),(48,'quoteRejectedEmailBody','<p><a href=\"{{ $quote->public_url }}\">Quote #{{ $quote->number }}</a> has been REJECTED.</p>',NULL,'2020-08-05 01:29:44','2020-08-05 01:29:44'),(49,'quotesExpireAfter','15',NULL,'2020-08-05 01:29:44','2020-08-05 01:29:44'),(50,'quoteStatusFilter','all_statuses',NULL,'2020-08-05 01:29:45','2020-08-05 01:29:45'),(51,'quoteTemplate','default.blade.php',NULL,'2020-08-05 01:29:45','2020-08-05 01:29:45'),(52,'resultsPerPage','10',NULL,'2020-08-05 01:29:45','2020-08-05 01:29:49'),(53,'roundTaxDecimals','3',NULL,'2020-08-05 01:29:45','2020-08-05 01:29:45'),(54,'skin','{\"headBackground\":\"purple\",\"headClass\":\"dark\",\"sidebarBackground\":\"white\",\"sidebarClass\":\"light\",\"sidebarMode\":\"open\"}',NULL,'2020-08-05 01:29:45','2020-08-05 01:31:03'),(55,'timezone','America/Phoenix',NULL,'2020-08-05 01:29:45','2020-08-05 01:29:45'),(56,'upcomingPaymentNoticeEmailBody','<p>This is a notice to let you know your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }} is due on {{ $invoice->formatted_due_at }}. Click the link below to view the invoice:</p><br><br><p><a href=\"{{ $invoice->public_url }}\">{{ $invoice->public_url }}</a></p>',NULL,'2020-08-05 01:29:45','2020-08-05 01:29:45'),(57,'upcomingPaymentNoticeEmailSubject','Upcoming Payment Due Notice: Invoice #{{ $invoice->number }}',NULL,'2020-08-05 01:29:45','2020-08-05 01:29:45'),(58,'version','5.2.0',NULL,'2020-08-05 01:29:45','2020-08-05 01:31:03'),(59,'widgetColumnWidthClientActivity','4',NULL,'2020-08-05 01:29:45','2020-08-05 01:29:45'),(60,'widgetColumnWidthInvoiceSummary','6',NULL,'2020-08-05 01:29:45','2020-08-05 01:29:45'),(61,'widgetColumnWidthQuoteSummary','6',NULL,'2020-08-05 01:29:45','2020-08-05 01:29:45'),(62,'widgetDisplayOrderClientActivity','3',NULL,'2020-08-05 01:29:45','2020-08-05 01:29:45'),(63,'widgetDisplayOrderInvoiceSummary','1',NULL,'2020-08-05 01:29:45','2020-08-05 01:29:45'),(64,'widgetDisplayOrderQuoteSummary','2',NULL,'2020-08-05 01:29:45','2020-08-05 01:29:45'),(65,'widgetEnabledClientActivity','0',NULL,'2020-08-05 01:29:45','2020-08-05 01:29:45'),(66,'widgetEnabledInvoiceSummary','1',NULL,'2020-08-05 01:29:45','2020-08-05 01:29:45'),(67,'widgetEnabledQuoteSummary','1',NULL,'2020-08-05 01:29:46','2020-08-05 01:29:46'),(68,'widgetInvoiceSummaryDashboardTotals','year_to_date',NULL,'2020-08-05 01:29:46','2020-08-05 01:29:46'),(69,'widgetQuoteSummaryDashboardTotals','year_to_date',NULL,'2020-08-05 01:29:46','2020-08-05 01:29:46'),(70,'restolup','0',NULL,'2020-08-05 01:29:46','2020-08-05 01:29:46'),(71,'emptolup','0',NULL,'2020-08-05 01:29:46','2020-08-05 01:29:46'),(72,'workorderTemplate','default.blade.php',NULL,'2020-08-05 01:29:46','2020-08-05 01:29:46'),(73,'workorderGroup','3',NULL,'2020-08-05 01:29:46','2020-08-05 01:29:46'),(74,'workordersExpireAfter','15',NULL,'2020-08-05 01:29:46','2020-08-05 01:29:46'),(75,'workorderTerms','Default Terms:',NULL,'2020-08-05 01:29:47','2020-08-05 01:29:47'),(76,'workorderFooter','Default Footer:',NULL,'2020-08-05 01:29:47','2020-08-05 01:29:47'),(77,'convertWorkorderTerms','workorder',NULL,'2020-08-05 01:29:47','2020-08-05 01:29:47'),(78,'tsCompanyName','YOURQBCOMPANYNAME',NULL,'2020-08-05 01:29:47','2020-08-05 01:29:47'),(79,'tsCompanyCreate','YOURQBCOMPANYCREATETIME',NULL,'2020-08-05 01:29:47','2020-08-05 01:29:47'),(80,'workorderStatusFilter','all_statuses',NULL,'2020-08-05 01:29:47','2020-08-05 01:29:47'),(81,'schedulerPastdays','60',NULL,'2020-08-05 01:29:47','2020-08-05 01:29:47'),(82,'schedulerEventLimit','5',NULL,'2020-08-05 01:29:47','2020-08-05 01:29:47'),(83,'schedulerCreateWorkorder','0',NULL,'2020-08-05 01:29:47','2020-08-05 01:29:47'),(84,'schedulerFcThemeSystem','standard',NULL,'2020-08-05 01:29:47','2020-08-05 01:29:47'),(85,'schedulerFcAspectRatio','1.35',NULL,'2020-08-05 01:29:47','2020-08-05 01:29:47'),(86,'schedulerTimestep','15',NULL,'2020-08-05 01:29:47','2020-08-05 01:29:47'),(87,'schedulerEnabledCoreEvents','15',NULL,'2020-08-05 01:29:47','2020-08-05 01:29:47'),(88,'schedulerDisplayInvoiced','0',NULL,'2020-08-05 01:29:47','2020-08-05 01:29:47'),(89,'pdfDisposition','inline',NULL,'2020-08-05 01:29:47','2020-08-05 01:29:47'),(90,'jquiTheme','cupertino',NULL,'2020-08-05 01:29:49','2020-08-05 01:29:49'),(91,'enabledModules','127',NULL,'2020-08-05 01:29:49','2020-08-05 01:31:03'),(92,'convertWorkorderDate','jobdate',NULL,'2020-08-05 01:29:50','2020-08-05 01:29:50'),(93,'purchaseorderTemplate','default.blade.php',NULL,'2020-08-05 01:31:02','2020-08-05 01:31:02'),(94,'purchaseorderGroup','4',NULL,'2020-08-05 01:31:02','2020-08-05 01:31:02'),(95,'purchaseordersDueAfter','30',NULL,'2020-08-05 01:31:02','2020-08-05 01:31:02'),(96,'purchaseorderStatusFilter','all_statuses',NULL,'2020-08-05 01:31:02','2020-08-05 01:31:02'),(97,'purchaseorderTerms','',NULL,'2020-08-05 01:31:02','2020-08-05 01:31:02'),(98,'purchaseorderFooter','',NULL,'2020-08-05 01:31:03','2020-08-05 01:31:03'),(99,'resetPurchaseorderDateEmailDraft','0',NULL,'2020-08-05 01:31:03','2020-08-05 01:31:03'),(100,'updateProductsDefault','1',NULL,'2020-08-05 01:31:03','2020-08-05 01:31:03'),(101,'updateInvProductsDefault','1',NULL,'2020-08-05 01:31:03','2020-08-05 01:31:03'),(102,'purchaseorderEmailSubject','Purchase Order #{{ $purchaseorder->number }}',NULL,'2020-08-05 01:31:03','2020-08-05 01:31:03'),(103,'purchaseorderEmailBody','<p>Please find the attached purchase order from {{ $purchaseorder->user->name }}</p>',NULL,'2020-08-05 01:31:03','2020-08-05 01:31:03'),(104,'currencyConversionKey','',NULL,'2020-08-05 01:31:03','2020-08-05 01:31:03');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `sizes` (
                         `id` int unsigned NOT NULL AUTO_INCREMENT,
                         `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sizes`
--

LOCK TABLES `sizes` WRITE;
/*!40000 ALTER TABLE `sizes` DISABLE KEYS */;
INSERT INTO `sizes` VALUES (1,''),(2,'1 - 3'),(3,'4 - 10'),(4,'11 - 50'),(5,'51 - 100'),(6,'101 - 500'),(7,'500+');
/*!40000 ALTER TABLE `sizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_rates`
--

DROP TABLE IF EXISTS `tax_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `tax_rates` (
                             `id` int unsigned NOT NULL AUTO_INCREMENT,
                             `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `percent` decimal(5,3) NOT NULL DEFAULT '0.000',
                             `is_compound` tinyint NOT NULL DEFAULT '0',
                             `calculate_vat` tinyint NOT NULL,
                             `deleted_at` timestamp NULL DEFAULT NULL,
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax_rates`
--

LOCK TABLES `tax_rates` WRITE;
/*!40000 ALTER TABLE `tax_rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `tax_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `time_tracking_projects`
--

DROP TABLE IF EXISTS `time_tracking_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `time_tracking_projects` (
                                          `id` int unsigned NOT NULL AUTO_INCREMENT,
                                          `company_profile_id` int unsigned DEFAULT NULL,
                                          `user_id` int unsigned DEFAULT NULL,
                                          `client_id` int unsigned DEFAULT NULL,
                                          `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `due_at` timestamp NULL DEFAULT NULL,
                                          `hourly_rate` decimal(8,2) NOT NULL,
                                          `status_id` int NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `time_tracking_projects`
--

LOCK TABLES `time_tracking_projects` WRITE;
/*!40000 ALTER TABLE `time_tracking_projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `time_tracking_projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `time_tracking_tasks`
--

DROP TABLE IF EXISTS `time_tracking_tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `time_tracking_tasks` (
                                       `id` int unsigned NOT NULL AUTO_INCREMENT,
                                       `time_tracking_project_id` int unsigned NOT NULL,
                                       `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                       `display_order` tinyint NOT NULL,
                                       `billed` tinyint NOT NULL DEFAULT '0',
                                       `invoice_id` int unsigned DEFAULT NULL,
                                       `deleted_at` timestamp NULL DEFAULT NULL,
                                       `created_at` timestamp NULL DEFAULT NULL,
                                       `updated_at` timestamp NULL DEFAULT NULL,
                                       PRIMARY KEY (`id`),
                                       KEY `time_tracking_tasks_time_tracking_project_id_index` (`time_tracking_project_id`),
                                       KEY `time_tracking_tasks_invoice_id_index` (`invoice_id`),
                                       CONSTRAINT `time_tracking_tasks_invoice_id_index` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
                                       CONSTRAINT `time_tracking_tasks_time_tracking_project_id_index` FOREIGN KEY (`time_tracking_project_id`) REFERENCES `time_tracking_projects` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `time_tracking_tasks`
--

LOCK TABLES `time_tracking_tasks` WRITE;
/*!40000 ALTER TABLE `time_tracking_tasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `time_tracking_tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `time_tracking_timers`
--

DROP TABLE IF EXISTS `time_tracking_timers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `time_tracking_timers` (
                                        `id` int unsigned NOT NULL AUTO_INCREMENT,
                                        `time_tracking_task_id` int unsigned NOT NULL,
                                        `start_at` timestamp NULL DEFAULT NULL,
                                        `end_at` timestamp NULL DEFAULT NULL,
                                        `hours` decimal(8,2) NOT NULL DEFAULT '0.00',
                                        `deleted_at` timestamp NULL DEFAULT NULL,
                                        `created_at` timestamp NULL DEFAULT NULL,
                                        `updated_at` timestamp NULL DEFAULT NULL,
                                        PRIMARY KEY (`id`),
                                        KEY `time_tracking_timers_time_tracking_task_id_index` (`time_tracking_task_id`),
                                        CONSTRAINT `time_tracking_timers_time_tracking_task_id_index` FOREIGN KEY (`time_tracking_task_id`) REFERENCES `time_tracking_tasks` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `time_tracking_timers`
--

LOCK TABLES `time_tracking_timers` WRITE;
/*!40000 ALTER TABLE `time_tracking_timers` DISABLE KEYS */;
/*!40000 ALTER TABLE `time_tracking_timers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `titles`
--

DROP TABLE IF EXISTS `titles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `titles` (
                          `id` int unsigned NOT NULL AUTO_INCREMENT,
                          `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `titles`
--

LOCK TABLES `titles` WRITE;
/*!40000 ALTER TABLE `titles` DISABLE KEYS */;
INSERT INTO `titles` VALUES (1,''),(2,'Accountant'),(3,'Administrative Assistant'),(4,'Administrator'),(5,'CEO'),(6,'Consultant'),(7,'Customer Service'),(8,'Director'),(9,'Driver'),(10,'IT Professional'),(11,'Manager'),(12,'Marketing'),(13,'Other'),(14,'Owner'),(15,'President'),(16,'Sales'),(17,'Secretary'),(18,'Software Developer'),(19,'Supervisor'),(20,'Technician'),(21,'Vice President'),(22,'Worker');
/*!40000 ALTER TABLE `titles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
                         `id` int unsigned NOT NULL AUTO_INCREMENT,
                         `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `api_public_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `api_secret_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `client_id` int unsigned DEFAULT NULL,
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
INSERT INTO `users` VALUES (1,'admin@example.com','$2y$10$iG2Ah5jwQvelqS83UMSBMeuuwQ5z8ZF9M2PNQ8vMVtCP9SA8Ih4iu','admin',NULL,NULL,NULL,NULL,NULL,'2020-08-04 18:31:28','2020-08-04 18:31:28');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_custom`
--

DROP TABLE IF EXISTS `users_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `users_custom` (
                                `user_id` int unsigned NOT NULL AUTO_INCREMENT,
                                `deleted_at` timestamp NULL DEFAULT NULL,
                                `created_at` timestamp NULL DEFAULT NULL,
                                `updated_at` timestamp NULL DEFAULT NULL,
                                PRIMARY KEY (`user_id`),
                                CONSTRAINT `users_custom_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_custom`
--

LOCK TABLES `users_custom` WRITE;
/*!40000 ALTER TABLE `users_custom` DISABLE KEYS */;
INSERT INTO `users_custom` VALUES (1,NULL,'2020-08-04 18:31:28','2020-08-04 18:31:28');
/*!40000 ALTER TABLE `users_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendor_contacts`
--

DROP TABLE IF EXISTS `vendor_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `vendor_contacts` (
                                   `id` int unsigned NOT NULL AUTO_INCREMENT,
                                   `vendor_id` int unsigned NOT NULL,
                                   `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                   `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                   `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                   `title_id` int unsigned DEFAULT '1',
                                   `default_to` tinyint NOT NULL DEFAULT '0',
                                   `default_cc` tinyint NOT NULL DEFAULT '0',
                                   `default_bcc` tinyint NOT NULL DEFAULT '0',
                                   `is_primary` tinyint NOT NULL DEFAULT '0',
                                   `optin` tinyint NOT NULL DEFAULT '1',
                                   `deleted_at` timestamp NULL DEFAULT NULL,
                                   `created_at` timestamp NULL DEFAULT NULL,
                                   `updated_at` timestamp NULL DEFAULT NULL,
                                   PRIMARY KEY (`id`),
                                   KEY `contacts_vendor_id_index` (`vendor_id`),
                                   KEY `vendor_contacts_title_id_foreign` (`title_id`),
                                   CONSTRAINT `contacts_vendor_id_index` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
                                   CONSTRAINT `vendor_contacts_title_id_foreign` FOREIGN KEY (`title_id`) REFERENCES `titles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendor_contacts`
--

LOCK TABLES `vendor_contacts` WRITE;
/*!40000 ALTER TABLE `vendor_contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendor_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `vendors` (
                           `id` int unsigned NOT NULL AUTO_INCREMENT,
                           `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `address` text COLLATE utf8mb4_unicode_ci,
                           `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `address_2` text COLLATE utf8mb4_unicode_ci,
                           `city_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `state_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `zip_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `country_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `active` tinyint NOT NULL DEFAULT '1',
                           `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `id_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `vat_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `paymentterm_id` int unsigned DEFAULT '1',
                           `deleted_at` timestamp NULL DEFAULT NULL,
                           `created_at` timestamp NULL DEFAULT NULL,
                           `updated_at` timestamp NULL DEFAULT NULL,
                           PRIMARY KEY (`id`),
                           KEY `vendors_active_index` (`active`),
                           KEY `vendors_name_index` (`name`),
                           KEY `vendors_paymentterm_id_foreign` (`paymentterm_id`),
                           CONSTRAINT `vendors_paymentterm_id_foreign` FOREIGN KEY (`paymentterm_id`) REFERENCES `payment_terms` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendors`
--

LOCK TABLES `vendors` WRITE;
/*!40000 ALTER TABLE `vendors` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendors_custom`
--

DROP TABLE IF EXISTS `vendors_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `vendors_custom` (
                                  `vendor_id` int unsigned NOT NULL AUTO_INCREMENT,
                                  `deleted_at` timestamp NULL DEFAULT NULL,
                                  `created_at` timestamp NULL DEFAULT NULL,
                                  `updated_at` timestamp NULL DEFAULT NULL,
                                  PRIMARY KEY (`vendor_id`),
                                  CONSTRAINT `vendors_custom_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendors_custom`
--

LOCK TABLES `vendors_custom` WRITE;
/*!40000 ALTER TABLE `vendors_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendors_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workorder_amounts`
--

DROP TABLE IF EXISTS `workorder_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `workorder_amounts` (
                                     `id` int unsigned NOT NULL AUTO_INCREMENT,
                                     `workorder_id` int unsigned NOT NULL,
                                     `subtotal` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                     `discount` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                     `tax` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                     `total` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                     `deleted_at` timestamp NULL DEFAULT NULL,
                                     `created_at` timestamp NULL DEFAULT NULL,
                                     `updated_at` timestamp NULL DEFAULT NULL,
                                     PRIMARY KEY (`id`),
                                     KEY `workorder_amounts_workorder_id_index` (`workorder_id`),
                                     CONSTRAINT `workorder_amounts_workorder_id_index` FOREIGN KEY (`workorder_id`) REFERENCES `workorders` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workorder_amounts`
--

LOCK TABLES `workorder_amounts` WRITE;
/*!40000 ALTER TABLE `workorder_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `workorder_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workorder_item_amounts`
--

DROP TABLE IF EXISTS `workorder_item_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `workorder_item_amounts` (
                                          `id` int unsigned NOT NULL AUTO_INCREMENT,
                                          `item_id` int unsigned NOT NULL,
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
                                          CONSTRAINT `workorder_item_amounts_item_id_index` FOREIGN KEY (`item_id`) REFERENCES `workorder_items` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workorder_item_amounts`
--

LOCK TABLES `workorder_item_amounts` WRITE;
/*!40000 ALTER TABLE `workorder_item_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `workorder_item_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workorder_items`
--

DROP TABLE IF EXISTS `workorder_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `workorder_items` (
                                   `id` int unsigned NOT NULL AUTO_INCREMENT,
                                   `workorder_id` int unsigned NOT NULL,
                                   `tax_rate_id` int NOT NULL,
                                   `tax_rate_2_id` int NOT NULL DEFAULT '0',
                                   `resource_table` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                   `resource_id` int unsigned DEFAULT NULL,
                                   `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `quantity` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                   `display_order` int NOT NULL,
                                   `price` decimal(20,4) NOT NULL DEFAULT '0.0000',
                                   `deleted_at` timestamp NULL DEFAULT NULL,
                                   `created_at` timestamp NULL DEFAULT NULL,
                                   `updated_at` timestamp NULL DEFAULT NULL,
                                   PRIMARY KEY (`id`),
                                   KEY `workorder_items_tax_rate_2_id_index` (`tax_rate_2_id`),
                                   KEY `workorder_items_display_order_index` (`display_order`),
                                   KEY `workorder_items_tax_rate_id_index` (`tax_rate_id`),
                                   KEY `workorder_items_workorder_id_index` (`workorder_id`),
                                   CONSTRAINT `workorder_items_workorder_id_index` FOREIGN KEY (`workorder_id`) REFERENCES `workorders` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workorder_items`
--

LOCK TABLES `workorder_items` WRITE;
/*!40000 ALTER TABLE `workorder_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `workorder_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workorders`
--

DROP TABLE IF EXISTS `workorders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `workorders` (
                              `id` int unsigned NOT NULL AUTO_INCREMENT,
                              `workorder_date` date NOT NULL,
                              `invoice_id` int NOT NULL DEFAULT '0',
                              `user_id` int NOT NULL,
                              `client_id` int NOT NULL,
                              `group_id` int NOT NULL,
                              `workorder_status_id` int NOT NULL,
                              `expires_at` date NOT NULL,
                              `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `footer` text COLLATE utf8mb4_unicode_ci,
                              `url_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                              `exchange_rate` decimal(10,7) NOT NULL DEFAULT '1.0000000',
                              `terms` text COLLATE utf8mb4_unicode_ci,
                              `template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                              `summary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                              `viewed` tinyint NOT NULL DEFAULT '0',
                              `discount` decimal(15,2) NOT NULL DEFAULT '0.00',
                              `job_date` date NOT NULL,
                              `start_time` time NOT NULL,
                              `end_time` time NOT NULL,
                              `will_call` tinyint NOT NULL DEFAULT '0',
                              `company_profile_id` int NOT NULL,
                              `deleted_at` timestamp NULL DEFAULT NULL,
                              `created_at` timestamp NULL DEFAULT NULL,
                              `updated_at` timestamp NULL DEFAULT NULL,
                              PRIMARY KEY (`id`),
                              KEY `workorders_group_id_index` (`group_id`),
                              KEY `workorders_company_profile_id_index` (`company_profile_id`),
                              KEY `workorders_number_index` (`number`),
                              KEY `workorders_user_id_index` (`user_id`),
                              KEY `workorders_client_id_index` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workorders`
--

LOCK TABLES `workorders` WRITE;
/*!40000 ALTER TABLE `workorders` DISABLE KEYS */;
/*!40000 ALTER TABLE `workorders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workorders_custom`
--

DROP TABLE IF EXISTS `workorders_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `workorders_custom` (
                                     `workorder_id` int unsigned NOT NULL AUTO_INCREMENT,
                                     `deleted_at` timestamp NULL DEFAULT NULL,
                                     `created_at` timestamp NULL DEFAULT NULL,
                                     `updated_at` timestamp NULL DEFAULT NULL,
                                     PRIMARY KEY (`workorder_id`),
                                     CONSTRAINT `workorders_custom_workorder_id` FOREIGN KEY (`workorder_id`) REFERENCES `workorders` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workorders_custom`
--

LOCK TABLES `workorders_custom` WRITE;
/*!40000 ALTER TABLE `workorders_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `workorders_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'BillingTrack-dev'
--

--
-- Dumping routines for database 'BillingTrack-dev'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-04 11:37:50
