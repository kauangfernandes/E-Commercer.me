/*
SQLyog Enterprise - MySQL GUI v8.12 
MySQL - 5.5.5-10.4.28-MariaDB : Database - db_ecommercer
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_ecommercer` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `db_ecommercer`;

/*Table structure for table `status_categorias` */

DROP TABLE IF EXISTS `status_categorias`;

CREATE TABLE `status_categorias` (
  `id_status_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `status_categoria` varchar(10) NOT NULL,
  PRIMARY KEY (`id_status_categoria`),
  UNIQUE KEY `status_categoria` (`status_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `status_categorias` */

insert  into `status_categorias`(`id_status_categoria`,`status_categoria`) values (1,'Ativo'),(2,'Inativo');

/*Table structure for table `status_produtos` */

DROP TABLE IF EXISTS `status_produtos`;

CREATE TABLE `status_produtos` (
  `id_status_produto` int(11) NOT NULL AUTO_INCREMENT,
  `status_produto` varchar(10) NOT NULL,
  PRIMARY KEY (`id_status_produto`),
  UNIQUE KEY `status_produto` (`status_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `status_produtos` */

insert  into `status_produtos`(`id_status_produto`,`status_produto`) values (1,'Ativo'),(2,'Inativo');

/*Table structure for table `status_telefones` */

DROP TABLE IF EXISTS `status_telefones`;

CREATE TABLE `status_telefones` (
  `id_status_telefone` int(11) NOT NULL AUTO_INCREMENT,
  `status_telefone` varchar(10) NOT NULL,
  PRIMARY KEY (`id_status_telefone`),
  UNIQUE KEY `status_telefone` (`status_telefone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `status_telefones` */

/*Table structure for table `status_usuarios` */

DROP TABLE IF EXISTS `status_usuarios`;

CREATE TABLE `status_usuarios` (
  `id_status_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `status_usuario` varchar(10) NOT NULL,
  PRIMARY KEY (`id_status_usuario`),
  UNIQUE KEY `status_usuario` (`status_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `status_usuarios` */

insert  into `status_usuarios`(`id_status_usuario`,`status_usuario`) values (1,'Ativo'),(2,'Inativo');

/*Table structure for table `tb_categorias` */

DROP TABLE IF EXISTS `tb_categorias`;

CREATE TABLE `tb_categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `descritivo` varchar(80) NOT NULL,
  `id_status_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_categoria`),
  UNIQUE KEY `descritivo` (`descritivo`),
  KEY `id_status_categoria` (`id_status_categoria`),
  CONSTRAINT `tb_categorias_ibfk_1` FOREIGN KEY (`id_status_categoria`) REFERENCES `status_categorias` (`id_status_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_categorias` */

insert  into `tb_categorias`(`id_categoria`,`descritivo`,`id_status_categoria`) values (1,'Bronze',1),(2,'Ferro',1),(3,'Ouro',1),(4,'Diamante',1),(5,'Ruby',2),(6,'Material Escolar',1),(7,'Material de Escritorio',1);

/*Table structure for table `tb_fornecedores` */

DROP TABLE IF EXISTS `tb_fornecedores`;

CREATE TABLE `tb_fornecedores` (
  `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT,
  `cnpj` varchar(20) NOT NULL,
  `razao_social` varchar(100) DEFAULT NULL,
  `id_status_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_fornecedor`),
  UNIQUE KEY `cnpj` (`cnpj`),
  KEY `id_status_usuario` (`id_status_usuario`),
  CONSTRAINT `tb_fornecedores_ibfk_1` FOREIGN KEY (`id_status_usuario`) REFERENCES `status_usuarios` (`id_status_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_fornecedores` */

insert  into `tb_fornecedores`(`id_fornecedor`,`cnpj`,`razao_social`,`id_status_usuario`) values (1,'XX.XXX.XXX/XXXX-XX','Pritti',1),(2,'XX.XXX.XXX/XXXX-X1','Tilibra',1),(3,'XX.XXX.XXX/XXXX-X2','Faber Castell',1),(4,'XX.XXX.XXX/XXXX-X3','Cis',1),(5,'XX.XXX.XXX/XXXX-X4','Foroni',1),(6,'XX.XXX.XXX/XXXX-X5','Jandaia',1),(7,'XX.XXX.XXX/XXXX-X6','Scotch',1),(8,'XX.XXX.XXX/XXXX-X7','Maped',1);

/*Table structure for table `tb_produtos` */

DROP TABLE IF EXISTS `tb_produtos`;

CREATE TABLE `tb_produtos` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(8,2) NOT NULL,
  `estoque` int(11) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `id_status_produto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_produto`),
  KEY `id_status_produto` (`id_status_produto`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `tb_produtos_ibfk_1` FOREIGN KEY (`id_status_produto`) REFERENCES `status_produtos` (`id_status_produto`),
  CONSTRAINT `tb_produtos_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categorias` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_produtos` */

insert  into `tb_produtos`(`id_produto`,`nome`,`descricao`,`preco`,`estoque`,`imagem`,`id_status_produto`,`id_categoria`) values (1,'Borracha','Apagando erros cometidos com lápis ou grafite : )','4.20',99,'borracha.jfif',1,6),(2,'Caderno de escrever','Escreverndo entre linhas : )','49.99',99,'caderno.png',1,6),(3,'Lapis de cor','Lapis de cor, desenhan do o mundo : (','99.99',99,'caixa_lapis_cor.png',1,6),(4,'Caneta Azul','Caneta de cor azul : )','1.99',99,'caneta.jfif',1,6),(5,'Portas Objetos','Porta objetos : )','9.99',999,'porta_objetos.jfif',1,7),(6,'Papel Sulfite','Papel Sulfite : )','29.99',99,'papel_sulfite.jfif',1,7),(7,'Lapis de cor','Lapis de cor 10 cores : )','20.99',99,'lapis_cor.png',1,6),(8,'Estojo','Estojo : )','99.99',99,'estojo.jfif',1,6),(9,'Compasso','Um compasso','99.99',999,'compasso.jfif',1,1),(10,'Caneta Preta','Uma caneta azul : )','1.99',99,'caneta.jfif',1,1),(11,'Caixa de laipis de cor : )','Uma boa descricao : )( :','99.99',999,'lapis_cor.png',1,7);

/*Table structure for table `tb_produtos_fornecedores` */

DROP TABLE IF EXISTS `tb_produtos_fornecedores`;

CREATE TABLE `tb_produtos_fornecedores` (
  `id_produto_fornecedor` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  PRIMARY KEY (`id_produto_fornecedor`),
  KEY `id_produto` (`id_produto`),
  KEY `id_fornecedor` (`id_fornecedor`),
  CONSTRAINT `tb_produtos_fornecedores_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `tb_produtos` (`id_produto`),
  CONSTRAINT `tb_produtos_fornecedores_ibfk_2` FOREIGN KEY (`id_fornecedor`) REFERENCES `tb_fornecedores` (`id_fornecedor`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_produtos_fornecedores` */

insert  into `tb_produtos_fornecedores`(`id_produto_fornecedor`,`id_produto`,`id_fornecedor`) values (1,1,1),(2,1,2),(3,1,3),(4,1,5),(5,2,1),(6,2,3),(7,2,4),(8,2,7),(9,2,8),(10,3,1),(11,3,5),(12,3,7),(19,5,1),(20,5,2),(21,5,3),(22,5,4),(23,6,1),(24,6,3),(25,6,8),(29,8,2),(30,8,3),(31,9,8),(48,7,3),(49,7,4),(57,4,2),(58,4,3),(59,4,4),(60,4,6),(61,4,7),(62,4,8),(63,10,1),(64,11,1),(65,11,2),(66,11,5),(67,11,7);

/*Table structure for table `tb_telefones_fornecedores` */

DROP TABLE IF EXISTS `tb_telefones_fornecedores`;

CREATE TABLE `tb_telefones_fornecedores` (
  `id_telefone` int(11) NOT NULL AUTO_INCREMENT,
  `dd` int(2) NOT NULL,
  `telefone` varchar(10) NOT NULL,
  `id_status_telefone` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  PRIMARY KEY (`id_telefone`),
  KEY `id_status_telefone` (`id_status_telefone`),
  KEY `id_fornecedor` (`id_fornecedor`),
  CONSTRAINT `tb_telefones_fornecedores_ibfk_1` FOREIGN KEY (`id_status_telefone`) REFERENCES `status_telefones` (`id_status_telefone`),
  CONSTRAINT `tb_telefones_fornecedores_ibfk_2` FOREIGN KEY (`id_fornecedor`) REFERENCES `tb_fornecedores` (`id_fornecedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_telefones_fornecedores` */

/*Table structure for table `tb_telefones_usuarios` */

DROP TABLE IF EXISTS `tb_telefones_usuarios`;

CREATE TABLE `tb_telefones_usuarios` (
  `id_telefone` int(11) NOT NULL AUTO_INCREMENT,
  `dd` int(2) NOT NULL,
  `telefone` varchar(10) NOT NULL,
  `id_status_telefone` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_telefone`),
  KEY `id_status_telefone` (`id_status_telefone`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `tb_telefones_usuarios_ibfk_1` FOREIGN KEY (`id_status_telefone`) REFERENCES `status_telefones` (`id_status_telefone`),
  CONSTRAINT `tb_telefones_usuarios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_telefones_usuarios` */

/*Table structure for table `tb_tipos_usuarios` */

DROP TABLE IF EXISTS `tb_tipos_usuarios`;

CREATE TABLE `tb_tipos_usuarios` (
  `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_usuario` varchar(20) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_tipos_usuarios` */

insert  into `tb_tipos_usuarios`(`id_tipo_usuario`,`tipo_usuario`) values (1,'Administrador'),(2,'Usuario'),(3,'Cliente');

/*Table structure for table `tb_usuarios` */

DROP TABLE IF EXISTS `tb_usuarios`;

CREATE TABLE `tb_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `id_status_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`),
  KEY `id_tipo_usuario` (`id_tipo_usuario`),
  KEY `id_status_usuario` (`id_status_usuario`),
  CONSTRAINT `tb_usuarios_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tb_tipos_usuarios` (`id_tipo_usuario`),
  CONSTRAINT `tb_usuarios_ibfk_2` FOREIGN KEY (`id_status_usuario`) REFERENCES `status_usuarios` (`id_status_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_usuarios` */

insert  into `tb_usuarios`(`id_usuario`,`nome`,`senha`,`email`,`id_tipo_usuario`,`id_status_usuario`) values (1,'Administrador','$2y$10$djtr.z1wBlEBtMpEip3u1ulPa7S3JeQPG6rh5qbsKYX9eAPFHtrQW','admin@ecommercer.com.br',1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
