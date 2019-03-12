<?php

require_once 'db_config.php';
$stmt = $DBcon->prepare("UPDATE alumnosclasesequipos
                          SET aluclaequ_estado = 0
                          WHERE aluclaequ_id = :aluclaequ_id ");

$stmt->bindParam(':aluclaequ_id', $_POST['aluclaequ_id'], PDO::PARAM_STR);

if ($stmt->execute()) {
  echo "true";
} else {
  echo "false";
}
?>
