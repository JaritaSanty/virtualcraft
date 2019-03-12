<?php

require_once 'db_config.php';

$stmtUpdate = $DBcon->prepare("UPDATE equipos
                                SET equ_fondo = :equ_fondo
                                WHERE equ_id = :equ_id ");

$stmtUpdate->bindParam(':equ_id', $_POST['equ_id'], PDO::PARAM_STR);
$stmtUpdate->bindParam(':equ_fondo', $_POST['equ_fondo'], PDO::PARAM_STR);

if ($stmtUpdate->execute()) {
  echo "true";
} else {
  echo "false";
}

?>
