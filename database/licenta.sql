-- MariaDB dump 10.17  Distrib 10.5.5-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: paperdeg
-- ------------------------------------------------------
-- Server version	10.5.5-MariaDB

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
-- Table structure for table `papers`
--

DROP TABLE IF EXISTS `papers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `papers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT 'the user who added the paper',
  `volume` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publication` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT 'lucrare',
  `uploaded_at` date NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'titlu',
  `authors` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ion simeria, tudor balac',
  `publisher` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'editura',
  `pages` int(5) NOT NULL DEFAULT 0,
  `website` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'https://scholar.google.com/',
  `country` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'romania',
  PRIMARY KEY (`id`),
  KEY `fk_paper_user` (`user_id`),
  CONSTRAINT `fk_paper_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `papers`
--

LOCK TABLES `papers` WRITE;
/*!40000 ALTER TABLE `papers` DISABLE KEYS */;
INSERT INTO `papers` VALUES (3,13,'Literatura','modernism.pdf','carte','2020-08-18','titlu','ion simeria, tudor balac','editura',0,'https://scholar.google.com/','romania'),(4,13,'Electrica','legi.pdf','articol','2020-08-18','titlu','ion simeria, tudor balac','editura',0,'https://scholar.google.com/','romania'),(5,13,'Mecanica cuantica','scaraatomica.pdf','articol','2020-08-18','titlu','ion simeria, tudor balac','editura',0,'https://scholar.google.com/','romania'),(6,13,'Algebra ','ecuatiisisisteme.pdf','articol','2020-08-18','titlu','ion simeria, tudor balac','editura',0,'https://scholar.google.com/','romania'),(7,13,'Literatura','tineretealuieminescu.pdf','articol','2020-08-18','titlu','ion simeria, tudor balac','editura',0,'https://scholar.google.com/','romania'),(8,14,'Mecanica necuantica','legealuinewton.pdfx','articol','2020-09-22','titluanabana','ion simeria','editura123',0,'https://scholar.google.com/','anglia'),(10,13,'Circuite','masurarevalori.pdf','articol','2020-08-18','titlu','ion simeria, tudor balac','editura',0,'https://scholar.google.com/','romania'),(11,11,'Gramatica','verbepredicative.pdf','carte','2020-08-18','titlu','ion simeria, tudor balac','editura',0,'https://scholar.google.com/','romania'),(19,11,'Programare','claseinjava.pdf','articol','2018-08-18','titlu','ion simeria, tudor balac','editura',0,'https://scholar.google.com/','romania'),(21,11,'calculatoare','managementulresurselor.pdf','articol','2020-08-18','titlu','ion simeria, tudor balac','editura',0,'https://scholar.google.com/','romania'),(23,14,'Fizica moleculelor9019','particule.pdf99','articol','2010-08-19','titlu99','ion simeria, tudor balac, sofronie vali, larisa bageac','editura',901,'https://scholar.google.com/','romania'),(25,14,'Fizica msoleculelor','atomulparticulelor9.pdf','articol','2020-09-01','titlu','ion simeria, tudor balac','editura99',0,'https://scholar.google.com/','romania'),(34,14,'Fizica','frecari.pdf','articol','2018-08-07','titlu23','ion simeria, tudor','editura',0,'https://scholar.google.com/','romania'),(37,11,'Programare','clasenoi.pdf','carte','2019-08-21','titlu','ion simeria, tudor balac','editura',0,'https://scholar.google.com/','romania'),(39,20,'Pescarie','lasun.pdf','articol','2020-08-22','titlu','ion simeria, tudor balac','editura',0,'https://scholar.google.com/','romania'),(40,18,'Lichide','vascozitate.pdf','articol','2020-08-22','titlu','ion simeria, tudor balac','editura',0,'https://scholar.google.com/','romania'),(41,18,'nou','albaneagra','carte','2020-08-22','titlu','ion simeria, tudor balac','editura',0,'https://scholar.google.com/','romania'),(43,18,'bbbb','yyyasd','articol','2020-08-22','titlu','ion simeria, tudor balac','editura',0,'https://scholar.google.com/','romania'),(44,18,'asdfsneadfd','asdfsfsf','articol','2020-08-22','titlu','ion simeria, tudor balac','editura',0,'https://scholar.google.com/','romania'),(45,18,'3','casa vrajitoarei','articol','2020-08-26','Semne','marcu tiberiu','editura corinz',184,'www.google.com','germania'),(46,14,'III','Adevarul vietuitoarelor','articol','2020-06-08','Viperele in Delta','Ion Simache','Balot',89,'www.google.ro','romania'),(47,14,'IV','Pescuitul sportiv','articol','2020-03-01','Bocancii de pescuit in secolul 19 si rigiditatea','Balas Tania','Mal si prada',15,'http://www.google.ro','Albania'),(49,14,'III','Gradinarit','carte','2020-09-30','Morcovii deliciosi','Tania Rupa','Rasaduri',12,'http://www.google.com','romania'),(51,14,'sdf','fsdfsf','articol','2020-09-22','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','fsdfsf','fsdf',1,'s','f');
/*!40000 ALTER TABLE `papers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resetPasswords`
--

DROP TABLE IF EXISTS `resetPasswords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resetPasswords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resetPasswords`
--

LOCK TABLES `resetPasswords` WRITE;
/*!40000 ALTER TABLE `resetPasswords` DISABLE KEYS */;
INSERT INTO `resetPasswords` VALUES (5,'82342','pffasfs@mail.com'),(6,'15f310c23a1667','florea.user@gmail.com'),(7,'15f310d8065d05','tanarmelancolic@gmail.com'),(8,'15f310ebb8b917','tanarmelancolic@gmail.com'),(9,'15f310ec925fca','tanarmelancolic@gmail.com'),(10,'15f310ff4b2041','tanarmelancolic@gmail.com'),(11,'15f3115348d41e','tanarmelancolic@gmail.com'),(14,'15f3123f38fae1','tanarmelancolic@gmail.com'),(17,'15f35418a8df84','floreauser@gmail.com'),(18,'15f3541f5af889','floreauser@gmailcom'),(19,'15f354208d6c73','floreausergmailcom');
/*!40000 ALTER TABLE `resetPasswords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` int(2) DEFAULT NULL COMMENT 'where the user teaches',
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (6,'Administrator','Administrator','administrator@sistemexpert.ro','$2y$12$vC32CvjWOoYVCQnsmx5uT.vHdu/ElW.sPOZqmgbTj8.gv8CGrg4xq','admin',NULL,'2020-08-18 09:47:06'),(7,'Maria','Tantu','tantumaria@yahoo.com','$2y$10$Ar3oQn1CK79IcwKytc4IhOiO4AscZALyqkiykirtQVCTuUGdX0Tsm',NULL,NULL,'2020-08-18 09:47:06'),(8,'a','G','agggggg@mail.com','$2y$10$e1R80qpnVg8Dy60C9z0lA.NDRudkOPu1F2K3oFnpA943AGrdidVXy',NULL,NULL,'2020-08-18 09:47:06'),(9,'a','G','agggggg@mail.com','$2y$10$e1R80qpnVg8Dy60C9z0lA.NDRudkOPu1F2K3oFnpA943AGrdidVXy',NULL,NULL,'2020-08-18 09:47:06'),(10,'i','i','iiiiiii@m.com','$2y$10$QgSCv6XYoKj..bqZOy9PjeSO4zkZwMv2P8fe3MSMGBXzahEGVip1O',NULL,NULL,'2020-08-18 09:47:06'),(11,'Laura','Tancu','tanculaura@mail.co','$2y$10$.eZFFIf/BLxy8SQb7G/EFuzwLkcVYB.aHclSwRVlBKIi2dsK0vUf6','director',2,'2020-08-18 09:47:06'),(12,'Stefan','Florea','tanarmelancolic@gmail.com','$2y$10$ArezIsi/z7Q3bPCrTle1ZuQB49CuvllZkivJD0dJSlDyKpP8A9t3e',NULL,NULL,'2020-08-18 09:47:06'),(13,'Giulia','Rucan','florea.user@gmail.com','$2y$10$0gCDyLpccZvKx1MnrBGiCuy.qDZ4Jg7EbzOPu0H9WRrueYAEWnaL2','director',1,'2020-08-18 09:47:06'),(14,'Stefania','Geolgau','geolgaustefania@yahoo.com','$2y$10$uTZI.MWCeKIPxGN0M2/5QO/nBLWl0ClbnWSfoFfiqgSl4MOlcqoUG','prof',2,'2020-08-18 09:47:06'),(18,'Iulia','Giulcan','giulcaniulia@yahoo.com','$2y$10$BeUFpss3vOY4HdjSgAlIKem1o2IRQE22xtKok2hcqt.NBy4UrWVka','prof',1,'2020-08-18 10:04:29'),(20,'Carina','Muci','mucicarina@yahoo.com','$2y$10$CsAW2/T1qw6/bajTUOnVwuK5MWI8fxRgTLaq7FULiHFBrv7ovFeu6','prof',1,'2020-08-21 21:24:02');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'paperdeg'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-28 16:38:18
