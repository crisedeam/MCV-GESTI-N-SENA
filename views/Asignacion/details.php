<div class="view-container">
    <div class="breadcrumb">
        <span>Ejecución</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <a href="?controller=Asignacion&action=index" style="color: #6b7280; text-decoration: none;">Asignaciones</a>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span style="color: #39A900; font-weight: 700;">Detalles</span>
    </div>

    <div class="view-header">
        <div class="view-title-block">
            <h1>Detalles de la Asignación</h1>
            <p>Información completa sobre la programación seleccionada.</p>
        </div>
        <div class="header-actions">
            <a href="?controller=Asignacion&action=index" class="btn-secondary" style="text-decoration: none;">
                <i class="fa-solid fa-arrow-left"></i> Volver a Asignaciones
            </a>
            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'coordinador'): ?>
            <a href="?controller=Asignacion&action=updateshow&id=<?= htmlspecialchars($asignacion->getASIG_ID()) ?>" class="btn-primary" style="text-decoration: none;">
                <i class="fa-solid fa-pen"></i> Editar
            </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="details-card" style="box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: none; border-top: 4px solid var(--brand-primary); background: var(--bg-card);">
        <div class="details-header" style="border-bottom: 1px solid var(--border-color-light); padding-bottom: 15px; margin-bottom: 20px;">
            <div class="details-icon" style="background: rgba(57, 169, 0, 0.1); padding: 15px; border-radius: 50%;">
                <i class="fa-solid fa-calendar-check" style="font-size: 28px; color: var(--brand-primary);"></i>
            </div>
            <div class="details-title-group" style="padding-left: 15px;">
                <h3 style="color: var(--text-primary); margin: 0; font-size: 22px;">Asignación #<?= htmlspecialchars($asignacion->getASIG_ID()) ?></h3>
                <p style="color: var(--text-secondary); margin: 5px 0 0 0; font-size: 14px;">Programación de ambiente confirmada</p>
            </div>
        </div>

        <div class="details-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
            <div class="detail-group" style="background: var(--bg-input); padding: 15px; border-radius: 8px;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-tertiary); font-weight: 700;">ID ASIGNACIÓN</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px;"><?= htmlspecialchars($asignacion->getASIG_ID()) ?></div>
            </div>
            
            <div class="detail-group" style="background: var(--bg-input); padding: 15px; border-radius: 8px;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-tertiary); font-weight: 700;">INSTRUCTOR ASIGNADO</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px;">
                    <i class="fa-solid fa-user-tie" style="color: var(--brand-primary); margin-right: 5px;"></i> <?= htmlspecialchars($asignacion->getInstructor_nombre() ? $asignacion->getInstructor_nombre() : $asignacion->getINSTRUCTOR_inst_id()) ?>
                </div>
            </div>

            <div class="detail-group" style="background: var(--bg-input); padding: 15px; border-radius: 8px;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-tertiary); font-weight: 700;">FICHA ASIGNADA</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px;">
                    <i class="fa-solid fa-users-viewfinder" style="color: var(--brand-primary); margin-right: 5px;"></i> <?= htmlspecialchars($asignacion->getFICHA_fich_id()) ?>
                </div>
            </div>

            <div class="detail-group" style="background: var(--bg-input); padding: 15px; border-radius: 8px;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-tertiary); font-weight: 700;">AMBIENTE</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px;">
                    <i class="fa-solid fa-building" style="color: var(--brand-primary); margin-right: 5px;"></i> <?= htmlspecialchars($asignacion->getAMBIENTE_amb_id()) ?>
                </div>
            </div>

            <div class="detail-group" style="background: var(--bg-input); padding: 15px; border-radius: 8px; grid-column: 1 / -1;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-tertiary); font-weight: 700;">COMPETENCIA</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px;">
                    <i class="fa-solid fa-book-open" style="color: var(--brand-primary); margin-right: 5px;"></i> <?= htmlspecialchars($asignacion->getCompetencia_nombre() ? $asignacion->getCompetencia_nombre() : $asignacion->getCOMPETENCIA_comp_id()) ?>
                </div>
            </div>

            <div class="detail-group" style="background: rgba(57, 169, 0, 0.05); border: 1px solid rgba(57, 169, 0, 0.2); padding: 15px; border-radius: 8px;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--brand-primary); font-weight: 700;">RANGO DE INICIO</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px;">
                    <i class="fa-regular fa-calendar-check" style="color: var(--brand-primary); margin-right: 5px;"></i>
                    <?= htmlspecialchars(date('d/m/Y', strtotime($asignacion->getAsig_fecha_ini()))) ?>
                </div>
            </div>

            <div class="detail-group" style="background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.2); padding: 15px; border-radius: 8px;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--danger); font-weight: 700;">RANGO DE FIN</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px;">
                    <i class="fa-regular fa-calendar-xmark" style="color: var(--danger); margin-right: 5px;"></i>
                    <?= htmlspecialchars(date('d/m/Y', strtotime($asignacion->getAsig_fecha_fin()))) ?>
                </div>
            </div>
        </div>
    </div>

    <div class='form-container' style='margin-top: 24px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border-radius: 12px; border-left: none; background: var(--bg-card); overflow: hidden;'>
        <div class='form-main-panel' style='width: 100%; border: none; padding: 24px;'>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="color: var(--brand-primary); font-family: 'Outfit', sans-serif; margin: 0; font-size: 20px;">
                    <i class="fa-regular fa-calendar-days"></i> Calendario de esta Asignación
                </h3>
                <span class="status-badge active" style="font-size: 12px; padding: 6px 12px; background: rgba(57, 169, 0, 0.1); color: var(--brand-primary); border-radius: 20px; font-weight: 600;">
                    <i class="fa-solid fa-circle" style="font-size: 8px; margin-right: 4px;"></i> Viendo Agenda
                </span>
            </div>
            <div id='calendar'></div>
        </div>
    </div>
