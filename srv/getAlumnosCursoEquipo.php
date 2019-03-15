<?php
require_once 'db_config.php';
include ('main.php');

$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;

echo selectAlumnosCursoEquipo($DBcon, $cla_id);
?>
