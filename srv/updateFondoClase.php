<?php

require_once 'db_config.php';

$stmtUpdate = $DBcon->prepare("UPDATE clases
                                SET cla_fondo = :cla_fondo
                                WHERE cla_id = :cla_id ");

$stmtUpdate->bindParam(':cla_id', $_POST['cla_id'], PDO::PARAM_STR);
$stmtUpdate->bindParam(':cla_fondo', $_POST['cla_fondo'], PDO::PARAM_STR);

if ($stmtUpdate->execute()) {
  echo "true";
} else {
  echo "false";
}

?>
