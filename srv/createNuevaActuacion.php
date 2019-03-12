<?php
$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;

$act_nombre = utf8_decode ($_POST['act_nombre']);
$act_descripcion = utf8_decode ($_POST['act_descripcion']);

require_once 'db_config.php';
$stmtInsert = $DBcon->prepare("INSERT INTO actuaciones (cla_id, act_nombre, act_descripcion, act_tipo, act_PV, act_PD, act_PO, act_PP, act_FO)
                                      VALUES(:cla_id, :act_nombre, :act_descripcion, :act_tipo, :act_PV, :act_PD, :act_PO, :act_PP, :act_FO)");

$stmtInsert->bindParam(':cla_id', $cla_id, PDO::PARAM_INT);
$stmtInsert->bindParam(':act_nombre', $act_nombre, PDO::PARAM_STR);
$stmtInsert->bindParam(':act_descripcion', $act_descripcion, PDO::PARAM_STR);
$stmtInsert->bindParam(':act_PV', $_POST['act_PV'], PDO::PARAM_STR);
$stmtInsert->bindParam(':act_PD', $_POST['act_PD'], PDO::PARAM_STR);
$stmtInsert->bindParam(':act_PO', $_POST['act_PO'], PDO::PARAM_STR);
$stmtInsert->bindParam(':act_PP', $_POST['act_PP'], PDO::PARAM_STR);
$stmtInsert->bindParam(':act_FO', $_POST['act_FO'], PDO::PARAM_STR);
$stmtInsert->bindParam(':act_tipo', $_POST['act_tipo'], PDO::PARAM_STR);

if ($stmtInsert->execute()) {
  echo "true";
} else {
  echo "false";
}
?>
