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
        <a href='?controller=Coordinacion&action=index' style='color: #39A900; text-decoration: none; font-weight: 700; text-transform: uppercase;'>Registrar Coordinacion</a>
    </div>

    <div class='view-header' style='margin-bottom: 0;'>
        <div class='view-title-block'>
            <h1>Registrar Coordinacion</h1>
            <p>Ingrese los detalles requeridos.</p>
        </div>
    </div>

    <div class='form-container'>
        <div class='form-side-panel'>
            <div class='panel-header'>
                <i class='fa-solid fa-file-signature'></i>
                <h3>Registro</h3>
                <p>Complete la información solicitada en el formulario para Coordinacion.</p>
            </div>
        </div>

        <div class='form-main-panel'>
            <form action='?controller=Coordinacion&action=save' method='POST'>
                <div class='form-grid'>
                    <div class='form-group full-width'>
                        <label for='coord_id'>ID / Identificador</label>
                        <input type='number' id='coord_id' name='coord_id' class='form-control' placeholder='Ej: 1'  >
                    </div>
                    <div class='form-group full-width'>
                        <label for='coord_descripcion'>Descripción de Coordinación</label>
                        <input type='text' id='coord_descripcion' name='coord_descripcion' class='form-control' placeholder='Ej: Área de Sistemas'>
                    </div>
                    <div class='form-group full-width'>
                        <label for='coord_nombre_coordinador'>Nombre del Coordinador</label>
                        <input type='text' id='coord_nombre_coordinador' name='coord_nombre_coordinador' class='form-control' placeholder='Ej: Juan Pérez'>
                    </div>
                    <div class='form-group full-width'>
                        <label for='coord_correo'>Correo de Coordinador</label>
                        <input type='email' id='coord_correo' name='coord_correo' class='form-control' placeholder='Ej: jperez@sena.edu.co'>
                    </div>
                    <div class='form-group full-width'>
                        <label for='coord_password'>Contraseña</label>
                        <input type='password' id='coord_password' name='coord_password' class='form-control' placeholder='Ingrese una contraseña segura'>
                    </div>
                    <div class='form-group full-width'>
                        <label for='CENTRO_FORMACION_cent_id'>Centro Formación</label>
                        <select id='CENTRO_FORMACION_cent_id' name='CENTRO_FORMACION_cent_id' class='form-control'>
                            <option value=''>Seleccione...</option>
                            <?php foreach($CentroFormacionList as $item): ?>
                                <option value='<?= $item->getCent_id() ?>'><?= $item->getCent_nombre() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class='form-actions'>
                    <a href='?controller=Coordinacion&action=index' class='btn-secondary' style='text-decoration: none;'>Cancelar</a>
                    <button type='submit' class='btn-success'>
                        <i class='fa-regular fa-floppy-disk'></i> Guardar Coordinacion
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>