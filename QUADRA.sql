-- -----------------------------------------------------
-- Table `quadra`.`USUARIO`
-- -----------------------------------------------------
CREATE TABLE `USUARIO` (
  `LOGIN` VARCHAR(45) NOT NULL,
  `SENHA` VARCHAR(45) NOT NULL,
  `ID` INT NOT NULL AUTO_INCREMENT,
  `EMAIL` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `quadra`.`CIDADAO`
-- -----------------------------------------------------
CREATE TABLE `CIDADAO` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `NOME` VARCHAR(45) NOT NULL,
  `EMAIL` VARCHAR(45) NOT NULL,
  `FOTO` MEDIUMBLOB NOT NULL,
  `SENHA` VARCHAR(30) NOT NULL,
  `RG` VARCHAR(9) NOT NULL,
  `USUARIO_ID` INT NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `quadra`.`TIPO_USUARIO`
-- -----------------------------------------------------
CREATE  TABLE `TIPO_USUARIO` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `TIPO` VARCHAR(45) NOT NULL,
  `USUARIO_ID` INT NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `quadra`.`RESERVAS`
-- -----------------------------------------------------
CREATE  TABLE `RESERVAS` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `DATA` DATETIME(6) NOT NULL,
  `USUARIO_ID` INT NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `quadra`.`QUADRAS`
-- -----------------------------------------------------
CREATE  TABLE `QUADRAS` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `NUMERO` INT(6) NOT NULL,
  `NOME` VARCHAR(45) NOT NULL,
  `BAIRRO` VARCHAR(45) NOT NULL,
  `LOGRADOURO` VARCHAR(45) NOT NULL,
  `RESERVAS_ID` INT NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;