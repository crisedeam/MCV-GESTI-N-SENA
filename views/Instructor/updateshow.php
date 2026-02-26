<?php
require_once 'models/CentroFormacion.php';

$CentroFormacionList = CentroFormacion::all();
if (isset($_SESSION['centro_id']) && !empty($_SESSION['centro_id'])) {
    $filteredList = [];
    foreach ($CentroFormacionList as $centro) {
        if ($centro->getCent_id() == $_SESSION['centro_id']) {
            $filteredList[] = $centro;
        }
    }
    $CentroFormacionList = $filteredList;
}
?>
<div class='view-container'>
    <div class='breadcrumb'>
        <span style='text-transform: uppercase;'>Administración</span>
        <i class='fa-solid fa-chevron-right' style='font-size: 10px;'></i>
        <a href='?controller=Instructor&action=index' style='color: #39A900; text-decoration: none; font-weight: 700; text-transform: uppercase;'>Actualizar Instructor</a>
    </div>

    <div class='view-header' style='margin-bottom: 0;'>
        <div class='view-title-block'>
            <h1>Actualizar Instructor</h1>
            <p>Modifique los detalles de este registro.</p>
        </div>
    </div>

    <div class='form-container'>
        <div class='form-side-panel'>
            <div class='panel-header'>
                <i class='fa-solid fa-file-signature'></i>
                <h3>Edición</h3>
                <p>Complete la información solicitada en el formulario para Instructor.</p>
            </div>
        </div>

        <div class='form-main-panel'>
            <form action='?controller=Instructor&action=update' method='POST'>
                <div class='form-grid'>
                    <div class='form-group full-width'>
                        <label for='inst_id'>ID / Identificador</label>
                        <input type='number' id='inst_id' name='inst_id' class='form-control' placeholder='Ej: 1' value='1' readonly style='background-color: #f8fafc;'>
                    </div>
                    <div class='form-group full-width'>
                        <label for='inst_nombre'>Nombre</label>
                        <input type='text' id='inst_nombre' name='inst_nombre' class='form-control' value='Ejemplo'>
                    </div>
                    <div class='form-group full-width'>
                        <label for='inst_apellido'>Apellido</label>
                        <input type='text' id='inst_apellido' name='inst_apellido' class='form-control' value='Ejemplo'>
                    </div>
                    <div class='form-group full-width'>
                        <label for='inst_correo'>Correo</label>
                        <input type='text' id='inst_correo' name='inst_correo' class='form-control' value='Ejemplo'>
                    </div>
                    <div class='form-group full-width'>
                        <label for='inst_telefono'>Teléfono</label>
                        <input type='text' id='inst_telefono' name='inst_telefono' class='form-control' value='Ejemplo'>
                    </div>
                    <div class='form-group full-width'>
                        <label for='CENTRO_FORMACION_cent_id'>Centro Formación</label>
                        <select id='CENTRO_FORMACION_cent_id' name='CENTRO_FORMACION_cent_id' class='form-control'>
                            <option value=''>Seleccione...</option>
                            <?php foreach($CentroFormacionList as $item): ?>
                                <option value='<?= $item->getCent_id() ?>' <?= $item->getCent_id() == $instructor->getCENTRO_FORMACION_cent_id() ? 'selected' : '' ?>><?= $item->getCent_nombre() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class='form-group full-width'>
                        <label for='inst_password'>Nueva Contraseña (Opcional)</label>
                        <input type='password' id='inst_password' name='inst_password' class='form-control' placeholder='Deje en blanco para mantener la actual'>
                    </div>
                </div>

                <div class='form-actions'>
                    <a href='?controller=Instructor&action=index' class='btn-secondary' style='text-decoration: none;'>Cancelar</a>
                    <button type='submit' class='btn-success'>
                        <i class='fa-regular fa-floppy-disk'></i> Actualizar Instructor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>