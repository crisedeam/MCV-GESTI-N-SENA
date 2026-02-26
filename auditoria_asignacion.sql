-- ============================================================================
-- SCRIPT DE CREACIÓN DE TABLA DE AUDITORÍA Y TRIGGERS PARA 'ASIGNACION'
-- ============================================================================

-- 1. CREACIÓN DE LA TABLA DE AUDITORÍA
CREATE TABLE IF NOT EXISTS `AUDITORIA_ASIGNACION` (
  `audit_id` INT(11) NOT NULL AUTO_INCREMENT,
  `ASIGNACION_ASIG_ID` INT(11) NOT NULL,
  `audit_accion` VARCHAR(15) NOT NULL COMMENT 'INSERT, UPDATE, o DELETE',
  `audit_fecha_hora` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_ejecutor` VARCHAR(100) DEFAULT NULL COMMENT 'ID o Rol del usuario que hizo el cambio',
  `datos_anteriores` JSON DEFAULT NULL COMMENT 'Datos antes de modificar o eliminar',
  `datos_nuevos` JSON DEFAULT NULL COMMENT 'Datos después de crear o modificar',
  PRIMARY KEY (`audit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================================
-- 2. CREACIÓN DE TRIGGERS
-- ============================================================================
-- Un "Trigger" es un disparador que se ejecuta automáticamente en MySQL
-- cuando ocurre un evento (INSERT, UPDATE o DELETE) en una tabla específica.

DELIMITER //

-- ----------------------------------------------------------------------------
-- TRIGGER PARA CUANDO SE CREA UNA NUEVA ASIGNACIÓN (INSERT)
-- ----------------------------------------------------------------------------
DROP TRIGGER IF EXISTS `trg_asignacion_after_insert`//
CREATE TRIGGER `trg_asignacion_after_insert`
AFTER INSERT ON `asignacion`
FOR EACH ROW
BEGIN
    INSERT INTO `AUDITORIA_ASIGNACION` (
        `ASIGNACION_ASIG_ID`, 
        `audit_accion`, 
        `usuario_ejecutor`, 
        `datos_anteriores`, 
        `datos_nuevos`
    ) VALUES (
        NEW.ASIG_ID,
        'INSERT',
        @usuario_actual, -- Esta variable la enviaremos desde PHP antes del INSERT
        NULL,            -- Como es nuevo, no hay datos anteriores
        JSON_OBJECT(     -- Guardamos todos los datos nuevos en formato JSON
            'INSTRUCTOR_inst_id', NEW.INSTRUCTOR_inst_id,
            'asig_fecha_ini', NEW.asig_fecha_ini,
            'asig_fecha_fin', NEW.asig_fecha_fin,
            'FICHA_fich_id', NEW.FICHA_fich_id,
            'AMBIENTE_amb_id', NEW.AMBIENTE_amb_id,
            'COMPETENCIA_comp_id', NEW.COMPETENCIA_comp_id
        )
    );
END//

-- ----------------------------------------------------------------------------
-- TRIGGER PARA CUANDO SE MODIFICA UNA ASIGNACIÓN (UPDATE)
-- ----------------------------------------------------------------------------
DROP TRIGGER IF EXISTS `trg_asignacion_after_update`//
CREATE TRIGGER `trg_asignacion_after_update`
AFTER UPDATE ON `asignacion`
FOR EACH ROW
BEGIN
    INSERT INTO `AUDITORIA_ASIGNACION` (
        `ASIGNACION_ASIG_ID`, 
        `audit_accion`, 
        `usuario_ejecutor`, 
        `datos_anteriores`, 
        `datos_nuevos`
    ) VALUES (
        NEW.ASIG_ID,
        'UPDATE',
        @usuario_actual,
        JSON_OBJECT(     -- Guardamos cómo estaba ANTES (OLD)
            'INSTRUCTOR_inst_id', OLD.INSTRUCTOR_inst_id,
            'asig_fecha_ini', OLD.asig_fecha_ini,
            'asig_fecha_fin', OLD.asig_fecha_fin,
            'FICHA_fich_id', OLD.FICHA_fich_id,
            'AMBIENTE_amb_id', OLD.AMBIENTE_amb_id,
            'COMPETENCIA_comp_id', OLD.COMPETENCIA_comp_id
        ),
        JSON_OBJECT(     -- Guardamos cómo quedó DESPUÉS (NEW)
            'INSTRUCTOR_inst_id', NEW.INSTRUCTOR_inst_id,
            'asig_fecha_ini', NEW.asig_fecha_ini,
            'asig_fecha_fin', NEW.asig_fecha_fin,
            'FICHA_fich_id', NEW.FICHA_fich_id,
            'AMBIENTE_amb_id', NEW.AMBIENTE_amb_id,
            'COMPETENCIA_comp_id', NEW.COMPETENCIA_comp_id
        )
    );
END//

-- ----------------------------------------------------------------------------
-- TRIGGER PARA CUANDO SE ELIMINA UNA ASIGNACIÓN (DELETE)
-- ----------------------------------------------------------------------------
DROP TRIGGER IF EXISTS `trg_asignacion_before_delete`//
CREATE TRIGGER `trg_asignacion_before_delete`
BEFORE DELETE ON `asignacion`
FOR EACH ROW
BEGIN
    INSERT INTO `AUDITORIA_ASIGNACION` (
        `ASIGNACION_ASIG_ID`, 
        `audit_accion`, 
        `usuario_ejecutor`, 
        `datos_anteriores`, 
        `datos_nuevos`
    ) VALUES (
        OLD.ASIG_ID,
        'DELETE',
        @usuario_actual,
        JSON_OBJECT(     -- Guardamos los datos antes de que se borren para siempre
            'INSTRUCTOR_inst_id', OLD.INSTRUCTOR_inst_id,
            'asig_fecha_ini', OLD.asig_fecha_ini,
            'asig_fecha_fin', OLD.asig_fecha_fin,
            'FICHA_fich_id', OLD.FICHA_fich_id,
            'AMBIENTE_amb_id', OLD.AMBIENTE_amb_id,
            'COMPETENCIA_comp_id', OLD.COMPETENCIA_comp_id
        ),
        NULL             -- No hay datos nuevos porque se eliminó
    );
END//

DELIMITER ;
