<?php
$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;

require_once 'db_config.php';

$stmtInsert = $DBcon->prepare("INSERT INTO actuacionesejecutadas (act_id, aluclaequ_id)
                                VALUES(:act_id, :aluclaequ_id)");

$stmtUpdate = $DBcon->prepare("UPDATE alumnosclasesequipos
                                SET aluclaequ_PV = CASE
                                                    WHEN  (aluclaequ_PV + :act_PV) < 0 THEN 0
                                                    WHEN  (aluclaequ_PV + :act_PV) > 100 THEN 100
                                                    ELSE (aluclaequ_PV + :act_PV)
                                                    END,
                                    aluclaequ_PD = CASE
                                                        WHEN  (aluclaequ_PD + :act_PD) < 0 THEN 0
                                                        WHEN  (aluclaequ_PD + :act_PD) > 100 THEN 100
                                                        ELSE (aluclaequ_PD + :act_PD)
                                                        END,
                                    aluclaequ_PO = CASE
                                                        WHEN  (aluclaequ_PO + :act_PO) < 0 THEN 0
                                                        WHEN  (aluclaequ_PO + :act_PO) > 100 THEN 100
                                                        ELSE (aluclaequ_PO + :act_PO)
                                                        END,
                                    aluclaequ_PP = CASE
                                                        WHEN  (aluclaequ_PP + :act_PP) < 0 THEN 0
                                                        WHEN  (aluclaequ_PP + :act_PP) > 100 THEN 100
                                                        ELSE (aluclaequ_PP + :act_PP)
                                                        END,
                                    aluclaequ_FO = CASE
                                                        WHEN  (aluclaequ_FO + :act_FO) < 0 THEN 0
                                                        WHEN  (aluclaequ_FO + :act_FO) > 100 THEN 100
                                                        ELSE (aluclaequ_FO + :act_FO)
                                                        END
                                WHERE aluclaequ_id = :aluclaequ_id");

$stmtInsert->bindParam(':aluclaequ_id', $_POST['aluclaequ_id'], PDO::PARAM_STR);
$stmtInsert->bindParam(':act_id', $_POST['act_id'], PDO::PARAM_STR);

$stmtUpdate->bindParam(':aluclaequ_id', $_POST['aluclaequ_id'], PDO::PARAM_STR);
$stmtUpdate->bindParam(':act_PV', $_POST['act_PV'], PDO::PARAM_STR);
$stmtUpdate->bindParam(':act_PD', $_POST['act_PD'], PDO::PARAM_STR);
$stmtUpdate->bindParam(':act_PO', $_POST['act_PO'], PDO::PARAM_STR);
$stmtUpdate->bindParam(':act_PP', $_POST['act_PP'], PDO::PARAM_STR);
$stmtUpdate->bindParam(':act_FO', $_POST['act_FO'], PDO::PARAM_STR);


if ($stmtUpdate->execute() && $stmtInsert->execute()) {
 echo "true";
} else {
 echo "false";
}

?>
