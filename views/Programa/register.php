<?php
require_once 'models/TituloPrograma.php';
$TituloProgramaList = TituloPrograma::all();
?>
<div class='view-container'>
    <div class='breadcrumb'>
        <span style='text-transform: uppercase;'>Administración</span>
        <i class='fa-solid fa-chevron-right' style='font-size: 10px;'></i>
        <a href='?controller=Programa&action=index' style='color: #39A900; text-decoration: none; font-weight: 700; text-transform: uppercase;'>Registrar Programa</a>
    </div>

    <div class='view-header' style='margin-bottom: 0;'>
        <div class='view-title-block'>
            <h1>Registrar Programa</h1>
            <p>Ingrese los detalles requeridos.</p>
        </div>
    </div>

    <div class='form-container'>
        <div class='form-side-panel'>
            <div class='panel-header'>
                <i class='fa-solid fa-file-signature'></i>
                <h3>Registro</h3>
                <p>Complete la información solicitada en el formulario para Programa.</p>
            </div>
        </div>

        <div class='form-main-panel'>
            <form action='?controller=Programa&action=save' method='POST'>
                <div class='form-grid'>
                    <div class='form-group full-width'>
                        <label for='prog_codigo'>ID / Identificador</label>
                        <input type='number' id='prog_codigo' name='prog_codigo' class='form-control' placeholder='Ej: 1'  >
                    </div>
                    <div class='form-group full-width'>
                        <label for='prog_denominacion'>Denominación</label>
                        <input type='text' id='prog_denominacion' name='prog_denominacion' class='form-control' >
                    </div>
                    <div class='form-group full-width'>
                        <label for='prog_tipo'>Tipo de Programa</label>
                        <select id='prog_tipo' name='prog_tipo' class='form-control'>
                            <option value='Tecnólogo'>Tecnólogo</option>
                            <option value='Técnico'>Técnico</option>
                            <option value='Especialización'>Especialización</option>
                        </select>
                    </div>
                    <div class='form-group full-width'>
                        <label for='TIT_PROGRAMA_titpro_id'>Título</label>
                        <select id='TIT_PROGRAMA_titpro_id' name='TIT_PROGRAMA_titpro_id' class='form-control'>
                            <option value=''>Seleccione...</option>
                            <?php foreach($TituloProgramaList as $item): ?>
                                <option value='<?= $item->getTitpro_id() ?>'><?= $item->getTitpro_nombre() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class='form-actions'>
                    <a href='?controller=Programa&action=index' class='btn-secondary' style='text-decoration: none;'>Cancelar</a>
                    <button type='submit' class='btn-success'>
                        <i class='fa-regular fa-floppy-disk'></i> Guardar Programa
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>