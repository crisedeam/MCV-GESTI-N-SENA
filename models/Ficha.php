<?php 
 class Ficha {
    private $fich_id;
    private $PROGRAMA_prog_id;
    private $INSTRUCTOR_inst_id_lider;
    private $fich_jornada;
    private $COORDINACION_coord_id;
     public function __construct($fich_id, $PROGRAMA_prog_id, $INSTRUCTOR_inst_id_lider, $fich_jornada, $COORDINACION_coord_id){
    $this->fich_id = $fich_id;
    $this->PROGRAMA_prog_id = $PROGRAMA_prog_id;
    $this->INSTRUCTOR_inst_id_lider = $INSTRUCTOR_inst_id_lider;
    $this->fich_jornada = $fich_jornada;
    $this->COORDINACION_coord_id = $COORDINACION_coord_id;
 }
 public function getFich_id(){
    return $this->fich_id;
 }
 public function setFich_id($fich_id){
    $this->fich_id = $fich_id;
 }
 public function getPROGRAMA_prog_id(){
    return $this->PROGRAMA_prog_id;
 }
 public function setPROGRAMA_prog_id($PROGRAMA_prog_id){
    $this->PROGRAMA_prog_id = $PROGRAMA_prog_id;
 }
 public function getINSTRUCTOR_inst_id_lider(){
    return $this->INSTRUCTOR_inst_id_lider;
 }
 public function setINSTRUCTOR_inst_id_lider($INSTRUCTOR_inst_id_lider){
    $this->INSTRUCTOR_inst_id_lider = $INSTRUCTOR_inst_id_lider;
 }
 public function getFich_jornada(){
    return $this->fich_jornada;
 }
 public function setFich_jornada($fich_jornada){
    $this->fich_jornada = $fich_jornada;
 }
 public function getCOORDINACION_coord_id(){
    return $this->COORDINACION_coord_id;
 }
 public function setCOORDINACION_coord_id($COORDINACION_coord_id){
    $this->COORDINACION_coord_id = $COORDINACION_coord_id;
 }
 public static function save($ficha){
    $db=DB::getConnect();
    $insert=$db->prepare('INSERT INTO ficha VALUES (:fich_id, :PROGRAMA_prog_id, :INSTRUCTOR_inst_id_lider, :fich_jornada, :COORDINACION_coord_id)');
    $insert->bindValue('fich_id',$ficha->getFich_id());
    $insert->bindValue('PROGRAMA_prog_id',$ficha->getPROGRAMA_prog_id());
    $insert->bindValue('INSTRUCTOR_inst_id_lider',$ficha->getINSTRUCTOR_inst_id_lider());
    $insert->bindValue('fich_jornada',$ficha->getFich_jornada());
    $insert->bindValue('COORDINACION_coord_id',$ficha->getCOORDINACION_coord_id());
    $insert->execute();
 }
 public static function all(){
    $db=DB::getConnect();
    $listaFichas=[];
    $select=$db->query('SELECT * FROM ficha ORDER BY fich_id');
    foreach($select->fetchAll() as $ficha){
        $listaFichas[]=new Ficha($ficha['fich_id'],$ficha['PROGRAMA_prog_id'],$ficha['INSTRUCTOR_inst_id_lider'],$ficha['fich_jornada'],$ficha['COORDINACION_coord_id']);
    }
    return $listaFichas; 
 }
 public static function searchById($fich_id){
    $db=DB::getConnect();
    $select=$db->prepare('SELECT * FROM ficha WHERE fich_id=:fich_id');
    $select->bindValue('fich_id',$fich_id);
    $select->execute();

    $fichaDb=$select->fetch();


    $ficha = new Ficha ($fichaDb['fich_id'],$fichaDb['PROGRAMA_prog_id'], $fichaDb['INSTRUCTOR_inst_id_lider'], $fichaDb['fich_jornada'], $fichaDb['COORDINACION_coord_id']);
    //var_dump($ficha);
    //die();
    return $ficha;
 }
 public static function update($ficha){
    $db=DB::getConnect();
    $update=$db->prepare('UPDATE ficha SET PROGRAMA_prog_id=:PROGRAMA_prog_id WHERE fich_id=:fich_id');
    $update->bindValue('PROGRAMA_prog_id', $ficha->getPROGRAMA_prog_id());
    $update->bindValue('fich_id',$ficha->getFich_id());
    $update->execute();
 }
 public static function delete($fich_id){
    $db=DB::getConnect();
    $delete=$db->prepare('DELETE FROM ficha WHERE fich_id=:fich_id');
    $delete->bindValue('fich_id',$fich_id);
    $delete->execute();	
 }

}
