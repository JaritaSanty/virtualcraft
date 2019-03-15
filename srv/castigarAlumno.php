<?php
require_once 'db_config.php';
include ('main.php');

$stmt1 = insertActuacionesEjecutadas($DBcon, $_POST['act_id'], $_POST['aluclaequ_id']);
$stmt2 = sumarPuntosAlumno($DBcon, $_POST['act_PV'], $_POST['act_PD'], $_POST['act_PO'], $_POST['act_PP'], $_POST['act_FO'], $_POST['aluclaequ_id']);

if ($stmt1 == "true" && $stmt2 == "true") {
 echo "true";
} else {
 echo "false";
}

?>
