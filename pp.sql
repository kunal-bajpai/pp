-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (i686)
--
-- Host: www.photopuddle.com    Database: pp
-- ------------------------------------------------------
-- Server version	5.5.36-cll-lve

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `password` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'asdfg@asd.co'),(2,'asd@asd.co'),(3,'kunalkb20@gmail.com'),(4,'ads@asd.co'),(5,'abhilashkumar360@gmail.com'),(6,'amikshay@gmail.com'),(7,'avinsingh007@gmail.com'),(8,'hjv@jbc.hgd'),(9,'ghn@hji.bh'),(10,'djdj@gmail.com'),(11,'ch@wer.com'),(12,'test@gmail.com'),(13,'avinsinghwewew007@gmail.com'),(14,'asd@asd.cl'),(15,'abh@abh.co'),(16,''),(17,'asd@asd.ko'),(18,'test@live.in'),(19,'ab@gj.gy'),(20,'aarzoosiddiqui2109@gmail.com'),(21,'asd@asd.com'),(22,'simplymailsajal@gmail.com'),(23,'blahblah@gmail.com'),(24,'prabhat.chowdhary@gmail.com'),(25,'a@aa.xss'),(26,'girirajgorani@gmail.com'),(27,'test@email.com'),(28,'yashemail55@gmail.com');
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donepics`
--

LOCK TABLES `donepics` WRITE;
/*!40000 ALTER TABLE `donepics` DISABLE KEYS */;
INSERT INTO `donepics` VALUES (12,1,0,NULL,1,'844589','jpg','2595d55befa031aca4690422f7d561a7.jpg'),(13,2,1,NULL,1,'439832','jpg','8c55af96b8d544f29ab8eeed029fcb87.jpg'),(14,2,1,NULL,1,'615942','jpg','c8ddf6274aa48dce329fc66c31f88099.jpg'),(15,8,0,NULL,1,'158862','jpg','836dd500954d0b1666a0572093134efe.jpg'),(16,8,0,NULL,1,'899917','jpg','ad15dfe35ef4df8eb37ed69a68324a9b.jpg'),(17,8,0,NULL,1,'197342','jpg','6f9018f50983b0d0fac16380336ffaaf.jpg'),(18,8,0,NULL,1,'552887','jpg','4f87408930e908d22ef2451e335b981e.jpg'),(19,8,0,NULL,1,'429766','jpg','713535aca2620b47e6ac7e8a1d8f2563.jpg'),(20,118,0,NULL,1,'494591','jpg','4187f4723088c34053c15cfacef71677.jpg'),(21,118,0,NULL,1,'125287','jpg','96f7420021bd8b08ae5d76fae5e5c530.jpg'),(22,118,0,NULL,1,'558245','jpg','b2b99195e33eed896d97390788993c36.jpg'),(31,279,0,NULL,1,'459675','jpg','a661732137620d050ff366430624c820.jpg'),(33,279,0,NULL,1,'195946','jpg','12633594ead2ad11508f93003ff32827.jpg');
/*!40000 ALTER TABLE `donepics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `edit_payout`
--

DROP TABLE IF EXISTS `edit_payout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `edit_payout` (
  `editor` int(11) DEFAULT NULL,
  `project` int(11) DEFAULT NULL,
  `payout` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `edit_payout`
--

LOCK TABLES `edit_payout` WRITE;
/*!40000 ALTER TABLE `edit_payout` DISABLE KEYS */;
/*!40000 ALTER TABLE `edit_payout` ENABLE KEYS */;
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
  `status` int(11) DEFAULT '-2',
  `bankname` varchar(50) DEFAULT NULL,
  `ifsc` varchar(11) DEFAULT NULL,
  `acname` varchar(30) DEFAULT NULL,
  `acno` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editors`
--

