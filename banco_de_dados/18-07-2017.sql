-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: casadosertao
-- ------------------------------------------------------
-- Server version	5.7.16-log

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
-- Table structure for table `aquisicao_item`
--

DROP TABLE IF EXISTS `aquisicao_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aquisicao_item` (
  `id_aquisicao_item` int(11) NOT NULL AUTO_INCREMENT,
  `data` date DEFAULT NULL,
  `modo_aquisicao` varchar(50) DEFAULT NULL,
  `autor` varchar(50) DEFAULT NULL,
  `observacao` varchar(50) DEFAULT NULL,
  `Item_id_item` int(11) NOT NULL,
  PRIMARY KEY (`id_aquisicao_item`,`Item_id_item`),
  KEY `fk_Aquisicao_Item1_idx` (`Item_id_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aquisicao_item`
--

LOCK TABLES `aquisicao_item` WRITE;
/*!40000 ALTER TABLE `aquisicao_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `aquisicao_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caracteristicas_estilisticas_item`
--

DROP TABLE IF EXISTS `caracteristicas_estilisticas_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caracteristicas_estilisticas_item` (
  `id_caracteristicas_estilisticas_item` int(11) NOT NULL AUTO_INCREMENT,
  `materiais_constitutivos` varchar(50) DEFAULT NULL,
  `tecnica_fabricacao` varchar(50) DEFAULT NULL,
  `autoria` varchar(50) DEFAULT NULL,
  `Item_id_item` int(11) NOT NULL,
  PRIMARY KEY (`id_caracteristicas_estilisticas_item`,`Item_id_item`),
  KEY `fk_Caracteristicas_estilisticas_item_Item1_idx` (`Item_id_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caracteristicas_estilisticas_item`
--

LOCK TABLES `caracteristicas_estilisticas_item` WRITE;
/*!40000 ALTER TABLE `caracteristicas_estilisticas_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `caracteristicas_estilisticas_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cria_evento`
--

DROP TABLE IF EXISTS `cria_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cria_evento` (
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Evento_id_evento` int(11) NOT NULL,
  `Usuario_id_usuario` varchar(100) NOT NULL,
  PRIMARY KEY (`Evento_id_evento`,`Usuario_id_usuario`),
  KEY `fk_Cria_evento_Usuario1_idx` (`Usuario_id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cria_evento`
--

LOCK TABLES `cria_evento` WRITE;
/*!40000 ALTER TABLE `cria_evento` DISABLE KEYS */;
/*!40000 ALTER TABLE `cria_evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cria_exposicao`
--

DROP TABLE IF EXISTS `cria_exposicao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cria_exposicao` (
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Exposicao_id_exposicao` int(11) NOT NULL,
  `Usuario_id_usuario` varchar(100) NOT NULL,
  PRIMARY KEY (`Exposicao_id_exposicao`,`Usuario_id_usuario`),
  KEY `fk_Logs_1_Usuario3_idx` (`Usuario_id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cria_exposicao`
--

LOCK TABLES `cria_exposicao` WRITE;
/*!40000 ALTER TABLE `cria_exposicao` DISABLE KEYS */;
/*!40000 ALTER TABLE `cria_exposicao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cria_item`
--

DROP TABLE IF EXISTS `cria_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cria_item` (
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Item_id_item` int(11) NOT NULL,
  `Usuario_id_usuario` varchar(100) NOT NULL,
  PRIMARY KEY (`Item_id_item`,`Usuario_id_usuario`),
  KEY `fk_Logs_Usuario1_idx` (`Usuario_id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cria_item`
--

LOCK TABLES `cria_item` WRITE;
/*!40000 ALTER TABLE `cria_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `cria_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `desabilita_pesquisa`
--

DROP TABLE IF EXISTS `desabilita_pesquisa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `desabilita_pesquisa` (
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Usuario_id_usuario` varchar(100) NOT NULL,
  `Pesquisa_id_pesquisa` int(11) NOT NULL,
  PRIMARY KEY (`Usuario_id_usuario`,`Pesquisa_id_pesquisa`),
  KEY `fk_Logs_Pesquisa1_idx` (`Pesquisa_id_pesquisa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `desabilita_pesquisa`
--

LOCK TABLES `desabilita_pesquisa` WRITE;
/*!40000 ALTER TABLE `desabilita_pesquisa` DISABLE KEYS */;
/*!40000 ALTER TABLE `desabilita_pesquisa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dimensao_item`
--

DROP TABLE IF EXISTS `dimensao_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dimensao_item` (
  `id_dimensao_item` int(11) NOT NULL AUTO_INCREMENT,
  `altura` decimal(5,2) DEFAULT NULL,
  `diamentro` decimal(5,2) DEFAULT NULL,
  `largura` decimal(5,2) DEFAULT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `comprimento` decimal(5,2) DEFAULT NULL,
  `Item_id_item` int(11) NOT NULL,
  PRIMARY KEY (`id_dimensao_item`,`Item_id_item`),
  KEY `fk_Dimensao_item_Item1_idx` (`Item_id_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dimensao_item`
--

LOCK TABLES `dimensao_item` WRITE;
/*!40000 ALTER TABLE `dimensao_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `dimensao_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documentacao_fotografica_item`
--

DROP TABLE IF EXISTS `documentacao_fotografica_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentacao_fotografica_item` (
  `id_documentacao_fotografica_item` int(11) NOT NULL AUTO_INCREMENT,
  `fotografo` varchar(50) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `foto_url` longtext,
  `Item_id_item` int(11) NOT NULL,
  PRIMARY KEY (`id_documentacao_fotografica_item`,`Item_id_item`),
  KEY `fk_Documentacao_fotografica_item_Item1_idx` (`Item_id_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentacao_fotografica_item`
--

LOCK TABLES `documentacao_fotografica_item` WRITE;
/*!40000 ALTER TABLE `documentacao_fotografica_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `documentacao_fotografica_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `edita_evento`
--

DROP TABLE IF EXISTS `edita_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `edita_evento` (
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Evento_id_evento` int(11) NOT NULL,
  `Usuario_id_usuario` varchar(100) NOT NULL,
  PRIMARY KEY (`Evento_id_evento`,`Usuario_id_usuario`,`data`),
  KEY `fk_Edita_evento_Usuario1_idx` (`Usuario_id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `edita_evento`
--

LOCK TABLES `edita_evento` WRITE;
/*!40000 ALTER TABLE `edita_evento` DISABLE KEYS */;
/*!40000 ALTER TABLE `edita_evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `edita_exposicao`
--

DROP TABLE IF EXISTS `edita_exposicao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `edita_exposicao` (
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Exposicao_id_exposicao` int(11) NOT NULL,
  `Usuario_id_usuario` varchar(100) NOT NULL,
  PRIMARY KEY (`Exposicao_id_exposicao`,`Usuario_id_usuario`,`data`),
  KEY `fk_Logs_Usuario2_idx` (`Usuario_id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `edita_exposicao`
--

LOCK TABLES `edita_exposicao` WRITE;
/*!40000 ALTER TABLE `edita_exposicao` DISABLE KEYS */;
/*!40000 ALTER TABLE `edita_exposicao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `edita_item`
--

DROP TABLE IF EXISTS `edita_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `edita_item` (
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Item_id_item` int(11) NOT NULL,
  `Usuario_id_usuario` varchar(100) NOT NULL,
  PRIMARY KEY (`Item_id_item`,`Usuario_id_usuario`,`data`),
  KEY `fk_Logs_1_Usuario1_idx` (`Usuario_id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `edita_item`
--

LOCK TABLES `edita_item` WRITE;
/*!40000 ALTER TABLE `edita_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `edita_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `editar_noticia`
--

DROP TABLE IF EXISTS `editar_noticia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `editar_noticia` (
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Usuario_id_user` varchar(100) NOT NULL,
  `Noticia_id_noticia` int(11) NOT NULL,
  PRIMARY KEY (`Usuario_id_user`,`Noticia_id_noticia`,`data`),
  KEY `fk_Editar_noticia_Noticia1_idx` (`Noticia_id_noticia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editar_noticia`
--

LOCK TABLES `editar_noticia` WRITE;
/*!40000 ALTER TABLE `editar_noticia` DISABLE KEYS */;
/*!40000 ALTER TABLE `editar_noticia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evento`
--

DROP TABLE IF EXISTS `evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento` (
  `id_evento` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) DEFAULT NULL,
  `local` varchar(200) DEFAULT NULL,
  `responsavel` varchar(50) DEFAULT NULL,
  `foto_url` longtext,
  `artista` varchar(50) DEFAULT NULL,
  `horario_visitacao` varchar(50) DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `ativo` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_evento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento`
--

LOCK TABLES `evento` WRITE;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exposicao`
--

DROP TABLE IF EXISTS `exposicao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exposicao` (
  `id_exposicao` int(11) NOT NULL AUTO_INCREMENT,
  `data_inicio` date NOT NULL,
  `data_termino` date NOT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `ativo` tinyint(4) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_exposicao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exposicao`
--

LOCK TABLES `exposicao` WRITE;
/*!40000 ALTER TABLE `exposicao` DISABLE KEYS */;
/*!40000 ALTER TABLE `exposicao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorita_evento`
--

DROP TABLE IF EXISTS `favorita_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorita_evento` (
  `Evento_id_evento` int(11) NOT NULL,
  `Usuario_id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`Evento_id_evento`,`Usuario_id_usuario`),
  KEY `fk_Favorita_evento_Usuario1_idx` (`Usuario_id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorita_evento`
--

LOCK TABLES `favorita_evento` WRITE;
/*!40000 ALTER TABLE `favorita_evento` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorita_evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorita_item`
--

DROP TABLE IF EXISTS `favorita_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorita_item` (
  `Item_id_item` int(11) NOT NULL,
  `Usuario_id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`Item_id_item`,`Usuario_id_usuario`),
  KEY `fk_Logs_1_Usuario2_idx` (`Usuario_id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorita_item`
--

LOCK TABLES `favorita_item` WRITE;
/*!40000 ALTER TABLE `favorita_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorita_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `material` varchar(50) DEFAULT NULL,
  `doador` varchar(50) DEFAULT NULL,
  `funcao` varchar(50) DEFAULT NULL,
  `procedencia` varchar(50) DEFAULT NULL,
  `autor` varchar(50) DEFAULT NULL,
  `origem` varchar(50) DEFAULT NULL,
  `conservacao` varchar(50) DEFAULT NULL,
  `colecao` varchar(50) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `classificacao` varchar(50) DEFAULT NULL,
  `titulo` varchar(50) NOT NULL,
  `imagem_3d` longtext,
  `estado_de_conservacao` varchar(50) DEFAULT NULL,
  `iconologia` varchar(50) DEFAULT NULL,
  `referencias_bibliograficas` varchar(50) DEFAULT NULL,
  `descricao_objeto` varchar(50) DEFAULT NULL,
  `local` varchar(200) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `historico` varchar(50) DEFAULT NULL,
  `ativo` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_exposicao`
--

DROP TABLE IF EXISTS `item_exposicao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_exposicao` (
  `Item_id_item` int(11) NOT NULL,
  `Exposicao_id_exposicao` int(11) NOT NULL,
  PRIMARY KEY (`Item_id_item`,`Exposicao_id_exposicao`),
  KEY `fk_Item_exposicao_Exposicao1_idx` (`Exposicao_id_exposicao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_exposicao`
--

LOCK TABLES `item_exposicao` WRITE;
/*!40000 ALTER TABLE `item_exposicao` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_exposicao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_imagem`
--

DROP TABLE IF EXISTS `item_imagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_imagem` (
  `id_item_imagem` int(11) NOT NULL AUTO_INCREMENT,
  `foto_url` longtext NOT NULL,
  `Item_id_item` int(11) NOT NULL,
  PRIMARY KEY (`id_item_imagem`,`Item_id_item`),
  KEY `fk_Item_imagem_Item1_idx` (`Item_id_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_imagem`
--

LOCK TABLES `item_imagem` WRITE;
/*!40000 ALTER TABLE `item_imagem` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_imagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticia`
--

DROP TABLE IF EXISTS `noticia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `noticia` (
  `id_noticia` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `descricao` longtext NOT NULL,
  `data_publicacao` date NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  `Usuario_id_user` varchar(100) NOT NULL,
  PRIMARY KEY (`id_noticia`),
  KEY `fk_Noticia_Usuario_idx` (`Usuario_id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticia`
--

LOCK TABLES `noticia` WRITE;
/*!40000 ALTER TABLE `noticia` DISABLE KEYS */;
/*!40000 ALTER TABLE `noticia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticia_imagem`
--

DROP TABLE IF EXISTS `noticia_imagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `noticia_imagem` (
  `id_noticia_imagem` int(11) NOT NULL AUTO_INCREMENT,
  `foto_url` longtext NOT NULL,
  `Noticia_id_noticia` int(11) NOT NULL,
  PRIMARY KEY (`id_noticia_imagem`,`Noticia_id_noticia`),
  KEY `fk_template 4_Noticia1_idx` (`Noticia_id_noticia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticia_imagem`
--

LOCK TABLES `noticia_imagem` WRITE;
/*!40000 ALTER TABLE `noticia_imagem` DISABLE KEYS */;
/*!40000 ALTER TABLE `noticia_imagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissao`
--

DROP TABLE IF EXISTS `permissao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissao` (
  `id_permissao` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) DEFAULT NULL,
  `Usuario_id_usuario` varchar(100) NOT NULL,
  PRIMARY KEY (`id_permissao`,`Usuario_id_usuario`),
  KEY `fk_Permissao_Usuario1_idx` (`Usuario_id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissao`
--

LOCK TABLES `permissao` WRITE;
/*!40000 ALTER TABLE `permissao` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pesquisa`
--

DROP TABLE IF EXISTS `pesquisa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pesquisa` (
  `id_pesquisa` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `link` longtext,
  `data` date DEFAULT NULL,
  `Usuario_id_usuario` varchar(100) NOT NULL,
  `ativo` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_pesquisa`),
  KEY `fk_Pesquisa_Usuario1_idx` (`Usuario_id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pesquisa`
--

LOCK TABLES `pesquisa` WRITE;
/*!40000 ALTER TABLE `pesquisa` DISABLE KEYS */;
/*!40000 ALTER TABLE `pesquisa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remove_evento`
--

DROP TABLE IF EXISTS `remove_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remove_evento` (
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Evento_id_evento` int(11) NOT NULL,
  `Usuario_id_usuario` varchar(100) NOT NULL,
  PRIMARY KEY (`Evento_id_evento`,`Usuario_id_usuario`),
  KEY `fk_Exclui_evento_Usuario1_idx` (`Usuario_id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remove_evento`
--

LOCK TABLES `remove_evento` WRITE;
/*!40000 ALTER TABLE `remove_evento` DISABLE KEYS */;
/*!40000 ALTER TABLE `remove_evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remove_exposicao`
--

DROP TABLE IF EXISTS `remove_exposicao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remove_exposicao` (
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Usuario_id_usuario` varchar(100) NOT NULL,
  `Exposicao_id_exposicao` int(11) NOT NULL,
  PRIMARY KEY (`Usuario_id_usuario`,`Exposicao_id_exposicao`),
  KEY `fk_Logs_2_Exposicao1_idx` (`Exposicao_id_exposicao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remove_exposicao`
--

LOCK TABLES `remove_exposicao` WRITE;
/*!40000 ALTER TABLE `remove_exposicao` DISABLE KEYS */;
/*!40000 ALTER TABLE `remove_exposicao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remove_item`
--

DROP TABLE IF EXISTS `remove_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remove_item` (
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Item_id_item` int(11) NOT NULL,
  `Usuario_id_usuario` varchar(100) NOT NULL,
  PRIMARY KEY (`Item_id_item`,`Usuario_id_usuario`),
  KEY `fk_Remove_item_Usuario1_idx` (`Usuario_id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remove_item`
--

LOCK TABLES `remove_item` WRITE;
/*!40000 ALTER TABLE `remove_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `remove_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remove_noticia`
--

DROP TABLE IF EXISTS `remove_noticia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remove_noticia` (
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Usuario_id_user` varchar(100) NOT NULL,
  `Noticia_id_noticia` int(11) NOT NULL,
  PRIMARY KEY (`Usuario_id_user`,`Noticia_id_noticia`),
  KEY `fk_Remove_noticia_Noticia1_idx` (`Noticia_id_noticia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remove_noticia`
--

LOCK TABLES `remove_noticia` WRITE;
/*!40000 ALTER TABLE `remove_noticia` DISABLE KEYS */;
/*!40000 ALTER TABLE `remove_noticia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` varchar(100) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  `tipo` enum('f','c') NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-18 20:03:05
