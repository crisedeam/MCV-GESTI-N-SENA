<div class='view-container'>
    <div class='breadcrumb'>
        <span>Ejecución</span>
        <i class='fa-solid fa-chevron-right' style='font-size: 10px;'></i>
        <a href='?controller=Asignacion&action=index' style='color: #6b7280; text-decoration: none;'>Asignaciones</a>
        <i class='fa-solid fa-chevron-right' style='font-size: 10px;'></i>
        <span style='color: #39A900; font-weight: 700;'>Editar Asignación</span>
    </div>

    <div class='view-header' style='margin-bottom: 0;'>
        <div class='view-title-block'>
            <h1>Editar Asignación</h1>
            <p>Modifique los detalles de la programación.</p>
        </div>
    </div>
    
    <?php if(isset($_GET['error'])): ?>
        <?php if($_GET['error'] == 'duplicate'): ?>
        <div class='alert alert-danger' style='background-color: #fce4e4; color: #cc0000; border: 1px solid #cc0000; padding: 15px; margin: 20px 0; border-radius: 5px; font-weight: bold;'>
            <i class="fa-solid fa-circle-exclamation"></i> Error: No se puede actualizar. Ya existe otra programación con estos mismos componentes (Instructor, Ficha, Ambiente y Competencia).
        </div>
        <?php elseif($_GET['error'] == 'date_order'): ?>
        <div class='alert alert-danger' style='background-color: #fce4e4; color: #cc0000; border: 1px solid #cc0000; padding: 15px; margin: 20px 0; border-radius: 5px; font-weight: bold;'>
            <i class="fa-solid fa-circle-exclamation"></i> Error: La fecha de fin no puede ser anterior a la fecha de inicio.
        </div>
        <?php elseif($_GET['error'] == 'max_week'): ?>
        <div class='alert alert-danger' style='background-color: #fce4e4; color: #cc0000; border: 1px solid #cc0000; padding: 15px; margin: 20px 0; border-radius: 5px; font-weight: bold;'>
            <i class="fa-solid fa-circle-exclamation"></i> Error: El rango de fechas (Inicio a Fin) no debe exceder 1 semana (7 días) para evitar sobrecarga.
        </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class='form-container'>
        <div class='form-side-panel'>
            <div class='panel-header'>
                <i class='fa-solid fa-pen-to-square'></i>
                <h3>Actualización</h3>
                <p>Modifique la información y guarde los cambios para actualizar esta asignación.</p>
            </div>
        </div>

        <div class='form-main-panel'>
            <form action='?controller=Asignacion&action=update' method='POST'>
                <input type='hidden' name='ASIG_ID' value='<?php echo $asignacion->getASIG_ID(); ?>'>
                <div class='form-grid'>
                    
                    <div class='form-group full-width'>
                        <label for='INSTRUCTOR_inst_id'>Instructor</label>
                        <select id='INSTRUCTOR_inst_id' name='INSTRUCTOR_inst_id' class='form-control' required>
                            <option value=''>Seleccione...</option>
                            <?php foreach($listaInstructores as $instructor): ?>
                                <option value='<?php echo $instructor->getInst_id(); ?>' <?php echo ($asignacion->getINSTRUCTOR_inst_id() == $instructor->getInst_id()) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($instructor->getInst_nombre() . " " . $instructor->getInst_apellido()); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class='form-group full-width'>
                        <label for='FICHA_fich_id'>Ficha</label>
                        <select id='FICHA_fich_id' name='FICHA_fich_id' class='form-control' required>
                            <option value=''>Seleccione...</option>
                            <?php foreach($listaFichas as $ficha): ?>
                                <option value='<?php echo $ficha->getFich_id(); ?>' <?php echo ($asignacion->getFICHA_fich_id() == $ficha->getFich_id()) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($ficha->getFich_id() . " - " . $ficha->getFich_jornada()); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class='form-group full-width'>
                        <label for='AMBIENTE_amb_id'>Ambiente</label>
                        <select id='AMBIENTE_amb_id' name='AMBIENTE_amb_id' class='form-control' required>
                            <option value=''>Seleccione...</option>
                            <?php foreach($listaAmbientes as $ambiente): ?>
                                <option value='<?php echo htmlspecialchars($ambiente->getAmb_id()); ?>' <?php echo ($asignacion->getAMBIENTE_amb_id() == $ambiente->getAmb_id()) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($ambiente->getAmb_id() . " - " . $ambiente->getAmb_nombre()); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class='form-group full-width'>
                        <label for='COMPETENCIA_comp_id'>Competencia</label>
                        <select id='COMPETENCIA_comp_id' name='COMPETENCIA_comp_id' class='form-control' required>
                            <option value=''>Seleccione...</option>
                            <?php foreach($listaCompetencias as $competencia): ?>
                                <option value='<?php echo $competencia->getComp_id(); ?>' <?php echo ($asignacion->getCOMPETENCIA_comp_id() == $competencia->getComp_id()) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($competencia->getComp_nombre_corto()); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class='form-group full-width'>
                        <label>Días de Formación (Al editar, reasignará los días)</label>
                        <div class='checkbox-group' style='display: flex; gap: 15px; margin-top: 8px; flex-wrap: wrap;'>
                            <label><input type="checkbox" name="dias[]" value="1" checked> Lunes</label>
                            <label><input type="checkbox" name="dias[]" value="2" checked> Martes</label>
                            <label><input type="checkbox" name="dias[]" value="3" checked> Miércoles</label>
                            <label><input type="checkbox" name="dias[]" value="4" checked> Jueves</label>
                            <label><input type="checkbox" name="dias[]" value="5" checked> Viernes</label>
                            <label><input type="checkbox" name="dias[]" value="6"> Sábado</label>
                            <label><input type="checkbox" name="dias[]" value="0"> Domingo</label>
                        </div>
                    </div>

                    <div class='form-group full-width' style='display: grid; grid-template-columns: 1fr 1fr; gap: 20px;'>
                        <div>
                            <label for='fecha_inicio'>Fecha Límite Inicio</label>
                            <input type='date' id='fecha_inicio' name='fecha_inicio' class='form-control' value='<?php echo date('Y-m-d', strtotime($asignacion->getAsig_fecha_ini())); ?>' required>
                        </div>
                        <div>
                            <label for='fecha_fin'>Fecha Límite Fin</label>
                            <input type='date' id='fecha_fin' name='fecha_fin' class='form-control' value='<?php echo date('Y-m-d', strtotime($asignacion->getAsig_fecha_fin())); ?>' required>
                        </div>
                    </div>

                    <div class='form-group full-width' style='display: grid; grid-template-columns: 1fr 1fr; gap: 20px;'>
                        <div>
                            <label for='hora_inicio'>Hora de Inicio (Diaria)</label>
                            <input type='time' id='hora_inicio' name='hora_inicio' class='form-control' value='<?php echo date('H:i', strtotime($asignacion->getAsig_fecha_ini())); ?>' required>
                        </div>
                        <div>
                            <label for='hora_fin'>Hora de Fin (Diaria)</label>
                            <input type='time' id='hora_fin' name='hora_fin' class='form-control' value='<?php echo date('H:i', strtotime($asignacion->getAsig_fecha_fin())); ?>' required>
                        </div>
                    </div>
                </div>

                <div class='form-actions'>
                    <a href='?controller=Asignacion&action=index' class='btn-secondary' style='text-decoration: none;'>Cancelar</a>
                    <button type='submit' class='btn-success'>
                        <i class='fa-regular fa-floppy-disk'></i> Actualizar Asignación
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class='form-container' style='margin-top: 20px;'>
        <div class='form-main-panel' style='width: 100%; border-left: none;'>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h3 style="color: var(--brand-primary); font-family: 'Outfit', sans-serif; margin: 0;">
                    <i class="fa-regular fa-calendar-check"></i> Calendario del Instructor Seleccionado
                </h3>
            </div>
            <div id='calendar'></div>
        </div>
    </div>
</div>

<!-- FullCalendar CSS y JS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js'></script>
<link rel="stylesheet" href="assets/css/calendar.css">

<script>
    window.calendarEventsData = <?php echo isset($eventosJson) ? $eventosJson : '[]'; ?>;
    window.editingAsigId = '<?php echo $asignacion->getASIG_ID(); ?>';
</script>

<script src="assets/js/Asignacion/updateshow.js"></script>
