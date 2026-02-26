<div class="view-container">
    <div class="breadcrumb">
        <span>Gestión</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <a href="?controller=Instructor&action=index" style="color: #6b7280; text-decoration: none;">Instructores</a>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Fichas Asignadas</span>
    </div>

    <div class="view-header" style="align-items: center;">
        <div class="view-title-block">
            <h1>Historial de Fichas de Formación</h1>
            <p>Fichas que han sido o están siendo impartidas por: <strong><?= htmlspecialchars($instructor->getInst_nombre()) ?> <?= htmlspecialchars($instructor->getInst_apellido()) ?></strong></p>
        </div>
        <div class="header-actions">
            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] !== 'instructor'): ?>
            <a href="?controller=Instructor&action=index" class="btn-secondary" style="text-decoration: none;">
                <i class="fa-solid fa-arrow-left"></i> Volver a Instructores
            </a>
            <?php endif; ?>
        </div>
    </div>

    <div style="margin-top: 10px; padding-top: 10px;">
        <?php if(empty($fichasAsignadas)): ?>
            <div style="background: var(--bg-card); padding: 60px 20px; text-align: center; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 400px;">
                <div style="width: 80px; height: 80px; background: rgba(57, 169, 0, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                    <i class="fa-solid fa-folder-open" style="font-size: 36px; color: var(--brand-primary);"></i>
                </div>
                <h3 style="color: var(--text-primary); font-size: 20px; font-weight: 700; margin-bottom: 10px; font-family: 'Outfit', sans-serif;">Aún no hay Fichas Asignadas</h3>
                <p style="color: var(--text-secondary); font-size: 15px; max-width: 450px; line-height: 1.5; margin: 0 auto;">
                    Este historial está vacío porque el instructor seleccionado todavía no ha sido programado para impartir formación. Las fichas aparecerán aquí orgánicamente una vez el Coordinador cree nuevas clases en el módulo de Asignaciones.
                </p>
                <div style="margin-top: 30px;">
                     <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] !== 'instructor'): ?>
                        <a href="?controller=Asignacion&action=register" class="btn-primary" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-plus"></i> Crear Nueva Asignación
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
                <?php foreach($fichasAsignadas as $ficha): ?>
                    <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 10px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); transition: all 0.2s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 15px rgba(0,0,0,0.05)'; this.style.borderColor='var(--brand-primary)'" onmouseout="this.style.transform='none'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.02)'; this.style.borderColor='var(--border-color)'">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                            <span style="background: rgba(57, 169, 0, 0.1); color: var(--brand-primary); font-size: 12px; font-weight: 700; padding: 5px 10px; border-radius: 6px; letter-spacing: 0.5px;">FICHA DE FORMACIÓN</span>
                            <span style="font-weight: 800; color: var(--text-primary); font-size: 18px;"><i class="fa-solid fa-hashtag" style="font-size: 14px; color: var(--brand-secondary);"></i> <?= htmlspecialchars($ficha['fich_id']) ?></span>
                        </div>
                        
                        <div style="margin-bottom: 15px;">
                            <h5 style="margin: 0 0 5px 0; color: var(--text-primary); font-size: 15px; font-weight: 600; line-height: 1.4;">
                                <?= htmlspecialchars($ficha['prog_denominacion']) ?>
                            </h5>
                        </div>
                        
                        <div style="border-top: 1px dashed var(--border-color-light); padding-top: 15px; display: flex; align-items: center; justify-content: space-between;">
                            <div style="color: var(--text-secondary); font-size: 13px; display: flex; align-items: center; gap: 6px;">
                                <i class="fa-solid fa-barcode" style="color: var(--text-tertiary);"></i> <span style="font-weight: 600;">Cód:</span> <?= htmlspecialchars($ficha['prog_codigo']) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
