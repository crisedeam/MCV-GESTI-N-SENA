<div class="view-container">
    <div class="breadcrumb">
        <span>Gestión</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Talento Humano</span>
    </div>

    <div class="view-header">
        <div class="view-title-block">
            <h1>Instructores</h1>
            <p>Administración del personal docente e instructores.</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Buscar instructor...">
            </div>
            <button class="btn-notifications">
                <i class="fa-regular fa-bell"></i>
            </button>
            <a href="?controller=Intructor&action=register" class="btn-primary" style="text-decoration: none;">
                <i class="fa-solid fa-plus"></i> Nuevo Instructor
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
                    <th>NOMBRES</th>
                    <th>APELLIDOS</th>
                    <th>TIPO DE CONTRATACIÓN</th>
                    <th>ÁREA</th>
                    <th>ESTADO</th>
                    <th style="text-align: right;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($listaIntructores)): ?>
                <tr>
                    <td colspan="6" class="empty-table-message">
                        No hay instructores registrados todavía. <br>
                        Utilice el botón "Nuevo Instructor" para agregar uno.
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($listaIntructores as $instructor): ?>
                    <tr>
                        <td style="font-weight: 500; font-family: 'Outfit', sans-serif; color: #39A900;"><?= htmlspecialchars($instructor->getInst_nombre()) ?></td>
                        <td style="font-weight: 500;"><?= htmlspecialchars($instructor->getInst_apellido()) ?></td>
                        <td>---</td>
                        <td><?= htmlspecialchars($instructor->getCENTRO_FORMACION_cent_id()) ?></td>
                        <td><span class="status-active">Activo</span></td>
                        <td style="text-align: right;">
                            <a href="?controller=Intructor&action=details&id=<?= htmlspecialchars($instructor->getInst_id()) ?>" class="btn-icon" title="Ver Detalles"><i class="fa-regular fa-eye"></i></a>
                            <a href="?controller=Intructor&action=updateshow&id=<?= htmlspecialchars($instructor->getInst_id()) ?>" class="btn-icon" title="Editar"><i class="fa-solid fa-pen"></i></a>
                            <a href="?controller=Intructor&action=delete&id=<?= htmlspecialchars($instructor->getInst_id()) ?>" class="btn-icon delete-icon" title="Eliminar" onclick="return confirm('¿Está seguro?');"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
