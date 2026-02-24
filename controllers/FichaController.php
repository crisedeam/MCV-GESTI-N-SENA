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
        
        // Calcular métricas para el dashboard
        $totalFichas = count($listaFichas);
        $totalDiurnas = 0;
        $totalNocturnas = 0;
        $totalMixtas = 0;
        
        foreach($listaFichas as $f) {
            if ($f->getFich_jornada() == 'Diurna') $totalDiurnas++;
            else if ($f->getFich_jornada() == 'Nocturna') $totalNocturnas++;
            else if ($f->getFich_jornada() == 'Mixta') $totalMixtas++;
        }
        
        require_once 'views/Ficha/show.php';
    }
    public function register() { 
        require_once 'views/Ficha/register.php';
    }
    public function save() { 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $ficha = new Ficha($_POST['fich_id'], $_POST['PROGRAMA_prog_id'], $_POST['INSTRUCTOR_inst_id_lider'], $_POST['fich_jornada'], $_POST['COORDINACION_coord_id'], $_POST['fich_fecha_ini_lectiva'], $_POST['fich_fecha_fin_lectiva']);
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
            $ficha = new Ficha($_POST['fich_id'], $_POST['PROGRAMA_prog_id'], $_POST['INSTRUCTOR_inst_id_lider'], $_POST['fich_jornada'], $_POST['COORDINACION_coord_id'], $_POST['fich_fecha_ini_lectiva'], $_POST['fich_fecha_fin_lectiva']);
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
