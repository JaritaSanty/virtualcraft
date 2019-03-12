<?php
$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;

$act_nombre = utf8_decode ($_POST['act_nombre']);
$act_descripcion = utf8_decode ($_POST['act_descripcion']);

require_once 'db_config.php';
$stmt = $DBcon->prepare("UPDATE actuaciones
                          SET act_nombre = :act_nombre, act_descripcion = :act_descripcion, act_PV = :act_PV, act_PD = :act_PD, act_PO = :act_PO, act_PP = :act_PP, act_FO = :act_FO
                          WHERE act_id = :act_id AND act_tipo = :act_tipo AND cla_id = :cla_id ");

                          $stmt->bindParam(':act_id', $_POST['act_id'], PDO::PARAM_INT);
                          $stmt->bindParam(':cla_id', $cla_id, PDO::PARAM_INT);
                          $stmt->bindParam(':act_nombre', $act_nombre, PDO::PARAM_STR);
                          $stmt->bindParam(':act_descripcion', $act_descripcion, PDO::PARAM_STR);
                          $stmt->bindParam(':act_PV', $_POST['act_PV'], PDO::PARAM_INT);
                          $stmt->bindParam(':act_PD', $_POST['act_PD'], PDO::PARAM_INT);
                          $stmt->bindParam(':act_PO', $_POST['act_PO'], PDO::PARAM_INT);
                          $stmt->bindParam(':act_PP', $_POST['act_PP'], PDO::PARAM_INT);
                          $stmt->bindParam(':act_FO', $_POST['act_FO'], PDO::PARAM_INT);
                          $stmt->bindParam(':act_tipo', $_POST['act_tipo'], PDO::PARAM_STR);

if ($stmt->execute()) {
  echo "true";
} else {
  echo "false";
}
?>
