<?php
class AuthController {

    public function login() {
        // Redirigir si ya está autenticado
        if (isset($_SESSION['usuario_id'])) {
            header('Location: ?controller=Home&action=index');
            exit();
        }
        require_once 'views/Auth/login.php';
    }

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $correo = $_POST['correo'];
            $password = $_POST['password'];

            $db = DB::getConnect();

            // 1. Buscar en Coordinacion
            $stmtCoord = $db->prepare('SELECT * FROM coordinacion WHERE coord_correo = :correo');
            $stmtCoord->bindValue('correo', $correo);
            $stmtCoord->execute();
            $coordinador = $stmtCoord->fetch();

            if ($coordinador && (password_verify($password, $coordinador['coord_password']) || $password === $coordinador['coord_password'])) {
                // Iniciar sesión como coordinador
                $_SESSION['usuario_id'] = $coordinador['coord_id'];
                $_SESSION['rol'] = 'coordinador';
                $_SESSION['nombre'] = $coordinador['coord_nombre_coordinador'];
                
                header('Location: ?controller=Home&action=index');
                exit();
            }

            // 2. Buscar en Instructor
            $stmtInst = $db->prepare('SELECT * FROM instructor WHERE inst_correo = :correo');
            $stmtInst->bindValue('correo', $correo);
            $stmtInst->execute();
            $instructor = $stmtInst->fetch();

            if ($instructor && (password_verify($password, $instructor['inst_password']) || $password === $instructor['inst_password'])) {
                // Iniciar sesión como instructor
                $_SESSION['usuario_id'] = $instructor['inst_id'];
                $_SESSION['rol'] = 'instructor';
                $_SESSION['nombre'] = $instructor['inst_nombres'] . ' ' . $instructor['inst_apellidos'];
                
                header('Location: ?controller=Home&action=index');
                exit();
            }

            // Si llegamos aquí, las credenciales son incorrectas
            header('Location: ?controller=Auth&action=login&error=invalid_credentials');
            exit();
        }
    }

    public function logout() {
        // Destruir todas las variables de sesión
        $_SESSION = array();

        // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finalmente, destruir la sesión.
        session_destroy();

        // Redirigir al login
        header('Location: ?controller=Auth&action=login');
        exit();
    }
}
?>
