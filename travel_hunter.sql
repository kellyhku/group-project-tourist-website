-- MySQL dump 10.16  Distrib 10.1.16-MariaDB, for osx10.6 (i386)
--
-- Host: localhost    Database: travel_hunter
-- ------------------------------------------------------
-- Server version	10.1.16-MariaDB

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
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_content` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Nice!!',
  `comment_idea_id` int(11) NOT NULL,
  `comment_user_id` int(11) NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (8,'very good',3,1,'2016-12-10 21:30:57'),(9,'yes',3,1,'2016-12-10 21:35:05'),(10,'I love it',3,1,'2016-12-10 21:44:04'),(11,'Successful',3,1,'2016-12-10 22:38:42'),(13,'hello',4,1,'2016-12-10 22:52:55'),(14,'yes',4,1,'2016-12-10 22:54:00'),(15,'successful again and agin',3,1,'2016-12-11 22:51:07');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `destination`
--

DROP TABLE IF EXISTS `destination`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `destination` (
  `destination_id` int(11) NOT NULL AUTO_INCREMENT,
  `destination_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `destination_latitude` float NOT NULL,
  `destination_longitude` float NOT NULL,
  PRIMARY KEY (`destination_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destination`
--

LOCK TABLES `destination` WRITE;
/*!40000 ALTER TABLE `destination` DISABLE KEYS */;
INSERT INTO `destination` VALUES (1,'日本福岛县',37.3854,139.481),(2,'Bukit Panjang, 新加坡',1.37803,103.775),(3,'美国明尼苏达州',44.8379,-96.0938),(4,'埃及新河谷省',25.6385,31.3476),(5,'美国芝加哥大都市区',42.421,-88.3594);
/*!40000 ALTER TABLE `destination` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `idea`
--

DROP TABLE IF EXISTS `idea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `idea` (
  `idea_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idea_title` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Travel idea',
  `idea_destination` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Hong Kong',
  `idea_start_date` date DEFAULT NULL,
  `idea_end_date` date DEFAULT NULL,
  `idea_tag` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idea_user_id` int(11) NOT NULL,
  PRIMARY KEY (`idea_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `idea`
--

LOCK TABLES `idea` WRITE;
/*!40000 ALTER TABLE `idea` DISABLE KEYS */;
INSERT INTO `idea` VALUES (3,'IU wanna travel with U now','日本福岛县','2016-12-14','2016-12-27','Japan',1),(4,'Hye Jeong wanna go to Singapore~~','Bukit Panjang, 新加坡','2016-12-21','2016-12-31','Singapore',1),(5,'Hani need a partner to travel together','美国明尼苏达州','2016-12-19','2016-12-29','USA',1),(6,'Haoning wanna enjoy trip with U!','埃及新河谷省','2016-12-28','2016-12-30','Egypt',5),(7,'haoning wanna go to Chicago!','美国芝加哥大都市区','2016-12-30','2017-01-02','Chicago',1);
/*!40000 ALTER TABLE `idea` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `tag_idea_id` int(11) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (3,'Japan',3),(4,'Singapore',4),(5,'USA',5),(6,'Egypt',6),(7,'Chicago',7);
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_first_name` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `user_last_name` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `user_img_url` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '/images/user_img/img_default/default.png',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'chumingjun@163.com','1111','mingjunn','chu','/images/user_img/da275559252dd42a133ae57c063b5bb5c8eab8c7.jpg'),(5,'anhaoning@qq.com','1234a','haoning','an','/images/user_img/img_default/default.png'),(6,'mingjun@163.com','123qwe','ming','jun','/images/user_img/img_default/default.png');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-12  7:19:49
