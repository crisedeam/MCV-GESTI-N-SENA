<?php 
class Coordinacion {
    private $coord_id;
    private $coord_nombre;
    private $CENTRO_FORMACION_cent_id;
    public function __construct($coord_id, $coord_nombre, $CENTRO_FORMACION_cent_id){
    $this->coord_id = $coord_id;
    $this->coord_nombre = $coord_nombre;
    $this->CENTRO_FORMACION_cent_id = $CENTRO_FORMACION_cent_id;    
}
public function getCoord_id(){
    return $this->coord_id;
}
public function setCoord_id(){
    $this->coord_id = $coord_id;
}
public function getCoord_nombre(){
    return $this->coord_nombre;
}
public function setCoord_nombre(){
    $this->coord_nombre = $coord_nombre;
}
public function getCENTRO_FORMACION_cent_id(){
    return $this->CENTRO_FORMACION_cent_id;
}
public function setCENTRO_FORMACION_cent_id(){
    $this->CENTRO_FORMACION_cent_id = $CENTRO_FORMACION_cent_id;
}
public static function save($coordinacion){
    $db=DB::getConnect();
    $insert=$db->prepare('INSERT INTO coordinacion VALUES (:coord_id, :coord_nombre, :CENTRO_FORMACION_cent_id)');
    $insert->bindValue('coord_id',$coordinacion->getCoord_id());
    $insert->bindValue('coord_nombre',$coordinacion->getCoord_nombre());
    $insert->bindValue('CENTRO_FORMACION_cent_id',$coordinacion->getCENTRO_FORMACION_cent_id());
    $insert->execute();
}   
public static function all(){
    $db=DB::getConnect();
    $listaCoordinacions=[];
    $select=$db->query('SELECT * FROM coordinacion ORDER BY coord_id');
    foreach($select->fetchAll() as $coordinacion){
        $listaCoordinacions[]=new Coordinacion($coordinacion['coord_id'],$coordinacion['coord_nombre'],$coordinacion['CENTRO_FORMACION_cent_id']);
    }
    return $listaCoordinacions; 
}   
public static function searchById($coord_id){
    $db=DB::getConnect();
    $select=$db->prepare('SELECT * FROM coordinacion WHERE coord_id=:coord_id');
    $select->bindValue('coord_id',$coord_id);
    $select->execute();

    $coordinacionDb=$select->fetch();


    $coordinacion = new Coordinacion ($coordinacionDb['coord_id'],$coordinacionDb['coord_nombre'],$coordinacionDb['CENTRO_FORMACION_cent_id']);
    //var_dump($coordinacion);
    //die();
    return $coordinacion;
}
public static function update($coordinacion){
    $db=DB::getConnect();
    $update=$db->prepare('UPDATE coordinacion SET coord_nombre=:coord_nombre, CENTRO_FORMACION_cent_id=:CENTRO_FORMACION_cent_id WHERE coord_id=:coord_id');
    $update->bindValue('coord_nombre', $coordinacion->getCoord_nombre());
    $update->bindValue('CENTRO_FORMACION_cent_id', $coordinacion->getCENTRO_FORMACION_cent_id());
    $update->bindValue('coord_id',$coordinacion->getCoord_id());
    $update->execute();
}
public static function delete($coord_id){
    $db=DB::getConnect();
    $delete=$db->prepare('DELETE FROM coordinacion WHERE coord_id=:coord_id');
    $delete->bindValue('coord_id',$coord_id);
    $delete->execute();	
}

}
