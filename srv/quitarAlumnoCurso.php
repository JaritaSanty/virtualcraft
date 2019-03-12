<?php
$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;

require_once 'db_config.php';
$stmt = $DBcon->prepare("UPDATE alumnosclases
                          SET alucla_estado = 0
                          WHERE cla_id = :cla_id AND alucla_id = :alucla_id;
                          UPDATE alumnosclasesequipos
                          SET aluclaequ_estado = 0
                          WHERE alucla_id = :alucla_id; ");

$stmt->bindParam(':alucla_id', $_POST['alucla_id'], PDO::PARAM_STR);
$stmt->bindParam(':cla_id', $cla_id, PDO::PARAM_INT);

if ($stmt->execute()) {
  echo "true";
} else {
  echo "false";
}
?>
