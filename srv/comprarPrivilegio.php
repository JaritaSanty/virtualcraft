<?php
require_once 'db_config.php';
include ('main.php');

$obj = json_decode($_POST["datosAlumno"]);

$aluclaequ_id = $obj->aluclaequ_id;
$equ_id = $obj->equ_id;
$log_descripcion = utf8_decode('compra privilegio');

$pri_id = $_POST['pri_id'];
$prieje_tipo = $_POST['prieje_tipo'];
$aluPV = $_POST['pri_aluPV'];
$aluPD = $_POST['pri_aluPD'];
$aluPO = $_POST['pri_aluPO'];
$aluPP = $_POST['pri_aluPP'];
$aluFO = $_POST['pri_aluFO'];
$equPV = $_POST['pri_equPV'];
$equPD = $_POST['pri_equPD'];
$equPO = $_POST['pri_equPO'];
$equPP = $_POST['pri_equPP'];
$equFO = $_POST['pri_equFO'];

$stmt1 = updatePuntosAlumno($DBcon, $aluclaequ_id, $aluPV, $aluPD, $aluPO, $aluPP, $aluFO, $equ_id, $log_descripcion);
$stmt2 = updatePuntosEquipo($DBcon, $equ_id, $equPV, $equPD, $equPO, $equPP, $equFO, $log_descripcion);
$stmt3 = insertPrivilegiosEjecutados($DBcon, $pri_id, $aluclaequ_id, $prieje_tipo);

if ($stmt1 == "true" && $stmt2 == "true" && $stmt3 == "true") {
 echo "true";
} else {
 echo "false";
}
?>
