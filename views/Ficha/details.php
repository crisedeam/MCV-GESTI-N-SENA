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
            <p>Información de la ficha seleccionada.</p>
        </div>
        <div class="header-actions">
            <a href="?controller=Ficha&action=updateshow&id=<?= htmlspecialchars($ficha->getFich_id()) ?>" class="btn-action edit" title="Editar" style="padding: 10px 16px; background-color: #f3f4f6; color: #374151; font-weight: 600; text-decoration: none; border-radius: 8px; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-pen-to-square"></i> Editar
            </a>
            <a href="?controller=Ficha&action=delete&id=<?= htmlspecialchars($ficha->getFich_id()) ?>" onclick="return confirm('¿Está seguro de eliminar este registro?');" class="btn-action delete" title="Eliminar Ficha" style="padding: 10px 16px; background-color: #fee2e2; color: #ef4444; font-weight: 600; text-decoration: none; border-radius: 8px; display: flex; align-items: center; gap: 8px; cursor: pointer; border: none;">
                <i class="fa-solid fa-trash"></i> Eliminar
            </a>
        </div>
    </div>

    <div style="background-color: white; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            <div>
                <h3 style="font-size: 16px; margin: 0 0 16px 0; color: #111827; border-bottom: 1px solid #e5e7eb; padding-bottom: 8px;">Información General</h3>
                <div style="margin-bottom: 12px;">
                    <span style="font-size: 12px; color: #6b7280; font-weight: 600; text-transform: uppercase;">Código de Ficha</span>
                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #111827;"><?= htmlspecialchars($ficha->getFich_id()) ?></p>
                </div>
                <div style="margin-bottom: 12px;">
                    <span style="font-size: 12px; color: #6b7280; font-weight: 600; text-transform: uppercase;">Programa de Formación</span>
                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #111827;"><?= htmlspecialchars($ficha->getPROGRAMA_prog_id()) ?></p>
                </div>
            </div>
            <div>
                <h3 style="font-size: 16px; margin: 0 0 16px 0; color: #111827; border-bottom: 1px solid #e5e7eb; padding-bottom: 8px;">Administración y Asignaciones</h3>
                <div style="margin-bottom: 12px;">
                    <span style="font-size: 12px; color: #6b7280; font-weight: 600; text-transform: uppercase;">Instructor Líder</span>
                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #111827;"><?= htmlspecialchars($ficha->getINSTRUCTOR_inst_id_lider()) ?></p>
                </div>
                <div style="margin-bottom: 12px;">
                    <span style="font-size: 12px; color: #6b7280; font-weight: 600; text-transform: uppercase;">Jornada</span>
                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #111827;"><?= htmlspecialchars($ficha->getFich_jornada()) ?></p>
                </div>
                <div style="margin-bottom: 12px;">
                    <span style="font-size: 12px; color: #6b7280; font-weight: 600; text-transform: uppercase;">Coordinación</span>
                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #111827;"><?= htmlspecialchars($ficha->getCOORDINACION_coord_id()) ?></p>
                </div>
                <div style="margin-bottom: 12px;">
                    <span style="font-size: 12px; color: #6b7280; font-weight: 600; text-transform: uppercase;">Fecha Inicio Lectiva</span>
                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #111827;"><?= htmlspecialchars($ficha->getFich_fecha_ini_lectiva()) ?></p>
                </div>
                <div style="margin-bottom: 12px;">
                    <span style="font-size: 12px; color: #6b7280; font-weight: 600; text-transform: uppercase;">Fecha Fin Lectiva</span>
                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #111827;"><?= htmlspecialchars($ficha->getFich_fecha_fin_lectiva()) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
