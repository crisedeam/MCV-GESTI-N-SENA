<div class="view-container">
    <div class="breadcrumb">
        <span>Gestión</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Infraestructura</span>
    </div>

    <div class="view-header">
        <div class="view-title-block">
            <h1>Ambientes</h1>
            <p>Administración de espacios físicos para la formación.</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Buscar ambiente...">
            </div>
            <button class="btn-notifications">
                <i class="fa-regular fa-bell"></i>
            </button>
            <a href="?controller=Ambiente&action=register" class="btn-primary" style="text-decoration: none;">
                <i class="fa-solid fa-plus"></i> Nuevo Ambiente
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
                    <th>NOMBRE DEL AMBIENTE</th>
                    <th>TIPO DE AMBIENTE</th>
                    <th>CAPACIDAD</th>
                    <th>CENTRO DE FORMACIÓN</th>
                    <th>ESTADO</th>
                    <th style="text-align: right;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($listaAmbientes)): ?>
                <tr>
                    <td colspan="6" class="empty-table-message">
                        No hay ambientes registrados todavía. <br>
                        Utilice el botón "Nuevo Ambiente" para agregar uno.
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($listaAmbientes as $ambiente): ?>
                    <tr>
                        <td style="font-weight: 500; font-family: 'Outfit', sans-serif; color: #39A900;"><?= htmlspecialchars($ambiente->getAmb_nombre()) ?></td>
                        <td>---</td>
                        <td>---</td>
                        <td style="font-weight: 500;"><?= htmlspecialchars($ambiente->getSEDE_sede_id()) ?></td>
                        <td><span class="status-active">Activo</span></td>
                        <td style="text-align: right;">
                            <a href="?controller=Ambiente&action=details&id=<?= htmlspecialchars($ambiente->getAmb_id()) ?>" class="btn-icon" title="Ver Detalles"><i class="fa-regular fa-eye"></i></a>
                            <a href="?controller=Ambiente&action=updateshow&id=<?= htmlspecialchars($ambiente->getAmb_id()) ?>" class="btn-icon" title="Editar"><i class="fa-solid fa-pen"></i></a>
                            <a href="?controller=Ambiente&action=delete&id=<?= htmlspecialchars($ambiente->getAmb_id()) ?>" class="btn-icon delete-icon" title="Eliminar" onclick="return confirm('¿Está seguro?');"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
