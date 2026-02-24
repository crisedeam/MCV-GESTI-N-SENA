<?php
require_once 'models/Programa.php';
$ProgramaList = Programa::all();
require_once 'models/Instructor.php';
$InstructorList = Instructor::all();
require_once 'models/Coordinacion.php';
$CoordinacionList = Coordinacion::all();
?>
<div class='view-container'>
    <div class='breadcrumb'>
        <span style='text-transform: uppercase;'>Administración</span>
        <i class='fa-solid fa-chevron-right' style='font-size: 10px;'></i>
        <a href='?controller=Ficha&action=index' style='color: #39A900; text-decoration: none; font-weight: 700; text-transform: uppercase;'>Actualizar Ficha</a>
    </div>

    <div class='view-header' style='margin-bottom: 0;'>
        <div class='view-title-block'>
            <h1>Actualizar Ficha</h1>
            <p>Modifique los detalles de este registro.</p>
        </div>
    </div>

    <div class='form-container'>
        <div class='form-side-panel'>
            <div class='panel-header'>
                <i class='fa-solid fa-file-signature'></i>
                <h3>Edición</h3>
                <p>Complete la información solicitada en el formulario para Ficha.</p>
            </div>
        </div>

        <div class='form-main-panel'>
            <form action='?controller=Ficha&action=update' method='POST'>
                <div class='form-grid'>
                    <div class='form-group full-width'>
                        <label for='fich_id'>ID / Identificador</label>
                        <input type='number' id='fich_id' name='fich_id' class='form-control' placeholder='Ej: 1' value='1' readonly style='background-color: #f8fafc;'>
                    </div>
                    <div class='form-group full-width'>
                        <label for='PROGRAMA_prog_id'>Programa</label>
                        <select id='PROGRAMA_prog_id' name='PROGRAMA_prog_id' class='form-control'>
                            <option value=''>Seleccione...</option>
                            <?php foreach($ProgramaList as $item): ?>
                                <option value='<?= $item->getProg_codigo() ?>'><?= $item->getProg_denominacion() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class='form-group full-width'>
                        <label for='INSTRUCTOR_inst_id_lider'>Instructor Líder</label>
                        <select id='INSTRUCTOR_inst_id_lider' name='INSTRUCTOR_inst_id_lider' class='form-control'>
                            <option value=''>Seleccione...</option>
                            <?php foreach($InstructorList as $item): ?>
                                <option value='<?= $item->getInst_id() ?>'><?= $item->getInst_nombre() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class='form-group full-width'>
                        <label for='fich_jornada'>Jornada</label>
                        <select id='fich_jornada' name='fich_jornada' class='form-control'>
                            <option value='Diurna'>Diurna</option>
                            <option value='Nocturna'>Nocturna</option>
                            <option value='Mixta'>Mixta</option>
                        </select>
                    </div>
                    <div class='form-group full-width'>
                        <label for='COORDINACION_coord_id'>Coordinación</label>
                        <select id='COORDINACION_coord_id' name='COORDINACION_coord_id' class='form-control'>
                            <option value=''>Seleccione...</option>
                            <?php foreach($CoordinacionList as $item): ?>
                                <option value='<?= $item->getCoord_id() ?>' <?= $item->getCoord_id() == $ficha->getCOORDINACION_coord_id() ? 'selected' : '' ?>><?= $item->getCoord_descripcion() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class='form-group full-width'>
                        <label for='fich_fecha_ini_lectiva'>Fecha Inicio Lectiva</label>
                        <input type='date' id='fich_fecha_ini_lectiva' name='fich_fecha_ini_lectiva' class='form-control' value='<?= htmlspecialchars($ficha->getFich_fecha_ini_lectiva()) ?>' required>
                    </div>
                    <div class='form-group full-width'>
                        <label for='fich_fecha_fin_lectiva'>Fecha Fin Lectiva</label>
                        <input type='date' id='fich_fecha_fin_lectiva' name='fich_fecha_fin_lectiva' class='form-control' value='<?= htmlspecialchars($ficha->getFich_fecha_fin_lectiva()) ?>' required>
                    </div>
                </div>

                <div class='form-actions'>
                    <a href='?controller=Ficha&action=index' class='btn-secondary' style='text-decoration: none;'>Cancelar</a>
                    <button type='submit' class='btn-success'>
                        <i class='fa-regular fa-floppy-disk'></i> Actualizar Ficha
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>