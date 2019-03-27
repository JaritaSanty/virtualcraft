<?php
require_once 'db_config.php';
include ('main.php');

$log_descripcion = utf8_decode ($_POST['log_descripcion']);
$log_tipo = 'puntosequipo';

$stmt1 = sumarPuntosEquipo($DBcon, $_POST['aluclaequ_equPV'], $_POST['aluclaequ_equPD'], $_POST['aluclaequ_equPO'], $_POST['aluclaequ_equPP'], $_POST['aluclaequ_equFO'], $_POST['equ_id']);
$stmt2 = insertLogProfesorEquipo($DBcon, $log_tipo, $_POST['aluclaequ_equPV'], $_POST['aluclaequ_equPD'], $_POST['aluclaequ_equPO'], $_POST['aluclaequ_equPP'], $_POST['aluclaequ_equFO'], $log_descripcion, $_POST['equ_id']);

if ($stmt1 == "true" && $stmt2 == "true") {
  echo "true";
} else {
  echo "false";
}
?>
