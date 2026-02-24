-- MySQL Script optimized for phpMyAdmin
-- Model: ProgSENA
-- Date: Feb 2026

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- -----------------------------------------------------
-- Schema ProgSENA
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ProgSENA` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ProgSENA`;

-- -----------------------------------------------------
-- Table `TITULO_PROGRAMA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TITULO_PROGRAMA` (
  `titpro_id` INT(11) NOT NULL,
  `titpro_nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`titpro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------
-- Table `PROGRAMA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PROGRAMA` (
  `prog_codigo` INT(11) NOT NULL,
  `prog_denominacion` VARCHAR(100) NOT NULL,
  `TIT_PROGRAMA_titpro_id` INT(11) NOT NULL,
  `prog_tipo` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`prog_codigo`),
  KEY `fk_PROGRAMA_TIPO_PROGRAMA_idx` (`TIT_PROGRAMA_titpro_id`),
  CONSTRAINT `fk_PROGRAMA_TIPO_PROGRAMA` FOREIGN KEY (`TIT_PROGRAMA_titpro_id`) REFERENCES `TITULO_PROGRAMA` (`titpro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------
-- Table `COMPETENCIA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `COMPETENCIA` (
  `comp_id` INT(11) NOT NULL,
  `comp_nombre_corto` VARCHAR(30) NOT NULL,
  `comp_horas` INT(11) NOT NULL,
  `comp_nombre_unidad_competencia` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`comp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------
-- Table `CENTRO_FORMACION`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CENTRO_FORMACION` (
  `cent_id` INT(11) NOT NULL,
  `cent_nombre` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`cent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------
-- Table `INSTRUCTOR`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `INSTRUCTOR` (
  `inst_id` INT(11) NOT NULL,
  `inst_nombres` VARCHAR(45) NOT NULL,
  `inst_apellidos` VARCHAR(45) NOT NULL,
  `inst_correo` VARCHAR(45) NOT NULL,
  `inst_telefono` BIGINT(20) NOT NULL,
  `CENTRO_FORMACION_cent_id` INT(11) NOT NULL,
  `inst_password` VARCHAR(255) NOT NULL, -- Ampliado para permitir hashes (ej. bcrypt)
  PRIMARY KEY (`inst_id`),
  KEY `fk_INSTRUCTOR_CENTRO_FORMACION1_idx` (`CENTRO_FORMACION_cent_id`),
  CONSTRAINT `fk_INSTRUCTOR_CENTRO_FORMACION1` FOREIGN KEY (`CENTRO_FORMACION_cent_id`) REFERENCES `CENTRO_FORMACION` (`cent_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------
-- Table `COMPETxPROGRAMA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `COMPETxPROGRAMA` (
  `PROGRAMA_prog_id` INT(11) NOT NULL,
  `COMPETENCIA_comp_id` INT(11) NOT NULL,
  PRIMARY KEY (`PROGRAMA_prog_id`,`COMPETENCIA_comp_id`),
  KEY `fk_COMPETxPROGRAMA_COMPETENCIA1_idx` (`COMPETENCIA_comp_id`),
  CONSTRAINT `fk_COMPETxPROGRAMA_COMPETENCIA1` FOREIGN KEY (`COMPETENCIA_comp_id`) REFERENCES `COMPETENCIA` (`comp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_COMPETxPROGRAMA_PROGRAMA1` FOREIGN KEY (`PROGRAMA_prog_id`) REFERENCES `PROGRAMA` (`prog_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------
-- Table `COORDINACION`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `COORDINACION` (
  `coord_id` INT(11) NOT NULL,
  `coord_descripcion` VARCHAR(45) NOT NULL,
  `CENTRO_FORMACION_cent_id` INT(11) NOT NULL,
  `coord_nombre_coordinador` VARCHAR(45) NOT NULL,
  `coord_correo` VARCHAR(45) NOT NULL,
  `coord_password` VARCHAR(255) NOT NULL, -- Ampliado para permitir hashes
  PRIMARY KEY (`coord_id`),
  KEY `fk_COORDINACION_CENTRO_FORMACION1_idx` (`CENTRO_FORMACION_cent_id`),
  CONSTRAINT `fk_COORDINACION_CENTRO_FORMACION1` FOREIGN KEY (`CENTRO_FORMACION_cent_id`) REFERENCES `CENTRO_FORMACION` (`cent_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------
-- Table `FICHA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `FICHA` (
  `fich_id` INT(11) NOT NULL,
  `PROGRAMA_prog_id` INT(11) NOT NULL,
  `INSTRUCTOR_inst_id_lider` INT(11) NOT NULL,
  `fich_jornada` VARCHAR(20) NOT NULL,
  `COORDINACION_coord_id` INT(11) NOT NULL,
  `fich_fecha_ini_lectiva` DATE NOT NULL,
  `fich_fecha_fin_lectiva` DATE NOT NULL,
  PRIMARY KEY (`fich_id`),
  KEY `fk_FICHA_PROGRAMA1_idx` (`PROGRAMA_prog_id`),
  KEY `fk_FICHA_INSTRUCTOR1_idx` (`INSTRUCTOR_inst_id_lider`),
  KEY `fk_FICHA_COORDINACION1_idx` (`COORDINACION_coord_id`),
  CONSTRAINT `fk_FICHA_COORDINACION1` FOREIGN KEY (`COORDINACION_coord_id`) REFERENCES `COORDINACION` (`coord_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_FICHA_INSTRUCTOR1` FOREIGN KEY (`INSTRUCTOR_inst_id_lider`) REFERENCES `INSTRUCTOR` (`inst_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_FICHA_PROGRAMA1` FOREIGN KEY (`PROGRAMA_prog_id`) REFERENCES `PROGRAMA` (`prog_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------
-- Table `SEDE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SEDE` (
  `sede_id` INT(11) NOT NULL,
  `sede_nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`sede_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------
-- Table `AMBIENTE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AMBIENTE` (
  `amb_id` VARCHAR(5) NOT NULL,
  `amb_nombre` VARCHAR(45) DEFAULT NULL,
  `SEDE_sede_id` INT(11) NOT NULL,
  PRIMARY KEY (`amb_id`),
  KEY `fk_AMBIENTE_SEDE1_idx` (`SEDE_sede_id`),
  CONSTRAINT `fk_AMBIENTE_SEDE1` FOREIGN KEY (`SEDE_sede_id`) REFERENCES `SEDE` (`sede_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------
-- Table `ASIGNACION`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ASIGNACION` (
  `ASIG_ID` INT(11) NOT NULL AUTO_INCREMENT,
  `INSTRUCTOR_inst_id` INT(11) NOT NULL,
  `asig_fecha_ini` DATETIME NOT NULL,
  `asig_fecha_fin` DATETIME NOT NULL,
  `FICHA_fich_id` INT(11) NOT NULL,
  `AMBIENTE_amb_id` VARCHAR(5) NOT NULL, -- Ajustado para emparejar con AMBIENTE.amb_id (VARCHAR 5)
  `COMPETENCIA_comp_id` INT(11) NOT NULL,
  PRIMARY KEY (`ASIG_ID`),
  KEY `fk_ASIGNACION_INSTRUCTOR1_idx` (`INSTRUCTOR_inst_id`),
  KEY `fk_ASIGNACION_FICHA1_idx` (`FICHA_fich_id`),
  KEY `fk_ASIGNACION_AMBIENTE1_idx` (`AMBIENTE_amb_id`),
  KEY `fk_ASIGNACION_COMPETENCIA1_idx` (`COMPETENCIA_comp_id`),
  CONSTRAINT `fk_ASIGNACION_AMBIENTE1` FOREIGN KEY (`AMBIENTE_amb_id`) REFERENCES `AMBIENTE` (`amb_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ASIGNACION_COMPETENCIA1` FOREIGN KEY (`COMPETENCIA_comp_id`) REFERENCES `COMPETENCIA` (`comp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ASIGNACION_FICHA1` FOREIGN KEY (`FICHA_fich_id`) REFERENCES `FICHA` (`fich_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ASIGNACION_INSTRUCTOR1` FOREIGN KEY (`INSTRUCTOR_inst_id`) REFERENCES `INSTRUCTOR` (`inst_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------
-- Table `DETALLExASIGNACION`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DETALLExASIGNACION` (
  `detasig_id` INT(11) NOT NULL AUTO_INCREMENT,
  `ASIGNACION_ASIG_ID` INT(11) NOT NULL,
  `detasig_hora_ini` DATETIME NOT NULL,
  `detasig_hora_fin` DATETIME NOT NULL,
  PRIMARY KEY (`detasig_id`),
  KEY `fk_DETALLExASIGNACION_ASIGNACION1_idx` (`ASIGNACION_ASIG_ID`),
  CONSTRAINT `fk_DETALLExASIGNACION_ASIGNACION1` FOREIGN KEY (`ASIGNACION_ASIG_ID`) REFERENCES `ASIGNACION` (`ASIG_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------
-- Table `INSTRU_COMPETENCIA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `INSTRU_COMPETENCIA` (
  `inscomp_id` INT(11) NOT NULL AUTO_INCREMENT,
  `INSTRUCTOR_inst_id` INT(11) NOT NULL,
  `COMPETxPROGRAMA_PROGRAMA_prog_id` INT(11) NOT NULL,
  `COMPETxPROGRAMA_COMPETENCIA_comp_id` INT(11) NOT NULL,
  `inscomp_vigencia` DATE NOT NULL,
  PRIMARY KEY (`inscomp_id`),
  KEY `fk_INSTRU_COMPETENCIA_COMPETxPROGRAMA1_idx` (`COMPETxPROGRAMA_PROGRAMA_prog_id`,`COMPETxPROGRAMA_COMPETENCIA_comp_id`),
  KEY `fk_INSTRU_COMPETENCIA_INSTRUCTOR1_idx` (`INSTRUCTOR_inst_id`),
  CONSTRAINT `fk_INSTRU_COMPETENCIA_COMPETxPROGRAMA1` FOREIGN KEY (`COMPETxPROGRAMA_PROGRAMA_prog_id`, `COMPETxPROGRAMA_COMPETENCIA_comp_id`) REFERENCES `COMPETxPROGRAMA` (`PROGRAMA_prog_id`, `COMPETENCIA_comp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_INSTRU_COMPETENCIA_INSTRUCTOR1` FOREIGN KEY (`INSTRUCTOR_inst_id`) REFERENCES `INSTRUCTOR` (`inst_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;

-- Inserción de un Coordinador Base para poder iniciar sesión inicialmente
-- La contraseña será 'admin123' (podremos editarla luego o encriptarla más adelante)
INSERT INTO `CENTRO_FORMACION` (`cent_id`, `cent_nombre`) VALUES (1, 'Centro Base Principal');
INSERT INTO `COORDINACION` (`coord_id`, `coord_descripcion`, `CENTRO_FORMACION_cent_id`, `coord_nombre_coordinador`, `coord_correo`, `coord_password`) 
VALUES (1, 'Coordinación General', 1, 'Admin Sistema', 'admin@sena.edu.co', '$2y$10$qKvIsPxVzXYOf6tobuinWOfZ14UtfwpjKGt3ZT8uT1A1T8Dy/7S6i');
