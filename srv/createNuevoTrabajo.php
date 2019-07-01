<?php
$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;

$tra_nombre = utf8_decode ($_POST['tra_nombre']);
$tra_descripcion = utf8_decode ($_POST['tra_descripcion']);

require_once 'db_config.php';
$stmtInsert = $DBcon->prepare("INSERT INTO trabajos (cla_id, tra_nombre, tra_descripcion, tra_PV, tra_PD, tra_PO, tra_FO)
                                      VALUES(:cla_id, :tra_nombre, :tra_descripcion, :tra_PV, :tra_PD, :tra_PO, :tra_FO)");

$stmtInsert->bindParam(':cla_id', $cla_id, PDO::PARAM_INT);
$stmtInsert->bindParam(':tra_nombre', $tra_nombre, PDO::PARAM_STR);
$stmtInsert->bindParam(':tra_descripcion', $tra_descripcion, PDO::PARAM_STR);
$stmtInsert->bindParam(':tra_PV', $_POST['tra_PV'], PDO::PARAM_STR);
$stmtInsert->bindParam(':tra_PD', $_POST['tra_PD'], PDO::PARAM_STR);
$stmtInsert->bindParam(':tra_PO', $_POST['tra_PO'], PDO::PARAM_STR);
$stmtInsert->bindParam(':tra_FO', $_POST['tra_FO'], PDO::PARAM_STR);

if ($stmtInsert->execute()) {
  echo "true";
} else {
  echo "false";
}
?>
