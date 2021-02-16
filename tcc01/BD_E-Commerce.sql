-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: bd_ecommerce
-- ------------------------------------------------------
-- Server version	8.0.22

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
-- Table structure for table `tb_admin`
--

DROP TABLE IF EXISTS `tb_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_admin` (
  `tb_admin_id` int NOT NULL AUTO_INCREMENT,
  `tb_admin_nome` varchar(255) NOT NULL,
  `tb_admin_senha` varchar(255) NOT NULL,
  PRIMARY KEY (`tb_admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_admin`
--

LOCK TABLES `tb_admin` WRITE;
/*!40000 ALTER TABLE `tb_admin` DISABLE KEYS */;
INSERT INTO `tb_admin` VALUES (1,'teste','teste'),(2,'admin 2','teste');
/*!40000 ALTER TABLE `tb_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_carrinho`
--

DROP TABLE IF EXISTS `tb_carrinho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_carrinho` (
  `tb_carrinho_id` int NOT NULL AUTO_INCREMENT,
  `tb_carrinho_preco` decimal(10,2) NOT NULL,
  `tb_carrinho_quantidade` int NOT NULL,
  `tb_carrinho_ativo` int NOT NULL,
  `tb_cliente_id` int NOT NULL,
  `tb_produto_id` int NOT NULL,
  PRIMARY KEY (`tb_carrinho_id`),
  KEY `pk_cliente_has_fk_carrinho` (`tb_cliente_id`),
  KEY `pk_produto_has_fk_carrinho` (`tb_produto_id`),
  CONSTRAINT `pk_cliente_has_fk_carrinho` FOREIGN KEY (`tb_cliente_id`) REFERENCES `tb_cliente` (`tb_cliente_id`),
  CONSTRAINT `pk_produto_has_fk_carrinho` FOREIGN KEY (`tb_produto_id`) REFERENCES `tb_produto` (`tb_produto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_carrinho`
--

LOCK TABLES `tb_carrinho` WRITE;
/*!40000 ALTER TABLE `tb_carrinho` DISABLE KEYS */;
INSERT INTO `tb_carrinho` VALUES (2,30.00,1,2,1,3),(3,30.00,1,2,1,4),(4,30.00,1,2,1,4),(5,1.98,1,2,1,2),(6,30.00,1,0,1,4),(10,1.98,1,0,1,2),(51,40.00,4,0,2,11),(52,6.00,3,0,2,10),(53,60.00,6,0,2,11),(54,30.00,10,0,2,5),(55,500.00,50,0,2,11),(56,50.00,5,0,3,12),(58,10.00,5,0,2,10),(60,15.00,5,0,5,14),(63,12.00,4,1,2,14),(65,15.00,5,0,23,14),(66,12.00,4,0,23,14),(68,19.95,5,0,30,17),(69,6.00,2,0,30,14),(70,24.95,5,0,31,18),(71,3.99,1,0,31,17);
/*!40000 ALTER TABLE `tb_carrinho` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_cliente`
--

DROP TABLE IF EXISTS `tb_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_cliente` (
  `tb_cliente_id` int NOT NULL AUTO_INCREMENT,
  `tb_cliente_nome` varchar(255) NOT NULL,
  `tb_cliente_endereco` varchar(255) NOT NULL,
  `tb_cliente_email` varchar(255) NOT NULL,
  `tb_cliente_senha` varchar(45) NOT NULL,
  `tb_cliente_cpf` varchar(50) NOT NULL,
  `tb_cliente_bairro` varchar(255) NOT NULL,
  `tb_cliente_cidade` varchar(255) NOT NULL,
  `tb_cliente_tel` varchar(45) NOT NULL,
  `tb_cliente_complemento` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`tb_cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_cliente`
--

LOCK TABLES `tb_cliente` WRITE;
/*!40000 ALTER TABLE `tb_cliente` DISABLE KEYS */;
INSERT INTO `tb_cliente` VALUES (1,'Eric Alexandre Brito','R SANTECLER FERREIRA, 15','Erikkukira@gmail.com','teste','51837795894','teste','CARAPICUIBA','00000000','SEM COMPLEMENTO'),(2,'Enzo da silva','R Fernão Dias, 20','teste@email.com','testeteste','51837795894','Jardins','teste','00000001','SEM COMPLEMENTO'),(3,'Gabriel Soares','R Fernão Dias, 20','Gabriel@gmail.com','testeteste','52181891036','Jardins','teste','00000000','SEM COMPLEMENTO'),(4,'Luigy teste','R Fernão Dias, 20','teste@teste','testeteste','52181891036','teste','teste','00000000','SEM COMPLEMENTO'),(5,'Guest','R Fernão Dias, 20','guest@email.com','teste','51837795894','teste1','teste','00000000','SEM COMPLEMENTO'),(15,'','','','','51837795894','','','','SEM COMPLEMENTO'),(21,'Eric Alexandre Brito','teste','ericalexandrebrito01@gmail.com','teste','52181891036','teste','CARAPICUIBA','00000000','SEM COMPLEMENTO'),(22,'TATI','teste','tati_jasmin.ge@hotmail.com','teste','52181891036','teste','teste','00000000','SEM COMPLEMENTO'),(23,'Eric Alexandre Brito','teste','ericalexandrebrito01@gmail.com','107281290','52181891036','teste','CARAPICUIBA','0000000009','SEM COMPLEMENTO'),(27,'teste','teste','grupowillpinturas@gmail.com','teste','51837795894','teste','teste','00000000','SEM COMPLEMENTO'),(28,'teste','teste','erikkukira@gmail.com','Testeteste','51837795894','','teste','00000000','SEM COMPLEMENTO'),(29,'Eric Brito','R Fernão Dias, 20','ericalexandrebrito01@gmail.com','testeteste','51837795894','teste','teste','00000000','SEM COMPLEMENTO'),(30,'Eric Brito','R Fernão Dias, 20','ericalexandrebrito01@gmail.com','testeteste','51837795894','chacara ','teste','00000000','SEM COMPLEMENTO'),(31,'Usuario ','R Fernão Dias, 20','ericalexandrebrito01@gmail.com','438170478','51837795894','jardins','teste','00000000','SEM COMPLEMENTO');
/*!40000 ALTER TABLE `tb_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_fornecedor`
--

DROP TABLE IF EXISTS `tb_fornecedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_fornecedor` (
  `tb_fornecedor_id` int NOT NULL AUTO_INCREMENT,
  `tb_fornecedor_nome` varchar(255) NOT NULL,
  `tb_fornecedor_cnpj` varchar(50) NOT NULL,
  `tb_fornecedor_endereco` varchar(255) NOT NULL,
  `tb_fornecedor_bairro` varchar(255) DEFAULT NULL,
  `tb_fornecedor_cidade` varchar(255) DEFAULT NULL,
  `tb_fornecedor_email` varchar(255) DEFAULT NULL,
  `tb_fornecedor_tel` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`tb_fornecedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_fornecedor`
--

LOCK TABLES `tb_fornecedor` WRITE;
/*!40000 ALTER TABLE `tb_fornecedor` DISABLE KEYS */;
INSERT INTO `tb_fornecedor` VALUES (1,'RAROZ','30491506000101','Av. Paulista,15','Jardins','São Paulo','rararoz@gmail.com','00000000'),(2,'Nissin ','06183253000124','R SANTECLER FERREIRA, 15','Andorinha','São Paulo','nissin@gmail.com','00000000'),(3,'Granja Paulista','06183253000124','teste','teste','teste','teste','00000000'),(4,'Ype ','06183253000124','teste','teste','teste','teste','00000000'),(5,'Mondelez','06183253000124','teste','teste','teste','teste','00000000'),(6,'Camil','06183253000124','teste','teste','teste','teste','00000000'),(7,'Faceto','06183253000124','teste','teste','teste','teste','00000000'),(8,'Yoki','06183253000124','teste','teste','teste','teste','11999999999'),(9,'Italac','06183253000124','teste','teste','teste','teste@email.com','00000000'),(11,'Paulista','06183253000124','teste','teste','teste','teste','00000000'),(14,'Vigor Alimentos Ltda.','06183253000124','teste','teste','Osasco','teste','00000000'),(15,'Delicia','06183253000124','teste','teste','Osasco','teste','00000000');
/*!40000 ALTER TABLE `tb_fornecedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_imagens_prdt`
--

DROP TABLE IF EXISTS `tb_imagens_prdt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_imagens_prdt` (
  `tb_imagens_prdt_id` int NOT NULL AUTO_INCREMENT,
  `tb_imagens_prdt_desc` varchar(255) NOT NULL,
  `tb_imagens_prdt_imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`tb_imagens_prdt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_imagens_prdt`
--

LOCK TABLES `tb_imagens_prdt` WRITE;
/*!40000 ALTER TABLE `tb_imagens_prdt` DISABLE KEYS */;
INSERT INTO `tb_imagens_prdt` VALUES (8,'Arroz Raroz','5fb3d34d31b83.jpg'),(9,'Arroz Raroz','5fb3d36b8b698.jpg'),(10,'Feijao kisabor','5fb3d3c033f84.png'),(11,'Feijao kisabor','5fb3d417b9f4d.png'),(12,'Miojo Nissin Carne','5fb3d47d9774b.jpg'),(13,'Miojo Nissin Carne','5fb3d4b28de71.jpg'),(14,'ovo Branco duzia','5fb3d4f81e230.jpg'),(15,'SABAO EM BARRA YPE','5fb43afc16d87.png'),(16,'Trakinas Chocolate','5fb6cbc93363e.jpg'),(17,'Feijao carioco','5fb6cd033edfd.jpg'),(18,'Arroz Camil','5fb6cdcab421d.jpg'),(19,'Salgadinho Fofura Churrasco','5fb6ce4ca42ff.jpg'),(20,'Milho pipoca Yoki tradicional','5fc16538e1064.jpg'),(21,'Milho de Pipoca Yoki Premium ','5fc1703568b1b.jpg'),(22,'Feijao kisabor','5fc22e9e0c91e.png'),(23,'leite paulista','5fc2463f98b15.jpg'),(24,'Requeijao Vigor','5fcd440d3c0b5.png'),(25,'Requeijao ','5fcd454cddf4e.png'),(26,'Vigor Requeijao','5fcd46a07f534.png'),(27,'Manteiga supreme','5fcd4bb925e6e.png');
/*!40000 ALTER TABLE `tb_imagens_prdt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_produto`
--

DROP TABLE IF EXISTS `tb_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_produto` (
  `tb_produto_id` int NOT NULL AUTO_INCREMENT,
  `tb_produto_nome` varchar(255) NOT NULL,
  `tb_produto_estoque` int NOT NULL,
  `tb_produto_preco` decimal(10,2) NOT NULL,
  `tb_produto_imagem` varchar(100) DEFAULT NULL,
  `tb_fornecedor_id` int NOT NULL,
  `tb_imagens_prdt_id` int NOT NULL,
  PRIMARY KEY (`tb_produto_id`),
  KEY `pk_produto_fk_fornecedor` (`tb_fornecedor_id`),
  KEY `pk_produto_fk_imagem` (`tb_imagens_prdt_id`),
  CONSTRAINT `pk_produto_fk_fornecedor` FOREIGN KEY (`tb_fornecedor_id`) REFERENCES `tb_fornecedor` (`tb_fornecedor_id`),
  CONSTRAINT `pk_produto_fk_imagem` FOREIGN KEY (`tb_imagens_prdt_id`) REFERENCES `tb_imagens_prdt` (`tb_imagens_prdt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_produto`
--

LOCK TABLES `tb_produto` WRITE;
/*!40000 ALTER TABLE `tb_produto` DISABLE KEYS */;
INSERT INTO `tb_produto` VALUES (2,'Miojo Carne',49,1.98,NULL,2,12),(3,'Ovo Branco Duzia',10,30.00,NULL,3,14),(4,'Ovo Branco meia duzia',9,15.00,NULL,3,14),(5,'sabão em barra',-10,3.00,NULL,4,15),(6,'Bolacha Trakinas Chocolate',50,2.00,NULL,5,16),(7,'Arroz Branco tipo 1',96,10.00,NULL,1,9),(8,'Feijão Carioca ',72,5.90,NULL,6,17),(9,'Arroz Branco tipo 1',10,3.00,NULL,6,18),(10,'Salgadinho Churrasco',110,2.00,NULL,7,19),(11,'Milho Pipoca Yoki Tradicional ',0,10.00,NULL,8,20),(12,'Milho  Pipoca Yoki Premium',50,10.00,NULL,8,21),(13,'Feijão kisabor Carioca 1',42,5.00,NULL,6,10),(14,'Leite Longa vida Paulista integral',33,3.00,NULL,11,23),(17,'Requeijão',48,3.99,NULL,14,26),(18,'Manteiga Supreme ',50,4.99,NULL,15,27);
/*!40000 ALTER TABLE `tb_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_venda`
--

DROP TABLE IF EXISTS `tb_venda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_venda` (
  `tb_venda_id` int NOT NULL AUTO_INCREMENT,
  `tb_venda_data` varchar(128) NOT NULL,
  `tb_carrinho_id` int NOT NULL,
  `tb_cliente_id` int NOT NULL,
  `tb_venda_metodopag` int NOT NULL,
  PRIMARY KEY (`tb_venda_id`),
  KEY `pk_venda_fk_carrinho` (`tb_carrinho_id`),
  KEY `pk_venda_fk_cliente` (`tb_cliente_id`),
  CONSTRAINT `pk_venda_fk_carrinho` FOREIGN KEY (`tb_carrinho_id`) REFERENCES `tb_carrinho` (`tb_carrinho_id`),
  CONSTRAINT `pk_venda_fk_cliente` FOREIGN KEY (`tb_cliente_id`) REFERENCES `tb_cliente` (`tb_cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_venda`
--

LOCK TABLES `tb_venda` WRITE;
/*!40000 ALTER TABLE `tb_venda` DISABLE KEYS */;
INSERT INTO `tb_venda` VALUES (6,'17-11-20',6,1,0),(10,'17-11-20',10,1,0),(24,'27-11-20',51,2,0),(25,'27-11-20',52,2,0),(26,'27-11-20',53,2,0),(27,'27-11-20',54,2,0),(28,'27-11-20',55,2,0),(29,'27-11-20',56,3,0),(31,'28-11-20',58,2,0),(32,'28-11-20',60,5,0),(36,'06-12-20',65,23,0),(37,'06-12-20',66,23,0),(39,'06-12-20',68,30,0),(40,'06-12-20',69,30,0),(41,'06-12-20',70,31,0),(42,'06-12-20',71,31,0);
/*!40000 ALTER TABLE `tb_venda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'bd_ecommerce'
--

--
-- Dumping routines for database 'bd_ecommerce'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-16 16:11:28
