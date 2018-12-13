-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 11, 2018 at 06:43 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adminimoveis`
--
CREATE DATABASE IF NOT EXISTS `adminimoveis` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `adminimoveis`;

-- --------------------------------------------------------

--
-- Table structure for table `administradora`
--

DROP TABLE IF EXISTS `administradora`;
CREATE TABLE IF NOT EXISTS `administradora` (
  `CNPJ` varchar(14) NOT NULL,
  `razaoSocial` varchar(45) NOT NULL,
  `telefone` bigint(20) NOT NULL,
  `Endereço_idEndereço` int(11) NOT NULL,
  PRIMARY KEY (`CNPJ`),
  KEY `FK_Administradora_Endereço_idEndereço` (`Endereço_idEndereço`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administradora`
--

INSERT INTO `administradora` (`CNPJ`, `razaoSocial`, `telefone`, `Endereço_idEndereço`) VALUES
('73373162000149', 'Imobiliaria Salvador', 7124745158, 1);

-- --------------------------------------------------------

--
-- Table structure for table `aluguel`
--

DROP TABLE IF EXISTS `aluguel`;
CREATE TABLE IF NOT EXISTS `aluguel` (
  `numContrato` int(11) NOT NULL,
  `Unidade_numero` int(11) NOT NULL,
  `Unidade_Condomínio_nome` varchar(45) NOT NULL,
  `Cliente_CPF` varchar(11) NOT NULL,
  PRIMARY KEY (`numContrato`),
  KEY `FK_Aluguel_Unidade_PK` (`Unidade_numero`,`Unidade_Condomínio_nome`),
  KEY `FK_Aluguel_Cliente_CPF` (`Cliente_CPF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aluguel`
--

INSERT INTO `aluguel` (`numContrato`, `Unidade_numero`, `Unidade_Condomínio_nome`, `Cliente_CPF`) VALUES
(1, 7, 'Acacia', '42572914223'),
(2, 11, 'Acacia', '31246554599'),
(3, 4, 'Boa Vista', '97375835733');

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `CPF` varchar(11) NOT NULL DEFAULT '00000000000',
  `nome` varchar(45) NOT NULL,
  `telefone` bigint(20) NOT NULL,
  PRIMARY KEY (`CPF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`CPF`, `nome`, `telefone`) VALUES
('17457583050', 'Lucas', 11987654321),
('31246554599', 'João', 71964466706),
('42572914223', 'Laís', 71980142097),
('45401818721', 'Pedro', 71910109938),
('80147769873', 'Maria', 71962685017),
('97375835733', 'Ana', 71924745158);

-- --------------------------------------------------------

--
-- Table structure for table `condomínio`
--

DROP TABLE IF EXISTS `condomínio`;
CREATE TABLE IF NOT EXISTS `condomínio` (
  `nome` varchar(45) NOT NULL,
  `Endereço_idEndereço` int(11) NOT NULL,
  PRIMARY KEY (`nome`),
  KEY `FK_Condomínio_Endereço_idEndereço` (`Endereço_idEndereço`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `condomínio`
--

INSERT INTO `condomínio` (`nome`, `Endereço_idEndereço`) VALUES
('Boa Vista', 1),
('Acacia', 2);

-- --------------------------------------------------------

--
-- Table structure for table `endereço`
--

DROP TABLE IF EXISTS `endereço`;
CREATE TABLE IF NOT EXISTS `endereço` (
  `idEndereço` int(11) NOT NULL AUTO_INCREMENT,
  `rua` varchar(45) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(45) DEFAULT NULL,
  `CEP` varchar(8) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(2) NOT NULL,
  PRIMARY KEY (`idEndereço`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `endereço`
--

INSERT INTO `endereço` (`idEndereço`, `rua`, `numero`, `complemento`, `CEP`, `cidade`, `estado`) VALUES
(1, 'Av Tancredo Neves', 501, NULL, '41820901', 'Salvador', 'BA'),
(2, 'Av ACM', 100, NULL, '41825000', 'Salvador', 'BA'),
(3, 'Av ACM', 201, NULL, '41825000', 'Salvador', 'BA'),
(4, 'Av ACM', 102, NULL, '41825000', 'Salvador', 'BA'),
(5, 'Av ACM', 103, NULL, '41825000', 'Salvador', 'BA'),
(6, 'Av ACM', 105, NULL, '41825000', 'Salvador', 'BA'),
(7, 'Av OCEANICA', 3042, NULL, '40140900', 'Salvador', 'BA'),
(8, 'Av OCEANICA', 3043, NULL, '40140900', 'Salvador', 'BA'),
(9, 'Av OCEANICA', 3044, NULL, '40140900', 'Salvador', 'BA'),
(10, 'Av OCEANICA', 3045, NULL, '40140900', 'Salvador', 'BA'),
(11, 'Av OCEANICA', 3046, NULL, '40140900', 'Salvador', 'BA'),
(12, 'Av OCEANICA', 3047, NULL, '40140900', 'Salvador', 'BA'),
(13, 'Av OCEANICA', 3048, NULL, '40140900', 'Salvador', 'BA'),
(15, 'Av ACM', 204, 'Ap 201', '41825008', 'Salvador', 'BA'),
(16, 'Av ACM', 208, NULL, '41825010', 'Salvador', 'BA');

-- --------------------------------------------------------

--
-- Table structure for table `posse`
--

DROP TABLE IF EXISTS `posse`;
CREATE TABLE IF NOT EXISTS `posse` (
  `numContrato` int(11) NOT NULL,
  `Cliente_CPF` varchar(11) NOT NULL,
  `Unidade_numero` int(11) NOT NULL,
  `Unidade_Condomínio_nome` varchar(45) NOT NULL,
  PRIMARY KEY (`numContrato`),
  KEY `FK_Posse_Unidade_PK` (`Unidade_numero`,`Unidade_Condomínio_nome`),
  KEY `FK_Posse_Cliente_CPF` (`Cliente_CPF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posse`
--

INSERT INTO `posse` (`numContrato`, `Cliente_CPF`, `Unidade_numero`, `Unidade_Condomínio_nome`) VALUES
(1, '31246554599', 12, 'Acacia'),
(2, '31246554599', 10, 'Acacia'),
(3, '31246554599', 11, 'Acacia'),
(4, '45401818721', 8, 'Acacia'),
(5, '80147769873', 9, 'Acacia'),
(6, '80147769873', 1, 'Boa Vista');

-- --------------------------------------------------------

--
-- Table structure for table `unidade`
--

DROP TABLE IF EXISTS `unidade`;
CREATE TABLE IF NOT EXISTS `unidade` (
  `numero` int(11) NOT NULL AUTO_INCREMENT,
  `Condomínio_nome` varchar(45) NOT NULL,
  `Administradora_CNPJ` varchar(14) NOT NULL,
  `Endereço_idEndereço` int(11) NOT NULL,
  PRIMARY KEY (`numero`,`Condomínio_nome`),
  KEY `FK_Unidade_Administradora_CNPJ` (`Administradora_CNPJ`),
  KEY `FK_Unidade_Condomínio_nome` (`Condomínio_nome`),
  KEY `FK_Unidade_Endereço_idEndereço` (`Endereço_idEndereço`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unidade`
--

INSERT INTO `unidade` (`numero`, `Condomínio_nome`, `Administradora_CNPJ`, `Endereço_idEndereço`) VALUES
(1, 'Boa Vista', '73373162000149', 2),
(2, 'Boa Vista', '73373162000149', 3),
(3, 'Boa Vista', '73373162000149', 4),
(4, 'Boa Vista', '73373162000149', 5),
(5, 'Boa Vista', '73373162000149', 6),
(6, 'Acacia', '73373162000149', 7),
(7, 'Acacia', '73373162000149', 8),
(8, 'Acacia', '73373162000149', 9),
(9, 'Acacia', '73373162000149', 10),
(10, 'Acacia', '73373162000149', 11),
(11, 'Acacia', '73373162000149', 12),
(12, 'Acacia', '73373162000149', 13);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administradora`
--
ALTER TABLE `administradora`
  ADD CONSTRAINT `FK_Administradora_Endereço_idEndereço` FOREIGN KEY (`Endereço_idEndereço`) REFERENCES `endereço` (`idEndereço`);

--
-- Constraints for table `aluguel`
--
ALTER TABLE `aluguel`
  ADD CONSTRAINT `FK_Aluguel_Cliente_CPF` FOREIGN KEY (`Cliente_CPF`) REFERENCES `cliente` (`CPF`),
  ADD CONSTRAINT `FK_Aluguel_Unidade_PK` FOREIGN KEY (`Unidade_numero`,`Unidade_Condomínio_nome`) REFERENCES `unidade` (`numero`, `Condomínio_nome`);

--
-- Constraints for table `condomínio`
--
ALTER TABLE `condomínio`
  ADD CONSTRAINT `FK_Condomínio_Endereço_idEndereço` FOREIGN KEY (`Endereço_idEndereço`) REFERENCES `endereço` (`idEndereço`);

--
-- Constraints for table `posse`
--
ALTER TABLE `posse`
  ADD CONSTRAINT `FK_Posse_Cliente_CPF` FOREIGN KEY (`Cliente_CPF`) REFERENCES `cliente` (`CPF`),
  ADD CONSTRAINT `FK_Posse_Unidade_PK` FOREIGN KEY (`Unidade_numero`,`Unidade_Condomínio_nome`) REFERENCES `unidade` (`numero`, `Condomínio_nome`);

--
-- Constraints for table `unidade`
--
ALTER TABLE `unidade`
  ADD CONSTRAINT `FK_Unidade_Administradora_CNPJ` FOREIGN KEY (`Administradora_CNPJ`) REFERENCES `administradora` (`CNPJ`),
  ADD CONSTRAINT `FK_Unidade_Condomínio_nome` FOREIGN KEY (`Condomínio_nome`) REFERENCES `condomínio` (`nome`),
  ADD CONSTRAINT `FK_Unidade_Endereço_idEndereço` FOREIGN KEY (`Endereço_idEndereço`) REFERENCES `endereço` (`idEndereço`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
