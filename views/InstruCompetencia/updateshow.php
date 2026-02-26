<div class='view-container'>
    <div class='breadcrumb'>
        <span>Ejecución</span>
        <i class='fa-solid fa-chevron-right' style='font-size: 10px;'></i>
        <a href='?controller=InstruCompetencia&action=index' style='color: #6b7280; text-decoration: none;'>Competencias por Instructor</a>
        <i class='fa-solid fa-chevron-right' style='font-size: 10px;'></i>
        <span style='color: #39A900; font-weight: 700;'>Editar Aval</span>
    </div>

    <div class='view-header' style='margin-bottom: 0;'>
        <div class='view-title-block'>
            <h1>Editar Aval</h1>
            <p>Modificar o renovar la vigencia de una competencia asignada a un instructor.</p>
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
                <i class='fa-solid fa-pen-to-square'></i>
                <h3>Actualización</h3>
                <p>Modifique la información y guarde los cambios para actualizar la fecha de expiración o reasignar la competencia.</p>
            </div>
        </div>

        <div class='form-main-panel'>
            <form action='?controller=InstruCompetencia&action=update' method='POST'>
                <input type="hidden" name="inscomp_id" value="<?php echo htmlspecialchars($instrucomp->getInscomp_id()); ?>">
                <div class='form-grid'>
                    
                    <div class='form-group full-width'>
                        <label for='INSTRUCTOR_inst_id'>Instructor</label>
                        <select id='INSTRUCTOR_inst_id' name='INSTRUCTOR_inst_id' class='form-control' required>
                            <option value=''>Seleccione un instructor...</option>
                            <?php foreach($listaInstructores as $instructor): ?>
                                <option value='<?php echo htmlspecialchars($instructor->getInst_id()); ?>' <?php echo ($instrucomp->getINSTRUCTOR_inst_id() == $instructor->getInst_id()) ? 'selected' : ''; ?>>
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
                                <option value='<?php echo htmlspecialchars($programa->getProg_codigo()); ?>' <?php echo ($instrucomp->getCOMPETxPROGRAMA_PROGRAMA_prog_id() == $programa->getProg_codigo()) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($programa->getProg_codigo() . " - " . $programa->getProg_denominacion()); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class='form-group full-width'>
                        <label for='COMPETxPROGRAMA_COMPETENCIA_comp_id'>Competencia</label>
                        <select id='COMPETxPROGRAMA_COMPETENCIA_comp_id' name='COMPETxPROGRAMA_COMPETENCIA_comp_id' class='form-control' required>
                            <!-- The current competition is selected by default -->
                            <?php foreach($listaCompetencias as $competencia): ?>
                                <?php if ($instrucomp->getCOMPETxPROGRAMA_COMPETENCIA_comp_id() == $competencia->getComp_id()): ?>
                                    <option value='<?php echo htmlspecialchars($competencia->getComp_id()); ?>' selected>
                                        <?php echo htmlspecialchars($competencia->getComp_nombre_corto()); ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class='form-group'>
                        <label for='inscomp_vigencia'>Fecha de Vigencia del Aval</label>
                        <input type='date' id='inscomp_vigencia' name='inscomp_vigencia' class='form-control' value='<?php echo htmlspecialchars($instrucomp->getInscomp_vigencia()); ?>' required>
                        <small style="color: #6b7280; display: block; margin-top: 5px;">Actualice la fecha si requiere renovar el aval.</small>
                    </div>

                </div>

                <div class='form-actions'>
                    <a href='?controller=InstruCompetencia&action=index' class='btn-secondary' style='text-decoration: none;'>Cancelar</a>
                    <button type='submit' class='btn-success'>
                        <i class='fa-regular fa-floppy-disk'></i> Actualizar Aval
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="assets/js/InstruCompetencia/updateshow.js"></script>
