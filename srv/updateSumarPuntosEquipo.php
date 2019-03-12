<?php

require_once 'db_config.php';
$stmt = $DBcon->prepare("UPDATE alumnosclasesequipos
                          SET aluclaequ_PV = CASE
                                                  WHEN  (aluclaequ_PV + :aluclaequ_equPV) < 0 THEN 0
                                                  WHEN  (aluclaequ_PV + :aluclaequ_equPV) > 100 THEN 100
                                                  ELSE (aluclaequ_PV + :aluclaequ_equPV)
                                                  END,
                              aluclaequ_PD = CASE
                                                  WHEN  (aluclaequ_PD + :aluclaequ_equPD) < 0 THEN 0
                                                  WHEN  (aluclaequ_PD + :aluclaequ_equPD) > 100 THEN 100
                                                  ELSE (aluclaequ_PD + :aluclaequ_equPD) 
                                                  END,
                              aluclaequ_PO = CASE
                                                  WHEN  (aluclaequ_PO + :aluclaequ_equPO) < 0 THEN 0
                                                  ELSE (aluclaequ_PO + :aluclaequ_equPO)
                                                  END,
                              aluclaequ_PP = CASE
                                                  WHEN  (aluclaequ_PP + :aluclaequ_equPP) < 0 THEN 0
                                                  ELSE (aluclaequ_PP + :aluclaequ_equPP)
                                                  END,
                              aluclaequ_FO = CASE
                                                  WHEN  (aluclaequ_FO + :aluclaequ_equFO) < 0 THEN 0
                                                  ELSE (aluclaequ_FO + :aluclaequ_equFO)
                                                  END
                          WHERE aluclaequ_estado = 1 AND equ_id = :equ_id;
                          INSERT INTO logprofesor (aluclaequ_id, log_tipo, log_PV, log_PD, log_PO, log_PP, log_FO, log_descripcion)
                          SELECT ace.aluclaequ_id, 'puntosequipo', :aluclaequ_equPV, :aluclaequ_equPD, :aluclaequ_equPO, :aluclaequ_equPP, :aluclaequ_equFO, :log_descripcion
                          FROM alumnosclasesequipos AS ace
                          INNER JOIN alumnosclases AS ac ON ac.alucla_id = ace.alucla_id
                          INNER JOIN alumnos AS a ON a.alu_id = ac.alu_id
                          INNER JOIN usuarios AS u ON u.usu_id = a.usu_id
                          INNER JOIN equipos AS e ON e.equ_id = ace.equ_id
                          WHERE ace.aluclaequ_estado = 1 AND ace.equ_id = :equ_id;");

$stmt->bindParam(':log_descripcion', $_POST['log_descripcion'], PDO::PARAM_STR);
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
