<?php
require_once 'db_config.php';
include ('main.php');

$aluclaequ_id = $_POST['aluclaequ_id'];
$sumPV = $_POST['act_PV'];
$sumPD = $_POST['act_PD'];
$sumPO = $_POST['act_PO'];
$sumPP = $_POST['act_PP'];
$sumFO = $_POST['act_FO'];
$equ_id = $_POST['equ_id'];
$act_id = $_POST['act_id'];

$log_descripcion = utf8_decode('castigaralumno');

$stmt1 = insertActuacionesEjecutadas($DBcon, $act_id, $aluclaequ_id);
$stmt2 = updatePuntosAlumno($DBcon, $aluclaequ_id, $sumPV, $sumPD, $sumPO, $sumPP, $sumFO, $equ_id, $log_descripcion);

if ($stmt1 == "true" && $stmt2 == "true") {
 echo "true";
} else {
 echo "false";
}

?>
