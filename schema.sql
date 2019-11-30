-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: 51.38.238.194    Database: ws
-- ------------------------------------------------------
-- Server version	5.7.28

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
-- Table structure for table `atendimentos_cliente`
--

DROP TABLE IF EXISTS `atendimentos_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atendimentos_cliente` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_cliente` int(11) NOT NULL,
  `codigo_funcionario` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atendimentos_cliente`
--

LOCK TABLES `atendimentos_cliente` WRITE;
/*!40000 ALTER TABLE `atendimentos_cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `atendimentos_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens`
--

DROP TABLE IF EXISTS `itens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itens` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) NOT NULL,
  `codigo_fornecedor` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens`
--

LOCK TABLES `itens` WRITE;
/*!40000 ALTER TABLE `itens` DISABLE KEYS */;
INSERT INTO `itens` VALUES (2,2,5,'Lápis'),(3,2,5,'Caneta Azul'),(4,2,5,'Post it'),(5,3,4,'Martelo'),(6,3,3,'Chave de fenda'),(7,1,1,'string'),(8,1,1,'string'),(9,1,1,'string');
/*!40000 ALTER TABLE `itens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens_ferramentas`
--

DROP TABLE IF EXISTS `itens_ferramentas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itens_ferramentas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_item` int(11) NOT NULL,
  `data_aquisicao` datetime NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens_ferramentas`
--

LOCK TABLES `itens_ferramentas` WRITE;
/*!40000 ALTER TABLE `itens_ferramentas` DISABLE KEYS */;
/*!40000 ALTER TABLE `itens_ferramentas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens_materiais_escritorio`
--

DROP TABLE IF EXISTS `itens_materiais_escritorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itens_materiais_escritorio` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_item` int(11) NOT NULL,
  `lote` varchar(200) NOT NULL,
  `data_aquisicao` datetime NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens_materiais_escritorio`
--

LOCK TABLES `itens_materiais_escritorio` WRITE;
/*!40000 ALTER TABLE `itens_materiais_escritorio` DISABLE KEYS */;
/*!40000 ALTER TABLE `itens_materiais_escritorio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens_mobiliarios`
--

DROP TABLE IF EXISTS `itens_mobiliarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itens_mobiliarios` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_item` int(11) NOT NULL,
  `codigo_patrimonio` varchar(200) NOT NULL,
  `data_aquisicao` datetime NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens_mobiliarios`
--

LOCK TABLES `itens_mobiliarios` WRITE;
/*!40000 ALTER TABLE `itens_mobiliarios` DISABLE KEYS */;
INSERT INTO `itens_mobiliarios` VALUES (1,1,'XPTO153245462019==','2019-11-20 19:46:54'),(2,2,'XPTO153245462019==','2019-11-20 19:46:54');
/*!40000 ALTER TABLE `itens_mobiliarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens_tipos`
--

DROP TABLE IF EXISTS `itens_tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itens_tipos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens_tipos`
--

LOCK TABLES `itens_tipos` WRITE;
/*!40000 ALTER TABLE `itens_tipos` DISABLE KEYS */;
INSERT INTO `itens_tipos` VALUES (1,'Mobiliario'),(2,'Material de Escritorio'),(3,'Ferramenta');
/*!40000 ALTER TABLE `itens_tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lancamentos`
--

DROP TABLE IF EXISTS `lancamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lancamentos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) NOT NULL,
  `valor` decimal(15,2) NOT NULL,
  `data_vencimento` datetime NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lancamentos`
--

LOCK TABLES `lancamentos` WRITE;
/*!40000 ALTER TABLE `lancamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `lancamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lancamentos_receitas`
--

DROP TABLE IF EXISTS `lancamentos_receitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lancamentos_receitas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_lancamento` int(11) NOT NULL,
  `codigo_fornecedor` int(11) NOT NULL,
  `pago` tinyint(1) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `data_pagamento` datetime NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lancamentos_receitas`
--

LOCK TABLES `lancamentos_receitas` WRITE;
/*!40000 ALTER TABLE `lancamentos_receitas` DISABLE KEYS */;
/*!40000 ALTER TABLE `lancamentos_receitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lancamentos_tipos`
--

DROP TABLE IF EXISTS `lancamentos_tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lancamentos_tipos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lancamentos_tipos`
--

LOCK TABLES `lancamentos_tipos` WRITE;
/*!40000 ALTER TABLE `lancamentos_tipos` DISABLE KEYS */;
INSERT INTO `lancamentos_tipos` VALUES (1,'Despesa'),(2,'Receita');
/*!40000 ALTER TABLE `lancamentos_tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordens_servico`
--

DROP TABLE IF EXISTS `ordens_servico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordens_servico` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_atendimento_cliente` int(11) NOT NULL,
  `data_chamado` datetime NOT NULL,
  `data_prevista` datetime NOT NULL,
  `data_de_execucao` datetime DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordens_servico`
--

LOCK TABLES `ordens_servico` WRITE;
/*!40000 ALTER TABLE `ordens_servico` DISABLE KEYS */;
/*!40000 ALTER TABLE `ordens_servico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordens_servico_ferramentas`
--

DROP TABLE IF EXISTS `ordens_servico_ferramentas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordens_servico_ferramentas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_ordem_servico` int(11) NOT NULL,
  `codigo_ferramenta` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordens_servico_ferramentas`
--

LOCK TABLES `ordens_servico_ferramentas` WRITE;
/*!40000 ALTER TABLE `ordens_servico_ferramentas` DISABLE KEYS */;
/*!40000 ALTER TABLE `ordens_servico_ferramentas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordens_servico_funcionarios`
--

DROP TABLE IF EXISTS `ordens_servico_funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordens_servico_funcionarios` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_ordem_servico` int(11) NOT NULL,
  `codigo_funcionario` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordens_servico_funcionarios`
--

LOCK TABLES `ordens_servico_funcionarios` WRITE;
/*!40000 ALTER TABLE `ordens_servico_funcionarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `ordens_servico_funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoas`
--

DROP TABLE IF EXISTS `pessoas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pessoas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `cpf` varchar(200) DEFAULT NULL,
  `cnpj` varchar(200) DEFAULT NULL,
  `data_nascimento` datetime DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `telefone` varchar(200) DEFAULT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoas`
--

LOCK TABLES `pessoas` WRITE;
/*!40000 ALTER TABLE `pessoas` DISABLE KEYS */;
INSERT INTO `pessoas` VALUES (1,'admin','admin@admin.com','','',NULL,'','','123456');
/*!40000 ALTER TABLE `pessoas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoas_clientes`
--

DROP TABLE IF EXISTS `pessoas_clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pessoas_clientes` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_tipo` int(11) NOT NULL,
  `codigo_pessoa` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoas_clientes`
--

LOCK TABLES `pessoas_clientes` WRITE;
/*!40000 ALTER TABLE `pessoas_clientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `pessoas_clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoas_fornecedores`
--

DROP TABLE IF EXISTS `pessoas_fornecedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pessoas_fornecedores` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_tipo` int(11) NOT NULL,
  `codigo_pessoa` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoas_fornecedores`
--

LOCK TABLES `pessoas_fornecedores` WRITE;
/*!40000 ALTER TABLE `pessoas_fornecedores` DISABLE KEYS */;
/*!40000 ALTER TABLE `pessoas_fornecedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoas_funcionarios`
--

DROP TABLE IF EXISTS `pessoas_funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pessoas_funcionarios` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_tipo` int(11) NOT NULL,
  `codigo_pessoa` int(11) NOT NULL,
  `cargo` varchar(200) DEFAULT NULL,
  `salario` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoas_funcionarios`
--

LOCK TABLES `pessoas_funcionarios` WRITE;
/*!40000 ALTER TABLE `pessoas_funcionarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `pessoas_funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoas_tipos`
--

DROP TABLE IF EXISTS `pessoas_tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pessoas_tipos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoas_tipos`
--

LOCK TABLES `pessoas_tipos` WRITE;
/*!40000 ALTER TABLE `pessoas_tipos` DISABLE KEYS */;
INSERT INTO `pessoas_tipos` VALUES (1,'Funcionario'),(2,'Cliente'),(3,'Fornecedor');
/*!40000 ALTER TABLE `pessoas_tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'ws'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-29 23:13:57
