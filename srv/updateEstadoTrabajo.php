<?php

require_once 'db_config.php';
$stmt = $DBcon->prepare("UPDATE trabajos
                          SET tra_estado = :tra_estado
                          WHERE tra_id = :tra_id ");

$stmt->bindParam(':tra_id', $_POST['tra_id'], PDO::PARAM_INT);
$stmt->bindParam(':tra_estado', $_POST['tra_estado'], PDO::PARAM_INT);

if ($stmt->execute()) {
  echo "true";
} else {
  echo "false";
}
?>
