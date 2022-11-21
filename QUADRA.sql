

-- --------------------------------------------------------
--
-- Estrutura da tabela `QUADRAS`
--

CREATE  TABLE `QUADRAS` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `NUMERO` INT(6) NOT NULL,
  `NOME` VARCHAR(45) NOT NULL,
  `BAIRRO` VARCHAR(45) NOT NULL,
  `LOGRADOURO` VARCHAR(45) NOT NULL,
  `RESERVAS_ID` INT NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;

-- --------------------------------------------------------
--
-- Estrutura da tabela `RESERVAS`
--

CREATE  TABLE `RESERVAS` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `DATA` DATETIME(6) NOT NULL,
  `USUARIO_ID` INT NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;

-- --------------------------------------------------------

--
-- Estrutura da tabela `TIPO_USUARIO`
--

CREATE  TABLE `TIPO` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `NOME` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;



-- --------------------------------------------------------

--
-- Estrutura da tabela `USUARIO`
--


CREATE TABLE `USUARIO` (
  `SENHA` varchar(45) NOT NULL,
  `ID` INT NOT NULL AUTO_INCREMENT,
  `EMAIL` varchar(45) NOT NULL,
  `TIPO_ID` INT NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;

/*
CREATE TABLE `USUARIO` (
  `LOGIN` VARCHAR(45) NOT NULL,
  `SENHA` VARCHAR(45) NOT NULL,
  `ID` INT NOT NULL AUTO_INCREMENT,
  `EMAIL` VARCHAR(45) NOT NULL,
  `TIPO_ID` INT NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;
*/

-- Estrutura da tabela `CIDADAO`
--

CREATE TABLE `CIDADAO` (
  `ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `NOME` VARCHAR(45) NOT NULL,
  `FOTO` MEDIUMBLOB NOT NULL,
  `CPF` VARCHAR(11) NOT NULL,
  `USUARIO_ID` INT NOT NULL,
  CONSTRAINT fk_usu_cid FOREIGN KEY(`USUARIO_ID`) REFERENCES USUARIO (`ID`)
  )
ENGINE = InnoDB;