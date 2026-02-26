<div class="view-container">
    <div class="breadcrumb">
        <span>Gestión</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <a href="?controller=Ficha&action=index" style="color: #6b7280; text-decoration: none;">Fichas</a>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Detalles de Ficha</span>
    </div>

    <div class="view-header" style="align-items: center;">
        <div class="view-title-block">
            <h1>Detalles de la Ficha</h1>
            <p>Información de la cohorte seleccionada.</p>
        </div>
        <div class="header-actions">
            <a href="?controller=Ficha&action=index" class="btn-secondary" style="text-decoration: none;">
                <i class="fa-solid fa-arrow-left"></i> Volver a Fichas
            </a>
            <a href="?controller=Ficha&action=updateshow&id=<?= htmlspecialchars($ficha->getFich_id()) ?>" class="btn-primary" style="text-decoration: none;">
                <i class="fa-solid fa-pen"></i> Editar
            </a>
        </div>
    </div>

    <div class="details-card" style="box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: none; border-top: 4px solid var(--brand-primary); background: var(--bg-card);">
        <div class="details-header" style="border-bottom: 1px solid var(--border-color-light); padding-bottom: 15px; margin-bottom: 20px;">
            <div class="details-icon" style="background: rgba(57, 169, 0, 0.1); padding: 15px; border-radius: 50%;">
                <i class="fa-solid fa-users-viewfinder" style="font-size: 28px; color: var(--brand-primary);"></i>
            </div>
            <div class="details-title-group" style="padding-left: 15px;">
                <h3 style="color: var(--text-primary); margin: 0; font-size: 22px;">Ficha #<?= htmlspecialchars($ficha->getFich_id()) ?></h3>
                <p style="color: var(--text-secondary); margin: 5px 0 0 0; font-size: 14px;">Grupo de aprendices de formación especializada</p>
            </div>
        </div>

        <div class="details-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
            <div class="detail-group" style="background: var(--bg-input); padding: 15px; border-radius: 8px;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-tertiary); font-weight: 700;">NÚMERO DE FICHA</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px;"><?= htmlspecialchars($ficha->getFich_id()) ?></div>
            </div>
            
            <div class="detail-group" style="background: var(--bg-input); padding: 15px; border-radius: 8px;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-tertiary); font-weight: 700;">PROGRAMA ASOCIADO</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px;">
                    <i class="fa-solid fa-folder-open" style="color: var(--brand-primary); margin-right: 5px;"></i> <?= htmlspecialchars($ficha->getPROGRAMA_prog_id()) ?>
                </div>
            </div>

            <div class="detail-group" style="background: var(--bg-input); padding: 15px; border-radius: 8px;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-tertiary); font-weight: 700;">INSTRUCTOR LÍDER</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px;">
                    <i class="fa-solid fa-chalkboard-user" style="color: var(--brand-primary); margin-right: 5px;"></i> <?= htmlspecialchars($ficha->getINSTRUCTOR_inst_id_lider()) ?>
                </div>
            </div>

            <div class="detail-group" style="background: var(--bg-input); padding: 15px; border-radius: 8px;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-tertiary); font-weight: 700;">JORNADA LECTIVA</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px;">
                    <i class="fa-solid fa-sun" style="color: var(--brand-primary); margin-right: 5px;"></i> <?= htmlspecialchars($ficha->getFich_jornada()) ?>
                </div>
            </div>

            <div class="detail-group" style="background: var(--bg-input); padding: 15px; border-radius: 8px;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-tertiary); font-weight: 700;">COORDINACIÓN DE RESPONSABILIDAD</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px;">
                    <i class="fa-solid fa-sitemap" style="color: var(--brand-primary); margin-right: 5px;"></i> <?= htmlspecialchars($ficha->getCOORDINACION_coord_id()) ?>
                </div>
            </div>

            <div class="detail-group" style="background: rgba(57, 169, 0, 0.05); border: 1px solid rgba(57, 169, 0, 0.2); padding: 15px; border-radius: 8px;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--brand-primary); font-weight: 700;">INICIO ETAPA LECTIVA</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px;">
                    <i class="fa-regular fa-calendar-check" style="color: var(--brand-primary); margin-right: 5px;"></i>
                    <?= htmlspecialchars(date('d/m/Y', strtotime($ficha->getFich_fecha_ini_lectiva()))) ?>
                </div>
            </div>

            <div class="detail-group" style="background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.2); padding: 15px; border-radius: 8px;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--danger); font-weight: 700;">FIN ETAPA LECTIVA</label>
                <div class="detail-value" style="font-size: 16px; font-weight: 600; color: var(--text-primary); margin-top: 5px;">
                    <i class="fa-regular fa-calendar-xmark" style="color: var(--danger); margin-right: 5px;"></i>
                    <?= htmlspecialchars(date('d/m/Y', strtotime($ficha->getFich_fecha_fin_lectiva()))) ?>
                </div>
            </div>
        </div>
    </div>
</div>
