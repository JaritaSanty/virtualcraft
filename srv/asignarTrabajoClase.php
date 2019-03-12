<?php
$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;

require_once 'db_config.php';

$stmtInsert = $DBcon->prepare("INSERT IGNORE INTO trabajosasignados (tra_id, aluclaequ_id)
                                SELECT :tra_id, ace.aluclaequ_id
                                FROM alumnosclasesequipos AS ace
                                INNER JOIN alumnosclases AS ac ON ac.alucla_id = ace.alucla_id
                                WHERE ace.aluclaequ_estado = 1 AND ac.cla_id = $cla_id;");

$stmtInsert->bindParam(':tra_id', $_POST['tra_id'], PDO::PARAM_STR);

if ($stmtInsert->execute()) {
 echo "true";
} else {
 echo "false";
}

?>
