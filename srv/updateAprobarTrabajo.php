<?php
require_once 'db_config.php';
include ('main.php');

$trasig_id = $_POST['trasig_id'];
$trasig_calificacion = $_POST['trasig_calificacion'];
$trasig_comentario = utf8_decode ($_POST['trasig_comentario']);

$aluclaequ_id = $_POST['aluclaequ_id'];
$tra_id = $_POST['tra_id'];
$tra_nombre = utf8_decode($_POST['tra_nombre']);
$sumPV = $_POST['tra_PV'];
$sumPD = $_POST['tra_PD'];
$sumPO = $_POST['tra_PO'];
$sumPP = $_POST['tra_PP'];
$sumFO = $_POST['tra_FO'];
$equ_id = $_POST['equ_id'];

$log_descripcion = utf8_decode('Treball Aprobat:'.$tra_nombre);

$stmt1 = updateAprobarTrabajo($DBcon, $trasig_id, $trasig_calificacion, $trasig_comentario);
$stmt2 = updatePuntosAlumno($DBcon, $aluclaequ_id, $sumPV, $sumPD, $sumPO, $sumPP, $sumFO, $equ_id, $log_descripcion);

if ($stmt1 == "true" && $stmt2 == "true") {
 echo "true";
} else {
 echo "false";
}
?>
