<?php
require_once 'models/InstruCompetencia.php';

class InstruCompetenciaController {
    public function index() { 
        static $listaInstruComp = [];
        $listaInstruComp = InstruCompetencia::all();
        // require_once 'views/InstruCompetencia/show.php';
    }
    public function register() { 
        // require_once 'views/InstruCompetencia/register.php';
    }
    public function save() { 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $instrucomp = new InstruCompetencia(null, $_POST['INSTRUCTOR_inst_id'], $_POST['COMPETxPROGRAMA_PROGRAMA_prog_id'], $_POST['COMPETxPROGRAMA_COMPETENCIA_comp_id'], $_POST['inscomp_vigencia']);
            InstruCompetencia::save($instrucomp);
            header('Location: ?controller=InstruCompetencia&action=index');
        }
    }
    public function details() { 
        $instrucomp = InstruCompetencia::searchById($_GET['id']);
        // require_once 'views/InstruCompetencia/details.php';
    }
    public function updateshow() { 
        $instrucomp = InstruCompetencia::searchById($_GET['id']);
        // require_once 'views/InstruCompetencia/updateshow.php';
    }
    public function update() { 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $instrucomp = new InstruCompetencia($_POST['inscomp_id'], $_POST['INSTRUCTOR_inst_id'], $_POST['COMPETxPROGRAMA_PROGRAMA_prog_id'], $_POST['COMPETxPROGRAMA_COMPETENCIA_comp_id'], $_POST['inscomp_vigencia']);
            InstruCompetencia::update($instrucomp);
            header('Location: ?controller=InstruCompetencia&action=index');
        }
    }
    public function delete() { 
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            try {
                InstruCompetencia::delete($_GET['id']);
                header('Location: ?controller=InstruCompetencia&action=index');
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    header('Location: ?controller=InstruCompetencia&action=index&error=foreign_key');
                } else {
                    header('Location: ?controller=InstruCompetencia&action=index&error=general');
                }
            }
        }
    }
}
?>
