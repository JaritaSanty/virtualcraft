<?php
require_once 'db_config.php';
include ('main.php');

$aluclaequ_id = $_POST['aluclaequ_id'];
$sumPV = $_POST['aluclaequ_aluPV'];
$sumPD = $_POST['aluclaequ_aluPD'];
$sumPO = $_POST['aluclaequ_aluPO'];
$sumPP = $_POST['aluclaequ_aluPP'];
$sumFO = $_POST['aluclaequ_aluFO'];
$equ_id = $_POST['equ_id'];

$log_descripcion = utf8_decode($_POST['log_descripcion']);

$stmt1 = updatePuntosAlumno($DBcon, $aluclaequ_id, $sumPV, $sumPD, $sumPO, $sumPP, $sumFO, $equ_id, $log_descripcion);

if ($stmt1 == "true") {
 echo "true";
} else {
 echo "false";
}
?>
