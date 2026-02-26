<div class="view-container">
    <div class="breadcrumb">
        <span>Ejecución</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Competencias por Instructor</span>
    </div>

    <div class="view-header">
        <div class="view-title-block">
            <h1>Avales de Instructores</h1>
            <p>Directorio de competencias que los instructores están capacitados para impartir.</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" placeholder="Buscar aval..." onkeyup="filterTable()">
            </div>
            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'coordinador'): ?>
            <a href="?controller=InstruCompetencia&action=register" class="btn-primary" style="text-decoration: none;">
                <i class="fa-solid fa-plus"></i> Nuevo Aval
            </a>
            <?php endif; ?>
        </div>
    </div>

    <?php if (isset($_GET['error'])): ?>
        <div style="background-color: #fee2e2; border-left: 4px solid #ef4444; color: #b91c1c; padding: 1rem; margin-bottom: 1.5rem; border-radius: 4px; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
                <?php if ($_GET['error'] == 'foreign_key'): ?>
                    <strong>No se pudo eliminar:</strong> Este aval está siendo usado en otras dependencias.
                <?php else: ?>
                    <strong>Error:</strong> Ocurrió un error al intentar eliminar el registro.
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Dashboard Mini -->
    <div class="dashboard-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background-color: #e6fced; color: #39A900;">
                <i class="fa-solid fa-certificate"></i>
            </div>
            <div class="stat-details">
                <h3>Total Avales</h3>
                <p class="stat-number"><?php echo $totalAvales ?? 0; ?></p>
            </div>
        </div>
    </div>

    <div class="table-card">
        <table id="dataTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>INSTRUCTOR</th>
                    <th>PROGRAMA (ID)</th>
                    <th>COMPETENCIA</th>
                    <th>VIGENCIA</th>
                    <th>ESTADO</th>
                    <th style="text-align: right;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($listaInstruComp)): ?>
                <tr>
                    <td colspan="7" class="empty-table-message">
                        No hay avales registrados todavía. <br>
                        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'coordinador'): ?>
                        Utilice el botón "Nuevo Aval" para agregar uno.
                        <?php endif; ?>
                    </td>
                </tr>
                <?php else: ?>
                    <?php 
                    $hoy = new DateTime();
                    foreach ($listaInstruComp as $ic): 
                        $vigencia = new DateTime($ic->getInscomp_vigencia());
                        $estaVencido = $vigencia < $hoy;
                    ?>
                    <tr>
                        <td style="font-weight: 500; font-family: 'Outfit', sans-serif; color: #39A900;"><?= htmlspecialchars($ic->getInscomp_id()) ?></td>
                        <td style="font-weight: 500;"><?= htmlspecialchars($instructoresMap[$ic->getINSTRUCTOR_inst_id()] ?? $ic->getINSTRUCTOR_inst_id()) ?></td>
                        <td><?= htmlspecialchars($ic->getCOMPETxPROGRAMA_PROGRAMA_prog_id()) ?></td>
                        <td><?= htmlspecialchars($competenciasMap[$ic->getCOMPETxPROGRAMA_COMPETENCIA_comp_id()] ?? $ic->getCOMPETxPROGRAMA_COMPETENCIA_comp_id()) ?></td>
                        <td><?= htmlspecialchars($vigencia->format('d/m/Y')) ?></td>
                        <td>
                            <?php if($estaVencido): ?>
                                <span style="background: #fee2e2; color: #b91c1c; padding: 2px 8px; border-radius: 12px; font-size: 12px; font-weight: bold;">Vencido</span>
                            <?php else: ?>
                                <span style="background: #dcfce7; color: #166534; padding: 2px 8px; border-radius: 12px; font-size: 12px; font-weight: bold;">Vigente</span>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: right;">
                            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'coordinador'): ?>
                            <a href="?controller=InstruCompetencia&action=updateshow&id=<?= htmlspecialchars($ic->getInscomp_id()) ?>" class="btn-icon" title="Editar / Renovar"><i class="fa-solid fa-pen"></i></a>
                            <a href="?controller=InstruCompetencia&action=delete&id=<?= htmlspecialchars($ic->getInscomp_id()) ?>" class="btn-icon delete-icon" title="Eliminar" onclick="return confirm('¿Está seguro de que desea eliminar este aval?');"><i class="fa-solid fa-trash-can"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="assets/js/InstruCompetencia/show.js"></script>
