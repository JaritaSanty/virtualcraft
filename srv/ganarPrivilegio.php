<?php
require_once 'db_config.php';
include ('main.php');

$obj = json_decode($_POST["datosAlumno"]);

$aluclaequ_id = $obj->aluclaequ_id;
$equ_id = $obj->equ_id;
$log_descripcion = utf8_decode('ganar privilegio');

$pri_id = $_POST['pri_id'];
$prieje_tipo = $_POST['prieje_tipo'];
$sumPV = $_POST['pri_costPV'];
$sumPD = $_POST['pri_costPD'];
$sumPO = $_POST['pri_costPO'];
$sumPP = $_POST['pri_costPP'];
$sumFO = $_POST['pri_costFO'];

$stmt1 = updatePuntosAlumno($DBcon, $aluclaequ_id, $sumPV, $sumPD, $sumPO, $sumPP, $sumFO, $equ_id, $log_descripcion);
$stmt2 = insertPrivilegiosEjecutados($DBcon, $pri_id, $aluclaequ_id, $prieje_tipo);

if ($stmt1 == "true" && $stmt2 == "true") {
 echo "true";
} else {
 echo "false";
}
?>
