<div class='view-container'>
    <div class='breadcrumb'>
        <span>Ejecución</span>
        <i class='fa-solid fa-chevron-right' style='font-size: 10px;'></i>
        <a href='?controller=InstruCompetencia&action=index' style='color: #6b7280; text-decoration: none;'>Competencias por Instructor</a>
        <i class='fa-solid fa-chevron-right' style='font-size: 10px;'></i>
        <span style='color: #39A900; font-weight: 700;'>Registrar Aval</span>
    </div>

    <div class='view-header' style='margin-bottom: 0;'>
        <div class='view-title-block'>
            <h1>Registrar Nuevo Aval</h1>
            <p>Conceder aval a un instructor para impartir una competencia.</p>
        </div>
    </div>
    
    <?php if (isset($_GET['error'])): ?>
        <div style="background-color: #fee2e2; border-left: 4px solid #ef4444; color: #b91c1c; padding: 1rem; margin-bottom: 1.5rem; border-radius: 4px; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
                <?php if ($_GET['error'] == 'foreign_key_comp_prog'): ?>
                    <strong>Error de Asignación:</strong> El Programa y la Competencia seleccionados no están vinculados en el sistema. Asegúrese de seleccionar primero el programa.
                <?php else: ?>
                    <strong>Error:</strong> Ocurrió un error al intentar guardar el registro.
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class='form-container'>
        <div class='form-side-panel'>
            <div class='panel-header'>
                <i class='fa-solid fa-certificate'></i>
                <h3>Registro</h3>
                <p>Seleccione el instructor, el programa y la competencia, luego establezca la fecha hasta la cual el aval es válido.</p>
            </div>
        </div>

        <div class='form-main-panel'>
            <form action='?controller=InstruCompetencia&action=save' method='POST'>
                <div class='form-grid'>
                    
                    <div class='form-group full-width'>
                        <label for='INSTRUCTOR_inst_id'>Instructor</label>
                        <select id='INSTRUCTOR_inst_id' name='INSTRUCTOR_inst_id' class='form-control' required>
                            <option value=''>Seleccione un instructor...</option>
                            <?php foreach($listaInstructores as $instructor): ?>
                                <option value='<?php echo htmlspecialchars($instructor->getInst_id()); ?>'>
                                    <?php echo htmlspecialchars($instructor->getInst_nombre() . " " . $instructor->getInst_apellido() . " - " . $instructor->getInst_id()); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class='form-group full-width'>
                        <label for='COMPETxPROGRAMA_PROGRAMA_prog_id'>Programa</label>
                        <select id='COMPETxPROGRAMA_PROGRAMA_prog_id' name='COMPETxPROGRAMA_PROGRAMA_prog_id' class='form-control' required>
                            <option value=''>Seleccione un programa...</option>
                            <?php foreach($listaProgramas as $programa): ?>
                                <option value='<?php echo htmlspecialchars($programa->getProg_codigo()); ?>'>
                                    <?php echo htmlspecialchars($programa->getProg_codigo() . " - " . $programa->getProg_denominacion()); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class='form-group full-width'>
                        <label for='COMPETxPROGRAMA_COMPETENCIA_comp_id'>Competencia</label>
                        <select id='COMPETxPROGRAMA_COMPETENCIA_comp_id' name='COMPETxPROGRAMA_COMPETENCIA_comp_id' class='form-control' required disabled>
                            <option value=''>Primero seleccione un programa...</option>
                        </select>
                    </div>

                    <div class='form-group'>
                        <label for='inscomp_vigencia'>Fecha de Vigencia del Aval</label>
                        <input type='date' id='inscomp_vigencia' name='inscomp_vigencia' class='form-control' required>
                        <small style="color: #6b7280; display: block; margin-top: 5px;">Obligatorio. A partir de esta fecha, el aval aparecerá como 'Vencido'.</small>
                    </div>

                </div>

                <div class='form-actions'>
                    <a href='?controller=InstruCompetencia&action=index' class='btn-secondary' style='text-decoration: none;'>Cancelar</a>
                    <button type='submit' class='btn-success'>
                        <i class='fa-regular fa-floppy-disk'></i> Guardar Aval
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="assets/js/InstruCompetencia/register.js"></script>
