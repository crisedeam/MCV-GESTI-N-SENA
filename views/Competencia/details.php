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
            <a href="?controller=Competencia&action=updateshow&id=<?= htmlspecialchars($competencia->getComp_id()) ?>" class="btn-action edit" title="Editar" style="padding: 10px 16px; background-color: #f3f4f6; color: #374151; font-weight: 600; text-decoration: none; border-radius: 8px; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-pen-to-square"></i> Editar
            </a>
            <a href="?controller=Competencia&action=delete&id=<?= htmlspecialchars($competencia->getComp_id()) ?>" onclick="return confirm('¿Está seguro de eliminar este registro?');" class="btn-action delete" title="Eliminar Competencia" style="padding: 10px 16px; background-color: #fee2e2; color: #ef4444; font-weight: 600; text-decoration: none; border-radius: 8px; display: flex; align-items: center; gap: 8px; cursor: pointer; border: none;">
                <i class="fa-solid fa-trash"></i> Eliminar
            </a>
        </div>
    </div>

    <div style="background-color: white; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            <div>
                <h3 style="font-size: 16px; margin: 0 0 16px 0; color: #111827; border-bottom: 1px solid #e5e7eb; padding-bottom: 8px;">Información General</h3>
                <div style="margin-bottom: 12px;">
                    <span style="font-size: 12px; color: #6b7280; font-weight: 600; text-transform: uppercase;">Código</span>
                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #111827;"><?= htmlspecialchars($competencia->getComp_id()) ?></p>
                </div>
                <div style="margin-bottom: 12px;">
                    <span style="font-size: 12px; color: #6b7280; font-weight: 600; text-transform: uppercase;">Nombre Corto</span>
                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #111827;"><?= htmlspecialchars($competencia->getComp_nombre_corto()) ?></p>
                </div>
            </div>
            <div>
                <h3 style="font-size: 16px; margin: 0 0 16px 0; color: #111827; border-bottom: 1px solid #e5e7eb; padding-bottom: 8px;">Detalles Adicionales</h3>
                <div style="margin-bottom: 12px;">
                    <span style="font-size: 12px; color: #6b7280; font-weight: 600; text-transform: uppercase;">Horas</span>
                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #111827;"><?= htmlspecialchars($competencia->getComp_horas()) ?> H</p>
                </div>
                <div style="margin-bottom: 12px;">
                    <span style="font-size: 12px; color: #6b7280; font-weight: 600; text-transform: uppercase;">Unidad de Competencia</span>
                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #111827;"><?= htmlspecialchars($competencia->getComp_nombre_unidad_competencia()) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
