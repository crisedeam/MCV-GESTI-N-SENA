<div class='view-container'>
    <div class='breadcrumb'>
        <span style='text-transform: uppercase;'>Administración</span>
        <i class='fa-solid fa-chevron-right' style='font-size: 10px;'></i>
        <a href='?controller=TituloPrograma&action=index' style='color: #39A900; text-decoration: none; font-weight: 700; text-transform: uppercase;'>Registrar TituloPrograma</a>
    </div>

    <div class='view-header' style='margin-bottom: 0;'>
        <div class='view-title-block'>
            <h1>Registrar TituloPrograma</h1>
            <p>Ingrese los detalles requeridos.</p>
        </div>
    </div>

    <div class='form-container'>
        <div class='form-side-panel'>
            <div class='panel-header'>
                <i class='fa-solid fa-file-signature'></i>
                <h3>Registro</h3>
                <p>Complete la información solicitada en el formulario para TituloPrograma.</p>
            </div>
        </div>

        <div class='form-main-panel'>
            <form action='?controller=TituloPrograma&action=save' method='POST'>
                <div class='form-grid'>
                    <div class='form-group full-width'>
                        <label for='titpro_id'>ID / Identificador</label>
                        <input type='number' id='titpro_id' name='titpro_id' class='form-control' placeholder='Ej: 1'  >
                    </div>
                    <div class='form-group full-width'>
                        <label for='titpro_nombre'>Nombre del Título</label>
                        <input type='text' id='titpro_nombre' name='titpro_nombre' class='form-control' >
                    </div>
                </div>

                <div class='form-actions'>
                    <a href='?controller=TituloPrograma&action=index' class='btn-secondary' style='text-decoration: none;'>Cancelar</a>
                    <button type='submit' class='btn-success'>
                        <i class='fa-regular fa-floppy-disk'></i> Guardar TituloPrograma
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>