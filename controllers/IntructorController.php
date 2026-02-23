<?php
// =========================================================================
// CONTROLADOR PARA EL MODELO: Intructor
// =========================================================================
// Tu misión didáctica: Programa la lógica interna de esta clase.
// =========================================================================

require_once 'models/Intructor.php';

class IntructorController {
    public function index() { 
        static $listaIntructors = [];
        $listaIntructors = Intructor::all();
        require_once 'views/Intructor/show.php';
    }
    public function register() { 
        require_once 'views/Intructor/register.php';
    }
    public function save() { 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $intructor = new Intructor($_POST['intructor_id'], $_POST['intructor_nombre'], $_POST['intructor_apellido'], $_POST['intructor_email'], $_POST['intructor_telefono'], $_POST['intructor_centro_formacion'], $_POST['intructor_coordinacion']);
            Intructor::save($intructor);
            header('Location: ?controller=Intructor&action=index');
        }
    }
    public function details() { 
        $intructor = Intructor::searchById($_GET['id']);
        require_once 'views/Intructor/details.php';
    }
    public function updateshow() { 
        $intructor = Intructor::searchById($_GET['id']);
        require_once 'views/Intructor/updateshow.php';
    }
    public function update() { 
<?php
// =========================================================================
// CONTROLADOR PARA EL MODELO: Intructor
// =========================================================================
// Tu misión didáctica: Programa la lógica interna de esta clase.
// =========================================================================

require_once 'models/Intructor.php';

class IntructorController {
    public function index() { 
        static $listaIntructors = [];
        $listaIntructors = Intructor::all();
        require_once 'views/Intructor/show.php';
    }
    public function register() { 
        require_once 'views/Intructor/register.php';
    }
    public function save() { 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $intructor = new Intructor($_POST['intructor_id'], $_POST['intructor_nombre'], $_POST['intructor_apellido'], $_POST['intructor_email'], $_POST['intructor_telefono'], $_POST['intructor_centro_formacion'], $_POST['intructor_coordinacion']);
            Intructor::save($intructor);
            header('Location: ?controller=Intructor&action=index');
        }
    }
    public function details() { 
        $intructor = Intructor::searchById($_GET['id']);
        require_once 'views/Intructor/details.php';
    }
    public function updateshow() { 
        $intructor = Intructor::searchById($_GET['id']);
        require_once 'views/Intructor/updateshow.php';
    }
    public function update() { 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $intructor = new Intructor($_POST['intructor_id'], $_POST['intructor_nombre'], $_POST['intructor_apellido'], $_POST['intructor_email'], $_POST['intructor_telefono'], $_POST['intructor_centro_formacion'], $_POST['intructor_coordinacion']);
            Intructor::update($intructor);
            header('Location: ?controller=Intructor&action=index');
        }
        }
    public function delete() { 
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            try {
                $intructor = Intructor::searchById($_GET['id']);
                Intructor::delete($_GET['id']);
                header('Location: ?controller=Intructor&action=index');
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    header('Location: ?controller=Intructor&action=index&error=foreign_key');
                } else {
                    header('Location: ?controller=Intructor&action=index&error=general');
                }
            }
        }
    }
}
?>
