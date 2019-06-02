<?php
require_once 'db_config.php';
include ('main.php');

$tra_nombre = utf8_decode ($_POST['tra_nombre']);
$trasig_comentario = utf8_decode ($_POST['trasig_comentario']);
$trasig_id = $_POST['trasig_id'];
$aluclaequ_id = $_POST['aluclaequ_id'];
$tra_id = $_POST['tra_id'];
$trasig_calificacion = $_POST['trasig_calificacion'];

$stmt = $DBcon->prepare("UPDATE trabajosasignados
                          SET trasig_aprobado_trabajo = 1,
                              trasig_calificacion = :trasig_calificacion,
                              trasig_comentario = :trasig_comentario
                          WHERE trasig_id = :trasig_id;
                          UPDATE alumnosclasesequipos ace,
                          (SELECT tra_id, tra_PV, tra_PD, tra_PO, tra_PP, tra_FO
                            FROM trabajos
                            WHERE tra_id = :tra_id) t
                          SET
                              ace.aluclaequ_PV = CASE
                                                      WHEN (ace.aluclaequ_PV + t.tra_PV) < 0 THEN 0
                                                      WHEN (ace.aluclaequ_PV + t.tra_PV) > 100 THEN 100
                                                      ELSE (ace.aluclaequ_PV + t.tra_PV)
                                                      END,
                              ace.aluclaequ_PD = CASE
                                                      WHEN (ace.aluclaequ_PD + t.tra_PD) < 0 THEN 0
                                                      WHEN (ace.aluclaequ_PD + t.tra_PD) > 100 THEN 100
                                                      ELSE (ace.aluclaequ_PD + t.tra_PD)
                                                      END,
                              ace.aluclaequ_PO = CASE
                                                      WHEN (ace.aluclaequ_PO + t.tra_PO) < 0 THEN 0
                                                      ELSE (ace.aluclaequ_PO + t.tra_PO)
                                                      END,
                              ace.aluclaequ_PP = CASE
                                                      WHEN (ace.aluclaequ_PP + t.tra_PP) < 0 THEN 0
                                                      ELSE (ace.aluclaequ_PP + t.tra_PP)
                                                      END,
                              ace.aluclaequ_FO = CASE
                                                      WHEN (ace.aluclaequ_FO + t.tra_FO) < 0 THEN 0
                                                      ELSE (ace.aluclaequ_FO + t.tra_FO)
                                                      END
                          WHERE ace.aluclaequ_id = :aluclaequ_id;
                          INSERT INTO logprofesor (aluclaequ_id, log_tipo, log_PV, log_PD, log_PO, log_PP, log_FO, log_descripcion)
                          SELECT :aluclaequ_id, 'puntosalumno', tra_PV, tra_PD, tra_PO, tra_PP, tra_FO, CONCAT('Treball Aprobat: ',:tra_nombre)
                          FROM trabajos
                          WHERE tra_id = :tra_id");

                          $stmt->bindParam(':trasig_id', $_POST['trasig_id'], PDO::PARAM_INT);
                          $stmt->bindParam(':aluclaequ_id', $_POST['aluclaequ_id'], PDO::PARAM_INT);
                          $stmt->bindParam(':tra_id', $_POST['tra_id'], PDO::PARAM_INT);
                          $stmt->bindParam(':tra_nombre', $tra_nombre, PDO::PARAM_STR);
                          $stmt->bindParam(':trasig_calificacion', $_POST['trasig_calificacion'], PDO::PARAM_STR);
                          $stmt->bindParam(':trasig_comentario', $_POST['trasig_comentario'], PDO::PARAM_STR);

if ($stmt->execute()) {
  echo "true";
} else {
  echo "false";
}
?>
