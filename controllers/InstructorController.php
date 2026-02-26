<?php
// =========================================================================
// CONTROLADOR PARA EL MODELO: Instructor
// =========================================================================
// Tu misión didáctica: Programa la lógica interna de esta clase.
// =========================================================================

require_once 'models/Instructor.php';

class InstructorController {
    public function index() { 
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'instructor') { header('Location: ?controller=Instructor&action=fichas&id='.$_SESSION['usuario_id']); exit; }
        
        static $listaInstructores = [];
        $listaInstructores = Instructor::all();
        
        $totalInstructores = count($listaInstructores);
        require_once 'views/Instructor/show.php';
    }
    public function register() { 
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'instructor') { header('Location: ?controller=Home&action=index'); exit; }
        require_once 'views/Instructor/register.php';
    }
    public function save() { 
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'instructor') { header('Location: ?controller=Home&action=index'); exit; }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $instructor = new Instructor($_POST['inst_id'], $_POST['inst_nombre'], $_POST['inst_apellido'], $_POST['inst_correo'], $_POST['inst_telefono'], $_POST['CENTRO_FORMACION_cent_id'], $_POST['inst_password']);
            Instructor::save($instructor);
            header('Location: ?controller=Instructor&action=index');
        }
    }
    public function details() { 
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'instructor') { header('Location: ?controller=Home&action=index'); exit; }
        $instructor = Instructor::searchById($_GET['id']);
        require_once 'views/Instructor/details.php';
    }
    
    public function fichas() {
        // Instructors can only view their own Fichas
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'instructor' && $_GET['id'] != $_SESSION['usuario_id']) { 
            header('Location: ?controller=Instructor&action=fichas&id='.$_SESSION['usuario_id']); 
            exit; 
        }
        $instructor = Instructor::searchById($_GET['id']);
        $fichasAsignadas = Instructor::getFichasAsignadas($_GET['id']);
        require_once 'views/Instructor/fichas.php';
    }
    public function updateshow() { 
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'instructor') { header('Location: ?controller=Home&action=index'); exit; }
        $instructor = Instructor::searchById($_GET['id']);
        require_once 'views/Instructor/updateshow.php';
    }
    public function update() { 
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'instructor') { header('Location: ?controller=Home&action=index'); exit; }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $password = isset($_POST['inst_password']) ? $_POST['inst_password'] : '';
            $instructor = new Instructor($_POST['inst_id'], $_POST['inst_nombre'], $_POST['inst_apellido'], $_POST['inst_correo'], $_POST['inst_telefono'], $_POST['CENTRO_FORMACION_cent_id'], $password);
            Instructor::update($instructor);
            header('Location: ?controller=Instructor&action=index');
        }
    }
    public function delete() { 
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            try {
                $instructor = Instructor::searchById($_GET['id']);
                Instructor::delete($_GET['id']);
                header('Location: ?controller=Instructor&action=index');
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    header('Location: ?controller=Instructor&action=index&error=foreign_key');
                } else {
                    header('Location: ?controller=Instructor&action=index&error=general');
                }
            }
        }
    }
}
?>
