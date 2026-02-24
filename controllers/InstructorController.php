<?php
// =========================================================================
// CONTROLADOR PARA EL MODELO: Instructor
// =========================================================================
// Tu misión didáctica: Programa la lógica interna de esta clase.
// =========================================================================

require_once 'models/Instructor.php';

class InstructorController {
    public function index() { 
        static $listaInstructores = [];
        $listaInstructores = Instructor::all();
        
        $totalInstructores = count($listaInstructores);
        require_once 'views/Instructor/show.php';
    }
    public function register() { 
        require_once 'views/Instructor/register.php';
    }
    public function save() { 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $instructor = new Instructor($_POST['inst_id'], $_POST['inst_nombre'], $_POST['inst_apellido'], $_POST['inst_correo'], $_POST['inst_telefono'], $_POST['CENTRO_FORMACION_cent_id'], $_POST['inst_password']);
            Instructor::save($instructor);
            header('Location: ?controller=Instructor&action=index');
        }
    }
    public function details() { 
        $instructor = Instructor::searchById($_GET['id']);
        require_once 'views/Instructor/details.php';
    }
    public function updateshow() { 
        $instructor = Instructor::searchById($_GET['id']);
        require_once 'views/Instructor/updateshow.php';
    }
    public function update() { 
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
