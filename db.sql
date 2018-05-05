-- MySQL dump 10.13  Distrib 5.1.58, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: tree_test
-- ------------------------------------------------------
-- Server version	5.1.58-1

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
-- Table structure for table `tree_entry`
--

DROP TABLE IF EXISTS `tree_entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tree_entry` (
  `entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_entry_id` int(11) NOT NULL DEFAULT '0' COMMENT '0 if its on the root level otherwise refering to another entry in this table',
  PRIMARY KEY (`entry_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COMMENT='table holding all the tree nodes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tree_entry`
--

LOCK TABLES `tree_entry` WRITE;
/*!40000 ALTER TABLE `tree_entry` DISABLE KEYS */;
INSERT INTO `tree_entry` VALUES (1,0),(2,0),(3,0),(4,9),(5,9),(6,9),(7,5),(8,5),(9,1),(10,1),(11,10),(12,11),(13,3),(14,2),(15,13),(19,13),(17,13),(18,5);
/*!40000 ALTER TABLE `tree_entry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tree_entry_lang`
--

DROP TABLE IF EXISTS `tree_entry_lang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tree_entry_lang` (
  `entry_id` int(11) NOT NULL,
  `lang` varchar(3) NOT NULL COMMENT 'language for the translation (eng/ger)',
  `name` varchar(255) NOT NULL COMMENT 'translated name for the given entry'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='translation table for tree_entry';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tree_entry_lang`
--

LOCK TABLES `tree_entry_lang` WRITE;
/*!40000 ALTER TABLE `tree_entry_lang` DISABLE KEYS */;
INSERT INTO `tree_entry_lang` VALUES (1,'eng','Prio 1 Tasks'),(2,'eng','Prio 2 Tasks'),(3,'eng','Prio 3 Tasks'),(1,'ger','Prio 1 Aufgaben'),(2,'ger','Prio 2 Aufgaben'),(3,'ger','Prio 3 Aufgaben'),(4,'ger','Punkt ABC123'),(5,'ger','Punkt BCD123'),(6,'ger','Punkt UARGH123'),(4,'eng','Point ABC123'),(5,'eng','Point BCD123'),(6,'eng','Point UARGH123'),(7,'eng','Task 22222'),(8,'eng','Task 566'),(9,'eng','Supplier'),(10,'eng','Customer'),(11,'eng','204. Task'),(12,'eng','209. Task'),(13,'eng','123. Task'),(14,'eng','asdasd. Task'),(15,'eng','nomnom. Task'),(19,'eng','mimimi. Task'),(17,'eng','Gedöns Task'),(18,'eng','ZOMG Task');
/*!40000 ALTER TABLE `tree_entry_lang` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-01-31  8:51:07