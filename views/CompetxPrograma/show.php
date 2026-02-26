<div class="view-container">
    <div class="breadcrumb">
        <span>Gestión Titulaciones</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Competencias por Programa</span>
    </div>

    <div class="view-header">
        <div class="view-title-block">
            <h1>Asignación Competencia x Programa</h1>
            <p>Relacione las competencias formativas a cada titularidad o programa.</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" placeholder="Buscar programa..." onkeyup="filterTable()">
            </div>
            <a href="?controller=CompetxPrograma&action=register" class="btn-primary" style="text-decoration: none;">
                <i class="fa-solid fa-plus"></i> Nueva Asociación
            </a>
        </div>
    </div>

    <?php if (isset($_GET['error'])): ?>
        <div style="background-color: #fee2e2; border-left: 4px solid #ef4444; color: #b91c1c; padding: 1rem; margin-bottom: 1.5rem; border-radius: 4px; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
                <?php if ($_GET['error'] == 'foreign_key'): ?>
                    <strong>Error:</strong> Esta asociación no puede ser eliminada porque está siendo utilizada.
                <?php elseif ($_GET['error'] == 'duplicate'): ?>
                    <strong>Error:</strong> Esta competencia ya se encuentra asociada a este programa.
                <?php else: ?>
                    <strong>Error:</strong> Ocurrió un error general en la operación solicitada.
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Dashboard Mini -->
    <div class="dashboard-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background-color: #eff6ff; color: #1d4ed8;">
                <i class="fa-solid fa-link"></i>
            </div>
            <div class="stat-details">
                <h3>Asociaciones</h3>
                <p class="stat-number"><?php echo count($asignaciones ?? []); ?></p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background-color: #fce7f3; color: #be185d;">
                <i class="fa-solid fa-book-open"></i>
            </div>
            <div class="stat-details">
                <h3>Red Curricular</h3>
                <p class="stat-number">Activa</p>
            </div>
        </div>
    </div>

    <div class="table-card">
        <table id="dataTable">
            <thead>
                <tr>
                    <th>PROGRAMA FORMATIVO</th>
                    <th>COMPETENCIA ASIGNADA</th>
                    <th>DURACIÓN</th>
                    <th style="text-align: right;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($asignaciones)): ?>
                <tr>
                    <td colspan="4" class="empty-table-message">
                        Aún no hay competencias asociadas a ningún programa.<br>
                        Utilice el botón "Nueva Asociación" para agregar una.
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($asignaciones as $asig): ?>
                    <tr>
                        <td style="font-weight: 500; font-size: 14px; color: var(--text-primary);">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <i class="fa-solid fa-book" style="color: var(--brand-primary); font-size: 16px;"></i>
                                <?= htmlspecialchars($asig->getProg_denominacion()) ?>
                            </div>
                        </td>
                        <td style="color: var(--text-secondary);"><?= htmlspecialchars($asig->getComp_nombre()) ?></td>
                        <td>
                            <span style="background-color: var(--bg-hover); color: var(--text-secondary); padding: 4px 8px; border-radius: 6px; font-weight: 600; font-size: 12px; border: 1px solid var(--border-color);">
                                <i class="fa-regular fa-clock"></i> <?= htmlspecialchars($asig->getComp_horas()) ?> h
                            </span>
                        </td>
                        <td style="text-align: right;">
                            <a href="?controller=CompetxPrograma&action=delete&prog_id=<?= $asig->getPROGRAMA_prog_id() ?>&comp_id=<?= $asig->getCOMPETENCIA_comp_id() ?>" class="btn-icon delete-icon" title="Eliminar Asociación" onclick="return confirm('¿Está seguro de eliminar esta relación Programa-Competencia?');"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="assets/js/CompetxPrograma/show.js"></script>