</div>

<!-- Modal para Detalles de Evento (Solo visible mediante JS) -->
<div id="eventModal" class="event-modal-overlay" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div class="event-modal-content" style="background: var(--bg-card); width: 100%; max-width: 450px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); overflow: hidden; transform: scale(0.95); transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
        <!-- Encabezado del Modal -->
        <div style="background: var(--brand-primary); padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; color: white;">
            <h3 style="margin: 0; font-size: 16px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                <i class="fa-regular fa-calendar-check"></i> Detalles de la Programación
            </h3>
            <button onclick="closeEventModal()" style="background: none; border: none; color: white; opacity: 0.8; cursor: pointer; font-size: 18px; padding: 0;">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        
        <!-- Cuerpo del Modal -->
        <div style="padding: 20px;">
            <!-- Título Ficha -->
            <div style="margin-bottom: 20px; text-align: center;">
                <span style="display: inline-block; background: rgba(57, 169, 0, 0.1); color: var(--brand-primary); font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 20px; letter-spacing: 0.5px; margin-bottom: 5px;">FICHA ASIGNADA</span>
                <h2 id="modalEventTitle" style="margin: 0; color: var(--text-primary); font-size: 22px; font-weight: 800;">#0000000</h2>
            </div>

            <!-- Grid de Info -->
            <div style="display: grid; grid-template-columns: 1fr; gap: 15px;">
                <div style="display: flex; align-items: flex-start; gap: 12px; padding: 12px; background: var(--bg-input); border-radius: 8px; border: 1px solid var(--border-color-light);">
                    <div style="color: var(--brand-secondary); font-size: 18px; padding-top: 2px;"><i class="fa-regular fa-clock"></i></div>
                    <div>
                        <span style="display: block; font-size: 11px; text-transform: uppercase; color: var(--text-tertiary); font-weight: 700; margin-bottom: 3px;">Horario Programado</span>
                        <span id="modalEventTime" style="color: var(--text-primary); font-weight: 600; font-size: 14px;">00:00 - 00:00</span>
                    </div>
                </div>
                
                <div style="display: flex; align-items: flex-start; gap: 12px; padding: 12px; background: var(--bg-input); border-radius: 8px; border: 1px solid var(--border-color-light);">
                    <div style="color: var(--brand-secondary); font-size: 18px; padding-top: 2px;"><i class="fa-solid fa-door-open"></i></div>
                    <div>
                        <span style="display: block; font-size: 11px; text-transform: uppercase; color: var(--text-tertiary); font-weight: 700; margin-bottom: 3px;">Ambiente de Formación</span>
                        <span id="modalEventAmbiente" style="color: var(--text-primary); font-weight: 600; font-size: 14px;">Cargando...</span>
                    </div>
                </div>
                
                <div style="display: flex; align-items: flex-start; gap: 12px; padding: 12px; background: var(--bg-input); border-radius: 8px; border: 1px solid var(--border-color-light);">
                    <div style="color: var(--brand-secondary); font-size: 18px; padding-top: 2px;"><i class="fa-solid fa-book"></i></div>
                    <div>
                        <span style="display: block; font-size: 11px; text-transform: uppercase; color: var(--text-tertiary); font-weight: 700; margin-bottom: 3px;">Competencia</span>
                        <span id="modalEventCompetencia" style="color: var(--text-primary); font-weight: 600; font-size: 13px; line-height: 1.4; display: block;">Cargando...</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer del Modal -->
        <div style="padding: 15px 20px; background: var(--bg-page); border-top: 1px solid var(--border-color-light); text-align: center; display: flex; gap: 10px; justify-content: space-between;">
            <button onclick="closeEventModal()" class="btn-secondary" style="flex: 1;">Cerrar</button>
            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'coordinador'): ?>
                <a href="#" id="btnEditDay" class="btn-primary" style="flex: 1; text-decoration: none; padding: 8px 15px; font-size: 14px;">
                    <i class="fa-solid fa-pen-to-square"></i> Editar Día
                </a>
                <a href="#" id="btnEditAll" class="btn-primary" style="flex: 1; text-decoration: none; padding: 8px 15px; font-size: 14px; background: var(--brand-secondary);">
                    <i class="fa-solid fa-layer-group"></i> Editar Todo
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
function closeEventModal() {
    const modal = document.getElementById('eventModal');
    const modalContent = modal.querySelector('.event-modal-content');
    modalContent.style.transform = 'scale(0.95)';
    setTimeout(() => {
        modal.style.display = 'none';
    }, 150);
}

// Cerrar modal si se hace clic afuera
document.getElementById('eventModal').addEventListener('click', function(e) {
    if(e.target === this) {
        closeEventModal();
    }
});
</script>

<!-- FullCalendar CSS y JS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js'></script>
<link rel="stylesheet" href="assets/css/calendar.css">

<script>
    window.calendarEventsData = <?php echo isset($eventosJson) ? $eventosJson : '[]'; ?>;
    window.viewingAsigId = '<?php echo $asignacion->getASIG_ID(); ?>';
    window.isCoordinador = <?php echo (isset($_SESSION['rol']) && $_SESSION['rol'] === 'coordinador') ? 'true' : 'false'; ?>;
</script>
<script src="assets/js/Asignacion/details.js"></script>
