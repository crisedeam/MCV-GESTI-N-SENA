<?php
// =========================================================================
// CONTROLADOR PARA EL MODELO: Competencia
// =========================================================================
// Tu misión didáctica: Programa la lógica interna de esta clase.
// =========================================================================

require_once 'models/Competencia.php';

class CompetenciaController {
    public function index() { 
        static $listaCompetencia =[];
        $listaCompetencia = Competencia::all();
        require_once 'views/Competencia/show.php';
    }
    public function register() { 
        require_once 'views/Competencia/register.php';
    }
    public function save() { 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $competencia = new Competencia($_POST['comp_id'], $_POST['comp_nombre_corto'], $_POST['comp_horas'], $_POST['comp_nombre_unidad_competencia']);
            Competencia::save($competencia);
            header('Location: ?controller=Competencia&action=index');
        }
    }
    public function details() { 
        $competencia = Competencia::searchById($_GET['id']);
        require_once 'views/Competencia/details.php';
    }
    public function updateshow() { 
        $competencia = Competencia::searchById($_GET['id']);
        require_once 'views/Competencia/updateshow.php';
    }
    public function update() { 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $competencia = new Competencia($_POST['comp_id'], $_POST['comp_nombre_corto'], $_POST['comp_horas'], $_POST['comp_nombre_unidad_competencia']);
            Competencia::update($competencia);
            header('Location: ?controller=Competencia&action=index');
        }
    }
    public function delete() { 
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            try {
                $competencia = Competencia::searchById($_GET['id']);
                Competencia::delete($_GET['id']);
                header('Location: ?controller=Competencia&action=index');
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    header('Location: ?controller=Competencia&action=index&error=foreign_key');
                } else {
                    header('Location: ?controller=Competencia&action=index&error=general');
                }
            }
        }
    }
}
?>
