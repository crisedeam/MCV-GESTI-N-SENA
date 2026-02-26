<div class='view-container'>
    <div class='breadcrumb'>
        <span style='text-transform: uppercase;'>Gestión Titulaciones</span>
        <i class='fa-solid fa-chevron-right' style='font-size: 10px;'></i>
        <a href='?controller=CompetxPrograma&action=index' style='color: #39A900; text-decoration: none; font-weight: 700; text-transform: uppercase;'>Asignar Competencia</a>
    </div>

    <div class='view-header' style='margin-bottom: 0;'>
        <div class='view-title-block'>
            <h1>Asociar Competencia x Programa</h1>
            <p>Relacione una competencia a un programa formativo existente.</p>
        </div>
    </div>

    <!-- Mensajes de Error -->
    <?php if (isset($_GET['error'])): ?>
        <div style="background-color: #fee2e2; border-left: 4px solid #ef4444; color: #b91c1c; padding: 1rem; margin-top: 1rem; margin-bottom: 1.5rem; border-radius: 4px; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
                <?php if ($_GET['error'] == 'duplicate'): ?>
                    <strong>Error:</strong> Esta competencia ya se encuentra asociada a este programa. Seleccione otra distinta.
                <?php else: ?>
                    <strong>Error:</strong> Ocurrió un fallo general al intentar crear la asociación.
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class='form-container'>
        <div class='form-side-panel'>
            <div class='panel-header'>
                <i class='fa-solid fa-link'></i>
                <h3>Asociación</h3>
                <p>Seleccione el programa formativo de destino y la competencia requerida en la malla curricular.</p>
            </div>
        </div>

        <div class='form-main-panel'>
            <form action='?controller=CompetxPrograma&action=save' method='POST'>
                <div class='form-grid'>
                    <div class='form-group full-width'>
                        <label for='PROGRAMA_prog_id'>Programa Formativo <span style='color:#ef4444'>*</span></label>
                        <select id='PROGRAMA_prog_id' name='PROGRAMA_prog_id' class='form-control' required style='appearance: auto;'>
                            <option value="">-- Seleccione un Programa --</option>
                            <?php foreach ($programas as $prog): ?>
                                <option value="<?= htmlspecialchars($prog->getProg_codigo()) ?>">
                                    <?= htmlspecialchars($prog->getProg_denominacion()) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class='form-group full-width'>
                        <label for='COMPETENCIA_comp_id'>Competencia a Asignar <span style='color:#ef4444'>*</span></label>
                        <select id='COMPETENCIA_comp_id' name='COMPETENCIA_comp_id' class='form-control' required style='appearance: auto;'>
                            <option value="">-- Seleccione una Competencia --</option>
                            <?php foreach ($competencias as $comp): ?>
                                <option value="<?= htmlspecialchars($comp->getComp_id()) ?>">
                                    <?= htmlspecialchars($comp->getComp_nombre_corto()) ?> - (<?= htmlspecialchars($comp->getComp_horas()) ?> horas)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class='form-actions'>
                    <a href='?controller=CompetxPrograma&action=index' class='btn-secondary' style='text-decoration: none;'>Cancelar y Volver</a>
                    <button type='submit' class='btn-success'>
                        <i class='fa-solid fa-plus'></i> Crear Asociación
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
