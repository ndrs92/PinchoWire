-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema G23
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema G23
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `G23` DEFAULT CHARACTER SET utf8 ;
USE `G23` ;

-- -----------------------------------------------------
-- Table `G23`.`administrador`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `G23`.`administrador` ;

CREATE TABLE IF NOT EXISTS `G23`.`administrador` (
  `idemail` VARCHAR(40) NOT NULL,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `contrasena` VARCHAR(32) NULL DEFAULT NULL,
  `rutaavatar` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`idemail`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `G23`.`juradoprofesional`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `G23`.`juradoprofesional` ;

CREATE TABLE IF NOT EXISTS `G23`.`juradoprofesional` (
  `curriculum` TEXT NOT NULL,
  `idemail` VARCHAR(40) NOT NULL,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `contrasena` VARCHAR(32) NULL DEFAULT NULL,
  `rutaavatar` TEXT NULL DEFAULT NULL,
  `baneado` INT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idemail`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `G23`.`establecimiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `G23`.`establecimiento` ;

CREATE TABLE IF NOT EXISTS `G23`.`establecimiento` (
  `idemail` VARCHAR(40) NOT NULL,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `contrasena` VARCHAR(32) NULL DEFAULT NULL,
  `rutaavatar` TEXT NULL DEFAULT NULL,
  `direccion` VARCHAR(45) NULL DEFAULT NULL,
  `web` VARCHAR(45) NULL DEFAULT NULL,
  `horario` VARCHAR(45) NULL DEFAULT NULL,
  `rutaimagen` TEXT NULL DEFAULT NULL,
  `geoloc` VARCHAR(45) NULL DEFAULT NULL,
  `baneado` INT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idemail`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `G23`.`pincho`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `G23`.`pincho` ;

CREATE TABLE IF NOT EXISTS `G23`.`pincho` (
  `idnombre` VARCHAR(40) NOT NULL,
  `descripcion` TEXT NULL DEFAULT NULL,
  `precio` DOUBLE NULL DEFAULT NULL,
  `ingredientes` TEXT NULL DEFAULT NULL,
  `ganadorPopular` TINYINT(1) NULL DEFAULT NULL,
  `estadoPropuesta` INT(1) NULL DEFAULT NULL,
  `establecimiento_idemail` VARCHAR(40) NOT NULL,
  `rutaimagen` TEXT NOT NULL,
  PRIMARY KEY (`idnombre`),
  INDEX `fk_pincho_establecimiento1_idx` (`establecimiento_idemail` ASC),
  CONSTRAINT `fk_pincho_establecimiento1`
    FOREIGN KEY (`establecimiento_idemail`)
    REFERENCES `G23`.`establecimiento` (`idemail`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `G23`.`asignado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `G23`.`asignado` ;

CREATE TABLE IF NOT EXISTS `G23`.`asignado` (
  `juradoprofesional_idemail` VARCHAR(40) NOT NULL,
  `pincho_idnombre` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`juradoprofesional_idemail`, `pincho_idnombre`),
  INDEX `fk_juradoprofesional_has_Pincho1_Pincho1_idx` (`pincho_idnombre` ASC),
  INDEX `fk_juradoprofesional_has_Pincho1_juradoprofesional1_idx` (`juradoprofesional_idemail` ASC),
  CONSTRAINT `fk_juradoprofesional_has_Pincho1_juradoprofesional1`
    FOREIGN KEY (`juradoprofesional_idemail`)
    REFERENCES `G23`.`juradoprofesional` (`idemail`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_juradoprofesional_has_Pincho1_Pincho1`
    FOREIGN KEY (`pincho_idnombre`)
    REFERENCES `G23`.`pincho` (`idnombre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `G23`.`codigo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `G23`.`codigo` ;

CREATE TABLE IF NOT EXISTS `G23`.`codigo` (
  `pincho_idnombre` VARCHAR(40) NOT NULL,
  `idcodigo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idcodigo`),
  INDEX `fk_Codigo_Pincho1_idx` (`pincho_idnombre` ASC),
  CONSTRAINT `fk_Codigo_Pincho1`
    FOREIGN KEY (`pincho_idnombre`)
    REFERENCES `G23`.`pincho` (`idnombre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `G23`.`juradopopular`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `G23`.`juradopopular` ;

CREATE TABLE IF NOT EXISTS `G23`.`juradopopular` (
  `idemail` VARCHAR(40) NOT NULL,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `contrasena` VARCHAR(32) NULL DEFAULT NULL,
  `rutaavatar` TEXT NULL DEFAULT NULL,
  `baneado` INT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idemail`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `G23`.`canjea`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `G23`.`canjea` ;

CREATE TABLE IF NOT EXISTS `G23`.`canjea` (
  `codigo_idcodigo` VARCHAR(45) NOT NULL,
  `juradopopular_idemail` VARCHAR(40) NOT NULL,
  `fecha` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`codigo_idcodigo`, `juradopopular_idemail`),
  INDEX `fk_codigo_has_juradopopular_juradopopular1_idx` (`juradopopular_idemail` ASC),
  INDEX `fk_codigo_has_juradopopular_codigo1_idx` (`codigo_idcodigo` ASC),
  CONSTRAINT `fk_codigo_has_juradopopular_codigo1`
    FOREIGN KEY (`codigo_idcodigo`)
    REFERENCES `G23`.`codigo` (`idcodigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_codigo_has_juradopopular_juradopopular1`
    FOREIGN KEY (`juradopopular_idemail`)
    REFERENCES `G23`.`juradopopular` (`idemail`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `G23`.`comentario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `G23`.`comentario` ;

CREATE TABLE IF NOT EXISTS `G23`.`comentario` (
  `idcomentario` INT(11) NOT NULL AUTO_INCREMENT,
  `juradopopular_idemail` VARCHAR(40) NOT NULL,
  `pincho_idnombre` VARCHAR(40) NOT NULL,
  `contenido` TEXT NULL DEFAULT NULL,
  `fecha` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`idcomentario`),
  INDEX `fk_comentario_juradopopular1_idx` (`juradopopular_idemail` ASC),
  INDEX `fk_comentario_pincho1_idx` (`pincho_idnombre` ASC),
  CONSTRAINT `fk_comentario_juradopopular1`
    FOREIGN KEY (`juradopopular_idemail`)
    REFERENCES `G23`.`juradopopular` (`idemail`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentario_pincho1`
    FOREIGN KEY (`pincho_idnombre`)
    REFERENCES `G23`.`pincho` (`idnombre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 49
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `G23`.`concurso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `G23`.`concurso` ;

CREATE TABLE IF NOT EXISTS `G23`.`concurso` (
  `idconcurso` INT(2) NOT NULL,
  `descripcion` TEXT NOT NULL,
  `fecha` DATE NULL DEFAULT NULL,
  `rutaportada` VARCHAR(45) NULL DEFAULT NULL,
  `titulo` TEXT NOT NULL,
  `estado` INT(1) NOT NULL DEFAULT '0',
  `facebook` VARCHAR(45) NULL DEFAULT NULL,
  `twitter` VARCHAR(45) NULL DEFAULT NULL,
  `googleplus` VARCHAR(45) NULL DEFAULT NULL,
  `numfinalistas` INT(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idconcurso`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `G23`.`finalista`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `G23`.`finalista` ;

CREATE TABLE IF NOT EXISTS `G23`.`finalista` (
  `juradoprofesional_idemail` VARCHAR(40) NOT NULL,
  `pincho_idnombre` VARCHAR(40) NOT NULL,
  `ganadorFinalista` TINYINT(1) NULL DEFAULT NULL,
  `voto` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`juradoprofesional_idemail`, `pincho_idnombre`),
  INDEX `fk_juradoprofesional_has_pincho_pincho1_idx` (`pincho_idnombre` ASC),
  INDEX `fk_juradoprofesional_has_pincho_juradoprofesional1_idx` (`juradoprofesional_idemail` ASC),
  CONSTRAINT `fk_juradoprofesional_has_pincho_juradoprofesional2`
    FOREIGN KEY (`juradoprofesional_idemail`)
    REFERENCES `G23`.`juradoprofesional` (`idemail`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_juradoprofesional_has_pincho_pincho2`
    FOREIGN KEY (`pincho_idnombre`)
    REFERENCES `G23`.`pincho` (`idnombre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `G23`.`probado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `G23`.`probado` ;

CREATE TABLE IF NOT EXISTS `G23`.`probado` (
  `pincho_idnombre` VARCHAR(40) NOT NULL,
  `juradopopular_idemail` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`pincho_idnombre`, `juradopopular_idemail`),
  INDEX `fk_pincho_has_juradopopular_juradopopular2_idx` (`juradopopular_idemail` ASC),
  INDEX `fk_pincho_has_juradopopular_pincho2_idx` (`pincho_idnombre` ASC),
  CONSTRAINT `fk_pincho_has_juradopopular_juradopopular2`
    FOREIGN KEY (`juradopopular_idemail`)
    REFERENCES `G23`.`juradopopular` (`idemail`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pincho_has_juradopopular_pincho2`
    FOREIGN KEY (`pincho_idnombre`)
    REFERENCES `G23`.`pincho` (`idnombre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `G23`.`promociona`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `G23`.`promociona` ;

CREATE TABLE IF NOT EXISTS `G23`.`promociona` (
  `juradoprofesional_idemail` VARCHAR(40) NOT NULL,
  `pincho_idnombre` VARCHAR(40) NOT NULL,
  `voto` INT(11) NULL DEFAULT NULL,
  `esfinalista` BIT NULL,
  PRIMARY KEY (`juradoprofesional_idemail`, `pincho_idnombre`),
  INDEX `fk_juradoprofesional_has_Pincho_Pincho1_idx` (`pincho_idnombre` ASC),
  INDEX `fk_juradoprofesional_has_Pincho_juradoprofesional1_idx` (`juradoprofesional_idemail` ASC),
  CONSTRAINT `fk_juradoprofesional_has_Pincho_juradoprofesional1`
    FOREIGN KEY (`juradoprofesional_idemail`)
    REFERENCES `G23`.`juradoprofesional` (`idemail`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_juradoprofesional_has_Pincho_Pincho1`
    FOREIGN KEY (`pincho_idnombre`)
    REFERENCES `G23`.`pincho` (`idnombre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `G23`.`vota`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `G23`.`vota` ;

CREATE TABLE IF NOT EXISTS `G23`.`vota` (
  `pincho_idnombre` VARCHAR(40) NOT NULL,
  `juradopopular_idemail` VARCHAR(40) NOT NULL,
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  INDEX `fk_pincho_has_juradopopular_juradopopular1_idx` (`juradopopular_idemail` ASC),
  INDEX `fk_pincho_has_juradopopular_pincho1_idx` (`pincho_idnombre` ASC),
  CONSTRAINT `fk_pincho_has_juradopopular_juradopopular1`
    FOREIGN KEY (`juradopopular_idemail`)
    REFERENCES `G23`.`juradopopular` (`idemail`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pincho_has_juradopopular_pincho1`
    FOREIGN KEY (`pincho_idnombre`)
    REFERENCES `G23`.`pincho` (`idnombre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
