<?php 
class Sede {
    private $sede_id;
    private $sede_nombre;
    
    public function __construct($sede_id, $sede_nombre){
        $this->sede_id = $sede_id;
        $this->sede_nombre = $sede_nombre;
    }
    public function getSede_id(){
        return $this->sede_id;
    }
    public function setSede_id($sede_id){
        $this->sede_id = $sede_id;
    }
    public function getSede_nombre(){
        return $this->sede_nombre;
    }
    public function setSede_nombre($sede_nombre){
        $this->sede_nombre = $sede_nombre;
    }
    public static function save($sede){
        $db=DB::getConnect();
        
        $insert=$db->prepare('INSERT INTO sede VALUES (:sede_id, :sede_nombre)');
        $insert->bindValue('sede_id', $sede->getSede_id());
        $insert->bindValue('sede_nombre',$sede->getSede_nombre());
        $insert->execute();
    }
    public static function all(){
        $db=DB::getConnect();
        $listaSedes=[];
    
        $select=$db->query('SELECT * FROM sede order by sede_id');
    
        foreach($select->fetchAll() as $sede){
            $listaSedes[]=new Sede($sede['sede_id'],$sede['sede_nombre']);
        }
        return $listaSedes;
    }   
    public static function searchById($sede_id){
        $db=DB::getConnect();
        $select=$db->prepare('SELECT * FROM sede WHERE sede_id=:sede_id');
        $select->bindValue('sede_id',$sede_id);
        $select->execute();
    
        $sedeDb=$select->fetch();
    
        $sede = new Sede ($sedeDb['sede_id'],$sedeDb['sede_nombre']);
        return $sede;
    }
    public static function update($sede){
        $db=DB::getConnect();
        $update=$db->prepare('UPDATE sede SET sede_nombre=:sede_nombre WHERE sede_id=:sede_id');
        $update->bindValue('sede_nombre', $sede->getSede_nombre());
        $update->bindValue('sede_id',$sede->getSede_id());
        $update->execute();
    }
    public static function delete($sede_id){
        $db=DB::getConnect();
        $delete=$db->prepare('DELETE FROM sede WHERE sede_id=:sede_id');
        $delete->bindValue('sede_id',$sede_id);
        $delete->execute();		
    }
}
?>
