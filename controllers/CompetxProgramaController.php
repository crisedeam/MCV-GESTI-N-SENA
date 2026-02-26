<?php
require_once 'models/CompetxPrograma.php';
require_once 'models/Programa.php';
require_once 'models/Competencia.php';

class CompetxProgramaController {

    public function index() {
        $asignaciones = CompetxPrograma::all();
        require_once 'views/CompetxPrograma/show.php';
    }

    public function register() {
        $programas = Programa::all();
        $competencias = Competencia::all();
        require_once 'views/CompetxPrograma/register.php';
    }

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $compProg = new CompetxPrograma($_POST['PROGRAMA_prog_id'], $_POST['COMPETENCIA_comp_id']);
                CompetxPrograma::save($compProg);
                header('Location: ?controller=CompetxPrograma&action=index');
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    // Unique constraint violation (already exists)
                    header('Location: ?controller=CompetxPrograma&action=register&error=duplicate');
                } else {
                    header('Location: ?controller=CompetxPrograma&action=register&error=general');
                }
            }
        }
    }

    public function delete() {
        if (isset($_GET['prog_id']) && isset($_GET['comp_id'])) {
            try {
                CompetxPrograma::delete($_GET['prog_id'], $_GET['comp_id']);
                header('Location: ?controller=CompetxPrograma&action=index');
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    // Foreign key constraint violation
                    header('Location: ?controller=CompetxPrograma&action=index&error=foreign_key');
                } else {
                    header('Location: ?controller=CompetxPrograma&action=index&error=general');
                }
            }
        } else {
            header('Location: ?controller=CompetxPrograma&action=index');
        }
    }
}
?>