LOCK TABLES `editors` WRITE;
/*!40000 ALTER TABLE `editors` DISABLE KEYS */;
INSERT INTO `editors` VALUES (1,'asdfgh','58b0ff339b747bf1ed02245b5439deba','1395486320','asd@asd.co','kunal','','',-4,'asd','ASDF0000000','asd','1234567'),(2,'bobbyy','27324a0425ba040c069c2fa3c0ff0793','1410920159','prabhat.chowdhary@gmail.com','prabhat','chowdhary','851297',-2,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `editors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `order_id` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `bank_ref_no` varchar(50) DEFAULT NULL,
  `order_status` varchar(15) DEFAULT NULL,
  `failure_message` varchar(50) DEFAULT NULL,
  `payment_mode` varchar(50) DEFAULT NULL,
  `card_name` varchar(50) DEFAULT NULL,
  `status_code` int(11) DEFAULT NULL,
  `status_message` varchar(150) DEFAULT NULL,
  `currency` char(3) DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `billing_name` varchar(60) DEFAULT NULL,
  `billing_address` varchar(150) DEFAULT NULL,
  `billing_city` varchar(30) DEFAULT NULL,
  `billing_state` varchar(30) DEFAULT NULL,
  `billing_zip` varchar(15) DEFAULT NULL,
  `billing_country` varchar(50) DEFAULT NULL,
  `billing_tel` varchar(20) DEFAULT NULL,
  `billing_email` varchar(70) DEFAULT NULL,
  `customer_identifier` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payouts`
--

DROP TABLE IF EXISTS `payouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payouts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` varchar(20) DEFAULT NULL,
  `basic_price` decimal(10,2) DEFAULT NULL,
  `advanced_price` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `bankname` varchar(50) DEFAULT NULL,
  `ifsc` varchar(11) DEFAULT NULL,
  `acname` varchar(30) DEFAULT NULL,
  `acno` varchar(16) DEFAULT NULL,
  `txnid` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payouts`
--

LOCK TABLES `payouts` WRITE;
/*!40000 ALTER TABLE `payouts` DISABLE KEYS */;
INSERT INTO `payouts` VALUES (1,'1409139424',19.00,29.00,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `payouts` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=302 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pictures`
--

LOCK TABLES `pictures` WRITE;
/*!40000 ALTER TABLE `pictures` DISABLE KEYS */;
INSERT INTO `pictures` VALUES (1,NULL,1,'jpg','65114','e20737daf154eb78c553b8a38e1a4939.jpg'),(2,NULL,1,'jpg','81637','cb46bd2b7dd3f7886cbec30b6ea299fc.jpg'),(3,NULL,1,'jpg','94948','98571467dbcb03500ede0a25db6047e2.jpg'),(4,NULL,1,'jpg','12984','036c389ecbd85e78ee96f6f17ff4181e.jpg'),(5,NULL,2,'jpg','23656','cd75cfe669abd8018f175861ab3d333c.jpg'),(6,NULL,2,'jpg','11524','bd8b1927a15c0c9f1735252ea46be723.jpg'),(7,NULL,3,'jpg','63774','8412587318d2791353ea080902e76a99.jpg'),(8,NULL,3,'jpg','44559','f0f01c828f18b2185765a932f7c4d74c.jpg'),(9,NULL,4,'jpg','66918','5d2f6894dfa1dbf4d27e5567597ea549.jpg'),(10,NULL,4,'jpg','89145','5e56575e330870b6509e95c1d7fd155a.jpg'),(11,NULL,5,'jpg','75924','a00d49d96f28ac147e0d43c367ed021d.jpg'),(12,NULL,5,'jpg','97683','30123db3e83038fda0d249f9bd5bb553.jpg'),(13,NULL,6,'jpg','89446','5712d5d2aa18a147efdf4d725fd7fae5.jpg'),(14,NULL,6,'jpg','82694','de7208f0f3e81f95e8a1f45bf2cdc772.jpg'),(15,NULL,7,'jpg','35338','09a99134d43ddf528ac7343b86720ca5.jpg'),(16,NULL,7,'jpg','39328','149824d545346e320b1e67cdace932eb.jpg'),(17,NULL,8,'jpg','81665','60bb99968417d32918b78ed0512ed0ca.jpg'),(18,NULL,8,'jpg','86424','a3d5774c2eb0aba6d47e1672cbe9f059.jpg'),(19,NULL,9,'jpg','52766','bf3687883eb88235cff30e53c166e67e.jpg'),(20,NULL,9,'jpg','18242','76cf2ba10b88b615ecab6bb9eccf950a.jpg'),(37,NULL,14,'jpg','75985','960771879ce7b5c2a0584d21e36ee7d0.jpg'),(38,NULL,14,'jpg','12992','082510ef38f6698f143046738ed377b4.jpg'),(39,NULL,14,'jpg','22547','9f6043d1059236d87893af397058e64b.jpg'),(40,NULL,14,'jpg','86162','6c5f28db4c97a82760ec8af03794982a.jpg'),(41,NULL,14,'jpg','83365','feabe2a92c9e02fb56d2da67ab2fb094.jpg'),(42,NULL,14,'jpg','22121','297c807bb6ea77d6156dab22f506949b.jpg'),(49,NULL,16,'jpg','94395','3e333a86f342b8c43d8a3ce64f13533c.jpg'),(50,NULL,16,'jpg','28597','37950e2e91e70159fa438cce09b1aa89.jpg'),(51,NULL,16,'jpg','97175','f646907de6093ea5881064fb87720a23.jpg'),(52,NULL,16,'jpg','95883','762f4d266d29467c5ae460e5246cdcc0.jpg'),(53,NULL,16,'jpg','52417','f4687314e23577823023e22c8a8d91e6.jpg'),(54,NULL,16,'jpg','77417','02fbf0efaaad4902b7fca3c4fe0b1681.jpg'),(65,'some instr',20,'jpg','42756','5e8c88dabb25d2d4d05a42a28e88e046.jpg'),(66,NULL,20,'jpg','49665','42cd0b369ca86744a80fc20076113ace.jpg'),(67,'abc',21,'jpg','84289','4b24cafc1a727eb802c4acc28f9c423d.jpg'),(68,NULL,21,'jpg','18731','2c86325eb83a1421fe2a63bade769add.jpg'),(71,NULL,23,'jpg','92139','b36c77520d721ae2c352afdef41ca426.jpg'),(72,'anything',23,'jpg','18153','286a24eb1b33792ba3b8103eb1b9df05.jpg'),(73,NULL,24,'jpg','44675','9cfddd3b0005e0f29237ede359afebde.jpg'),(75,NULL,26,'JPG','88248','cd8d6a96d0e992f04817b30c9eff6466.JPG'),(76,NULL,26,'jpg','85818','938303ca4051bf31da6c7705750e7106.jpg'),(77,NULL,26,'jpg','91671','52128cd05ee656be3c0adec12b7bebe8.jpg'),(78,NULL,26,'jpg','38995','e25606c93b6279aa2ffab9fc26fec845.jpg'),(79,NULL,27,'JPG','55879','219a34a1e0dd2483e10c0c180e93f531.JPG'),(82,NULL,30,'jpg','61427','764fcbd1ef4edf282ca785f0c3cf1a84.jpg'),(83,NULL,31,'jpg','33681','a03219c99581698723f03b0fdfd5de8f.jpg'),(84,NULL,31,'png','21392','3927c29a4dec994b9f3a0cc92a8e1361.png'),(85,NULL,31,'jpg','52962','530e9f6b14d8fbb1ce21ec581649c70b.jpg'),(86,NULL,32,'jpg','32958','831a0fc543a77c6fd19aca2c404f4e23.jpg'),(87,NULL,32,'jpg','86754','6ce19e78281549dc4c462f4955f14722.jpg'),(88,NULL,32,'jpg','57933','9c977e63c9bb97d7345c1ac555f9c592.jpg'),(89,NULL,33,'jpg','93816','d5195ed96c9934917b98c53d273b7dea.jpg'),(91,NULL,35,'jpg','69978','850dbcdbf7133a5c316583d8e46b9e51.jpg'),(92,NULL,36,'jpg','37143','3b3c3a6372ead3cd106a86008e49535c.jpg'),(93,NULL,36,'jpg','24926','2c6176c49af8517601d3d53d52f5d4d2.jpg'),(94,NULL,36,'jpg','22555','b9a0a1cffe81601c7c191574c6bf2c9e.jpg'),(95,NULL,37,'jpg','35849','01d31d4d5725cd3eaa8c08bb9f0e87b4.jpg'),(97,NULL,39,'jpg','49344','c92063078b84bae45a443645db18b2e8.jpg'),(98,NULL,40,'jpg','21689','ec70e3a8d4d861e4ee0f4bd9765fb7be.jpg'),(99,NULL,41,'jpg','54749','0e53cb5caeabc0c267a2ec1919e56fb1.jpg'),(100,NULL,41,'jpg','83688','1caca3487ef5883f06735eea380c53d7.jpg'),(101,NULL,41,'jpg','19494','11976b679c8874df17cd53b2c516d166.jpg'),(102,NULL,42,'jpeg','83839','7a8f90bc0f1eb4bf6d15175dc1d13ad7.jpeg'),(103,NULL,43,'jpg','67874','df256fb9c5c0c08f40ad277847c09c5f.jpg'),(104,NULL,44,'jpg','83857','75c5764fc4746baf239008b1a52065b0.jpg'),(105,NULL,45,'jpg','15947','2be1c57fe330f9c174d9363d1eca11fa.jpg'),(107,NULL,47,'jpg','15438','7d5f9f84413a9666d70bafac04bdf61a.jpg'),(108,NULL,48,'jpg','68793','8092ba47b1fb293a3a89289671992e68.jpg'),(109,NULL,49,'jpg','29319','1d07c0b165cdf8c2126c4dc33be1624f.jpg'),(112,NULL,51,'jpg','49166','b2e2ae709fe429576085bebeb1581985.jpg'),(113,NULL,52,'jpg','64433','5d8a9c5482bc0123901c385e1f071ee4.jpg'),(114,NULL,53,'jpg','42687','48bd74d0e7c506b12adb26ddfe202adb.jpg'),(115,NULL,54,'jpg','79316','7e325bf5f2439d7132d41bc5a56ce133.jpg'),(116,NULL,55,'jpg','59735','4618acb7e5181610055da7b0d49f82cb.jpg'),(117,NULL,55,'jpg','12531','2cf52117f43299abdee74738225db3a2.jpg'),(118,NULL,56,'jpg','79987','e61cd63c5e34bca4ef53b0818449cce2.jpg'),(119,NULL,57,'JPG','73377','4fc5d44b8691422a838b8aea8ee8f7c6.JPG'),(120,NULL,58,'jpg','64181','28933f9359bd9f44bcdc68b2916b0989.jpg'),(121,NULL,58,'JPG','65749','c7781a23f8d54958d8d2e306160ce851.JPG'),(125,NULL,61,'jpg','42592','91a99a08f116b1eb701757395a03ee93.jpg'),(126,NULL,62,'jpg','66129','2500b3ee33e3cc0e785c0a45d11b50f2.jpg'),(127,NULL,63,'jpg','28571','36e33acf9b77e02e8444fad9d1f0628d.jpg'),(128,NULL,64,'JPG','55336','401584f2892cb404a0e3f5f64b9bc1a3.JPG'),(134,NULL,68,'JPG','57786','fb2f514a99d3b573d1be2d9952acaea7.JPG'),(135,NULL,69,'JPG','63329','a60e4c9fa36ccc7db4266fa599d0024a.JPG'),(136,NULL,70,'JPG','16461','d56904d6d6a9ea75f6965c8447abd53d.JPG'),(137,NULL,71,'JPG','15392','96404aee7b271a3f831fee479c9f6252.JPG'),(139,NULL,73,'JPG','32948','83d92367bc535c2d0406a1ce23aeecab.JPG'),(140,NULL,74,'JPG','51142','b927c38de4287ac72af190f99f85e828.JPG'),(141,NULL,75,'JPG','23568','681e813c90f7b4216fa63a2ce22c371d.JPG'),(142,NULL,75,'JPG','34997','e7191acbe1ccde1eec90b85fb1374c5f.JPG'),(143,NULL,76,'JPG','63869','fd563d43bd2a166e8199ee3c48708d1f.JPG'),(144,NULL,76,'JPG','29252','23c2ace5d9bfee3d9dd423d2d2632816.JPG'),(145,NULL,77,'JPG','44724','715c7f758bb10ddfd62e7a8c330aaf19.JPG'),(146,NULL,78,'JPG','12512','0ccfa7db32e24094a717790c1f0ce037.JPG'),(147,NULL,79,'JPG','57979','60b4bb8e83e84ae4fbaf734c4a66ea55.JPG'),(148,NULL,79,'JPG','99571','535491a7ae57b3b9c597916e7281f071.JPG'),(149,NULL,79,'JPG','45451','8efe4a7c3c395bc3f2939807c0b78397.JPG'),(150,NULL,80,'JPG','75962','cc9d451b114aab7eb5a28b54eec8dfc0.JPG'),(151,NULL,80,'JPG','86388','8012a14fd7606b245f6d67817c3a9d95.JPG'),(152,NULL,81,'JPG','73173','8852d967f7fe3ff1aeb5bfea4ebbe923.JPG'),(153,NULL,82,'JPG','15913','17997ba3e9f1b6e0d0a7e49c73833502.JPG'),(154,NULL,82,'JPG','88632','bbddb8ea6ef9c59e608fb95ef303958c.JPG'),(156,NULL,84,'jpg','46837','65eefbd6d0ba788691fac33f7029519e.jpg'),(159,NULL,85,'jpg','49682','38a34599abc01799a506c57fd1f9518c.jpg'),(161,NULL,87,'JPG','18451','5a8f7e7b10ec0ecafa412561ef9a6c4b.JPG'),(162,NULL,88,'jpg','96416','23aa09bcec2ee9dee0b80fc8d2a70f4b.jpg'),(163,NULL,89,'jpg','16587','8280bbb1e3ffca403164762b2e5e2726.jpg'),(164,NULL,90,'JPG','62461','e881e65d3ebdb5768f3d55fe3c08e5c6.JPG'),(165,NULL,91,'jpg','29999','e9119a290d8ae5b74f49b0f567a623d9.jpg'),(166,NULL,92,'NEF','23726','efa3a4000a0213de11d49ade28143d70.NEF'),(167,NULL,93,'NEF','61668','ba740cfb5c88b25378a0e0e402cc243d.NEF'),(168,NULL,94,'NEF','47766','e71da888ce04ff966217be61d146eadf.NEF'),(169,NULL,95,'NEF','31394','c4dc5b393165018d899a3b31a707d854.NEF'),(170,NULL,96,'jpg','16933','1ec120cac904c0d83598703be4e2be9f.jpg'),(172,NULL,100,'png','58267','cff2db976a0c9a13e52d1197e94b91e4.png'),(173,NULL,101,'png','83435','721af93135296054a74369b31014283f.png'),(174,NULL,102,'png','54468','422e41d60afc15a6bdd90ecab4e5d3cc.png'),(175,NULL,103,'png','45947','6a3faacae00613f82aaa1fe926a56b67.png'),(176,NULL,104,'png','62752','49a9f299aa26d5f6fe1e9ab9c324df7e.png'),(177,NULL,105,'png','53253','71c6a291645a957dac52f09fd068f1a4.png'),(178,NULL,106,'png','34143','953d814f923ae28828212f5ce7a1baf7'),(179,NULL,107,'png','18694','fbb5988592456b638627a200fc01a114'),(180,NULL,108,'png','78297','773a4068c8fb8cdf2271ce85f484869d'),(181,NULL,109,'png','44458','122e967ca35b4f1899777ca323b3a7f0'),(182,NULL,110,'png','38351','35a5c5203b2c1a1c5c8f8a2013d41aa1'),(183,NULL,111,'png','42421','74d9bc51ec752b75671f1e9344709a33'),(184,NULL,112,'png','82294','9b2f258df58442684376714179300e0f'),(185,NULL,113,'jpg','11635','c7cbed4d98657df679818bf3e6955dde'),(186,NULL,114,'jpg','51984','093d8cca5414665f22ac7bdcfcbdd2a5'),(187,NULL,115,'jpg','59995','69fffa410893a107b7d567b4e6bd8784'),(188,NULL,116,'jpg','45734','bee1a56874c302daae3f7e400db9fc31'),(189,NULL,117,'jpg','57814','0167dc674051cb29de7948f51632368f'),(190,NULL,118,'jpg','19195','8498cb001535d7a7095992da3dc94174'),(191,NULL,119,'jpg','78299','759e973dbc3db5d8e24fb8d44ce23c97'),(192,NULL,120,'jpg','75738','0d4c0f973597afd2553f55be64e8b824'),(193,NULL,120,'jpg','94956','62b403a7a02727ac28ddf357030722e3'),(194,NULL,121,'jpg','21766','5ed216f65d77d7154afde1e083422644'),(195,NULL,122,'jpg','87172','032da7403cfc8415fdaa59a0f64c696f'),(196,NULL,123,'jpg','12494','c5d8934c85814b2c326b4fffb0995c62'),(197,NULL,124,'jpg','17462','80bfcb4e512e6d737e402bd75f7886d3'),(198,NULL,125,'jpg','52514','fb3d1fb37b828a156fc38b6ace735aae'),(199,NULL,126,'jpg','15518','0cc2be46e9ad1a23a2bcd4da20f944f8'),(202,NULL,128,'jpg','87787','3f69b67367f8f40848504dc1af007eac'),(203,NULL,128,'jpg','26568','ac4e7b246588b6b230e41d2d832b7133'),(204,NULL,128,'jpg','76844','c0b3e478e0f171e037af1f8fa1451ea7'),(205,NULL,129,'jpg','26385','65da99d97f56c209f796edb99af3ca7c'),(206,NULL,129,'jpg','26673','1f13b3ed341bcdee7a77766e02bd01f1'),(214,NULL,133,'jpg','63956','71ebb8e3e45194164cec6c11a769f7e1'),(216,NULL,135,'jpg','28361','b47ec8b18bea4e802591fcd5297cb7d7'),(217,NULL,136,'jpg','96475','41c954a1df971b883fe993858353b7c3'),(218,NULL,136,'jpg','11995','b46a37b5674ab2df9cae25bf9f06d192'),(219,NULL,137,'JPG','21236','5d773ea63e22671937db026bb42140a4'),(220,NULL,138,'png','66311','6626721362f93975d9eca8aab3462f31'),(223,NULL,141,'jpg','48681','508c0384ba912be1a4228e12c12b4cb2'),(224,NULL,142,'PNG','56227','513f81fe9e5965c709c55280a97345c2'),(225,NULL,143,'jpg','88195','ee4d1a7b729171a83740c5cb45cc58ff'),(226,NULL,144,'jpg','13227','a18d69ccee048d87eb837d6544d38f00'),(227,NULL,144,'jpg','86149','8d94ea8470c39dac47520a95bce781bd'),(232,NULL,149,'jpg','64278','2a09c02120bd3d9ea80db0211a07793f'),(233,NULL,150,'jpg','64821','b7d73ae7b3095cb72a288f1f91f23204'),(234,NULL,151,'jpg','11887','3f49b2057ca89afc4cb75575ebf12f57'),(235,NULL,151,'jpg','16977','c651dafe165be1e595c5a818db492a78'),(236,NULL,152,'jpg','86499','50c0ac5229d36eaedbc6c010b8253d4d'),(238,NULL,154,'jpg','16524','3215f170bd410172ea4e243d2fb7829c'),(239,NULL,155,'jpg','69393','b94ff5dbeff0fefdaa5daa7db6305cc3'),(240,NULL,156,'jpg','74753','496fe42a29ccd6692fa9241c27409a38'),(241,NULL,157,'jpg','45598','7820e85c5da6a7a2516dd617ec6164a7'),(244,'some instr',160,'jpg','68153','19bdaaf52e1e5973d13c0adce295683c'),(245,NULL,161,'jpg','61124','cce186b9da91774eb95c764e0df4f95a'),(246,NULL,162,'jpg','56923','0a83be563de3e966090dd661b6988dd1'),(247,NULL,163,'jpg','58542','eb18bb01553524899278c2f98f9e5841'),(248,NULL,164,'jpg','21517','4230dd09c1a07ff03cf25f3a6603b4c8'),(249,NULL,165,'jpg','25679','b111398ed7f3fea61085febc22ea0948'),(252,NULL,167,'jpg','79141','9d0be0a7cb2971719e8f17fcdbcbdf84'),(253,NULL,168,'jpg','51497','d8faad700c09db97af15e4cf0c6e0484'),(254,NULL,169,'jpg','64756','d07ed86c813d4b42de410d5542f0c150'),(255,NULL,170,'jpg','94428','7765dd600d4c77d936bc39cbf902c2b8'),(256,NULL,171,'jpg','16572','b2700628fd0efcea8aedd20c1709e451'),(257,NULL,172,'jpg','31267','a8855290eeab4394e77bfdf344ba7a56'),(258,NULL,173,'jpg','71674','594cc730f9190294c6081d55732aff36'),(259,NULL,174,'jpg','75617','a84ae4fc5f89898ab53ba4f083d07881'),(260,NULL,175,'jpg','11315','b6a75d64c9012371a7aed8a0c72476d6'),(262,NULL,177,'jpg','43224','617308d8db979ed8d73494fbfe0962c3'),(263,NULL,178,'jpg','44933','87dc154bf1414d2b3f85b702f2e5f357'),(264,NULL,179,'jpg','15315','932d26a923340ecefa88d5bc1e497895'),(265,NULL,180,'jpg','88157','12718ebf2dbb9a4c1d2b400170618b8a'),(266,NULL,181,'jpg','51158','3a239cd7c8ec95306871460702bef612'),(267,NULL,182,'jpg','42115','3cc1883c9f5ba1c715b8bbe27a45fbda'),(268,NULL,183,'jpg','29345','5f9465bcf4692a2a2800cd46d0b37580'),(269,NULL,184,'jpg','93628','35625299b86d640c879e15fb785c8bdb'),(270,NULL,185,'jpg','34557','9c3b9932925ba790fc6faf38ce11c699'),(271,NULL,186,'jpg','96717','1cc96d2c13cb7422329085333aaa116b'),(272,NULL,187,'jpg','87668','840e84212ab513a4c47dc14f9076d5a0'),(273,NULL,188,'jpg','78444','bbf3ea1a670140f34330338078167c1e'),(274,NULL,189,'jpg','94395','f66ae56e8bda3d1ec89326ec61d26e45'),(275,NULL,190,'jpg','43289','281d531dce9cadc2e5a0c40377fcedf3'),(276,NULL,191,'jpg','58556','9aa12d78260ba8426f68473f4d6d2e3a'),(277,NULL,192,'jpg','66195','e8126cf19abba3dfb7937f110253981e'),(278,NULL,193,'jpg','24783','c8e2b281f17b12ef8ccc11e09ab221fb'),(279,NULL,194,'jpg','92176','145e6849cd73e4ed7216bcf10a41317e'),(281,NULL,196,'jpg','56381','c701589a0ae1758b3fa5749e6b5992cc'),(282,NULL,197,'jpg','64151','6009fe1eddaea323d52d74d286dce457'),(283,NULL,198,'jpg','72333','72b109018e989ec0a0349198c8339ae6'),(284,NULL,199,'jpg','96287','6883d6fb87710d913e144db56ae93034'),(285,NULL,200,'jpg','97569','2ccb8fad494f0c5f33f756b238f1ac78'),(286,NULL,201,'jpg','59159','c48e8d6e451618e978bc4fb9dbb54eca'),(287,NULL,202,'jpg','59887','0ef9314afe2aae6627d818738dbba708'),(288,NULL,203,'jpg','45439','846806ec8de9c5caaa186ce140589e51'),(289,NULL,204,'jpg','85813','fc34b3c1bca06d5503c08676a43232a7'),(290,NULL,205,'jpg','74456','a2a2f28cfc7788ab4af01ac08b206a59'),(291,NULL,206,'jpg','94727','3047313ab1c7397b3de568a42c412bae'),(292,NULL,207,'jpg','46783','ce69942527441180cf7edc863f5a6969'),(294,NULL,209,'jpg','24816','26670b72d830b0156421b1193dcf37de'),(300,NULL,213,'jpg','38952','88a82a0055d93b70ff52cca6ef58f318'),(301,NULL,214,'jpg','43547','797fc99afb20c37091e8dacfb0339e91');
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
INSERT INTO `project_key` VALUES (0,'unconfirmed'),(1,'confirmed'),(2,'cancelled'),(3,'completed');
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
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'Ankush Paul',NULL,'',1,'1395750115',2,0,NULL,'1398085841'),(2,'asd','722344','',1,'1397476078',3,0,827325,NULL),(3,'asd',NULL,'',0,'1397653045',2,0,NULL,NULL),(5,'asd',NULL,'',0,'1397653197',2,0,NULL,NULL),(6,'asd',NULL,'',0,'1397653260',2,0,NULL,NULL),(11,'asd',NULL,'',0,'1397712650',2,0,NULL,NULL),(14,'asd',NULL,'',0,'1397812795',2,0,NULL,NULL),(16,'asd',NULL,'',0,'1397813405',2,0,NULL,NULL),(20,'asd','624994','proj instr',1,'1397886683',2,1,453291,NULL),(21,'asd','784692','abc',1,'1397888777',2,1,453511,NULL),(23,'bad','525689','asdf',1,'1397889757',2,1,527746,NULL),(24,'asd',NULL,'',0,'1407325741',2,0,NULL,NULL),(26,'hbkbkbbk','326953','',1,'1407757280',5,0,241478,NULL),(27,'vikas',NULL,'need to develop it as glamorizes weeding photo',0,'1407778337',6,0,NULL,NULL),(30,'asd','466733','',0,'1407941757',2,0,256825,NULL),(31,'hbkbkbbk','387228','',1,'1408011704',5,0,199389,NULL),(32,'hbkbkbbk','139168','hilao aache se ispar',1,'1408027736',5,0,268263,NULL),(33,'asd','415566','',0,'1408187173',2,0,986589,NULL),(35,'abc','855622','',1,'1408274220',7,0,886699,NULL),(36,'DVDs','279273','',0,'1408275066',8,1,814686,NULL),(37,'Then','275183','',0,'1408275239',9,0,373731,NULL),(39,'I\'d','774845','Hello',0,'1408276124',10,0,744545,NULL),(40,'bhjk','649726','vhgchcjhvm jmgfjh,n ,hg,j',1,'1408277006',11,0,144663,NULL),(41,'asd','253162','',1,'1408283439',2,0,319154,NULL),(42,'bhfgrth','933269','jkjhkjhji',0,'1408459724',12,0,565296,NULL),(43,'test_avinash','293961','',0,'1408535027',7,0,716493,NULL),(44,'test_avinash','224243','',0,'1408535375',7,0,615253,NULL),(45,'test_avinash','775853','',0,'1408535609',7,0,595529,NULL),(47,'aaaa','674583','',0,'1408539326',13,0,133478,NULL),(48,'aaaa','839951','',0,'1408539488',13,0,858321,NULL),(49,'aaaa','348676','',0,'1408539573',13,0,481729,NULL),(51,'aaaa','776986','',0,'1408539828',13,0,714994,NULL),(52,'aaaa','684563','',0,'1408540180',13,0,474982,NULL),(53,'aaaa','899419','',0,'1408540260',13,0,556158,NULL),(54,'aaaa','799329','',0,'1408540436',13,0,726579,NULL),(55,'Hkbkkh','644636','Hila apache',0,'1408611224',15,1,593444,NULL),(56,'temp','475886','',1,'1408620593',7,0,858673,NULL),(57,'asd','636638','',0,'1408627779',2,0,799888,NULL),(58,'asd','933979','',0,'1408630056',2,0,979291,NULL),(61,'asd','712885','',0,'1408645763',2,0,825727,NULL),(62,'asd','595225','',0,'1408645911',2,0,368519,NULL),(63,'asd','947177','',0,'1408645976',2,0,577945,NULL),(64,'asd','233983','',0,'1408646099',2,0,959968,NULL),(68,'asd','622273','',0,'1408680198',2,0,285323,NULL),(69,'asd','116552','',0,'1408680467',2,0,416355,NULL),(70,'asd','689254','',0,'1408680631',2,0,811354,NULL),(71,'asd','486913','',0,'1408680937',2,0,247555,NULL),(73,'asd','869177','',0,'1408701633',2,0,166714,NULL),(74,'asd','922232','',0,'1408701803',2,0,998224,NULL),(75,'asd','991773','',0,'1408702100',2,0,743247,NULL),(76,'asd','348856','',0,'1408704071',2,0,427916,NULL),(77,'asd','128896','',0,'1408704426',2,0,921896,NULL),(78,'asd','132479','',0,'1408704934',2,0,733375,NULL),(79,'asd','738554','',0,'1408705423',2,0,833866,NULL),(80,'asd','473818','',0,'1408706217',2,0,998651,NULL),(81,'asd','169758','',0,'1408706433',2,0,615397,NULL),(82,'asd','478574','',0,'1408706620',2,0,732254,NULL),(84,'temp2','748741','',0,'1408706836',7,0,239861,NULL),(85,'test','993564','test test',0,'1408721602',18,0,927841,NULL),(87,'asd','493987','',0,'1408786205',2,0,596413,NULL),(88,'temp','647115','',1,'1408786446',7,0,736295,NULL),(89,'tempwewew','431979','',0,'1408786528',7,0,224491,NULL),(90,'asd','448968','',0,'1408786546',2,0,565971,NULL),(91,'aaaa','623963','',0,'1408786608',7,0,178665,NULL),(92,'asd','991859','',0,'1408804120',2,0,139332,NULL),(93,'asd','495724','',0,'1408804374',2,0,221417,NULL),(94,'asd','135329','',0,'1408805437',2,0,494546,NULL),(95,'asd','188889','',0,'1408805754',2,0,449228,NULL),(96,'asd','244326','',0,'1408812915',2,0,465935,NULL),(99,'asd','738213','',0,'1408813878',2,0,745446,NULL),(100,'asd','644223','',0,'1408814295',2,0,993568,NULL),(101,'asd','986239','',0,'1408814992',2,0,613484,NULL),(102,'asd','974141','',0,'1408815202',2,0,635125,NULL),(103,'asd','575167','',0,'1408815411',2,0,592745,NULL),(104,'asd','269974','',0,'1408815845',2,0,963541,NULL),(105,'asd','534792','',0,'1408815969',2,0,148526,NULL),(106,'asd','898297','',0,'1408816306',2,0,516198,NULL),(107,'asd','227235','',1,'1408962610',2,0,289323,NULL),(108,'asd','127941','',1,'1408972460',2,0,885442,NULL),(109,'asd','639968','',1,'1408973024',2,0,744122,NULL),(110,'asd','551179','',1,'1408973188',2,0,696487,NULL),(111,'asd','721389','',0,'1408973512',2,0,559997,NULL),(112,'asd','811374','',1,'1408973700',2,0,221941,NULL),(113,'hbkbkbbk','286166','',0,'1409051019',5,0,772274,NULL),(114,'hbkbkbbk','983255','',1,'1409056396',5,0,342533,NULL),(115,'hbkbkbbk','882363','',0,'1409058832',5,0,839358,NULL),(116,'aa','814739','aa',0,'1409064345',7,0,156671,NULL),(117,'ssss','854132','',0,'1409065937',7,0,773557,NULL),(118,'Avinash Singh','749199','',0,'1409066392',7,0,555598,NULL),(119,'aaaa','857391','',0,'1409066604',7,0,734834,NULL),(120,'aaaa','868782','',1,'1409066851',7,0,267196,NULL),(121,'hbkbkbbk','878595','',1,'1409072003',5,0,146549,NULL),(122,'hbkbkbbk','317728','',1,'1409072105',5,0,122283,NULL),(123,'hbkbkbbk','569665','',1,'1409073095',5,0,142263,NULL),(124,'hbkbkbbk','835254','',0,'1409074459',5,0,834425,NULL),(125,'hbkbkbbk','329368','',0,'1409074535',5,0,234142,NULL),(126,'hbkbkbbk','523865','',0,'1409074710',5,0,462723,NULL),(128,'hbkbkbbk','124522','',0,'1409074998',5,0,612132,NULL),(129,'hbkbkbbk','351613','',0,'1409075305',5,0,773986,NULL),(133,'Avinash Singh','357534','',0,'1409076285',7,0,549656,NULL),(135,'hbkbkbbk','385958','',0,'1409114928',5,1,417687,NULL),(136,'aaaa','588975','',0,'1409125192',7,0,594658,NULL),(137,'abcd','882335','hi :)',1,'1409136902',20,0,915457,NULL),(138,'hgjjj','576786','',0,'1409468979',21,0,291266,NULL),(141,'Swag master\'s project','831567','Do what you can.',1,'1410359899',22,0,488892,NULL),(142,'Blah','139558','blah',1,'1410712600',23,0,176476,NULL),(143,'pics','312734','hehe hahahaha',1,'1410919605',24,1,744175,NULL),(144,'hbkbkbbk','454483','',0,'1411200895',5,0,573172,NULL),(149,'Avinash2','479819','test',0,'1411962307',25,0,222925,NULL),(150,'aa','477751','aaaa',0,'1411962712',7,0,158471,NULL),(151,'a','169877','aaa',1,'1411963260',7,0,647227,NULL),(152,'asd','481444','',0,'1412067774',2,1,447358,NULL),(154,'asd','545284','',0,'1412068073',2,1,184565,NULL),(155,'asd','366212','',0,'1412068505',2,0,155918,NULL),(156,'asd','472763','',0,'1412068989',2,1,827539,NULL),(157,'asd','226968','some proj inst',0,'1412069673',2,1,649665,NULL),(160,'asd','769987','somethihng',1,'1412070702',2,1,675733,NULL),(161,'asd','836747','',0,'1412071953',2,0,664373,NULL),(162,'asd','496782','',0,'1412072013',2,0,413386,NULL),(163,'flsdkf','919784','',0,'1414591309',26,0,948634,NULL),(164,'Avinash','315172','',0,'1415369849',7,0,266621,NULL),(165,'aaaa','239882','',0,'1415378002',7,1,944232,NULL),(167,'asd','477777','',0,'1415380335',2,0,437981,NULL),(168,'asd','668238','',0,'1415380595',2,0,451877,NULL),(169,'asd','942121','',0,'1415380780',2,1,818381,NULL),(170,'asd','241828','',0,'1415381137',2,0,553765,NULL),(171,'asd','584715','',0,'1415381458',2,1,812795,NULL),(172,'asd','197635','',0,'1415381651',2,1,138453,NULL),(173,'asd','331592','',0,'1415381859',2,1,161871,NULL),(174,'asd','977954','',0,'1415382410',2,0,298337,NULL),(175,'asd','316445','',1,'1415382500',2,0,668468,NULL),(177,'asd','389816','',0,'1415429921',2,0,819178,NULL),(178,'asd','256531','',0,'1415429924',2,0,133217,NULL),(179,'asd','927913','',0,'1415430230',2,0,431511,NULL),(180,'asd','167814','',0,'1415430243',2,0,839589,NULL),(181,'asd','821573','',0,'1415430247',2,0,735669,NULL),(182,'Avinash','628327','',0,'1415454115',7,1,561315,NULL),(183,'Avinash','383642','',0,'1415455559',7,1,475835,NULL),(184,'Avinash Singh','833678','',0,'1415455725',7,1,694117,NULL),(185,'Avinash','314617','a',0,'1415456394',7,1,755153,NULL),(186,'Avinash Singh','931161','aa',0,'1415457055',7,1,517533,NULL),(187,'Test Name','157675','a',0,'1415457664',27,1,576885,NULL),(188,'Avinash Singh','379571','a',0,'1415457856',7,1,477278,NULL),(189,'Test Name','165749','a',0,'1415458669',27,1,427977,NULL),(190,'Test Name','541723','test',0,'1415459190',27,1,748553,NULL),(191,'Avinash Singh','414984','test',0,'1415459335',7,1,881631,NULL),(192,'Test Name','841686','a',0,'1415459564',27,1,939129,NULL),(193,'Avinash Singh','977564','',0,'1415459836',7,1,793757,NULL),(194,'Avinash Singh','742746','a',1,'1415460103',7,1,769523,NULL),(196,'asd','229768','',0,'1415615548',2,0,125234,NULL),(197,'asd','874326','',0,'1415615828',2,0,538277,NULL),(198,'asd','919194','',0,'1415616149',2,0,415631,NULL),(199,'asd','191947','',0,'1415616349',2,0,692262,NULL),(200,'asd','481954','',0,'1415616694',2,0,441817,NULL),(201,'asd','918789','',0,'1415617057',2,0,167141,NULL),(202,'asd','349472','',0,'1415617653',2,0,551184,NULL),(203,'asd','715479','',0,'1415617773',2,0,377439,NULL),(204,'asd','298332','',0,'1415618079',2,0,623353,NULL),(205,'asd','963387','',0,'1415618153',2,0,138625,NULL),(206,'asd','628953','',0,'1415618329',2,0,248152,NULL),(207,'asd','624359','',0,'1415618929',2,0,571381,NULL),(209,'test','125538','',1,'1415981357',28,0,966285,NULL),(213,'Project Domination','775256','Make it nice :)',1,'1416077205',22,1,552828,NULL),(214,'asd','529552','',1,'1416115945',2,0,275257,NULL);
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
INSERT INTO `work` VALUES (1,1,3,'1398075237','1410961023'),(1,56,0,'1408785395',NULL),(1,194,0,'1415783802',NULL);
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

-- Dump completed on 2014-11-21 23:50:47
