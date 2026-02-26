<?php
class CompetxPrograma {
    private $PROGRAMA_prog_id;
    private $COMPETENCIA_comp_id;
    // Extra properties to store joined names for displaying in views
    private $prog_denominacion;
    private $comp_nombre;
    private $comp_horas;

    public function __construct($PROGRAMA_prog_id, $COMPETENCIA_comp_id, $prog_denominacion = '', $comp_nombre = '', $comp_horas = '') {
        $this->PROGRAMA_prog_id = $PROGRAMA_prog_id;
        $this->COMPETENCIA_comp_id = $COMPETENCIA_comp_id;
        $this->prog_denominacion = $prog_denominacion;
        $this->comp_nombre = $comp_nombre;
        $this->comp_horas = $comp_horas;
    }

    public function getPROGRAMA_prog_id() { return $this->PROGRAMA_prog_id; }
    public function setPROGRAMA_prog_id($val) { $this->PROGRAMA_prog_id = $val; }
    public function getCOMPETENCIA_comp_id() { return $this->COMPETENCIA_comp_id; }
    public function setCOMPETENCIA_comp_id($val) { $this->COMPETENCIA_comp_id = $val; }
    
    public function getProg_denominacion() { return $this->prog_denominacion; }
    public function getComp_nombre() { return $this->comp_nombre; }
    public function getComp_horas() { return $this->comp_horas; }

    public static function all() {
        $db = DB::getConnect();
        $lista = [];
        $query = "SELECT cp.PROGRAMA_prog_id, cp.COMPETENCIA_comp_id, p.prog_denominacion, c.comp_nombre_corto, c.comp_horas 
                  FROM competxprograma cp
                  JOIN programa p ON cp.PROGRAMA_prog_id = p.prog_codigo
                  JOIN competencia c ON cp.COMPETENCIA_comp_id = c.comp_id
                  ORDER BY p.prog_denominacion, c.comp_nombre_corto";
        
        $select = $db->query($query);
        foreach($select->fetchAll() as $row) {
            $lista[] = new CompetxPrograma($row['PROGRAMA_prog_id'], $row['COMPETENCIA_comp_id'], $row['prog_denominacion'], $row['comp_nombre_corto'], $row['comp_horas']);
        }
        return $lista;
    }

    public static function save($competxprograma) {
        $db = DB::getConnect();
        $insert = $db->prepare('INSERT INTO competxprograma (PROGRAMA_prog_id, COMPETENCIA_comp_id) VALUES (:prog, :comp)');
        $insert->bindValue('prog', $competxprograma->getPROGRAMA_prog_id());
        $insert->bindValue('comp', $competxprograma->getCOMPETENCIA_comp_id());
        $insert->execute();
    }

    public static function delete($prog_id, $comp_id) {
        $db = DB::getConnect();
        $delete = $db->prepare('DELETE FROM competxprograma WHERE PROGRAMA_prog_id = :prog AND COMPETENCIA_comp_id = :comp');
        $delete->bindValue('prog', $prog_id);
        $delete->bindValue('comp', $comp_id);
        $delete->execute();
    }
}
?>
