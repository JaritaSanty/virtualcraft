<?php
$equ_nombre = utf8_decode ($_POST['equ_nombre']);
$equ_descripcion = utf8_decode ($_POST['equ_descripcion']);

require_once 'db_config.php';
$stmt = $DBcon->prepare("UPDATE equipos
                          SET equ_nombre = :equ_nombre, equ_descripcion = :equ_descripcion
                          WHERE equ_id = :equ_id");

$stmt->bindParam(':equ_nombre', $equ_nombre, PDO::PARAM_STR);
$stmt->bindParam(':equ_descripcion', $equ_descripcion, PDO::PARAM_STR);
$stmt->bindParam(':equ_id', $_POST['equ_id'], PDO::PARAM_INT);

if ($stmt->execute()) {
  echo "true";
} else {
  echo "false";
}
?>
