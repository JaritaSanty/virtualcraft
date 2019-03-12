<?php
$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;

$equ_nombre = utf8_decode ($_POST['equ_nombre']);
$equ_descripcion = utf8_decode ($_POST['equ_descripcion']);

require_once 'db_config.php';
$stmt = $DBcon->prepare("INSERT INTO equipos (equ_nombre, equ_descripcion, cla_id, equ_escudo, equ_fondo)
                                      VALUES(:equ_nombre, :equ_descripcion, :cla_id, '1', '19')");

$stmt->bindParam(':equ_nombre', $equ_nombre, PDO::PARAM_STR);
$stmt->bindParam(':equ_descripcion', $equ_descripcion, PDO::PARAM_STR);
$stmt->bindParam(':cla_id', $cla_id, PDO::PARAM_INT);

if ($stmt->execute()) {
  echo "true";
} else {
  echo "false";
}
?>
