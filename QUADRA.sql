-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Set-2022 às 14:23
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `quadra`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `CIDADAO`
--

CREATE TABLE `CIDADAO` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `NOME` VARCHAR(45) NOT NULL,
  `EMAIL` VARCHAR(45) NOT NULL,
  `FOTO` MEDIUMBLOB NOT NULL,
  `SENHA` VARCHAR(30) NOT NULL,
  `RG` VARCHAR(9) NOT NULL,
  `USUARIO_ID` INT NOT NULL,
  `TIPO_ID` INT(1) NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;

-- --------------------------------------------------------

--
-- Estrutura da tabela `QUADRAS`
--

CREATE  TABLE `QUADRAS` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `NUMERO` INT(6) NOT NULL,
  `NOME` VARCHAR(45) NOT NULL,
  `BAIRRO` VARCHAR(45) NOT NULL,
  `LOGRADOURO` VARCHAR(45) NOT NULL,
  `RESERVAS_ID` INT(11) NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;

-- --------------------------------------------------------

--
-- Estrutura da tabela `RESERVAS`
--

CREATE  TABLE `RESERVAS` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `DATA` DATETIME(6) NOT NULL,
  `USUARIO_ID` INT(11) NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;

-- --------------------------------------------------------

--
-- Estrutura da tabela `TIPO_USUARIO`
--

CREATE  TABLE `TIPO_USUARIO` (
  `ID` INT(5) NOT NULL AUTO_INCREMENT,
  `NOME` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;

--
-- Extraindo dados da tabela `TIPO_USUARIO`
--

INSERT INTO `TIPO_USUARIO` (`ID`, `NOME`) VALUES
(1, 'Cidadão'),
(2, 'ADM'),
(3, 'Zelador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `USUARIO`
--

CREATE TABLE `USUARIO` (
  `LOGIN` varchar(45) NOT NULL,
  `SENHA` varchar(45) NOT NULL,
  `ID` INT(11) NOT NULL,
  `EMAIL` varchar(45) NOT NULL,
  `TIPO_ID_USER` INT(1) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE `USUARIO` (
  `LOGIN` VARCHAR(45) NOT NULL,
  `SENHA` VARCHAR(45) NOT NULL,
  `ID` INT NOT NULL AUTO_INCREMENT,
  `EMAIL` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;

--
-- Extraindo dados da tabela `USUARIO`
--

INSERT INTO `USUARIO` (`LOGIN`, `SENHA`, `ID`, `EMAIL`, `TIPO_ID_USER`) VALUES
('totozo', '202cb962ac59075b964b07152d234b70', 1, 'natan@gmail.com', 3);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `CIDADAO`
--
ALTER TABLE `CIDADAO`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `QUADRAS`
--
ALTER TABLE `QUADRAS`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `RESERVAS`
--
ALTER TABLE `RESERVAS`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `TIPO_USUARIO`
--
ALTER TABLE `TIPO_USUARIO`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `CIDADAO`
--
ALTER TABLE `CIDADAO`
  MODIFY `ID` INT(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `QUADRAS`
--
ALTER TABLE `QUADRAS`
  MODIFY `ID` INT(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `RESERVAS`
--
ALTER TABLE `RESERVAS`
  MODIFY `ID` INT(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `TIPO_USUARIO`
--
ALTER TABLE `TIPO_USUARIO`
  MODIFY `ID` INT(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `USUARIO`
--
ALTER TABLE `USUARIO`
  MODIFY `ID` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
