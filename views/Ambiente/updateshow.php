<?php
require_once 'models/Sede.php';
$SedeList = Sede::all();
?>
<div class='view-container'>
    <div class='breadcrumb'>
        <span style='text-transform: uppercase;'>Administración</span>
        <i class='fa-solid fa-chevron-right' style='font-size: 10px;'></i>
        <a href='?controller=Ambiente&action=index' style='color: #39A900; text-decoration: none; font-weight: 700; text-transform: uppercase;'>Actualizar Ambiente</a>
    </div>

    <div class='view-header' style='margin-bottom: 0;'>
        <div class='view-title-block'>
            <h1>Actualizar Ambiente</h1>
            <p>Modifique los detalles de este registro.</p>
        </div>
    </div>

    <div class='form-container'>
        <div class='form-side-panel'>
            <div class='panel-header'>
                <i class='fa-solid fa-file-signature'></i>
                <h3>Edición</h3>
                <p>Complete la información solicitada en el formulario para Ambiente.</p>
            </div>
        </div>

        <div class='form-main-panel'>
            <form action='?controller=Ambiente&action=update' method='POST'>
                <div class='form-grid'>
                    <div class='form-group full-width'>
                        <label for='amb_id'>ID / Identificador</label>
                        <input type='number' id='amb_id' name='amb_id' class='form-control' placeholder='Ej: 1' value='1' readonly style='background-color: #f8fafc;'>
                    </div>
                    <div class='form-group full-width'>
                        <label for='amb_nombre'>Nombre del Ambiente</label>
                        <input type='text' id='amb_nombre' name='amb_nombre' class='form-control' value='Ejemplo'>
                    </div>
                    <div class='form-group full-width'>
                        <label for='SEDE_sede_id'>Sede</label>
                        <select id='SEDE_sede_id' name='SEDE_sede_id' class='form-control'>
                            <option value=''>Seleccione...</option>
                            <?php foreach($SedeList as $item): ?>
                                <option value='<?= $item->getSede_id() ?>'><?= $item->getSede_nombre() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class='form-actions'>
                    <a href='?controller=Ambiente&action=index' class='btn-secondary' style='text-decoration: none;'>Cancelar</a>
                    <button type='submit' class='btn-success'>
                        <i class='fa-regular fa-floppy-disk'></i> Actualizar Ambiente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>