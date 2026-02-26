<div class="view-container">
    <div class="breadcrumb">
        <span>Gestión</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <a href="?controller=Instructor&action=index" style="color: #6b7280; text-decoration: none;">Instructores</a>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Detalles de Instructor</span>
    </div>

    <div class="view-header" style="align-items: center;">
        <div class="view-title-block">
            <h1>Detalles del Instructor</h1>
            <p>Información del instructor seleccionado.</p>
        </div>
        <div class="header-actions">
            <a href="?controller=Instructor&action=index" class="btn-secondary" style="text-decoration: none;">
                <i class="fa-solid fa-arrow-left"></i> Volver a Instructores
            </a>
            <a href="?controller=Instructor&action=updateshow&id=<?= htmlspecialchars($instructor->getInst_id()) ?>" class="btn-primary" style="text-decoration: none;">
                <i class="fa-solid fa-pen"></i> Editar
            </a>
        </div>
    </div>

    <div class="details-card" style="box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: none; border-top: 4px solid var(--brand-primary); background: var(--bg-card);">
        <div class="details-header" style="border-bottom: 1px solid var(--border-color-light); padding-bottom: 15px; margin-bottom: 20px;">
            <div class="details-icon" style="background: rgba(57, 169, 0, 0.1); padding: 15px; border-radius: 50%;">
                <i class="fa-solid fa-user-tie" style="font-size: 28px; color: var(--brand-primary);"></i>
            </div>
            <div class="details-title-group" style="padding-left: 15px;">
                <h3 style="color: var(--text-primary); margin: 0; font-size: 22px;"><?= htmlspecialchars($instructor->getInst_nombre()) ?> <?= htmlspecialchars($instructor->getInst_apellido()) ?></h3>
                <p style="color: var(--text-secondary); margin: 5px 0 0 0; font-size: 14px;">Perfil del empleado formativo</p>
            </div>
        </div>

        <div class="details-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
            <div class="detail-group" style="background: var(--bg-input); padding: 15px; border-radius: 8px;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-tertiary); font-weight: 700;">NÚMERO DE DOCUMENTO / ID</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px;">
                    <i class="fa-solid fa-id-card" style="color: var(--brand-primary); margin-right: 5px;"></i> <?= htmlspecialchars($instructor->getInst_id()) ?>
                </div>
            </div>
            
            <div class="detail-group" style="background: var(--bg-input); padding: 15px; border-radius: 8px;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-tertiary); font-weight: 700;">CORREO ELECTRÓNICO</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px; word-break: break-all;">
                    <i class="fa-solid fa-envelope" style="color: var(--brand-primary); margin-right: 5px;"></i> <?= htmlspecialchars($instructor->getInst_correo()) ?>
                </div>
            </div>

            <div class="detail-group" style="background: var(--bg-input); padding: 15px; border-radius: 8px;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-tertiary); font-weight: 700;">TELÉFONO DE CONTACTO</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px;">
                    <i class="fa-solid fa-phone" style="color: var(--brand-primary); margin-right: 5px;"></i> <?= htmlspecialchars($instructor->getInst_telefono()) ?>
                </div>
            </div>

            <div class="detail-group" style="background: var(--bg-input); padding: 15px; border-radius: 8px; grid-column: 1 / -1;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-tertiary); font-weight: 700;">CENTRO DE FORMACIÓN ASIGNADO</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px;">
                    <i class="fa-solid fa-building-columns" style="color: var(--brand-primary); margin-right: 5px;"></i> <?= htmlspecialchars($instructor->getCENTRO_FORMACION_cent_id()) ?>
                </div>
    </div>
</div>
