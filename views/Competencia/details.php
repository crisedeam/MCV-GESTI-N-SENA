<div class="view-container">
    <div class="breadcrumb">
        <span>Gestión</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <a href="?controller=Competencia&action=index" style="color: #6b7280; text-decoration: none;">Competencias</a>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Detalles de Competencia</span>
    </div>

    <div class="view-header" style="align-items: center;">
        <div class="view-title-block">
            <h1>Detalles de la Competencia</h1>
            <p>Información de la competencia seleccionada.</p>
        </div>
        <div class="header-actions">
            <a href="?controller=Competencia&action=index" class="btn-secondary" style="text-decoration: none;">
                <i class="fa-solid fa-arrow-left"></i> Volver a Competencias
            </a>
            <a href="?controller=Competencia&action=updateshow&id=<?= htmlspecialchars($competencia->getComp_id()) ?>" class="btn-primary" style="text-decoration: none;">
                <i class="fa-solid fa-pen"></i> Editar
            </a>
        </div>
    </div>

    <div class="details-card" style="box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: none; border-top: 4px solid var(--brand-primary); background: var(--bg-card);">
        <div class="details-header" style="border-bottom: 1px solid var(--border-color-light); padding-bottom: 15px; margin-bottom: 20px;">
            <div class="details-icon" style="background: rgba(57, 169, 0, 0.1); padding: 15px; border-radius: 50%;">
                <i class="fa-solid fa-book-open" style="font-size: 28px; color: var(--brand-primary);"></i>
            </div>
            <div class="details-title-group" style="padding-left: 15px;">
                <h3 style="color: var(--text-primary); margin: 0; font-size: 22px;">Competencia #<?= htmlspecialchars($competencia->getComp_id()) ?></h3>
                <p style="color: var(--text-secondary); margin: 5px 0 0 0; font-size: 14px;">Módulo de aprendizaje formativo</p>
            </div>
        </div>

        <div class="details-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
            <div class="detail-group" style="background: var(--bg-input); padding: 15px; border-radius: 8px;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-tertiary); font-weight: 700;">CÓDIGO DE COMPETENCIA</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px;"><?= htmlspecialchars($competencia->getComp_id()) ?></div>
            </div>
            
            <div class="detail-group" style="background: var(--bg-input); padding: 15px; border-radius: 8px;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-tertiary); font-weight: 700;">NOMBRE CORTO</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px;">
                    <i class="fa-solid fa-tag" style="color: var(--brand-primary); margin-right: 5px;"></i> <?= htmlspecialchars($competencia->getComp_nombre_corto()) ?>
                </div>
            </div>

            <div class="detail-group" style="background: var(--bg-input); padding: 15px; border-radius: 8px;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-tertiary); font-weight: 700;">DURACIÓN (HORAS)</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px;">
                    <i class="fa-regular fa-clock" style="color: var(--brand-primary); margin-right: 5px;"></i> <?= htmlspecialchars($competencia->getComp_horas()) ?> H
                </div>
            </div>

            <div class="detail-group" style="background: var(--bg-input); padding: 15px; border-radius: 8px; grid-column: 1 / -1;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-tertiary); font-weight: 700;">UNIDAD DE COMPETENCIA (NOMBRE COMPLETO)</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px; line-height: 1.5;">
                    <i class="fa-solid fa-align-left" style="color: var(--brand-primary); margin-right: 5px;"></i> <?= htmlspecialchars($competencia->getComp_nombre_unidad_competencia()) ?>
                </div>
            </div>
        </div>
    </div>
</div>
