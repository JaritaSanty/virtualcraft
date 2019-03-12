<?php

require_once 'db_config.php';
$stmt = $DBcon->prepare("UPDATE actuaciones
                          SET act_estado = :act_estado
                          WHERE act_id = :act_id AND act_tipo = :act_tipo");

$stmt->bindParam(':act_id', $_POST['act_id'], PDO::PARAM_INT);
$stmt->bindParam(':act_estado', $_POST['act_estado'], PDO::PARAM_INT);
$stmt->bindParam(':act_tipo', $_POST['act_tipo'], PDO::PARAM_STR);

if ($stmt->execute()) {
  echo "true";
} else {
  echo "false";
}
?>
