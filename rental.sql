CREATE DATABASE  IF NOT EXISTS `rental` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `rental`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: rental
-- ------------------------------------------------------
-- Server version	5.7.21

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `fName` varchar(45) NOT NULL,
  `lName` varchar(45) NOT NULL,
  `contactNum` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `typeAccount` enum('sp','admin','customer') NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES ('1','1','1','1','1','1','admin','1'),('1234','asdf','Tangalin','asdfsadfasdf','asdf','kimlopez1999@gmail.com','sp','Lot 7, Block 7, Phase 1, Eagle Crest, Bakakeng'),('12345','asdf','sdSF','SDFSAF','ASDFSDAF','ASDFSADF','sp','ASDFSA'),('2','1','1','1','1','1','sp','1'),('3','1','1','1','1','1','customer','1'),('45654654','asdf','Tangalin','asdf','asdf','kimlopez1999@gmail.com','sp','Lot 7, Block 7, Phase 1, Eagle Crest, Bakakeng'),('5','asdf','5','5','5','5','sp','5'),('dfdasfsdf','asdfsadf','Tangalin','asdf','asdf','kimlopez1999@gmail.com','sp','Lot 7, Block 7, Phase 1, Eagle Crest, Bakakeng'),('erasergdsrg','sadfdsaf','asfdsaf','sadfsda','asdfsdf','asdfsdf','customer','sadfsdaf'),('ersafsdfa','sdfadsf','asdfadsf','asdfsdaf','ASDFSDAF','asfdsa','sp','asdfsdaf'),('lope','asfadf','asdfsad','asdfasd','asdfsadf','asdfasdf','sp','asdfsadf'),('lozerauxlopez34324','asdf','Tangalin','asdf','asdf','kimlopez1999@gmail.com','sp','Lot 7, Block 7, Phase 1, Eagle Crest, Bakakeng'),('rtdrtsdfadsf','asdfas','asdfsad','asdfsadf','asdfsadf','asdfdf','sp','asdfsdaf');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `adminID` varchar(45) NOT NULL,
  PRIMARY KEY (`adminID`),
  UNIQUE KEY `adminID_UNIQUE` (`adminID`),
  CONSTRAINT `asdfgfagqe` FOREIGN KEY (`adminID`) REFERENCES `account` (`username`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('1');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `customerID` varchar(45) NOT NULL,
  `status` enum('pending','accepted','blocked') NOT NULL,
  PRIMARY KEY (`customerID`),
  UNIQUE KEY `customerID_UNIQUE` (`customerID`),
  CONSTRAINT `dfdf` FOREIGN KEY (`customerID`) REFERENCES `account` (`username`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES ('3','pending'),('erasergdsrg','pending');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_service`
--

DROP TABLE IF EXISTS `customer_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_service` (
  `serviceID` int(20) NOT NULL AUTO_INCREMENT,
  `customerID` varchar(45) NOT NULL,
  `requested` datetime NOT NULL,
  `dispatch` datetime DEFAULT NULL,
  `returned` datetime DEFAULT NULL,
  `noOfDays` int(10) NOT NULL,
  `status` enum('pending','success') NOT NULL,
  PRIMARY KEY (`serviceID`,`customerID`),
  UNIQUE KEY `customerID_UNIQUE` (`customerID`),
  UNIQUE KEY `serviceID_UNIQUE` (`serviceID`),
  CONSTRAINT `jkshkjdashf` FOREIGN KEY (`serviceID`) REFERENCES `service` (`serviceID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `qwesxc` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_service`
--

LOCK TABLES `customer_service` WRITE;
/*!40000 ALTER TABLE `customer_service` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `paymentID` int(10) NOT NULL AUTO_INCREMENT,
  `advance` decimal(20,0) NOT NULL DEFAULT '0',
  `balance` decimal(20,0) NOT NULL DEFAULT '0',
  `totalAmount` decimal(20,0) NOT NULL DEFAULT '0',
  `advanceDate` datetime DEFAULT NULL,
  `fullPaymentDate` datetime DEFAULT NULL,
  `billStatus` enum('paid','pending') NOT NULL,
  `serviceID` int(10) NOT NULL,
  `customerID` varchar(45) NOT NULL,
  PRIMARY KEY (`paymentID`),
  UNIQUE KEY `paymentID_UNIQUE` (`paymentID`),
  KEY `adsfga_idx` (`serviceID`,`customerID`),
  CONSTRAINT `adsfga` FOREIGN KEY (`serviceID`, `customerID`) REFERENCES `customer_service` (`serviceID`, `customerID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report` (
  `reportID` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL,
  `customerID` varchar(45) NOT NULL,
  `spID` varchar(45) NOT NULL,
  PRIMARY KEY (`reportID`),
  UNIQUE KEY `reportID_UNIQUE` (`reportID`),
  KEY `iiewr9_idx` (`customerID`),
  KEY `adsf23r_idx` (`spID`),
  CONSTRAINT `adsf23r` FOREIGN KEY (`spID`) REFERENCES `sp` (`spID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `iiewr9` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service` (
  `serviceID` int(20) NOT NULL AUTO_INCREMENT,
  `serviceName` varchar(45) NOT NULL,
  `price` decimal(20,0) NOT NULL,
  `image` blob NOT NULL,
  `description` varchar(45) NOT NULL,
  `category` enum('attire','costume') NOT NULL,
  `spID` varchar(45) NOT NULL,
  `gender` varchar(45) NOT NULL,
  `age` enum('children','teen','adult','senior') NOT NULL,
  `occasion` varchar(45) NOT NULL,
  PRIMARY KEY (`serviceID`),
  UNIQUE KEY `serviceID_UNIQUE` (`serviceID`),
  KEY `erueiojf_idx` (`spID`),
  CONSTRAINT `dflksjlf` FOREIGN KEY (`spID`) REFERENCES `sp` (`spID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp`
--

DROP TABLE IF EXISTS `sp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp` (
  `spID` varchar(45) NOT NULL,
  `contractBill` decimal(20,0) DEFAULT '0',
  `status` enum('pending','accepted','blocked') NOT NULL,
  PRIMARY KEY (`spID`),
  UNIQUE KEY `spID_UNIQUE` (`spID`),
  CONSTRAINT `kjjgkhk` FOREIGN KEY (`spID`) REFERENCES `account` (`username`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp`
--

LOCK TABLES `sp` WRITE;
/*!40000 ALTER TABLE `sp` DISABLE KEYS */;
INSERT INTO `sp` VALUES ('1234',0,'pending'),('12345',0,'pending'),('2',0,'pending'),('45654654',0,'pending'),('5',0,'pending'),('dfdasfsdf',0,'pending'),('ersafsdfa',0,'pending'),('lope',0,'pending'),('lozerauxlopez34324',0,'pending'),('rtdrtsdfadsf',0,'pending');
/*!40000 ALTER TABLE `sp` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-01 11:18:19
