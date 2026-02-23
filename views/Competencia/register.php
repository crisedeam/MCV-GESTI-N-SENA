<div class='view-container'>
    <div class='breadcrumb'>
        <span style='text-transform: uppercase;'>Administración</span>
        <i class='fa-solid fa-chevron-right' style='font-size: 10px;'></i>
        <a href='?controller=Competencia&action=index' style='color: #39A900; text-decoration: none; font-weight: 700; text-transform: uppercase;'>Registrar Competencia</a>
    </div>

    <div class='view-header' style='margin-bottom: 0;'>
        <div class='view-title-block'>
            <h1>Registrar Competencia</h1>
            <p>Ingrese los detalles requeridos.</p>
        </div>
    </div>

    <div class='form-container'>
        <div class='form-side-panel'>
            <div class='panel-header'>
                <i class='fa-solid fa-file-signature'></i>
                <h3>Registro</h3>
                <p>Complete la información solicitada en el formulario para Competencia.</p>
            </div>
        </div>

        <div class='form-main-panel'>
            <form action='?controller=Competencia&action=save' method='POST'>
                <div class='form-grid'>
                    <div class='form-group full-width'>
                        <label for='comp_id'>ID / Identificador</label>
                        <input type='number' id='comp_id' name='comp_id' class='form-control' placeholder='Ej: 1'  >
                    </div>
                    <div class='form-group full-width'>
                        <label for='comp_nombre_corto'>Nombre Corto</label>
                        <input type='text' id='comp_nombre_corto' name='comp_nombre_corto' class='form-control' >
                    </div>
                    <div class='form-group full-width'>
                        <label for='comp_nombre_unidad_competencia'>Unidad Competencia</label>
                        <input type='text' id='comp_nombre_unidad_competencia' name='comp_nombre_unidad_competencia' class='form-control' >
                    </div>
                    <div class='form-group full-width'>
                        <label for='comp_horas'>Horas</label>
                        <input type='number' id='comp_horas' name='comp_horas' class='form-control' >
                    </div>
                </div>

                <div class='form-actions'>
                    <a href='?controller=Competencia&action=index' class='btn-secondary' style='text-decoration: none;'>Cancelar</a>
                    <button type='submit' class='btn-success'>
                        <i class='fa-regular fa-floppy-disk'></i> Guardar Competencia
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>