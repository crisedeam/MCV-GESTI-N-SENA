<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "connection.php";
require_once "models/Asignacion.php";
require_once "models/Instructor.php";
require_once "models/Ficha.php";
require_once "models/Ambiente.php";
require_once "models/Competencia.php";
require_once "models/DetalleAsignacion.php";

try { 
    $db = DB::getConnect(); 
    
    // Fetch valid IDs
    $inst = Instructor::all()[0]->getInst_id();
    $fich = Ficha::all()[0]->getFich_id();
    $amb = Ambiente::all()[0]->getAmb_id();
    $comp = Competencia::all()[0]->getComp_id();
    
    $asignacion = new Asignacion(null, $inst, "2026-02-23 08:00:00", "2026-02-23 12:00:00", $fich, $amb, $comp); 
    $asig_id = Asignacion::save($asignacion); 
    echo "Success! Last ID inserted: " . $asig_id . "\n";
    
    $diasSeleccionados = [1, 2];
    $currentDate = new DateTime("2026-02-23");
    $endDate = new DateTime("2026-02-24");
    
    while ($currentDate <= $endDate) {
        $dayOfWeek = $currentDate->format('w');
        if (in_array($dayOfWeek, $diasSeleccionados)) {
            $dt_ini = $currentDate->format('Y-m-d') . ' 08:00:00';
            $dt_fin = $currentDate->format('Y-m-d') . ' 12:00:00';
            $detalle = new DetalleAsignacion(null, $asig_id, $dt_ini, $dt_fin);
            DetalleAsignacion::save($detalle);
            echo "Detalle guardado para: " . $dt_ini . "\n";
        }
        $currentDate->modify('+1 day');
    }
} catch (Exception $e) { 
    echo "¡ERROR!\n";
    echo $e->getMessage(); 
} 
?>
