<?php
require_once 'db_config.php';
$log_descripcion = utf8_decode ($_POST['log_descripcion']);

$stmt = $DBcon->prepare("UPDATE alumnosclasesequipos
                          SET
                              aluclaequ_PV = CASE
                                                  WHEN  (aluclaequ_PV + :aluclaequ_aluPV) < 0 THEN 0
                                                  WHEN  (aluclaequ_PV + :aluclaequ_aluPV) > 100 THEN 100
                                                  ELSE (aluclaequ_PV + :aluclaequ_aluPV)
                                                  END,
                              aluclaequ_PD = CASE
                                                  WHEN  (aluclaequ_PD + :aluclaequ_aluPD) < 0 THEN 0
                                                  WHEN  (aluclaequ_PD + :aluclaequ_aluPD) > 100 THEN 100
                                                  ELSE (aluclaequ_PD + :aluclaequ_aluPD)
                                                  END,
                              aluclaequ_PO = CASE
                                                  WHEN  (aluclaequ_PO + :aluclaequ_aluPO) < 0 THEN 0
                                                  ELSE (aluclaequ_PO + :aluclaequ_aluPO)
                                                  END,
                              aluclaequ_PP = CASE
                                                  WHEN  (aluclaequ_PP + :aluclaequ_aluPP) < 0 THEN 0
                                                  ELSE (aluclaequ_PP + :aluclaequ_aluPP)
                                                  END,
                              aluclaequ_FO = CASE
                                                  WHEN  (aluclaequ_FO + :aluclaequ_aluFO) < 0 THEN 0
                                                  ELSE (aluclaequ_FO + :aluclaequ_aluFO)
                                                  END
                          WHERE aluclaequ_id = :aluclaequ_id;
                          INSERT INTO logprofesor (aluclaequ_id, log_tipo, log_PV, log_PD, log_PO, log_PP, log_FO, log_descripcion)
                          VALUES(:aluclaequ_id, 'puntosalumno', :aluclaequ_aluPV, :aluclaequ_aluPD, :aluclaequ_aluPO, :aluclaequ_aluPP, :aluclaequ_aluFO, :log_descripcion);");

$stmt->bindParam(':aluclaequ_aluPV', $_POST['aluclaequ_aluPV'], PDO::PARAM_STR);
$stmt->bindParam(':aluclaequ_aluPD', $_POST['aluclaequ_aluPD'], PDO::PARAM_STR);
$stmt->bindParam(':aluclaequ_aluPO', $_POST['aluclaequ_aluPO'], PDO::PARAM_STR);
$stmt->bindParam(':aluclaequ_aluPP', $_POST['aluclaequ_aluPP'], PDO::PARAM_STR);
$stmt->bindParam(':aluclaequ_aluFO', $_POST['aluclaequ_aluFO'], PDO::PARAM_STR);
$stmt->bindParam(':log_descripcion', $log_descripcion, PDO::PARAM_STR);
$stmt->bindParam(':aluclaequ_id', $_POST['aluclaequ_id'], PDO::PARAM_INT);

if ($stmt->execute()) {
  echo "true";
} else {
  echo "false";
}
?>
