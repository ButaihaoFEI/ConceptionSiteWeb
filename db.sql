-- MySQL Script generated by MySQL Workbench
-- 10/26/16 11:46:03
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema bddgr1004
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bddgr1004
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bddgr1004` DEFAULT CHARACTER SET utf8 ;
USE `bddgr1004` ;

-- -----------------------------------------------------
-- Table `bddgr1004`.`utilisateur`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bddgr1004`.`utilisateur` (
  `identifiant` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `motdepasse` VARCHAR(255) NOT NULL,
  `droits` INT ZEROFILL NOT NULL,
  PRIMARY KEY (`identifiant`),
  UNIQUE INDEX `identifiant_UNIQUE` (`identifiant` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bddgr1004`.`objet`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bddgr1004`.`objet` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `couleur` VARCHAR(45) NULL,
  `etat` INT ZEROFILL NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


INSERT INTO `bddgr1004`.`utilisateur` (`identifiant`, `email`, `motdepasse`, `droits`) VALUES (NULL, 'stu1@gmail.com', '$2y$10$thrFJsPQcx9fM9QXC82x2u1hgk2JDs.1cJ7DjHyU8qPmzHmxfGJS6', '0'), (NULL, 'stu2@gmail.com', '$2y$10$Y2a8pkGs5aBkMTP6Z63Ts.Pv9Le7wukNzJYJY6UTP0OOQLD4WdcES', '0');

INSERT INTO `bddgr1004`.`utilisateur` (`identifiant`, `email`, `motdepasse`, `droits`) VALUES (NULL, 'admin1@gmail.com', '$2y$10$/78g66mcqy74q93xglz9SuCkmILZsraS4IBTGrrqElaqz4qFBCpxO', '1'), (NULL, 'admin2@gmail.com', '$2y$10$HhiT45AklASyC4vdUvm4aeotFzRbUlduFSVzuCWABBtpd6lIcMKU.', '1');

INSERT INTO `bddgr1004`.`utilisateur` (`identifiant`, `email`, `motdepasse`, `droits`) VALUES (NULL, 'gestion1@gmail.com', '$2y$10$z5L4gl8KF3GWzE8XysEq9uywcX8mtsGEJ71IdMZWBlmI93xSzhyuy', '2');





SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
