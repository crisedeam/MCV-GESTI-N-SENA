<?php
class HomeController {
    public function index() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ?controller=Auth&action=login');
            exit();
        }

        $rol = $_SESSION['rol'] ?? '';

        if ($rol === 'coordinador') {
            require_once 'views/Home/coordinador_dashboard.php';
        } elseif ($rol === 'instructor') {
            require_once 'views/Home/instructor_dashboard.php';
        } else {
            echo "<div style='text-align: center; padding: 50px;'>
                    <h2 style='color: red;'>Error de Acceso</h2>
                    <p>No se reconoce el rol del usuario. Por favor <a href='?controller=Auth&action=logout'>cierre sesión</a> e intente nuevamente.</p>
                  </div>";
        }
    }
}
?>
