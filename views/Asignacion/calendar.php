<div class="view-container">
    <div class="breadcrumb">
        <span>Ejecución</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Mi Horario</span>
    </div>

    <div class="view-header">
        <div class="view-title-block">
            <h1><?php echo (isset($_SESSION['rol']) && $_SESSION['rol'] === 'coordinador') ? 'Horarios de Instructores' : 'Mi Horario'; ?></h1>
            <p>Visualiza las programaciones asignadas en el calendario.</p>
        </div>
        <div class="header-actions">
            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'coordinador'): ?>
                <div class="search-box" style="margin-right: 15px;">
                    <select id="instructorSelect" class="form-control" onchange="window.location.href='?controller=Asignacion&action=calendar&inst_id=' + this.value" style="padding-top: 5px; padding-bottom: 5px; border-radius: 6px;">
                        <option value="">Seleccione Instructor...</option>
                        <?php if (isset($listaInstructores)): ?>
                            <?php foreach($listaInstructores as $inst): ?>
                                <option value="<?= $inst->getInst_id() ?>" <?= (isset($_GET['inst_id']) && $_GET['inst_id'] == $inst->getInst_id()) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($inst->getInst_nombre() . ' ' . $inst->getInst_apellido()) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            <?php endif; ?>
            <!-- Acciones como botón imprimir PDF o exportar -->
            <button class="btn-primary" onclick="window.print()">
                <i class="fa-solid fa-print"></i> Imprimir Horario
            </button>
        </div>
    </div>

    <!-- Contenedor del Calendario -->
    <div class="table-card" style="padding: 20px;">
        <div id="calendar"></div>
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
    window.calendarEventsData = <?php echo $eventosJson; ?>;
    window.isCoordinador = <?php echo (isset($_SESSION['rol']) && $_SESSION['rol'] === 'coordinador') ? 'true' : 'false'; ?>;
</script>
<script src="assets/js/Asignacion/calendar.js"></script>
