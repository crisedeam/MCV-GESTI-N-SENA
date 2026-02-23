<div class="view-container">
    <div class="breadcrumb">
        <span>Gestión</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Infraestructura</span>
    </div>

    <div class="view-header">
        <div class="view-title-block">
            <h1>Centros de Formación</h1>
            <p>Administración de los centros de formación por regionales.</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Buscar centro...">
            </div>
            <button class="btn-notifications">
                <i class="fa-regular fa-bell"></i>
            </button>
            <a href="?controller=CentroFormacion&action=register" class="btn-primary" style="text-decoration: none;">
                <i class="fa-solid fa-plus"></i> Nuevo Centro
            </a>
        </div>
    </div>

    <?php if (isset($_GET['error'])): ?>
        <div style="background-color: #fee2e2; border-left: 4px solid #ef4444; color: #b91c1c; padding: 1rem; margin-bottom: 1.5rem; border-radius: 4px; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
                <?php if ($_GET['error'] == 'foreign_key'): ?>
                    <strong>No se pudo eliminar:</strong> El registro no puede ser eliminado porque tiene otros registros asociados o dependientes.
                <?php else: ?>
                    <strong>Error:</strong> Ocurrió un error al intentar eliminar el registro.
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>NOMBRE DEL CENTRO</th>
                    <th>REGIONAL</th>
                    <th>UBICACIÓN</th>
                    <th>ESTADO</th>
                    <th style="text-align: right;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($listaCentros)): ?>
                <tr>
                    <td colspan="5" class="empty-table-message">
                        No hay centros de formación registrados todavía. <br>
                        Utilice el botón "Nuevo Centro" para agregar uno.
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($listaCentros as $centro): ?>
                    <tr>
                        <td style="font-weight: 500; font-family: 'Outfit', sans-serif;"><?= htmlspecialchars($centro->getCent_nombre()) ?></td>
                        <td>---</td>
                        <td>---</td>
                        <td><span class="status-active">Activo</span></td>
                        <td style="text-align: right;">
                            <a href="?controller=CentroFormacion&action=details&id=<?= htmlspecialchars($centro->getCent_id()) ?>" class="btn-icon" title="Ver Detalles"><i class="fa-regular fa-eye"></i></a>
                            <a href="?controller=CentroFormacion&action=updateshow&id=<?= htmlspecialchars($centro->getCent_id()) ?>" class="btn-icon" title="Editar"><i class="fa-solid fa-pen"></i></a>
                            <a href="?controller=CentroFormacion&action=delete&id=<?= htmlspecialchars($centro->getCent_id()) ?>" class="btn-icon delete-icon" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar este registro?');"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
