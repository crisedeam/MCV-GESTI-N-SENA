<?php
// =========================================================================
// CONTROLADOR PARA EL MODELO: Programa
// =========================================================================
// Tu misión didáctica: Programa la lógica interna de esta clase.
// =========================================================================

require_once 'models/Programa.php';

class ProgramaController {

    public function index() {
        static $listaProgramas = [];
        $listaProgramas = Programa::all();
        require_once 'views/Programa/show.php';
        // TAREA: Cargar todos los registros usando Programa::all() e ir a 'show.php'
    }

    public function register() {
        require_once 'views/Programa/register.php';
        // TAREA: Cargar la vista 'register.php'
    }

    public function save() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $programa = new Programa($_POST['programa_id'], $_POST['programa_codigo'], $_POST['programa_denominacion'], $_POST['programa_tipo'], $_POST['programa_titpro_id']);
            Programa::save($programa);
            header('Location: ?controller=Programa&action=index');
        }
        // TAREA: Capturar el $_POST, armar un objeto Programa (codigo, denominacion, tipo, titpro_id) y enviarlo a Programa::save()
    }

    public function details() {
        $programa = Programa::searchById($_GET['id']);
        require_once 'views/Programa/details.php';
        // TAREA: Capturar el $_GET['id'], buscar con searchById() y cargar la vista 'details.php'
    }

    public function updateshow() {
        $programa = Programa::searchById($_GET['id']);
        require_once 'views/Programa/updateshow.php';
        // TAREA: Capturar el $_GET['id'], buscar con searchById() y cargar la vista 'updateshow.php'
    }

    public function update() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $programa = new Programa($_POST['programa_id'], $_POST['programa_codigo'], $_POST['programa_denominacion'], $_POST['programa_tipo'], $_POST['programa_titpro_id']);
            Programa::update($programa);
            header('Location: ?controller=Programa&action=index');
        }
        // TAREA: Recibir $_POST, crear objeto actualizado y enviarlo a Programa::update(), luego redirigir a index
    }

    public function delete() {
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            try {
                $programa = Programa::searchById($_GET['id']);
                Programa::delete($_GET['id']);
                header('Location: ?controller=Programa&action=index');
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    header('Location: ?controller=Programa&action=index&error=foreign_key');
                } else {
                    header('Location: ?controller=Programa&action=index&error=general');
                }
            }
        }
        // TAREA: Recibir $_GET['id'], llamar a Programa::delete() y volver a index
    }
}
?>
