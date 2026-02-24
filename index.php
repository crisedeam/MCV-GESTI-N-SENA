<?php
ob_start(); // Iniciar buffer de salida para evitar errores de 'headers already sent'
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'connection.php';
// Controlador y acción por defecto para la lógica de visualización base
$controller_view = $_GET['controller'] ?? 'Auth';
$action_view = $_GET['action'] ?? 'login';

// Si no hay sesión, forzamos a que sea Auth
if (!isset($_SESSION['usuario_id'])) {
    $controller_view = 'Auth';
    $action_view = 'login';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENA - Gestión de Ambientes</title>
    <?php $vs = '?v=' . time(); ?>
    <!-- General Layout CSS -->
    <link rel="stylesheet" href="assets/css/main.css<?= $vs ?>">
    <!-- Sidebar CSS -->
    <link rel="stylesheet" href="assets/css/sidebar.css<?= $vs ?>">
    <!-- Views CSS -->
    <link rel="stylesheet" href="assets/css/views.css<?= $vs ?>">
    <!-- Forms CSS -->
    <link rel="stylesheet" href="assets/css/forms.css<?= $vs ?>">
    <!-- Icons (Font Awesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <?php if ($controller_view == 'Auth'): ?>
        <!-- Si es Auth (Login), no mostramos sidebar y renderizamos completo -->
        <?php require_once 'routing.php'; ?>
    <?php else: ?>
        <div class="main-container">
            <!-- Sidebar -->
            <?php include_once 'views/layouts/sidebar.php'; ?>

            <!-- Main Content Area where views will be loaded -->
            <main class="content-area">
                <?php
                // Requerir nuestra lógica de enrutamiento principal
                require_once 'routing.php';
                ?>
            </main>
        </div>
    <?php endif; ?>

    <!-- MODO OSCURO (DARK THEME) SCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeToggleBtn = document.getElementById('themeToggleBtn');
            const currentTheme = localStorage.getItem('theme');

            // Apply saved theme on load
            if (currentTheme) {
                document.body.classList.add(currentTheme);
                if (currentTheme === 'dark-theme' && themeToggleBtn) {
                    themeToggleBtn.innerHTML = '<i class="fa-solid fa-sun"></i> Modo Claro';
                }
            }

            // Toggle theme on click
            if(themeToggleBtn) {
                themeToggleBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    document.body.classList.toggle('dark-theme');
                    document.body.classList.remove('light-theme');
                    let theme = 'light-theme';
                    
                    if (document.body.classList.contains('dark-theme')) {
                        theme = 'dark-theme';
                        themeToggleBtn.innerHTML = '<i class="fa-solid fa-sun"></i> Modo Claro';
                    } else {
                        themeToggleBtn.innerHTML = '<i class="fa-solid fa-moon"></i> Modo Oscuro';
                        document.body.classList.add('light-theme');
                    }
                    
                    localStorage.setItem('theme', theme);
                });
            }
        });
    </script>
</body>
</html>
<?php
ob_end_flush(); // Enviar el contenido del buffer al navegador
?>
