<?php
$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;

$tra_nombre = utf8_decode ($_POST['tra_nombre']);
$tra_descripcion = utf8_decode ($_POST['tra_descripcion']);

require_once 'db_config.php';
$stmt = $DBcon->prepare("UPDATE trabajos
                          SET tra_nombre = :tra_nombre, tra_descripcion = :tra_descripcion, tra_PV = :tra_PV, tra_PD = :tra_PD, tra_PO = :tra_PO, tra_PP = :tra_PP, tra_FO = :tra_FO
                          WHERE tra_id = :tra_id AND cla_id = :cla_id ");

                          $stmt->bindParam(':tra_id', $_POST['tra_id'], PDO::PARAM_INT);
                          $stmt->bindParam(':cla_id', $cla_id, PDO::PARAM_INT);
                          $stmt->bindParam(':tra_nombre', $tra_nombre, PDO::PARAM_STR);
                          $stmt->bindParam(':tra_descripcion', $tra_descripcion, PDO::PARAM_STR);
                          $stmt->bindParam(':tra_PV', $_POST['tra_PV'], PDO::PARAM_INT);
                          $stmt->bindParam(':tra_PD', $_POST['tra_PD'], PDO::PARAM_INT);
                          $stmt->bindParam(':tra_PO', $_POST['tra_PO'], PDO::PARAM_INT);
                          $stmt->bindParam(':tra_PP', $_POST['tra_PP'], PDO::PARAM_INT);
                          $stmt->bindParam(':tra_FO', $_POST['tra_FO'], PDO::PARAM_INT);

if ($stmt->execute()) {
  echo "true";
} else {
  echo "false";
}
?>
