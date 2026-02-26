<?php 
class Instructor {
    private $inst_id;
    private $inst_nombre;
    private $inst_apellido;
    private $inst_correo;
    private $inst_telefono;
    private $CENTRO_FORMACION_cent_id;
    private $inst_password;
    private $cent_nombre;

    public function __construct($inst_id, $inst_nombre, $inst_apellido, $inst_correo, $inst_telefono, $CENTRO_FORMACION_cent_id, $inst_password, $cent_nombre = ''){
        $this->inst_id = $inst_id;
        $this->inst_nombre = $inst_nombre;
        $this->inst_apellido = $inst_apellido;
        $this->inst_correo = $inst_correo;
        $this->inst_telefono = $inst_telefono;
        $this->CENTRO_FORMACION_cent_id = $CENTRO_FORMACION_cent_id;    
        $this->inst_password = $inst_password;
        $this->cent_nombre = $cent_nombre;
    }
public function getCent_nombre(){
    return $this->cent_nombre;
}
public function getInst_id(){
    return $this->inst_id;
}
public function setInst_id($inst_id){
    $this->inst_id = $inst_id;
}
public function getInst_nombre(){
    return $this->inst_nombre;
}
public function setInst_nombre($inst_nombre){
    $this->inst_nombre = $inst_nombre;
}
public function getInst_apellido(){
    return $this->inst_apellido;
}
public function setInst_apellido($inst_apellido){
    $this->inst_apellido = $inst_apellido;
}
public function getInst_correo(){
    return $this->inst_correo;
}
public function setInst_correo($inst_correo){
    $this->inst_correo = $inst_correo;
}
public function getInst_telefono(){
    return $this->inst_telefono;
}
public function setInst_telefono($inst_telefono){
    $this->inst_telefono = $inst_telefono;
}
public function getCENTRO_FORMACION_cent_id(){
    return $this->CENTRO_FORMACION_cent_id;
}
public function setCENTRO_FORMACION_cent_id($CENTRO_FORMACION_cent_id){
    $this->CENTRO_FORMACION_cent_id = $CENTRO_FORMACION_cent_id;
}
public function getInst_password(){
    return $this->inst_password;
}
public function setInst_password($inst_password){
    $this->inst_password = $inst_password;
}
public static function save($instructor){
    $db=DB::getConnect();
    $insert=$db->prepare('INSERT INTO instructor VALUES (:inst_id, :inst_nombres, :inst_apellidos, :inst_correo, :inst_telefono, :CENTRO_FORMACION_cent_id, :inst_password)');
    $insert->bindValue('inst_id',$instructor->getInst_id());
    $insert->bindValue('inst_nombres',$instructor->getInst_nombre());
    $insert->bindValue('inst_apellidos',$instructor->getInst_apellido());
    $insert->bindValue('inst_correo',$instructor->getInst_correo());
    $insert->bindValue('inst_telefono',$instructor->getInst_telefono());
    $insert->bindValue('CENTRO_FORMACION_cent_id',$instructor->getCENTRO_FORMACION_cent_id());
    // Hash password before saving
    $hashedPassword = password_hash($instructor->getInst_password(), PASSWORD_DEFAULT);
    $insert->bindValue('inst_password', $hashedPassword);
    $insert->execute();
}   
    public static function all(){
        $db=DB::getConnect();
        $listaInstructores=[];
        $centro_id = $_SESSION['centro_id'] ?? null;
        
        if ($centro_id !== null && $centro_id !== '') {
            $sql = 'SELECT * FROM instructor WHERE CENTRO_FORMACION_cent_id = :centro_id ORDER BY inst_id';
            $select=$db->prepare($sql);
            $select->bindValue(':centro_id', $centro_id);
            $select->execute();
            $results = $select->fetchAll();
        } else {
            $sql = 'SELECT * FROM instructor ORDER BY inst_id';
            $select=$db->query($sql);
            $results = $select->fetchAll();
        }
        
        foreach($results as $instructor){
            $listaInstructores[]=new Instructor($instructor['inst_id'],$instructor['inst_nombres'],$instructor['inst_apellidos'],$instructor['inst_correo'],$instructor['inst_telefono'],$instructor['CENTRO_FORMACION_cent_id'],$instructor['inst_password']);
        }
        return $listaInstructores;
    }   
    public static function searchById($inst_id){
        $db=DB::getConnect();
        
        $centro_id = $_SESSION['centro_id'] ?? null;
        if ($centro_id !== null && $centro_id !== '') {
            $select=$db->prepare('SELECT * FROM instructor WHERE inst_id=:inst_id AND CENTRO_FORMACION_cent_id = :centro_id');
            $select->bindValue('centro_id', $centro_id);
        } else {
            $select=$db->prepare('SELECT * FROM instructor WHERE inst_id=:inst_id');
        }
        
        $select->bindValue('inst_id',$inst_id);
        $select->execute();

        $instructorDb=$select->fetch();

        if ($instructorDb) {
            $instructor = new Instructor ($instructorDb['inst_id'],$instructorDb['inst_nombres'],$instructorDb['inst_apellidos'],$instructorDb['inst_correo'],$instructorDb['inst_telefono'],$instructorDb['CENTRO_FORMACION_cent_id'],$instructorDb['inst_password']);
            return $instructor;
        }
        return null;
    }
public static function update($instructor){
    $db=DB::getConnect();
    
    // Solo actualizamos la contraseña si el usuario introdujo una nueva
    if (!empty($instructor->getInst_password())) {
        $update=$db->prepare('UPDATE instructor SET inst_nombres=:inst_nombres, inst_apellidos=:inst_apellidos, inst_correo=:inst_correo, inst_telefono=:inst_telefono, CENTRO_FORMACION_cent_id=:CENTRO_FORMACION_cent_id, inst_password=:inst_password WHERE inst_id=:inst_id');
        $hashedPassword = password_hash($instructor->getInst_password(), PASSWORD_DEFAULT);
        $update->bindValue('inst_password', $hashedPassword);
    } else {
        $update=$db->prepare('UPDATE instructor SET inst_nombres=:inst_nombres, inst_apellidos=:inst_apellidos, inst_correo=:inst_correo, inst_telefono=:inst_telefono, CENTRO_FORMACION_cent_id=:CENTRO_FORMACION_cent_id WHERE inst_id=:inst_id');
    }

    $update->bindValue('inst_nombres', $instructor->getInst_nombre());
    $update->bindValue('inst_apellidos', $instructor->getInst_apellido());
    $update->bindValue('inst_correo', $instructor->getInst_correo());
    $update->bindValue('inst_telefono', $instructor->getInst_telefono());
    $update->bindValue('CENTRO_FORMACION_cent_id', $instructor->getCENTRO_FORMACION_cent_id());
    $update->bindValue('inst_id',$instructor->getInst_id());
    $update->execute();
}

