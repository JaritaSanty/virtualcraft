<?php
require_once 'db_config.php';
include ('main.php');

$aluclaequ_PV = $_POST['aluclaequ_equPV'];
$aluclaequ_PD = $_POST['aluclaequ_equPD'];
$aluclaequ_PO = $_POST['aluclaequ_equPO'];
$aluclaequ_PP = $_POST['aluclaequ_equPP'];
$aluclaequ_FO = $_POST['aluclaequ_equFO'];

$log_descripcion = utf8_decode($_POST['log_descripcion']);
$equ_id = $_POST['equ_id'];

$stmt1 = updatePuntosEquipo($DBcon, $equ_id, $aluclaequ_PV, $aluclaequ_PD, $aluclaequ_PO, $aluclaequ_PP, $aluclaequ_FO, $log_descripcion);

if ($stmt1 == "true") {
 echo "true";
} else {
 echo "false";
}
?>
