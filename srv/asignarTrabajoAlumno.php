<?php

require_once 'db_config.php';

$stmtInsert = $DBcon->prepare("INSERT IGNORE INTO trabajosasignados (tra_id, aluclaequ_id)
                                VALUES(:tra_id, :aluclaequ_id)");

$stmtInsert->bindParam(':aluclaequ_id', $_POST['aluclaequ_id'], PDO::PARAM_STR);
$stmtInsert->bindParam(':tra_id', $_POST['tra_id'], PDO::PARAM_STR);

if ($stmtInsert->execute()) {
 echo "true";
} else {
 echo "false";
}

?>
