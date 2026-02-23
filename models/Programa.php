<?php 
class Programa {
    private $prog_codigo;
    private $prog_denominacion;
    private $TIT_PROGRAMA_titpro_id;
    private $prog_tipo;
    public function __construct($prog_codigo, $prog_denominacion, $TIT_PROGRAMA_titpro_id, $prog_tipo){
    $this->prog_codigo = $prog_codigo;
    $this->prog_denominacion = $prog_denominacion;
    $this->TIT_PROGRAMA_titpro_id = $TIT_PROGRAMA_titpro_id;
    $this->prog_tipo = $prog_tipo;
}
public function getProg_codigo(){
    return $this->prog_codigo;
}
public function setProg_codigo(){
    $this->prog_codigo = $prog_codigo;
}
public function getProg_denominacion(){
    return $this->prog_denominacion;
}
public function setProg_denominacion(){
    $this->prog_denominacion = $prog_denominacion;
}
public function getTIT_PROGRAMA_titpro_id(){
    return $this->TIT_PROGRAMA_titpro_id;
}
public function setTIT_PROGRAMA_titpro_id(){
    $this->TIT_PROGRAMA_titpro_id = $TIT_PROGRAMA_titpro_id;
}
public function getProg_tipo(){
    return $this->prog_tipo;
}
public function setProg_tipo(){
    $this->prog_tipo = $prog_tipo;
}
public static function save($programa){
    $db=DB::getConnect();
    $insert=$db->prepare('INSERT INTO programa VALUES (:prog_codigo, :prog_denominacion, :TIT_PROGRAMA_titpro_id, :prog_tipo)');
    $insert->bindValue('prog_codigo',$programa->getProg_codigo());
    $insert->bindValue('prog_denominacion',$programa->getProg_denominacion());
    $insert->bindValue('TIT_PROGRAMA_titpro_id',$programa->getTIT_PROGRAMA_titpro_id());
    $insert->bindValue('prog_tipo',$programa->getProg_tipo());
    $insert->execute();
}
public static function all(){
    $db=DB::getConnect();
    $listaProgramas=[];
    $select=$db->query('SELECT * FROM programa ORDER BY prog_codigo');
    foreach($select->fetchAll() as $programa){
        $listaProgramas[]=new Programa($programa['prog_codigo'],$programa['prog_denominacion'],$programa['TIT_PROGRAMA_titpro_id'],$programa['prog_tipo']);
    }
    return $listaProgramas; 
}
public static function searchById($prog_codigo){
    $db=DB::getConnect();
    $select=$db->prepare('SELECT * FROM programa WHERE prog_codigo=:prog_codigo');
    $select->bindValue('prog_codigo',$prog_codigo);
    $select->execute();

    $programaDb=$select->fetch();


    $programa = new Programa ($programaDb['prog_codigo'],$programaDb['prog_denominacion'], $programaDb['TIT_PROGRAMA_titpro_id'], $programaDb['prog_tipo']);
    //var_dump($programa);
    //die();
    return $programa;
}
public static function update($programa){
    $db=DB::getConnect();
    $update=$db->prepare('UPDATE programa SET prog_denominacion=:prog_denominacion WHERE prog_codigo=:prog_codigo');
    $update->bindValue('prog_denominacion', $programa->getProg_denominacion());
    $update->bindValue('prog_codigo',$programa->getProg_codigo());
    $update->execute();
}
public static function delete($prog_codigo){
    $db=DB::getConnect();
    $delete=$db->prepare('DELETE FROM programa WHERE prog_codigo=:prog_codigo');
    $delete->bindValue('prog_codigo',$prog_codigo);
    $delete->execute();	
}


}
