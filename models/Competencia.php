<?php 
class Competencia {
    private $comp_id;
    private $comp_nombre_corto;
    private $comp_horas;
    private $comp_nombre_unidad_competencia;
    public function __construct($comp_id, $comp_nombre_corto, $comp_horas, $comp_nombre_unidad_competencia){
    $this->comp_id = $comp_id;
    $this->comp_nombre_corto = $comp_nombre_corto;
    $this->comp_horas = $comp_horas;
    $this->comp_nombre_unidad_competencia = $comp_nombre_unidad_competencia;
}   
public function getComp_id(){
    return $this->comp_id;
}
public function setComp_id(){
    $this->comp_id = $comp_id;
}
public function getComp_nombre_corto(){
    return $this->comp_nombre_corto;
}
public function setComp_nombre_corto(){
    $this->comp_nombre_corto = $comp_nombre_corto;
}
public function getComp_horas(){
    return $this->comp_horas;
}
public function setComp_horas(){
    $this->comp_horas = $comp_horas;
}
public function getComp_nombre_unidad_competencia(){
    return $this->comp_nombre_unidad_competencia;
}
public function setComp_nombre_unidad_competencia(){
    $this->comp_nombre_unidad_competencia = $comp_nombre_unidad_competencia;
}
public static function save($competencia){
    $db=DB::getConnect();
    $insert=$db->prepare('INSERT INTO competencia VALUES (:comp_id, :comp_nombre_corto, :comp_horas, :comp_nombre_unidad_competencia)');
    $insert->bindValue('comp_id',$competencia->getComp_id());
    $insert->bindValue('comp_nombre_corto',$competencia->getComp_nombre_corto());
    $insert->bindValue('comp_horas',$competencia->getComp_horas());
    $insert->bindValue('comp_nombre_unidad_competencia',$competencia->getComp_nombre_unidad_competencia());
    $insert->execute();
}
public static function all(){
    $db=DB::getConnect();
    $listaCompetencias=[];
    $select=$db->query('SELECT * FROM competencia ORDER BY comp_id');
    foreach($select->fetchAll() as $competencia){
        $listaCompetencias[]=new Competencia($competencia['comp_id'],$competencia['comp_nombre_corto'],$competencia['comp_horas'],$competencia['comp_nombre_unidad_competencia']);
    }
    return $listaCompetencias; 
}
public static function searchById($comp_id){
    $db=DB::getConnect();
    $select=$db->prepare('SELECT * FROM competencia WHERE comp_id=:comp_id');
    $select->bindValue('comp_id',$comp_id);
    $select->execute();

    $competenciaDb=$select->fetch();


    $competencia = new Competencia ($competenciaDb['comp_id'],$competenciaDb['comp_nombre_corto'],$competenciaDb['comp_horas'],$competenciaDb['comp_nombre_unidad_competencia']);
    //var_dump($competencia);
    //die();
    return $competencia;
}
public static function update($competencia){
    $db=DB::getConnect();
    $update=$db->prepare('UPDATE competencia SET comp_nombre_corto=:comp_nombre_corto, comp_horas=:comp_horas, comp_nombre_unidad_competencia=:comp_nombre_unidad_competencia WHERE comp_id=:comp_id');
    $update->bindValue('comp_nombre_corto', $competencia->getComp_nombre_corto());
    $update->bindValue('comp_horas', $competencia->getComp_horas());
    $update->bindValue('comp_nombre_unidad_competencia', $competencia->getComp_nombre_unidad_competencia());
    $update->bindValue('comp_id',$competencia->getComp_id());
    $update->execute();
}
public static function delete($comp_id){
    $db=DB::getConnect();
    $delete=$db->prepare('DELETE FROM competencia WHERE comp_id=:comp_id');
    $delete->bindValue('comp_id',$comp_id);
    $delete->execute();	
}


}
