-- MySQL dump 10.13  Distrib 5.5.35, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: pp
-- ------------------------------------------------------
-- Server version	5.5.35-0ubuntu0.12.04.2

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
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'asdfg@asd.co'),(2,'asd@asd.co'),(3,'kunalkb20@gmail.com'),(4,'ads@asd.co');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donepics`
--

DROP TABLE IF EXISTS `donepics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `donepics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `original` int(11) DEFAULT NULL,
  `chosen` int(11) DEFAULT '0',
  `uploadtime` varchar(20) DEFAULT NULL,
  `editor` int(11) DEFAULT NULL,
  `prefix` char(6) DEFAULT NULL,
  `ext` varchar(5) DEFAULT NULL,
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donepics`
--

LOCK TABLES `donepics` WRITE;
/*!40000 ALTER TABLE `donepics` DISABLE KEYS */;
INSERT INTO `donepics` VALUES (12,1,0,NULL,1,'844589','jpg','2595d55befa031aca4690422f7d561a7.jpg'),(13,2,0,NULL,1,'439832','jpg','8c55af96b8d544f29ab8eeed029fcb87.jpg'),(14,2,0,NULL,1,'615942','jpg','c8ddf6274aa48dce329fc66c31f88099.jpg');
/*!40000 ALTER TABLE `donepics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `editors`
--

DROP TABLE IF EXISTS `editors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `editors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) DEFAULT NULL,
  `password` text,
  `signuptime` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `verify` char(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editors`
--

LOCK TABLES `editors` WRITE;
/*!40000 ALTER TABLE `editors` DISABLE KEYS */;
INSERT INTO `editors` VALUES (1,'asdfgh','58b0ff339b747bf1ed02245b5439deba','1395486320','asd@asd.co','kunal','','');
/*!40000 ALTER TABLE `editors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `instructions` varchar(100) DEFAULT NULL,
  `project` int(11) DEFAULT NULL,
  `ext` varchar(5) DEFAULT NULL,
  `prefix` char(5) DEFAULT NULL,
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pictures`
--

LOCK TABLES `pictures` WRITE;
/*!40000 ALTER TABLE `pictures` DISABLE KEYS */;
INSERT INTO `pictures` VALUES (1,NULL,1,'jpg','65114','e20737daf154eb78c553b8a38e1a4939.jpg'),(2,NULL,1,'jpg','81637','cb46bd2b7dd3f7886cbec30b6ea299fc.jpg'),(3,NULL,1,'jpg','94948','98571467dbcb03500ede0a25db6047e2.jpg'),(4,NULL,1,'jpg','12984','036c389ecbd85e78ee96f6f17ff4181e.jpg'),(5,NULL,2,'jpg','23656','cd75cfe669abd8018f175861ab3d333c.jpg'),(6,NULL,2,'jpg','11524','bd8b1927a15c0c9f1735252ea46be723.jpg'),(7,NULL,3,'jpg','63774','8412587318d2791353ea080902e76a99.jpg'),(8,NULL,3,'jpg','44559','f0f01c828f18b2185765a932f7c4d74c.jpg'),(9,NULL,4,'jpg','66918','5d2f6894dfa1dbf4d27e5567597ea549.jpg'),(10,NULL,4,'jpg','89145','5e56575e330870b6509e95c1d7fd155a.jpg'),(11,NULL,5,'jpg','75924','a00d49d96f28ac147e0d43c367ed021d.jpg'),(12,NULL,5,'jpg','97683','30123db3e83038fda0d249f9bd5bb553.jpg'),(13,NULL,6,'jpg','89446','5712d5d2aa18a147efdf4d725fd7fae5.jpg'),(14,NULL,6,'jpg','82694','de7208f0f3e81f95e8a1f45bf2cdc772.jpg'),(15,NULL,7,'jpg','35338','09a99134d43ddf528ac7343b86720ca5.jpg'),(16,NULL,7,'jpg','39328','149824d545346e320b1e67cdace932eb.jpg'),(17,NULL,8,'jpg','81665','60bb99968417d32918b78ed0512ed0ca.jpg'),(18,NULL,8,'jpg','86424','a3d5774c2eb0aba6d47e1672cbe9f059.jpg'),(19,NULL,9,'jpg','52766','bf3687883eb88235cff30e53c166e67e.jpg'),(20,NULL,9,'jpg','18242','76cf2ba10b88b615ecab6bb9eccf950a.jpg'),(37,NULL,14,'jpg','75985','960771879ce7b5c2a0584d21e36ee7d0.jpg'),(38,NULL,14,'jpg','12992','082510ef38f6698f143046738ed377b4.jpg'),(39,NULL,14,'jpg','22547','9f6043d1059236d87893af397058e64b.jpg'),(40,NULL,14,'jpg','86162','6c5f28db4c97a82760ec8af03794982a.jpg'),(41,NULL,14,'jpg','83365','feabe2a92c9e02fb56d2da67ab2fb094.jpg'),(42,NULL,14,'jpg','22121','297c807bb6ea77d6156dab22f506949b.jpg'),(49,NULL,16,'jpg','94395','3e333a86f342b8c43d8a3ce64f13533c.jpg'),(50,NULL,16,'jpg','28597','37950e2e91e70159fa438cce09b1aa89.jpg'),(51,NULL,16,'jpg','97175','f646907de6093ea5881064fb87720a23.jpg'),(52,NULL,16,'jpg','95883','762f4d266d29467c5ae460e5246cdcc0.jpg'),(53,NULL,16,'jpg','52417','f4687314e23577823023e22c8a8d91e6.jpg'),(54,NULL,16,'jpg','77417','02fbf0efaaad4902b7fca3c4fe0b1681.jpg'),(65,'some instr',20,'jpg','42756','5e8c88dabb25d2d4d05a42a28e88e046.jpg'),(66,NULL,20,'jpg','49665','42cd0b369ca86744a80fc20076113ace.jpg'),(67,'abc',21,'jpg','84289','4b24cafc1a727eb802c4acc28f9c423d.jpg'),(68,NULL,21,'jpg','18731','2c86325eb83a1421fe2a63bade769add.jpg'),(71,NULL,23,'jpg','92139','b36c77520d721ae2c352afdef41ca426.jpg'),(72,'anything',23,'jpg','18153','286a24eb1b33792ba3b8103eb1b9df05.jpg');
/*!40000 ALTER TABLE `pictures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prefs`
--

DROP TABLE IF EXISTS `prefs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prefs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `editor` int(11) DEFAULT NULL,
  `project` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prefs`
--

LOCK TABLES `prefs` WRITE;
/*!40000 ALTER TABLE `prefs` DISABLE KEYS */;
/*!40000 ALTER TABLE `prefs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_key`
--

DROP TABLE IF EXISTS `project_key`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_key` (
  `status` int(11) DEFAULT NULL,
  `value` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_key`
--

LOCK TABLES `project_key` WRITE;
/*!40000 ALTER TABLE `project_key` DISABLE KEYS */;
INSERT INTO `project_key` VALUES (0,'unconfirmed'),(1,'confirmed'),(2,'cancelled');
/*!40000 ALTER TABLE `project_key` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `password` text,
  `instructions` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `submittime` varchar(20) DEFAULT NULL,
  `customer` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `checkcode` int(11) DEFAULT NULL,
  `endtime` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'Ankush Paul',NULL,'',1,'1395750115',2,0,NULL,'1398085841'),(2,'asd','722344','',1,'1397476078',3,0,827325,NULL),(3,'asd',NULL,'',0,'1397653045',2,0,NULL,NULL),(5,'asd',NULL,'',0,'1397653197',2,0,NULL,NULL),(6,'asd',NULL,'',0,'1397653260',2,0,NULL,NULL),(11,'asd',NULL,'',0,'1397712650',2,0,NULL,NULL),(14,'asd',NULL,'',0,'1397812795',2,0,NULL,NULL),(16,'asd',NULL,'',0,'1397813405',2,0,NULL,NULL),(20,'asd','624994','proj instr',1,'1397886683',2,1,453291,NULL),(21,'asd','784692','abc',1,'1397888777',2,1,453511,NULL),(23,'bad','525689','asdf',1,'1397889757',2,1,527746,NULL);
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work`
--

DROP TABLE IF EXISTS `work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `work` (
  `editor` int(11) NOT NULL DEFAULT '0',
  `project` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `start` varchar(20) DEFAULT NULL,
  `end` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`editor`,`project`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work`
--

LOCK TABLES `work` WRITE;
/*!40000 ALTER TABLE `work` DISABLE KEYS */;
INSERT INTO `work` VALUES (1,1,0,'1398075237','1398085841');
/*!40000 ALTER TABLE `work` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_key`
--

DROP TABLE IF EXISTS `work_key`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `work_key` (
  `status` int(11) DEFAULT NULL,
  `value` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_key`
--

LOCK TABLES `work_key` WRITE;
/*!40000 ALTER TABLE `work_key` DISABLE KEYS */;
INSERT INTO `work_key` VALUES (0,'ongoing'),(1,'dropped'),(2,'failed'),(3,'completed'),(4,'removed'),(5,'cancelled');
/*!40000 ALTER TABLE `work_key` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-21 18:42:28
