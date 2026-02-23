<?php
// =========================================================================
// CONTROLADOR PARA EL MODELO: TituloPrograma
// =========================================================================
// Tu misión didáctica: Programa la lógica interna de esta clase.
// =========================================================================

require_once 'models/TituloPrograma.php';

class TituloProgramaController {
    public function index() {
        static $listaTituloProgramas = [];
        $listaTituloProgramas = TituloPrograma::all();
        require_once 'views/TituloPrograma/show.php';
        // TAREA: listar con all() y cargar show.php
    }
    public function register() {
        require_once 'views/TituloPrograma/register.php';
        // TAREA: cargar register.php
    }
    public function save() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $tituloPrograma = new TituloPrograma($_POST['titpro_id'], $_POST['titpro_nombre'], $_POST['titpro_abreviatura']);
            TituloPrograma::save($tituloPrograma);
            header('Location: ?controller=TituloPrograma&action=index');
        }
        // TAREA: Guardar con el POST (ID manual y nombre corto) usando save()
    }
    public function details() {
        $tituloPrograma = TituloPrograma::searchById($_GET['id']);
        require_once 'views/TituloPrograma/details.php';
        // TAREA: Buscar detalles pasándo $_GET
    }
    public function updateshow() {
        $tituloPrograma = TituloPrograma::searchById($_GET['id']);
        require_once 'views/TituloPrograma/updateshow.php';
        // TAREA: Buscar y cargar formulario editable
    }
    public function update() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $tituloPrograma = new TituloPrograma($_POST['titpro_id'], $_POST['titpro_nombre'], $_POST['titpro_abreviatura']);
            TituloPrograma::update($tituloPrograma);
            header('Location: ?controller=TituloPrograma&action=index');
        }
        // TAREA: Actualizar información de la BD con el POST editado
    }
    public function delete() {
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            try {
                $tituloPrograma = TituloPrograma::searchById($_GET['id']);
                TituloPrograma::delete($_GET['id']);
                header('Location: ?controller=TituloPrograma&action=index');
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    header('Location: ?controller=TituloPrograma&action=index&error=foreign_key');
                } else {
                    header('Location: ?controller=TituloPrograma&action=index&error=general');
                }
            }
        }
        // TAREA: Eliminar mediante el GET
    }
}
?>
