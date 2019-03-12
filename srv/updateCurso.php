<?php

$cla_nombre = utf8_decode ($_POST['cla_nombre']);
$cla_descripcion = utf8_decode ($_POST['cla_descripcion']);

require_once 'db_config.php';
$stmt = $DBcon->prepare("UPDATE clases
                          SET cla_nombre = :cla_nombre, cla_descripcion = :cla_descripcion
                          WHERE cla_id = :cla_id");

$stmt->bindParam(':cla_nombre', $cla_nombre, PDO::PARAM_STR);
$stmt->bindParam(':cla_descripcion', $cla_descripcion, PDO::PARAM_STR);
$stmt->bindParam(':cla_id', $_POST['cla_id'], PDO::PARAM_INT);

if ($stmt->execute()) {
  echo "true";
} else {
  echo "false";
}
?>
