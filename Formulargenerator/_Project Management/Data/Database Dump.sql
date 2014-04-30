SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `Formulargenerator` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `Formulargenerator` ;

-- -----------------------------------------------------
-- Table `Formulargenerator`.`Mixed`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Formulargenerator`.`Mixed` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `Vorname` VARCHAR(35) NULL,
  `Nachname` VARCHAR(35) NOT NULL,
  `Geschlecht_r` ENUM('Männlich', 'Weiblich') NULL,
  `Newsletter` BIT NOT NULL DEFAULT 1,
  `Password_p` VARCHAR(256) NOT NULL,
  `Beschreibung_ta` TEXT NULL,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Formulargenerator`.`Input_required`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Formulargenerator`.`Input_required` (
  `Checkbox` BIT NOT NULL,
  `Color_c` VARCHAR(30) NOT NULL,
  `Date_d` VARCHAR(50) NOT NULL,
  `DateTime_dt` VARCHAR(50) NOT NULL,
  `DateTimeLocal_dtl` VARCHAR(50) NOT NULL,
  `EMail_e` VARCHAR(128) NOT NULL,
  `File_f` VARCHAR(256) NOT NULL,
  `Month_m` VARCHAR(15) NOT NULL,
  `Number_n` VARCHAR(10) NOT NULL,
  `Password_p` VARCHAR(256) NOT NULL,
  `Range_r` VARCHAR(20) NOT NULL,
  `Search_s` VARCHAR(64) NOT NULL,
  `Telephone_tel` VARCHAR(12) NOT NULL,
  `Text` VARCHAR(100) NOT NULL,
  `Time_t` VARCHAR(30) NOT NULL,
  `Url_u` VARCHAR(256) NOT NULL,
  `Week_w` VARCHAR(30) NOT NULL)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Formulargenerator`.`Non_input`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Formulargenerator`.`Non_input` (
  `Text1_ta` TEXT NOT NULL,
  `Text2_ta` TEXT NULL,
  `Select1` ENUM('a', 'b', 'c', 'd') NOT NULL,
  `Select2` ENUM('b', 'a', 'c', 'd') NULL,
  `radiobuttons1_r` ENUM('1', '2', '3') NOT NULL,
  `radiobuttons2_r` ENUM('1', '4', '3') NULL)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Formulargenerator`.`Input_not_required`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Formulargenerator`.`Input_not_required` (
  `Checkbox` BIT NULL,
  `Color_c` VARCHAR(30) NULL,
  `Date_d` VARCHAR(50) NULL,
  `DateTime_dt` VARCHAR(50) NULL,
  `DateTimeLocal_dtl` VARCHAR(50) NULL,
  `EMail_e` VARCHAR(128) NULL,
  `File_f` VARCHAR(256) NULL,
  `Month_m` VARCHAR(15) NULL,
  `Number_n` VARCHAR(10) NULL,
  `Password_p` VARCHAR(256) NULL,
  `Range_r` VARCHAR(20) NULL,
  `Search_s` VARCHAR(64) NULL,
  `Telephone_tel` VARCHAR(12) NULL,
  `Text` VARCHAR(100) NULL,
  `Time_t` VARCHAR(30) NULL,
  `Url_u` VARCHAR(256) NULL,
  `Week_w` VARCHAR(30) NULL)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
