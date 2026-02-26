<div class="view-container">
    <div class="breadcrumb">
        <span>Ejecución</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <a href="?controller=Asignacion&action=index" style="color: #6b7280; text-decoration: none;">Asignaciones</a>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Editar Solo un Día</span>
    </div>

    <div class="view-header">
        <div class="view-title-block">
            <h1>Editar Día Específico</h1>
            <p>Modifica únicamente el horario de este día en particular.</p>
        </div>
        <div class="header-actions">
            <a href="?controller=Asignacion&action=index" class="btn-secondary" style="text-decoration: none;">
                <i class="fa-solid fa-arrow-left"></i> Volver a Asignaciones
            </a>
        </div>
    </div>

    <!-- Mensajes de error del servidor -->
    <?php if(isset($_GET['error'])): ?>
        <div class="alert alert-danger" style="background-color: var(--danger-bg); color: var(--danger); padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid var(--danger);">
            <i class="fa-solid fa-circle-exclamation"></i>
            <?php 
                if($_GET['error'] == 'date_order') echo "La fecha u hora de inicio no puede ser mayor a la de fin.";
                else echo "Ocurrió un error al procesar la solicitud.";
            ?>
        </div>
    <?php endif; ?>

    <div class="form-card" style="max-width: 600px; margin: 0 auto; background: var(--bg-card); padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border: 1px solid var(--border-color);">
        <form action="?controller=DetalleAsignacion&action=update" method="POST">
            <!-- Campos Ocultos Requeridos -->
            <input type="hidden" name="detasig_id" value="<?= htmlspecialchars($detalle->getDetasig_id()) ?>">
            <input type="hidden" name="ASIGNACION_ASIG_ID" value="<?= htmlspecialchars($detalle->getASIGNACION_ASIG_ID()) ?>">

            <?php
                // Desglosar las fechas y horas para los inputs separados
                $dt_ini = new DateTime($detalle->getDetasig_hora_ini());
                $dt_fin = new DateTime($detalle->getDetasig_hora_fin());
                $fecha_actual = $dt_ini->format('Y-m-d');
                $hora_ini_actual = $dt_ini->format('H:i');
                $hora_fin_actual = $dt_fin->format('H:i');
            ?>

            <div class="form-group" style="margin-bottom: 20px;">
                <label><b>Fecha y Hora Actual de este Día:</b></label>
                <div style="background: var(--bg-input); padding: 15px; border-radius: 8px; font-size: 14px; margin-top: 5px;">
                    <i class="fa-regular fa-calendar"></i> <?php echo $fecha_actual; ?> <br>
                    <i class="fa-regular fa-clock" style="margin-top: 8px;"></i> <?php echo $hora_ini_actual; ?> - <?php echo $hora_fin_actual; ?>
                </div>
            </div>

            <!-- Como es solo un día, podemos dejarles escoger la fecha nueva en caso que la quieran mover, y la hora de entrada y salida -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label class="form-label" for="fecha">Cambiar Fecha (Opcional)</label>
                <input type="date" id="fecha" name="fecha" class="form-control" value="<?= $fecha_actual ?>" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label" for="hora_inicio">Nueva Hora Inicio</label>
                    <input type="time" id="hora_inicio" name="hora_inicio" class="form-control" value="<?= $hora_ini_actual ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="hora_fin">Nueva Hora Fin</label>
                    <input type="time" id="hora_fin" name="hora_fin" class="form-control" value="<?= $hora_fin_actual ?>" required>
                </div>
            </div>

            <div style="margin-top: 30px; text-align: right;">
                <button type="submit" class="btn-primary">
                    <i class="fa-solid fa-save"></i> Guardar Cambios para este Día
                </button>
            </div>
        </form>
    </div>
</div>
