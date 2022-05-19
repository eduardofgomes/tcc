
-- -----------------------------------------------------
-- Schema quadra
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema quadra
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `quadra` DEFAULT CHARACTER SET utf8 ;
USE `quadra` ;

-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------
CREATE TABLE `usuario` (
  `login` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC) ,
  UNIQUE INDEX `tipo_usuario_idtable2_UNIQUE` (`id_usuario` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cidadao`
-- -----------------------------------------------------
CREATE TABLE `cidadao` (
  `id_cidadao` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `foto` MEDIUMBLOB NOT NULL,
  `senha` VARCHAR(30) NOT NULL,
  `rg` VARCHAR(9) NOT NULL,
  `usuario_id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_cidadao`),
  UNIQUE INDEX `idusuario_UNIQUE` (`id_cidadao` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  UNIQUE INDEX `rg_UNIQUE` (`rg` ASC) ,
  INDEX `fk_cidadao_usuario1_idx` (`usuario_id_usuario` ASC) ,
  CONSTRAINT `fk_cidadao_usuario1`
    FOREIGN KEY (`usuario_id_usuario`)
    REFERENCES `usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tipo_usuario`
-- -----------------------------------------------------
CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NOT NULL,
  `usuario_id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`),
  UNIQUE INDEX `id_usuario_UNIQUE` (`id_tipo_usuario` ASC) ,
  INDEX `fk_tipo_usuario_usuario1_idx` (`usuario_id_usuario` ASC) ,
  CONSTRAINT `fk_tipo_usuario_usuario1`
    FOREIGN KEY (`usuario_id_usuario`)
    REFERENCES `usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reservas`
-- -----------------------------------------------------
CREATE TABLE `reservas` (
  `id_reserva` INT NOT NULL AUTO_INCREMENT,
  `data` DATETIME(6) NOT NULL,
  `usuario_id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_reserva`),
  UNIQUE INDEX `data_UNIQUE` (`data` ASC) ,
  INDEX `fk_reservas_usuario1_idx` (`usuario_id_usuario` ASC) ,
  CONSTRAINT `fk_reservas_usuario1`
    FOREIGN KEY (`usuario_id_usuario`)
    REFERENCES `usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `quadras`
-- -----------------------------------------------------
CREATE TABLE `quadras` (
  `id_quadras` INT NOT NULL AUTO_INCREMENT,
  `numero` INT(6) NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `bairro` VARCHAR(45) NOT NULL,
  `logradouro` VARCHAR(45) NOT NULL,
  `reservas_id_reserva` INT NOT NULL,
  PRIMARY KEY (`id_quadras`),
  UNIQUE INDEX `id_quadras_UNIQUE` (`id_quadras` ASC) ,
  INDEX `fk_quadras_reservas1_idx` (`reservas_id_reserva` ASC) ,
  CONSTRAINT `fk_quadras_reservas1`
    FOREIGN KEY (`reservas_id_reserva`)
    REFERENCES `reservas` (`id_reserva`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

