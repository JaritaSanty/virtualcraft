<?php

require_once 'db_config.php';
$stmt = $DBcon->prepare("UPDATE alumnosclasesequipos
                          SET aluclaequ_PV = aluclaequ_PV - :aluclaequ_equPV,
                              aluclaequ_PD = aluclaequ_PD - :aluclaequ_equPD,
                              aluclaequ_PO = aluclaequ_PO - :aluclaequ_equPO,
                              aluclaequ_PP = aluclaequ_PP - :aluclaequ_equPP,
                              aluclaequ_FO = aluclaequ_FO - :aluclaequ_equFO
                          WHERE aluclaequ_estado = 1 AND equ_id = :equ_id");

$stmt->bindParam(':aluclaequ_equPV', $_POST['aluclaequ_equPV'], PDO::PARAM_STR);
$stmt->bindParam(':aluclaequ_equPD', $_POST['aluclaequ_equPD'], PDO::PARAM_STR);
$stmt->bindParam(':aluclaequ_equPO', $_POST['aluclaequ_equPO'], PDO::PARAM_STR);
$stmt->bindParam(':aluclaequ_equPP', $_POST['aluclaequ_equPP'], PDO::PARAM_STR);
$stmt->bindParam(':aluclaequ_equFO', $_POST['aluclaequ_equFO'], PDO::PARAM_STR);
$stmt->bindParam(':equ_id', $_POST['equ_id'], PDO::PARAM_INT);

if ($stmt->execute()) {
  echo "true";
} else {
  echo "false";
}
?>
