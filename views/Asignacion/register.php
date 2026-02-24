<?php
$selectedDate = '';
$selectedTime = '';
$selectedDayOfWeek = -1;

if (isset($_GET['date'])) {
    try {
        $dt = new DateTime($_GET['date']);
        $selectedDate = $dt->format('Y-m-d');
        if (strpos($_GET['date'], 'T') !== false) {
            $selectedTime = $dt->format('H:i');
        }
        $selectedDayOfWeek = (int)$dt->format('w');
    } catch (Exception $e) {
        // Ignorar formato invalido
    }
}
?>
<div class='view-container'>
    <div class='breadcrumb'>
        <span>Ejecución</span>
        <i class='fa-solid fa-chevron-right' style='font-size: 10px;'></i>
        <a href='?controller=Asignacion&action=index' style='color: #39A900; text-decoration: none; font-weight: 700;'>Registrar Asignación</a>
    </div>

    <div class='view-header' style='margin-bottom: 0;'>
        <div class='view-title-block'>
            <h1>Registrar Asignación</h1>
            <p>Ingrese los detalles requeridos para la programación.</p>
        </div>
    </div>

    <div class='form-container'>
        <div class='form-side-panel'>
            <div class='panel-header'>
                <i class='fa-solid fa-calendar-plus'></i>
                <h3>Registro</h3>
                <p>Complete la información para asignar un ambiente y competencia a una Ficha y un Instructor.</p>
            </div>
        </div>

        <div class='form-main-panel'>
            <form action='?controller=Asignacion&action=save' method='POST'>
                <div class='form-grid'>
                    
                    <div class='form-group full-width'>
                        <label for='INSTRUCTOR_inst_id'>Instructor</label>
                        <select id='INSTRUCTOR_inst_id' name='INSTRUCTOR_inst_id' class='form-control' required>
                            <option value=''>Seleccione...</option>
                            <?php foreach($listaInstructores as $instructor): ?>
                                <option value='<?php echo $instructor->getInst_id(); ?>'>
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
                                <option value='<?php echo $ficha->getFich_id(); ?>'>
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
                                <option value='<?php echo htmlspecialchars($ambiente->getAmb_id()); ?>'>
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
                                <option value='<?php echo $competencia->getComp_id(); ?>'>
                                    <?php echo htmlspecialchars($competencia->getComp_nombre_corto()); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class='form-group full-width'>
                        <label>Días de Formación</label>
                        <div class='checkbox-group' style='display: flex; gap: 15px; margin-top: 8px; flex-wrap: wrap;'>
                            <label><input type="checkbox" name="dias[]" value="1" <?php echo ($selectedDayOfWeek == -1 || $selectedDayOfWeek == 1) ? 'checked' : ''; ?>> Lunes</label>
                            <label><input type="checkbox" name="dias[]" value="2" <?php echo ($selectedDayOfWeek == -1 || $selectedDayOfWeek == 2) ? 'checked' : ''; ?>> Martes</label>
                            <label><input type="checkbox" name="dias[]" value="3" <?php echo ($selectedDayOfWeek == -1 || $selectedDayOfWeek == 3) ? 'checked' : ''; ?>> Miércoles</label>
                            <label><input type="checkbox" name="dias[]" value="4" <?php echo ($selectedDayOfWeek == -1 || $selectedDayOfWeek == 4) ? 'checked' : ''; ?>> Jueves</label>
                            <label><input type="checkbox" name="dias[]" value="5" <?php echo ($selectedDayOfWeek == -1 || $selectedDayOfWeek == 5) ? 'checked' : ''; ?>> Viernes</label>
                            <label><input type="checkbox" name="dias[]" value="6" <?php echo ($selectedDayOfWeek == 6) ? 'checked' : ''; ?>> Sábado</label>
                            <label><input type="checkbox" name="dias[]" value="0" <?php echo ($selectedDayOfWeek == 0) ? 'checked' : ''; ?>> Domingo</label>
                        </div>
                    </div>

                    <div class='form-group full-width' style='display: grid; grid-template-columns: 1fr 1fr; gap: 20px;'>
                        <div>
                            <label for='fecha_inicio'>Fecha Límite Inicio</label>
                            <input type='date' id='fecha_inicio' name='fecha_inicio' class='form-control' value='<?php echo htmlspecialchars($selectedDate); ?>' required>
                        </div>
                        <div>
                            <label for='fecha_fin'>Fecha Límite Fin</label>
                            <input type='date' id='fecha_fin' name='fecha_fin' class='form-control' value='<?php echo htmlspecialchars($selectedDate); ?>' required>
                        </div>
                    </div>

                    <div class='form-group full-width' style='display: grid; grid-template-columns: 1fr 1fr; gap: 20px;'>
                        <div>
                            <label for='hora_inicio'>Hora de Inicio (Diaria)</label>
                            <input type='time' id='hora_inicio' name='hora_inicio' class='form-control' value='<?php echo htmlspecialchars($selectedTime); ?>' required>
                        </div>
                        <div>
                            <label for='hora_fin'>Hora de Fin (Diaria)</label>
                            <input type='time' id='hora_fin' name='hora_fin' class='form-control' required>
                        </div>
                    </div>
                </div>

                <div class='form-actions'>
                    <a href='?controller=Asignacion&action=index' class='btn-secondary' style='text-decoration: none;'>Cancelar</a>
                    <button type='submit' class='btn-success'>
                        <i class='fa-regular fa-floppy-disk'></i> Guardar Asignación
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
