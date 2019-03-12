<?php

require_once 'db_config.php';

$stmtUpdate = $DBcon->prepare("UPDATE alumnosclasesequipos ace,
                                  (SELECT rolniv_id, rolniv_PV, rolniv_PD, rolniv_PO, rolniv_PP, rolniv_FO
                                    FROM rolesniveles
                                    WHERE rol_id = :rol_id AND niv_id = :niv_id) rn
                                SET ace.rolniv_id = rn.rolniv_id, ace.aluclaequ_PV = rn.rolniv_PV,
                                    ace.aluclaequ_PD = rn.rolniv_PD, ace.aluclaequ_PO = rn.rolniv_PO,
                                    ace.aluclaequ_PP = rn.rolniv_PP, ace.aluclaequ_FO = rn.rolniv_FO
                                WHERE ace.aluclaequ_id = :aluclaequ_id ");

$stmtUpdate->bindParam(':aluclaequ_id', $_POST['aluclaequ_id'], PDO::PARAM_STR);
$stmtUpdate->bindParam(':rol_id', $_POST['rol_id'], PDO::PARAM_STR);
$stmtUpdate->bindParam(':niv_id', $_POST['niv_id'], PDO::PARAM_STR);

 if ($stmtUpdate->execute()) {
   echo "true";
 } else {
   echo "false";
 }
?>
