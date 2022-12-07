-- --------------------------------------------------------
--
-- Estrutura da tabela `RESERVAS`
--

CREATE  TABLE `QUADRAS` (
  `ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `NUMERO` INT(6) NOT NULL,
  `NOME` VARCHAR(45) NOT NULL,
  `BAIRRO` VARCHAR(45) NOT NULL,
  `LOGRADOURO` VARCHAR(45) NOT NULL
  )
ENGINE = InnoDB;

CREATE TABLE `DIA` (
  `ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `DIA` DATE NOT NULL,
  `QUADRAS_ID` INT NOT NULL,
  CONSTRAINT fk_quadra_dia FOREIGN KEY(`QUADRAS_ID`) REFERENCES QUADRAS (`ID`))
ENGINE = InnoDB;

CREATE TABLE `HORARIO` (
  `ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `HORARIO` DATE NOT NULL,
  `QUADRAS_ID` INT NOT NULL,
  CONSTRAINT fk_quadra_horario FOREIGN KEY(`QUADRAS_ID`) REFERENCES QUADRAS (`ID`))
ENGINE = InnoDB;
-- --------------------------------------------------------




-- --------------------------------------------------------

--
-- Estrutura da tabela `TIPO_USUARIO`
--

CREATE  TABLE `TIPO` (
  `ID` INT NOT NULL,
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


CREATE TABLE `CIDADAO` (
  `ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `NOME` VARCHAR(45) NOT NULL,
  `FOTO` MEDIUMBLOB NOT NULL,
  `CPF` VARCHAR(11) NOT NULL,
  `USUARIO_ID` INT NOT NULL,
  CONSTRAINT fk_usu_cid FOREIGN KEY(`USUARIO_ID`) REFERENCES USUARIO (`ID`)
  )
ENGINE = InnoDB;

-- --------------------------------------------------------

-- Dados da tabela `TIPO`

INSERT INTO TIPO (ID, NOME) VALUES (1, "ADM");
INSERT INTO TIPO (ID, NOME) VALUES (2, "Cidadão");
INSERT INTO TIPO (ID, NOME) VALUES (3, "Zelador");

-- --------------------------------------------------------

