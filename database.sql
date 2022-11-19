-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: SGSSI
-- ------------------------------------------------------
-- Server version	10.4.22-MariaDB

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
-- Table structure for table `carros`
--

DROP TABLE IF EXISTS `carros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carros` (
  `Modelo` varchar(30) NOT NULL,
  `Victorias` int(11) DEFAULT NULL,
  `Pole_positions` int(11) DEFAULT NULL,
  `Primer_piloto` varchar(25) DEFAULT NULL,
  `Anno` int(11) DEFAULT NULL,
  `foto` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`Modelo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carros`
--

LOCK TABLES `carros` WRITE;
/*!40000 ALTER TABLE `carros` DISABLE KEYS */;
INSERT INTO `carros` VALUES ('Ferrari F2004',15,12,'Michael Schumacher',2004, 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/Ferrari_f2004.jpg/2560px-Ferrari_f2004.jpg'),('HRT F112',0,0,'Pedro Martinez De La Rosa',2012, 'https://upload.wikimedia.org/wikipedia/commons/0/08/Narain_Karthikeyan_2012_Malaysia_Qualify.jpg'),('McLaren MP4/22',8,8,'Fernando Alonso',2007, 'https://upload.wikimedia.org/wikipedia/commons/1/1d/Fernando_Alonso_2007_2.jpg'),('Mercedes-AMG W11 EQPerformance',12,15,'Lewis Hamilton',2020, 'https://upload.wikimedia.org/wikipedia/commons/3/31/Lewis_Hamilton_2020_Tuscan_Grand_Prix_-_race_day_%28cropped%29.jpg'),('RedBull RB16B',13,11,'Max  Verstappen',2021, 'https://upload.wikimedia.org/wikipedia/commons/f/fa/FIA_F1_Austria_2021_Nr._33_Verstappen_%28side%29.jpg'),('RedBull RB9',13,11,'Sebastian Vettel',2013, 'https://upload.wikimedia.org/wikipedia/commons/0/02/Sebastian_Vettel_2013_Malaysia_FP1.jpg'),('Renault R25',8,7,'Fernando Alonso',2005, 'https://upload.wikimedia.org/wikipedia/commons/b/be/Alonso_%28Renault%29_qualifying_at_USGP_2005.jpg'),('Renault R26',8,7,'Fernando Alonso',2006, 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Fernando_Alonso_2006_Canada.jpg');
/*!40000 ALTER TABLE `carros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `nombreAp` varchar(35) DEFAULT NULL,
  `DNI` varchar(9) DEFAULT NULL,
  `telf` int(11) DEFAULT NULL,
  `fechaN` date DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `pass` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES ('amdmin',NULL,NULL,NULL,'','admin');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-29 10:53:48
