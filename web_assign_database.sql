-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: web_assign
-- ------------------------------------------------------
-- Server version	8.0.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `account` (
  `accountID` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `createDAY` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`accountID`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (1,'linh','$2y$10$ZFVlnYtvTrg73h68uE/uJuZk3r1nIT5w0xf1VyjjSGDncFLGMbODe','linh@gmail.com','2021-11-16 21:36:56','student'),(2,'quang','$2y$10$STDAwF0d09g/K2hci/SDFujE1/qrbJtNrsPlRiJuxTHTitM7wSLn6','quang@gmail.com','2021-11-16 22:41:03','teacher'),(5,'tien','$2y$10$BS658Cur2OhmywXbzb.RKulnQBqpNy3vjNo2UgH/lKvUlBNrtwXqW','tien@gmail.com','2021-11-20 20:59:00','teacher'),(6,'minh','$2y$10$zRZBXGZyiiFg8z1Psa0Ks.RmNFPoqlqBUH5dQHPQu4tV66oDMrM.q','minh@gmail.com','2021-11-21 16:20:37','teacher'),(7,'hang','$2y$10$/aSlHmQjebpCnnv5LTFFbuKsVq46u1jZXufTWkbbhfR5m7S56AUQO','hang@gmail.com','2021-11-21 16:28:31','student'),(8,'tu','$2y$10$Xpen9tS6pVnjQkkOPLPJ5.eKaT.MOn2oaqVE6eOgYh9hmpiHsSm7G','tu@gmail.com','2021-11-21 20:29:20','teacher'),(9,'binh','$2y$10$D4vENW9izx9J361ChiBQwePsX4w/o66J22chRCM3U625ilC24Ccx.','binh@gmail.com','2021-11-21 21:27:26','student'),(10,'nguyenlelanvy','$2y$10$cKMdepsH/UEpYgRr7RZQ8Ozah42vQ1w6jvgWcODJgs2mJSMoDaR6q','s``````ad@ffg.co','2021-12-02 11:23:56','teacher');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `adminID` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`adminID`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `adminID_UNIQUE` (`adminID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'admin','$2y$10$eTP6h114AdFAn8L026wlj.nzvMkVt7UBzy.nw5ELMAfisBPcVpxcS'),(2,'haku','$2y$10$FCYZVOzuAiX4rlOkEQZeN.Zj43OSUv8gmql.W4HLaLRun4IEXvL.O'),(3,'phuc','$2y$10$Vi.hL1Ofcwn.B2TD9S4kfemLvTmIovYpyOhr6ogdtJNEtCrXvMs5q');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam`
--

DROP TABLE IF EXISTS `exam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exam` (
  `examID` int unsigned NOT NULL AUTO_INCREMENT,
  `teacherID` int unsigned NOT NULL,
  `exName` varchar(255) NOT NULL,
  `createDay` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic` varchar(255) NOT NULL,
  `diff_level` varchar(255) NOT NULL,
  `duration` int unsigned DEFAULT NULL,
  PRIMARY KEY (`examID`),
  UNIQUE KEY `exName_UNIQUE` (`exName`),
  KEY `teacherid_idx` (`teacherID`),
  CONSTRAINT `teacherid` FOREIGN KEY (`teacherID`) REFERENCES `account` (`accountID`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam`
--

LOCK TABLES `exam` WRITE;
/*!40000 ALTER TABLE `exam` DISABLE KEYS */;
INSERT INTO `exam` VALUES (1,2,'Math Test 1','2021-11-17 20:18:53','Math','A1',1),(2,2,'C1 Vocab Test 1','2021-11-17 20:46:49','English','C1',10),(3,2,'C1 Vocab Test 2','2021-11-17 20:58:04','English','C1',10),(4,2,'C1 Vocab Test 3','2021-11-17 21:10:18','English','C1',10);
/*!40000 ALTER TABLE `exam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_content`
--

DROP TABLE IF EXISTS `exam_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exam_content` (
  `exID` int unsigned NOT NULL,
  `questionID` int unsigned NOT NULL,
  PRIMARY KEY (`questionID`,`exID`),
  KEY `questionid_idx` (`questionID`),
  KEY `exid_idx` (`exID`),
  CONSTRAINT `exid` FOREIGN KEY (`exID`) REFERENCES `exam` (`examID`),
  CONSTRAINT `quesid` FOREIGN KEY (`questionID`) REFERENCES `question` (`questID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_content`
--

LOCK TABLES `exam_content` WRITE;
/*!40000 ALTER TABLE `exam_content` DISABLE KEYS */;
INSERT INTO `exam_content` VALUES (1,1),(1,2),(1,3),(1,4),(2,5),(2,6),(2,7),(2,8),(2,9),(2,10),(2,11),(2,12),(2,13),(3,13),(2,14),(3,14),(3,15),(3,16),(3,17),(3,18),(3,19),(3,20),(3,21),(4,21),(3,22),(4,22),(4,23),(4,24),(4,25),(4,26),(4,27),(4,28),(4,29),(4,30);
/*!40000 ALTER TABLE `exam_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examination`
--

DROP TABLE IF EXISTS `examination`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `examination` (
  `takeExID` int unsigned NOT NULL AUTO_INCREMENT,
  `studentID` int unsigned NOT NULL,
  `testID` int unsigned NOT NULL,
  `testDay` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `result` double NOT NULL,
  `spendTime` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`takeExID`,`studentID`,`testID`),
  KEY `examid_idx` (`testID`),
  KEY `studID_idx` (`studentID`),
  CONSTRAINT `examid` FOREIGN KEY (`testID`) REFERENCES `exam` (`examID`),
  CONSTRAINT `studID` FOREIGN KEY (`studentID`) REFERENCES `account` (`accountID`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examination`
--

LOCK TABLES `examination` WRITE;
/*!40000 ALTER TABLE `examination` DISABLE KEYS */;
INSERT INTO `examination` VALUES (81,1,1,'2021-12-03 13:20:47',10,'0 min 9 sec'),(82,1,2,'2021-12-03 14:22:37',3,'0 min 9 sec'),(83,1,1,'2021-12-03 14:23:10',0,'0 min 9 sec'),(84,1,1,'2021-12-03 14:23:51',0,'0'),(85,1,1,'2021-12-03 14:23:56',10,'0 min 9 sec'),(86,1,1,'2021-12-03 14:32:38',0,'0'),(87,1,1,'2021-12-03 14:32:49',0,'0 min 9 sec'),(88,1,1,'2021-12-03 14:33:35',8,'0 min 9 sec'),(89,1,1,'2021-12-03 14:44:56',8,'0 min 9 sec'),(90,1,1,'2021-12-03 14:48:53',5,'0 min 9 sec'),(91,1,1,'2021-12-03 14:51:07',3,'0 min 9 sec'),(92,1,1,'2021-12-03 14:52:40',0,'0'),(93,1,1,'2021-12-03 14:55:17',8,'0 min 5 sec'),(94,1,1,'2021-12-03 14:57:11',5,'0 min 13 sec'),(95,1,2,'2021-12-03 14:59:42',4,'0 min 46 sec'),(96,1,3,'2021-12-03 15:01:06',1,'0 min 46 sec'),(97,1,3,'2021-12-03 15:01:52',0,'0 min 46 sec'),(98,1,4,'2021-12-03 15:02:15',1,'0 min 4 sec'),(99,1,2,'2021-12-03 15:03:34',3,'0 min 11 sec'),(100,1,1,'2021-12-03 15:13:36',3,'1 min 0 sec');
/*!40000 ALTER TABLE `examination` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exhistory`
--

DROP TABLE IF EXISTS `exhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exhistory` (
  `takenExID` int unsigned NOT NULL,
  `testExamID` int unsigned NOT NULL,
  `testQuestID` int unsigned NOT NULL,
  `studentAns` varchar(255) NOT NULL,
  PRIMARY KEY (`takenExID`,`testExamID`,`testQuestID`),
  KEY `testexamID_idx` (`testExamID`),
  KEY `questionID_idx` (`testQuestID`),
  CONSTRAINT `questionID` FOREIGN KEY (`testQuestID`) REFERENCES `question` (`questID`),
  CONSTRAINT `takenexamID` FOREIGN KEY (`takenExID`) REFERENCES `examination` (`takeExID`),
  CONSTRAINT `testexamID` FOREIGN KEY (`testExamID`) REFERENCES `exam` (`examID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exhistory`
--

LOCK TABLES `exhistory` WRITE;
/*!40000 ALTER TABLE `exhistory` DISABLE KEYS */;
INSERT INTO `exhistory` VALUES (81,1,1,'2'),(81,1,2,'3'),(81,1,3,'4'),(81,1,4,'1'),(82,2,5,'4'),(82,2,6,'in the West'),(82,2,7,'firmly'),(82,2,8,'involved'),(82,2,9,'flexible'),(82,2,10,'fine'),(82,2,11,'botanical'),(82,2,12,'national'),(82,2,13,'strike'),(82,2,14,'work'),(83,1,1,'none'),(83,1,2,'none'),(83,1,3,'none'),(83,1,4,'2'),(85,1,1,'2'),(85,1,2,'3'),(85,1,3,'4'),(85,1,4,'1'),(87,1,1,'1'),(87,1,2,'4'),(87,1,3,'2'),(87,1,4,'2'),(88,1,1,'2'),(88,1,2,'3'),(88,1,3,'4'),(88,1,4,'none'),(89,1,1,'2'),(89,1,2,'3'),(89,1,3,'4'),(89,1,4,'2'),(90,1,1,'2'),(90,1,2,'2'),(90,1,3,'4'),(90,1,4,'2'),(91,1,1,'2'),(91,1,2,'4'),(91,1,3,'1'),(91,1,4,'2'),(93,1,1,'2'),(93,1,2,'1'),(93,1,3,'4'),(93,1,4,'1'),(94,1,1,'2'),(94,1,2,'3'),(94,1,3,'2'),(94,1,4,'none'),(95,2,5,'4'),(95,2,6,'in the East'),(95,2,7,'firmly'),(95,2,8,'concerned'),(95,2,9,'main'),(95,2,10,'price'),(95,2,11,'natural'),(95,2,12,'neighbour'),(95,2,13,'occur'),(95,2,14,'duty'),(96,3,13,'occur'),(96,3,14,'work'),(96,3,15,'manner'),(96,3,16,'up'),(96,3,17,'ample'),(96,3,18,'flawed'),(96,3,19,'insist'),(96,3,20,'contrasting'),(96,3,21,'debutants'),(96,3,22,'situation'),(97,3,13,'hit'),(97,3,14,'none'),(97,3,15,'none'),(97,3,16,'none'),(97,3,17,'none'),(97,3,18,'none'),(97,3,19,'none'),(97,3,20,'none'),(97,3,21,'none'),(97,3,22,'none'),(98,4,21,'revolutionaries'),(98,4,22,'none'),(98,4,23,'none'),(98,4,24,'none'),(98,4,25,'none'),(98,4,26,'none'),(98,4,27,'summoned'),(98,4,28,'none'),(98,4,29,'none'),(98,4,30,'expectation'),(99,2,5,'2'),(99,2,6,'in the North'),(99,2,7,'smartly'),(99,2,8,'concerned'),(99,2,9,'lively'),(99,2,10,'price'),(99,2,11,'biological'),(99,2,12,'none'),(99,2,13,'none'),(99,2,14,'none'),(100,1,1,'2'),(100,1,2,'none'),(100,1,3,'none'),(100,1,4,'none');
/*!40000 ALTER TABLE `exhistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question` (
  `questID` int unsigned NOT NULL AUTO_INCREMENT,
  `question` longtext NOT NULL,
  `answerA` varchar(255) NOT NULL,
  `answerB` varchar(255) NOT NULL,
  `answerC` varchar(255) NOT NULL,
  `answerD` varchar(255) NOT NULL,
  `correctAns` varchar(255) NOT NULL,
  PRIMARY KEY (`questID`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (1,'1+1 equal ?','1','2','3','4','2'),(2,'2 +1 equal','1','2','3','4','3'),(3,'3+1 equal','1','2','3','4','4'),(4,'2-1 equal','1','2','3','4','1'),(5,'The dog has ____ legs','2','4','8','All answer is incorrect','4'),(6,'The sun rises ______','in the East','in the West','in the North','in the South','in the East'),(7,'Lance is ________ knowledgeable on this subject','smartly','powerfully','firmly','highly','highly'),(8,' I need a good explanation of all the costs ________ in buying a new car.','affected','involved','concerned','implied','involved'),(9,'There was a ________ debate about the Middle East, then they moved to a vote.','lively','flexible','main','nimble','lively'),(10,'The doctor told him to lose weight quickly or pay the ________ later in life.','fee','fine','price','cost','price'),(11,'Jet lag causes problems with our ________ clock.','biological','botanical','natural','rhythmical','biological'),(12,'This species of seagull is not a ________ of the island, but will sometimes rest here a while.','neighbour','national','citizen','resident','resident'),(13,'Doesn\'t it ________ you as strange that it\'s the middle of May and it\'s snowing?','hit','occur','strike','touch','strike'),(14,'I didn\'t stay behind because I wanted to, I did so because it was my','work','duty','shift','chore','duty'),(15,'What angered me wasn\'t his resignation but the ________ in which he did it.','method','manner','aspect','bearing','manner'),(16,'If you can\'t make ________ what\'s written, change the zoom level and it\'ll become clearer.','for','off','up','out','out'),(17,'There\'s a ________ range of issues that we need to discuss as soon as possible.','far','ample','wide','high','wide'),(18,'Despite being ________ in the battle, the solider fought on and was awarded a medal for bravery.','enraged','wounded','flawed','bruised','wounded'),(19,'The rain will ________ for most of the morning, but we are expecting a brighter afternoon.','persist','insist','resist','consist','persist'),(20,'In the mating season, the male of the species calls out with a ________ gu-gu sound.','separate','distinctive','contrasting','individual','distinctive'),(21,'Marie Curie, one of the best-known ________ in working with radiation, died in 1934.','debutants','revolutionaries','pioneers','rebels','pioneers'),(22,'Deep sea oil exploration is a dirty and dangerous','affair','situation','case','business','business'),(23,'Much of the neighbourhood was demolished in the 1940s when living ________ had deteriorated.','situations','conditions','circumstances','states','conditions'),(24,'Scientists are yet to understand the full nutritional ________ of the humble olive.','favours','helps','goods','benefits','benefits'),(25,'You can come and ________ us performing this operation, if you want.','discover','gaze','observe','look','observe'),(26,'Bears used to be very ________ in this part of the country, but nobody has seen one for ten years.','sparse','broad','thorough','widespread','widespread'),(27,'Ben was ________ to the court for jury duty, but took a doctor\'s note with him and was excused.','pulled','assembled','summoned','requested','summoned'),(28,'The police ________ four states in pursuit of the bank robber.','crossed','journeyed','chased','travelled','crossed'),(29,'After three years of ________, the country\'s economy is finally looking a lot healthier.','letdown','demise','overdraft','recession','recession'),(30,'We altered our final ________ of yearly profits due to more accurate advertising and marketing costs.','forecast','expectancy','expectation','wishes','forecast'),(35,'1 +1 = ?','2','3','5','6','2'),(36,'3 +2 = ?','5','4','3','2','5'),(38,'1 + 9 = ?','2','3','10','6','10'),(40,'How many people in this class ?','11','45','32','22','45'),(45,'aeqw','adsasd','qweqwe','wqeqwe','1231234','wqeqwe'),(46,'12312312354','324234','12e','ddsaf','qwerqwe','qwerqwe'),(48,'2+3 =','1','2','3','5','5'),(49,'3 -1 =','1','2','3','4','2'),(50,'deadline is','end','1','2','3','end'),(51,'123123123123','34223423','234234','qweqwe','q','234234'),(55,'aaaaaa','22','3','32','2','32'),(56,'4+5 =','1','3','9','6','9'),(57,'1 + 4 =','1','2','3','5','5'),(58,'1 + 6 =','1','4','7','13','7'),(59,'qweqwe3123','23213','145','234234','123123','234234');
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'web_assign'
--

--
-- Dumping routines for database 'web_assign'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-03 17:10:27
