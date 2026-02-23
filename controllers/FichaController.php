<?php
// =========================================================================
// CONTROLADOR PARA EL MODELO: Ficha
// =========================================================================
// Tu misión didáctica: Programa la lógica interna de esta clase.
// Contiene hasta 3 llaves foráneas según la base de datos que especificaste.
// =========================================================================

require_once 'models/Ficha.php';

class FichaController {
    public function index() { 
        static $listaFichas = [];
        $listaFichas = Ficha::all();
        require_once 'views/Ficha/show.php';
    }
    public function register() { 
        require_once 'views/Ficha/register.php';
    }
    public function save() { 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $ficha = new Ficha($_POST['ficha_id'], $_POST['ficha_numero'], $_POST['ficha_nombre'], $_POST['ficha_estado'], $_POST['ficha_fecha_inicio'], $_POST['ficha_fecha_fin'], $_POST['ficha_trimestre'], $_POST['ficha_modalidad'], $_POST['ficha_jornada'], $_POST['ficha_tipo_formacion'], $_POST['ficha_centro_formacion'], $_POST['ficha_coordinacion'], $_POST['ficha_programa_formacion']);
            Ficha::save($ficha);
            header('Location: ?controller=Ficha&action=index');
        }
    }
    public function details() { 
        $ficha = Ficha::searchById($_GET['id']);
        require_once 'views/Ficha/details.php';
    }
    public function updateshow() { 
        $ficha = Ficha::searchById($_GET['id']);
        require_once 'views/Ficha/updateshow.php';
    }
    public function update() { 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $ficha = new Ficha($_POST['ficha_id'], $_POST['ficha_numero'], $_POST['ficha_nombre'], $_POST['ficha_estado'], $_POST['ficha_fecha_inicio'], $_POST['ficha_fecha_fin'], $_POST['ficha_trimestre'], $_POST['ficha_modalidad'], $_POST['ficha_jornada'], $_POST['ficha_tipo_formacion'], $_POST['ficha_centro_formacion'], $_POST['ficha_coordinacion'], $_POST['ficha_programa_formacion']);
            Ficha::update($ficha);
            header('Location: ?controller=Ficha&action=index');
        }
    }
    public function delete() { 
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            try {
                $ficha = Ficha::searchById($_GET['id']);
                Ficha::delete($_GET['id']);
                header('Location: ?controller=Ficha&action=index');
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    header('Location: ?controller=Ficha&action=index&error=foreign_key');
                } else {
                    header('Location: ?controller=Ficha&action=index&error=general');
                }
            }
        }
    }
}
?>
