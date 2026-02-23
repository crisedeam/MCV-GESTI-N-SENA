<?php 
class TituloPrograma {
    private $titpro_id;
    private $titpro_nombre;
    public function __construct($titpro_id, $titpro_nombre){
    $this->titpro_id = $titpro_id;
    $this->titpro_nombre = $titpro_nombre;
}
public function getTitpro_id(){
    return $this->titpro_id;
}
public function setTitpro_id(){
    $this->titpro_id = $titpro_id;
}
public function getTitpro_nombre(){
    return $this->titpro_nombre;
}
public function setTitpro_nombre(){
    $this->titpro_nombre = $titpro_nombre;
}
public static function save($tituloPrograma){
    $db=DB::getConnect();
    $insert=$db->prepare('INSERT INTO titulo_programa VALUES (:titpro_id, :titpro_nombre)');
    $insert->bindValue('titpro_id',$tituloPrograma->getTitpro_id());
    $insert->bindValue('titpro_nombre',$tituloPrograma->getTitpro_nombre());
    $insert->execute();
}
public static function all(){
    $db=DB::getConnect();
    $listaTituloProgramas=[];
    $select=$db->query('SELECT * FROM titulo_programa ORDER BY titpro_id');
    foreach($select->fetchAll() as $tituloPrograma){
        $listaTituloProgramas[]=new TituloPrograma($tituloPrograma['titpro_id'],$tituloPrograma['titpro_nombre']);
    }
    return $listaTituloProgramas; 
}
public static function searchById($titpro_id){
    $db=DB::getConnect();
    $select=$db->prepare('SELECT * FROM titulo_programa WHERE titpro_id=:titpro_id');
    $select->bindValue('titpro_id',$titpro_id);
    $select->execute();

    $tituloProgramaDb=$select->fetch();


    $tituloPrograma = new TituloPrograma ($tituloProgramaDb['titpro_id'],$tituloProgramaDb['titpro_nombre']);
    //var_dump($tituloPrograma);
    //die();
    return $tituloPrograma;
}
public static function update($tituloPrograma){
    $db=DB::getConnect();
    $update=$db->prepare('UPDATE titulo_programa SET titpro_nombre=:titpro_nombre WHERE titpro_id=:titpro_id');
    $update->bindValue('titpro_nombre', $tituloPrograma->getTitpro_nombre());
    $update->bindValue('titpro_id',$tituloPrograma->getTitpro_id());
    $update->execute();
}
public static function delete($titpro_id){
    $db=DB::getConnect();
    $delete=$db->prepare('DELETE FROM titulo_programa WHERE titpro_id=:titpro_id');
    $delete->bindValue('titpro_id',$titpro_id);
    $delete->execute();	
}
}