    public static function getByCompetencia($comp_id) {
        $db = DB::getConnect();
        $listaInstructores = [];
        
        $centro_id = $_SESSION['centro_id'] ?? null;
        
        if ($centro_id !== null && $centro_id !== '') {
            $select = $db->prepare('
                SELECT DISTINCT i.* 
                FROM instructor i
                INNER JOIN instru_competencia ic ON i.inst_id = ic.INSTRUCTOR_inst_id
                WHERE ic.COMPETxPROGRAMA_COMPETENCIA_comp_id = :comp_id
                  AND ic.inscomp_vigencia >= CURDATE()
                  AND i.CENTRO_FORMACION_cent_id = :centro_id
                ORDER BY i.inst_nombres, i.inst_apellidos
            ');
            $select->bindValue('centro_id', $centro_id);
        } else {
            $select = $db->prepare('
                SELECT DISTINCT i.* 
                FROM instructor i
                INNER JOIN instru_competencia ic ON i.inst_id = ic.INSTRUCTOR_inst_id
                WHERE ic.COMPETxPROGRAMA_COMPETENCIA_comp_id = :comp_id
                  AND ic.inscomp_vigencia >= CURDATE()
                ORDER BY i.inst_nombres, i.inst_apellidos
            ');
        }
        
        $select->bindValue('comp_id', $comp_id);
        $select->execute();
        
        foreach($select->fetchAll() as $instructor){
            $listaInstructores[] = new Instructor(
                $instructor['inst_id'],
                $instructor['inst_nombres'],
                $instructor['inst_apellidos'],
                $instructor['inst_correo'],
                $instructor['inst_telefono'],
                $instructor['CENTRO_FORMACION_cent_id'],
                $instructor['inst_password']
            );
        }
        return $listaInstructores;
    }

public static function delete($inst_id){
    $db=DB::getConnect();
    $delete=$db->prepare('DELETE FROM instructor WHERE inst_id=:inst_id');
    $delete->bindValue('inst_id',$inst_id);
    $delete->execute();	
}

    public static function getFichasAsignadas($inst_id) {
        $db = DB::getConnect();
        
        $centro_id = $_SESSION['centro_id'] ?? null;
        
        if ($centro_id !== null && $centro_id !== '') {
            $select = $db->prepare('
                SELECT DISTINCT f.fich_id, p.prog_denominacion, p.prog_codigo
                FROM ficha f
                JOIN asignacion a ON f.fich_id = a.FICHA_fich_id
                JOIN programa p ON f.PROGRAMA_prog_id = p.prog_codigo
                JOIN instructor i ON a.INSTRUCTOR_inst_id = i.inst_id
                WHERE a.INSTRUCTOR_inst_id = :inst_id AND i.CENTRO_FORMACION_cent_id = :centro_id
            ');
            $select->bindValue('centro_id', $centro_id);
        } else {
            $select = $db->prepare('
                SELECT DISTINCT f.fich_id, p.prog_denominacion, p.prog_codigo
                FROM ficha f
                JOIN asignacion a ON f.fich_id = a.FICHA_fich_id
                JOIN programa p ON f.PROGRAMA_prog_id = p.prog_codigo
                WHERE a.INSTRUCTOR_inst_id = :inst_id
            ');
        }
        
        $select->bindValue('inst_id', $inst_id);
        $select->execute();
        
        return $select->fetchAll();
    }



}
