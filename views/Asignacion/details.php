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

    <div class="details-card">
        <div class="details-header">
            <div class="details-icon">
                <i class="fa-solid fa-calendar-check" style="font-size: 24px; color: #39A900;"></i>
            </div>
            <div class="details-title-group">
                <h3>Asignación #<?= htmlspecialchars($asignacion->getASIG_ID()) ?></h3>
                <p>Fecha de creación no registrada</p>
            </div>
        </div>

        <div class="details-grid">
            <div class="detail-group">
                <label>ID ASIGNACIÓN</label>
                <div class="detail-value"><?= htmlspecialchars($asignacion->getASIG_ID()) ?></div>
            </div>
            
            <div class="detail-group">
                <label>INSTRUCTOR ASIGNADO</label>
                <div class="detail-value"><?= htmlspecialchars($asignacion->getINSTRUCTOR_inst_id()) ?></div>
            </div>

            <div class="detail-group">
                <label>FICHA ASIGNADA</label>
                <div class="detail-value"><?= htmlspecialchars($asignacion->getFICHA_fich_id()) ?></div>
            </div>

            <div class="detail-group">
                <label>AMBIENTE</label>
                <div class="detail-value"><?= htmlspecialchars($asignacion->getAMBIENTE_amb_id()) ?></div>
            </div>

            <div class="detail-group">
                <label>COMPETENCIA</label>
                <div class="detail-value"><?= htmlspecialchars($asignacion->getCOMPETENCIA_comp_id()) ?></div>
            </div>

            <div class="detail-group">
                <label>FECHA DE INICIO</label>
                <div class="detail-value">
                    <i class="fa-regular fa-calendar" style="color:#6b7280; margin-right:5px;"></i>
                    <?= htmlspecialchars(date('d/m/Y h:i A', strtotime($asignacion->getAsig_fecha_ini()))) ?>
                </div>
            </div>

            <div class="detail-group">
                <label>FECHA FINAL</label>
                <div class="detail-value">
                    <i class="fa-solid fa-calendar-xmark" style="color:#6b7280; margin-right:5px;"></i>
                    <?= htmlspecialchars(date('d/m/Y h:i A', strtotime($asignacion->getAsig_fecha_fin()))) ?>
                </div>
            </div>
        </div>
    </div>
</div>
