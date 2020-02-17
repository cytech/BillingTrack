CREATE DATABASE  IF NOT EXISTS `BillingTrack-dev` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `BillingTrack-dev`;
-- MySQL dump 10.13  Distrib 8.0.16, for Linux (x86_64)
--
-- Host: 192.168.1.11    Database: BillingTrack-dev
-- ------------------------------------------------------
-- Server version	5.7.29-0ubuntu0.18.04.1

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
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `addons`
--

LOCK TABLES `addons` WRITE;
/*!40000 ALTER TABLE `addons` DISABLE KEYS */;
/*!40000 ALTER TABLE `addons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `attachments`
--

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `clients_custom`
--

LOCK TABLES `clients_custom` WRITE;
/*!40000 ALTER TABLE `clients_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `company_profiles`
--

LOCK TABLES `company_profiles` WRITE;
/*!40000 ALTER TABLE `company_profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `company_profiles_custom`
--

LOCK TABLES `company_profiles_custom` WRITE;
/*!40000 ALTER TABLE `company_profiles_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_profiles_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'AUD','Australian Dollar','$','before','.',',',NULL,NULL,NULL),(2,'CAD','Canadian Dollar','$','before','.',',',NULL,NULL,NULL),(3,'EUR','Euro','€','before','.',',',NULL,NULL,NULL),(4,'GBP','Pound Sterling','£','before','.',',',NULL,NULL,NULL),(5,'USD','US Dollar','$','before','.',',',NULL,NULL,NULL);
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `custom_fields`
--

LOCK TABLES `custom_fields` WRITE;
/*!40000 ALTER TABLE `custom_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `expenses_custom`
--

LOCK TABLES `expenses_custom` WRITE;
/*!40000 ALTER TABLE `expenses_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Invoice Default',1,0,'INV{NUMBER}',0,0,0,0,0,'',NULL,NULL,NULL),(2,'Quote Default',1,0,'QUO{NUMBER}',0,0,0,0,0,'',NULL,NULL,NULL),(3,'Workorder Default',1,0,'WO{NUMBER}',0,0,0,0,0,'',NULL,NULL,NULL),(4,'Purchaseorder Default',1,0,'PO{NUMBER}',0,0,0,0,0,'',NULL,NULL,NULL);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `industries`
--

LOCK TABLES `industries` WRITE;
/*!40000 ALTER TABLE `industries` DISABLE KEYS */;
INSERT INTO `industries` VALUES (1,''),(2,'Accounting & Legal'),(3,'Advertising'),(4,'Aerospace'),(5,'Agriculture'),(6,'Automotive'),(7,'Banking & Finance'),(8,'Biotechnology'),(9,'Broadcasting'),(10,'Business Services'),(11,'Commodities & Chemicals'),(12,'Communications'),(13,'Computers & Hightech'),(14,'Construction'),(15,'Defense'),(16,'Energy'),(17,'Entertainment'),(18,'Government'),(19,'Healthcare & Life Sciences'),(20,'Insurance'),(21,'Manufacturing'),(22,'Marketing'),(23,'Media'),(24,'Nonprofit & Higher Ed'),(25,'Pharmaceuticals'),(26,'Photography'),(27,'Professional Services & Consulting'),(28,'Real Estate'),(29,'Restaurant & Catering'),(30,'Retail & Wholesale'),(31,'Sports'),(32,'Transportation'),(33,'Travel & Luxury'),(34,'Other');
/*!40000 ALTER TABLE `industries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `inventory_types`
--

LOCK TABLES `inventory_types` WRITE;
/*!40000 ALTER TABLE `inventory_types` DISABLE KEYS */;
INSERT INTO `inventory_types` VALUES (1,'',0),(2,'Rental',1),(3,'Resale',1),(4,'Labor',0),(5,'Asset',0),(6,'Non-Inventory',0),(7,'Other',0),(8,'Raw Materials',1),(9,'W.I.P.',1),(10,'Finished Goods',1);
/*!40000 ALTER TABLE `inventory_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `invoice_amounts`
--

LOCK TABLES `invoice_amounts` WRITE;
/*!40000 ALTER TABLE `invoice_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `invoice_item_amounts`
--

LOCK TABLES `invoice_item_amounts` WRITE;
/*!40000 ALTER TABLE `invoice_item_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_item_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `invoice_items`
--

LOCK TABLES `invoice_items` WRITE;
/*!40000 ALTER TABLE `invoice_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `invoice_transactions`
--

LOCK TABLES `invoice_transactions` WRITE;
/*!40000 ALTER TABLE `invoice_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `invoices_custom`
--

LOCK TABLES `invoices_custom` WRITE;
/*!40000 ALTER TABLE `invoices_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoices_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `item_lookups`
--

LOCK TABLES `item_lookups` WRITE;
/*!40000 ALTER TABLE `item_lookups` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_lookups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `mail_queue`
--

LOCK TABLES `mail_queue` WRITE;
/*!40000 ALTER TABLE `mail_queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `mail_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `merchant_clients`
--

LOCK TABLES `merchant_clients` WRITE;
/*!40000 ALTER TABLE `merchant_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `merchant_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `merchant_payments`
--

LOCK TABLES `merchant_payments` WRITE;
/*!40000 ALTER TABLE `merchant_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `merchant_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2018_08_17_000000_create_activities_table',1),(2,'2018_08_17_000001_create_currencies_table',1),(3,'2018_08_17_000002_create_users_table',1),(4,'2018_08_17_000003_create_workorders_table',1),(5,'2018_08_17_000004_create_mail_queue_table',1),(6,'2018_08_17_000005_create_products_table',1),(7,'2018_08_17_000006_create_item_lookups_table',1),(8,'2018_08_17_000007_create_employees_table',1),(9,'2018_08_17_000008_create_expense_vendors_table',1),(10,'2018_08_17_000009_create_company_profiles_table',1),(11,'2018_08_17_000011_create_payment_methods_table',1),(12,'2018_08_17_000012_create_schedule_categories_table',1),(13,'2018_08_17_000013_create_clients_table',1),(14,'2018_08_17_000014_create_tax_rates_table',1),(15,'2018_08_17_000015_create_groups_table',1),(16,'2018_08_17_000016_create_expense_categories_table',1),(17,'2018_08_17_000017_create_addons_table',1),(18,'2018_08_17_000018_create_settings_table',1),(19,'2018_08_17_000019_create_custom_fields_table',1),(20,'2018_08_17_000020_create_clients_custom_table',1),(21,'2018_08_17_000021_create_workorder_items_table',1),(22,'2018_08_17_000022_create_attachments_table',1),(23,'2018_08_17_000023_create_contacts_table',1),(24,'2018_08_17_000024_create_invoices_table',1),(25,'2018_08_17_000025_create_notes_table',1),(26,'2018_08_17_000026_create_schedule_table',1),(27,'2018_08_17_000027_create_users_custom_table',1),(28,'2018_08_17_000028_create_time_tracking_projects_table',1),(29,'2018_08_17_000029_create_quotes_table',1),(30,'2018_08_17_000030_create_recurring_invoices_table',1),(31,'2018_08_17_000031_create_company_profiles_custom_table',1),(32,'2018_08_17_000032_create_merchant_clients_table',1),(33,'2018_08_17_000033_create_workorder_amounts_table',1),(34,'2018_08_17_000034_create_workorders_custom_table',1),(35,'2018_08_17_000035_create_invoice_items_table',1),(36,'2018_08_17_000036_create_recurring_invoice_amounts_table',1),(37,'2018_08_17_000037_create_quote_amounts_table',1),(38,'2018_08_17_000038_create_time_tracking_tasks_table',1),(39,'2018_08_17_000039_create_quote_items_table',1),(40,'2018_08_17_000040_create_invoice_transactions_table',1),(41,'2018_08_17_000041_create_invoices_custom_table',1),(42,'2018_08_17_000042_create_expenses_table',1),(43,'2018_08_17_000043_create_schedule_occurrences_table',1),(44,'2018_08_17_000044_create_invoice_amounts_table',1),(45,'2018_08_17_000045_create_payments_table',1),(46,'2018_08_17_000046_create_schedule_reminders_table',1),(47,'2018_08_17_000047_create_recurring_invoice_items_table',1),(48,'2018_08_17_000048_create_workorder_item_amounts_table',1),(49,'2018_08_17_000049_create_quotes_custom_table',1),(50,'2018_08_17_000050_create_recurring_invoices_custom_table',1),(51,'2018_08_17_000051_create_schedule_resources_table',1),(52,'2018_08_17_000052_create_expenses_custom_table',1),(53,'2018_08_17_000053_create_merchant_payments_table',1),(54,'2018_08_17_000054_create_time_tracking_timers_table',1),(55,'2018_08_17_000055_create_invoice_item_amounts_table',1),(56,'2018_08_17_000056_create_quote_item_amounts_table',1),(57,'2018_08_17_000057_create_recurring_invoice_item_amounts_table',1),(58,'2018_08_17_000058_create_payments_custom_table',1),(59,'2018_08_17_000100_version_400',1),(60,'2018_09_07_000100_version_401',1),(61,'2018_10_17_000100_version_402',1),(62,'2018_11_08_000100_version_410',1),(63,'2018_12_16_000100_version_411',1),(64,'2018_12_17_000100_version_412',1),(65,'2019_03_19_000100_version_500',1),(66,'2019_03_25_000100_version_501',1),(67,'2019_05_29_000100_version_510',1),(68,'2019_06_11_000100_version_5102',1),(69,'2019_06_14_000010_create_purchaseorders_table',1),(70,'2019_06_14_000020_create_purchaseorder_items_table',1),(71,'2019_06_14_000040_create_purchaseorders_custom_table',1),(72,'2019_06_14_000050_create_purchaseorder_amounts_table',1),(73,'2019_06_14_000060_create_purchaseorder_item_amounts_table',1),(74,'2019_06_17_000010_version_5103',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `payment_methods`
--

LOCK TABLES `payment_methods` WRITE;
/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;
INSERT INTO `payment_methods` VALUES (1,'Cash',NULL,NULL,NULL),(2,'Check',NULL,NULL,NULL),(3,'Credit Card',NULL,NULL,NULL),(4,'Online Payment',NULL,NULL,NULL);
/*!40000 ALTER TABLE `payment_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `payment_terms`
--

LOCK TABLES `payment_terms` WRITE;
/*!40000 ALTER TABLE `payment_terms` DISABLE KEYS */;
INSERT INTO `payment_terms` VALUES (1,0,''),(2,0,'COD'),(3,0,'Due On Receipt'),(4,7,'Net 7'),(5,10,'Net 10'),(6,15,'Net 15'),(7,30,'Net 30'),(8,60,'Net 60'),(9,90,'Net 90');
/*!40000 ALTER TABLE `payment_terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `payments_custom`
--

LOCK TABLES `payments_custom` WRITE;
/*!40000 ALTER TABLE `payments_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `purchaseorder_amounts`
--

LOCK TABLES `purchaseorder_amounts` WRITE;
/*!40000 ALTER TABLE `purchaseorder_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchaseorder_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `purchaseorder_item_amounts`
--

LOCK TABLES `purchaseorder_item_amounts` WRITE;
/*!40000 ALTER TABLE `purchaseorder_item_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchaseorder_item_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `purchaseorder_items`
--

LOCK TABLES `purchaseorder_items` WRITE;
/*!40000 ALTER TABLE `purchaseorder_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchaseorder_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `purchaseorders`
--

LOCK TABLES `purchaseorders` WRITE;
/*!40000 ALTER TABLE `purchaseorders` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchaseorders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `purchaseorders_custom`
--

LOCK TABLES `purchaseorders_custom` WRITE;
/*!40000 ALTER TABLE `purchaseorders_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchaseorders_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `quote_amounts`
--

LOCK TABLES `quote_amounts` WRITE;
/*!40000 ALTER TABLE `quote_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `quote_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `quote_item_amounts`
--

LOCK TABLES `quote_item_amounts` WRITE;
/*!40000 ALTER TABLE `quote_item_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `quote_item_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `quote_items`
--

LOCK TABLES `quote_items` WRITE;
/*!40000 ALTER TABLE `quote_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `quote_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `quotes`
--

LOCK TABLES `quotes` WRITE;
/*!40000 ALTER TABLE `quotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `quotes_custom`
--

LOCK TABLES `quotes_custom` WRITE;
/*!40000 ALTER TABLE `quotes_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotes_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `recurring_invoice_amounts`
--

LOCK TABLES `recurring_invoice_amounts` WRITE;
/*!40000 ALTER TABLE `recurring_invoice_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `recurring_invoice_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `recurring_invoice_item_amounts`
--

LOCK TABLES `recurring_invoice_item_amounts` WRITE;
/*!40000 ALTER TABLE `recurring_invoice_item_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `recurring_invoice_item_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `recurring_invoice_items`
--

LOCK TABLES `recurring_invoice_items` WRITE;
/*!40000 ALTER TABLE `recurring_invoice_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `recurring_invoice_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `recurring_invoices`
--

LOCK TABLES `recurring_invoices` WRITE;
/*!40000 ALTER TABLE `recurring_invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `recurring_invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `recurring_invoices_custom`
--

LOCK TABLES `recurring_invoices_custom` WRITE;
/*!40000 ALTER TABLE `recurring_invoices_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `recurring_invoices_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `schedule`
--

LOCK TABLES `schedule` WRITE;
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `schedule_categories`
--

LOCK TABLES `schedule_categories` WRITE;
/*!40000 ALTER TABLE `schedule_categories` DISABLE KEYS */;
INSERT INTO `schedule_categories` VALUES (1,'Worker Schedule','#000000','#aaffaa',NULL,NULL,NULL),(2,'General Appointment','#000000','#5656ff',NULL,NULL,NULL),(3,'Employee Appointment','#000000','#d4aaff',NULL,NULL,NULL),(4,'Quote','#ffffff','#716cb1',NULL,NULL,NULL),(5,'Workorder','#000000','#aaffaa',NULL,NULL,NULL),(6,'Invoice','#ffffff','#377eb8',NULL,NULL,NULL),(7,'Payment','#ffffff','#5fa213',NULL,NULL,NULL),(8,'Expense and Purchaseorder','#ffffff','#d95d02',NULL,NULL,NULL),(9,'Project','#ffffff','#676767',NULL,NULL,NULL),(10,'Task','#ffffff','#a87821',NULL,NULL,NULL);
/*!40000 ALTER TABLE `schedule_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `schedule_occurrences`
--

LOCK TABLES `schedule_occurrences` WRITE;
/*!40000 ALTER TABLE `schedule_occurrences` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedule_occurrences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `schedule_reminders`
--

LOCK TABLES `schedule_reminders` WRITE;
/*!40000 ALTER TABLE `schedule_reminders` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedule_reminders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `schedule_resources`
--

LOCK TABLES `schedule_resources` WRITE;
/*!40000 ALTER TABLE `schedule_resources` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedule_resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'addressFormat','{{ address }}\r\n{{ city }}, {{ state }} {{ postal_code }}',NULL,NULL,NULL),(2,'allowPaymentsWithoutBalance','0',NULL,NULL,NULL),(3,'amountDecimals','2',NULL,NULL,NULL),(4,'attachPdf','1',NULL,NULL,NULL),(5,'automaticEmailOnRecur','1',NULL,NULL,NULL),(6,'baseCurrency','USD',NULL,NULL,NULL),(7,'convertQuoteTerms','quote',NULL,NULL,NULL),(8,'convertQuoteWhenApproved','1',NULL,NULL,NULL),(9,'currencyConversionDriver','FixerIOCurrencyConverter',NULL,NULL,NULL),(10,'dashboardTotals','year_to_date',NULL,NULL,NULL),(11,'dateFormat','m/d/Y',NULL,NULL,NULL),(12,'defaultCompanyProfile','1',NULL,NULL,NULL),(13,'displayClientUniqueName','0',NULL,NULL,NULL),(14,'displayProfileImage','1',NULL,NULL,NULL),(15,'exchangeRateMode','automatic',NULL,NULL,NULL),(16,'headerTitleText','BillingTrack',NULL,NULL,NULL),(17,'invoiceEmailBody','<p>To view your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }}, click the link below:</p>\r\n\r\n<p><a href=\"{{ $invoice->public_url }}\">{{ $invoice->public_url }}</a></p>',NULL,NULL,NULL),(18,'invoiceEmailSubject','Invoice #{{ $invoice->number }}',NULL,NULL,NULL),(19,'invoiceGroup','1',NULL,NULL,NULL),(20,'invoicesDueAfter','30',NULL,NULL,NULL),(21,'invoiceStatusFilter','all_statuses',NULL,NULL,NULL),(22,'invoiceTemplate','default.blade.php',NULL,NULL,NULL),(23,'language','en',NULL,NULL,NULL),(24,'markInvoicesSentPdf','0',NULL,NULL,NULL),(25,'markQuotesSentPdf','0',NULL,NULL,NULL),(26,'merchant','{\"PayPalExpress\":{\"enabled\":0,\"username\":\"\",\"password\":\"\",\"signature\":\"\",\"testMode\":0,\"paymentButtonText\":\"Pay with PayPal\"},\"Stripe\":{\"enabled\":0,\"secretKey\":\"\",\"publishableKey\":\"\",\"requireBillingName\":0,\"requireBillingAddress\":0,\"requireBillingCity\":0,\"requireBillingState\":0,\"requireBillingZip\":0,\"paymentButtonText\":\"Pay with Stripe\"},\"Mollie\":{\"enabled\":0,\"apiKey\":\"\",\"paymentButtonText\":\"Pay with Mollie\"}}',NULL,NULL,NULL),(27,'merchant_Mollie_apiKey','',NULL,NULL,NULL),(28,'merchant_Mollie_enabled','0',NULL,NULL,NULL),(29,'merchant_Mollie_paymentButtonText','Pay with Mollie',NULL,NULL,NULL),(30,'merchant_PayPal_paymentButtonText','Pay with PayPal',NULL,NULL,NULL),(31,'merchant_Stripe_enableBitcoinPayments','0',NULL,NULL,NULL),(32,'merchant_Stripe_enabled','0',NULL,NULL,NULL),(33,'merchant_Stripe_paymentButtonText','Pay with Stripe',NULL,NULL,NULL),(34,'merchant_Stripe_publishableKey','',NULL,NULL,NULL),(35,'merchant_Stripe_secretKey','',NULL,NULL,NULL),(36,'overdueInvoiceEmailBody','<p>This is a reminder to let you know your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }} is overdue. Click the link below to view the invoice:</p>\r\n\r\n<p><a href=\"{{ $invoice->public_url }}\">{{ $invoice->public_url }}</a></p>',NULL,NULL,NULL),(37,'overdueInvoiceEmailSubject','Overdue Invoice Reminder: Invoice #{{ $invoice->number }}',NULL,NULL,NULL),(38,'paperOrientation','portrait',NULL,NULL,NULL),(39,'paperSize','letter',NULL,NULL,NULL),(40,'paymentReceiptBody','<p>Thank you! Your payment of {{ $payment->formatted_amount }} has been applied to Invoice #{{ $payment->invoice->number }}.</p>',NULL,NULL,NULL),(41,'paymentReceiptEmailSubject','Payment Receipt for Invoice #{{ $payment->invoice->number }}',NULL,NULL,NULL),(42,'pdfDriver','domPDF',NULL,NULL,NULL),(43,'profileImageDriver','Gravatar',NULL,NULL,NULL),(44,'quoteApprovedEmailBody','<p><a href=\"{{ $quote->public_url }}\">Quote #{{ $quote->number }}</a> has been APPROVED.</p>',NULL,NULL,NULL),(45,'quoteEmailBody','<p>To view your quote from {{ $quote->user->name }} for {{ $quote->amount->formatted_total }}, click the link below:</p>\r\n\r\n<p><a href=\"{{ $quote->public_url }}\">{{ $quote->public_url }}</a></p>',NULL,NULL,NULL),(46,'quoteEmailSubject','Quote #{{ $quote->number }}',NULL,NULL,NULL),(47,'quoteGroup','2',NULL,NULL,NULL),(48,'quoteRejectedEmailBody','<p><a href=\"{{ $quote->public_url }}\">Quote #{{ $quote->number }}</a> has been REJECTED.</p>',NULL,NULL,NULL),(49,'quotesExpireAfter','15',NULL,NULL,NULL),(50,'quoteStatusFilter','all_statuses',NULL,NULL,NULL),(51,'quoteTemplate','default.blade.php',NULL,NULL,NULL),(52,'resultsPerPage','10',NULL,NULL,'2020-02-17 23:45:53'),(53,'roundTaxDecimals','3',NULL,NULL,NULL),(54,'skin','{\"headBackground\":\"purple\",\"headClass\":\"dark\",\"sidebarBackground\":\"white\",\"sidebarClass\":\"light\",\"sidebarMode\":\"open\"}',NULL,NULL,'2020-02-17 23:46:27'),(55,'timezone','America/Phoenix',NULL,NULL,NULL),(56,'upcomingPaymentNoticeEmailBody','<p>This is a notice to let you know your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }} is due on {{ $invoice->formatted_due_at }}. Click the link below to view the invoice:</p>\r\n\r\n<p><a href=\"{{ $invoice->public_url }}\">{{ $invoice->public_url }}</a></p>',NULL,NULL,NULL),(57,'upcomingPaymentNoticeEmailSubject','Upcoming Payment Due Notice: Invoice #{{ $invoice->number }}',NULL,NULL,NULL),(58,'version','5.1.0',NULL,NULL,'2020-02-17 23:46:04'),(59,'widgetColumnWidthClientActivity','4',NULL,NULL,NULL),(60,'widgetColumnWidthInvoiceSummary','6',NULL,NULL,NULL),(61,'widgetColumnWidthQuoteSummary','6',NULL,NULL,NULL),(62,'widgetDisplayOrderClientActivity','3',NULL,NULL,NULL),(63,'widgetDisplayOrderInvoiceSummary','1',NULL,NULL,NULL),(64,'widgetDisplayOrderQuoteSummary','2',NULL,NULL,NULL),(65,'widgetEnabledClientActivity','0',NULL,NULL,NULL),(66,'widgetEnabledInvoiceSummary','1',NULL,NULL,NULL),(67,'widgetEnabledQuoteSummary','1',NULL,NULL,NULL),(68,'widgetInvoiceSummaryDashboardTotals','year_to_date',NULL,NULL,NULL),(69,'widgetQuoteSummaryDashboardTotals','year_to_date',NULL,NULL,NULL),(70,'restolup','0',NULL,NULL,NULL),(71,'emptolup','0',NULL,NULL,NULL),(72,'workorderTemplate','default.blade.php',NULL,NULL,NULL),(73,'workorderGroup','3',NULL,NULL,NULL),(74,'workordersExpireAfter','15',NULL,NULL,NULL),(75,'workorderTerms','Default Terms:',NULL,NULL,NULL),(76,'workorderFooter','Default Footer:',NULL,NULL,NULL),(77,'convertWorkorderTerms','workorder',NULL,NULL,NULL),(78,'tsCompanyName','YOURQBCOMPANYNAME',NULL,NULL,NULL),(79,'tsCompanyCreate','YOURQBCOMPANYCREATETIME',NULL,NULL,NULL),(80,'workorderStatusFilter','all_statuses',NULL,NULL,NULL),(81,'schedulerPastdays','60',NULL,NULL,NULL),(82,'schedulerEventLimit','5',NULL,NULL,NULL),(83,'schedulerCreateWorkorder','0',NULL,NULL,NULL),(84,'schedulerFcThemeSystem','standard',NULL,NULL,NULL),(85,'schedulerFcAspectRatio','1.35',NULL,NULL,NULL),(86,'schedulerTimestep','15',NULL,NULL,NULL),(87,'schedulerEnabledCoreEvents','15',NULL,NULL,NULL),(88,'schedulerDisplayInvoiced','0',NULL,NULL,NULL),(89,'pdfDisposition','inline',NULL,NULL,NULL),(90,'jquiTheme','cupertino',NULL,'2020-02-17 23:45:53','2020-02-17 23:45:53'),(91,'enabledModules','127',NULL,'2020-02-17 23:45:53','2020-02-17 23:46:27'),(92,'convertWorkorderDate','jobdate',NULL,'2020-02-17 23:45:53','2020-02-17 23:45:53'),(93,'purchaseorderTemplate','default.blade.php',NULL,'2020-02-17 23:46:27','2020-02-17 23:46:27'),(94,'purchaseorderGroup','4',NULL,'2020-02-17 23:46:27','2020-02-17 23:46:27'),(95,'purchaseordersDueAfter','30',NULL,'2020-02-17 23:46:27','2020-02-17 23:46:27'),(96,'purchaseorderStatusFilter','all_statuses',NULL,'2020-02-17 23:46:27','2020-02-17 23:46:27'),(97,'purchaseorderTerms','',NULL,'2020-02-17 23:46:27','2020-02-17 23:46:27'),(98,'purchaseorderFooter','',NULL,'2020-02-17 23:46:27','2020-02-17 23:46:27'),(99,'resetPurchaseorderDateEmailDraft','0',NULL,'2020-02-17 23:46:27','2020-02-17 23:46:27'),(100,'updateProductsDefault','1',NULL,'2020-02-17 23:46:27','2020-02-17 23:46:27'),(101,'updateInvProductsDefault','1',NULL,'2020-02-17 23:46:27','2020-02-17 23:46:27'),(102,'purchaseorderEmailSubject','Purchase Order #{{ $purchaseorder->number }}',NULL,'2020-02-17 23:46:27','2020-02-17 23:46:27'),(103,'purchaseorderEmailBody','<p>Please find the attached purchase order from {{ $purchaseorder->user->name }}</p>',NULL,'2020-02-17 23:46:27','2020-02-17 23:46:27'),(104,'currencyConversionKey','',NULL,'2020-02-17 23:46:27','2020-02-17 23:46:27');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sizes`
--

LOCK TABLES `sizes` WRITE;
/*!40000 ALTER TABLE `sizes` DISABLE KEYS */;
INSERT INTO `sizes` VALUES (1,''),(2,'1 - 3'),(3,'4 - 10'),(4,'11 - 50'),(5,'51 - 100'),(6,'101 - 500'),(7,'500+');
/*!40000 ALTER TABLE `sizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tax_rates`
--

LOCK TABLES `tax_rates` WRITE;
/*!40000 ALTER TABLE `tax_rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `tax_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `time_tracking_projects`
--

LOCK TABLES `time_tracking_projects` WRITE;
/*!40000 ALTER TABLE `time_tracking_projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `time_tracking_projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `time_tracking_tasks`
--

LOCK TABLES `time_tracking_tasks` WRITE;
/*!40000 ALTER TABLE `time_tracking_tasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `time_tracking_tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `time_tracking_timers`
--

LOCK TABLES `time_tracking_timers` WRITE;
/*!40000 ALTER TABLE `time_tracking_timers` DISABLE KEYS */;
/*!40000 ALTER TABLE `time_tracking_timers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `titles`
--

LOCK TABLES `titles` WRITE;
/*!40000 ALTER TABLE `titles` DISABLE KEYS */;
INSERT INTO `titles` VALUES (1,''),(2,'Accountant'),(3,'Administrative Assistant'),(4,'Administrator'),(5,'CEO'),(6,'Consultant'),(7,'Customer Service'),(8,'Director'),(9,'Driver'),(10,'IT Professional'),(11,'Manager'),(12,'Marketing'),(13,'Other'),(14,'Owner'),(15,'President'),(16,'Sales'),(17,'Secretary'),(18,'Software Developer'),(19,'Supervisor'),(20,'Technician'),(21,'Vice President'),(22,'Worker');
/*!40000 ALTER TABLE `titles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users_custom`
--

LOCK TABLES `users_custom` WRITE;
/*!40000 ALTER TABLE `users_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `vendor_contacts`
--

LOCK TABLES `vendor_contacts` WRITE;
/*!40000 ALTER TABLE `vendor_contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendor_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `vendors`
--

LOCK TABLES `vendors` WRITE;
/*!40000 ALTER TABLE `vendors` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `vendors_custom`
--

LOCK TABLES `vendors_custom` WRITE;
/*!40000 ALTER TABLE `vendors_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendors_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `workorder_amounts`
--

LOCK TABLES `workorder_amounts` WRITE;
/*!40000 ALTER TABLE `workorder_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `workorder_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `workorder_item_amounts`
--

LOCK TABLES `workorder_item_amounts` WRITE;
/*!40000 ALTER TABLE `workorder_item_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `workorder_item_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `workorder_items`
--

LOCK TABLES `workorder_items` WRITE;
/*!40000 ALTER TABLE `workorder_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `workorder_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `workorders`
--

LOCK TABLES `workorders` WRITE;
/*!40000 ALTER TABLE `workorders` DISABLE KEYS */;
/*!40000 ALTER TABLE `workorders` ENABLE KEYS */;
UNLOCK TABLES;

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

-- Dump completed on 2020-02-17  9:48:06
