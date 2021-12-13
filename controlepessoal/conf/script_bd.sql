-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema controlepessoal
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema controlepessoal
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `controlepessoal` DEFAULT CHARACTER SET utf8mb4 ;
USE `controlepessoal` ;

-- -----------------------------------------------------
-- Table `controlepessoal`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controlepessoal`.`usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `user` VARCHAR(255) NOT NULL,
  `pass` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `controlepessoal`.`valores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controlepessoal`.`valores` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `valor` FLOAT NOT NULL,
  `usuarios_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_valores_usuarios_idx` (`usuarios_id` ASC),
  CONSTRAINT `fk_valores_usuarios`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `controlepessoal`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `controlepessoal`.`gastos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controlepessoal`.`gastos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `gasto` FLOAT NOT NULL,
  `usuarios_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_gastos_usuarios1_idx` (`usuarios_id` ASC),
  CONSTRAINT `fk_gastos_usuarios1`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `controlepessoal`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
INSERT INTO `controlepessoal`.`usuarios` (`nome`,`user`,`pass`,`email`)
VALUES ('Administrador','admin','d033e22ae348aeb5660fc2140aec35850c4da997','admin@admin.edu.br');
INSERT INTO `controlepessoal`.`usuarios` (`nome`, `user`, `pass`, `email`) 
VALUES ('Fulano', 'user', '12dea96fec20593566ab75692c9949596833adc9', 'fulano@email.com');