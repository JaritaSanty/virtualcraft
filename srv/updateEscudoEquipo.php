<?php

require_once 'db_config.php';

$stmtUpdate = $DBcon->prepare("UPDATE equipos
                                SET equ_escudo = :equ_escudo
                                WHERE equ_id = :equ_id ");

$stmtUpdate->bindParam(':equ_id', $_POST['equ_id'], PDO::PARAM_STR);
$stmtUpdate->bindParam(':equ_escudo', $_POST['equ_escudo'], PDO::PARAM_STR);

if ($stmtUpdate->execute()) {
  echo "true";
} else {
  echo "false";
}

?>
