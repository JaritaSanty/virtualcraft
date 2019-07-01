<?php
$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;
$equ_id = $_POST["equ_id"];
$aluclaequ_id = $_POST["aluclaequ_id"];

require_once 'db_config.php';
$stmt = $DBcon->prepare("SELECT t.tra_id, t.cla_id, t.tra_nombre, t.tra_estado, t.tra_PV, t.tra_PD, t.tra_PO, t.tra_PP, t.tra_FO, t.tra_descripcion,

(SELECT (CASE WHEN COUNT(*) <= 0 THEN 'true' ELSE 'false' END)
                            		FROM trabajosasignados
                            		WHERE tra_id = t.tra_id  AND aluclaequ_id = :aluclaequ_id) AS trasig_alumno,
                                (SELECT
                                        CASE WHEN (SELECT COUNT(*) FROM alumnosclasesequipos AS ace WHERE ace.aluclaequ_estado = 1 AND ace.equ_id = :equ_id)
                                                    <=
                                                    (SELECT COUNT(*)
                                                    FROM trabajosasignados AS ta
                                                    WHERE ta.tra_id = t.tra_id AND ta.aluclaequ_id IN (SELECT DISTINCT ace.aluclaequ_id
                                                                                                        FROM alumnosclasesequipos AS ace
                                                                                                        WHERE ace.equ_id = :equ_id))
                                        THEN 'false' ELSE 'true' END) AS trasig_equipo,
                                (SELECT CASE WHEN (SELECT COUNT(*)
                                                    FROM alumnosclasesequipos AS ace
                                                    INNER JOIN alumnosclases AS ac ON ac.alucla_id = ace.alucla_id
                                                    WHERE ace.aluclaequ_estado = 1 AND ac.cla_id = :cla_id)
                                        <=
                                                    (SELECT COUNT(ta.aluclaequ_id)
                                                    FROM trabajosasignados AS ta
                                                    WHERE ta.tra_id = t.tra_id AND ta.aluclaequ_id IN (SELECT ace.aluclaequ_id
                                                                                                        FROM alumnosclasesequipos AS ace
                                                                                                        INNER JOIN alumnosclases AS ac ON ac.alucla_id = ace.alucla_id
                                                                                                        WHERE ace.aluclaequ_estado = 1 AND ac.cla_id = :cla_id))
                                        THEN 'false' ELSE 'true' END) AS trasig_clase
                          FROM trabajos AS t
                          WHERE t.tra_estado = 1 AND t.cla_id = 1");

                          $stmt->bindParam(':cla_id', $cla_id, PDO::PARAM_INT);
                          $stmt->bindParam(':equ_id', $equ_id, PDO::PARAM_INT);
                          $stmt->bindParam(':aluclaequ_id', $aluclaequ_id, PDO::PARAM_INT);

try
 {
     $stmt->execute();
 }
 catch(PDOException $e)
 {
     echo "ERROR : ".$e->getMessage();
 }
 function utf8ize($d) {
     if (is_array($d)) {
         foreach ($d as $k => $v) {
             $d[$k] = utf8ize($v);
         }
     } else if (is_string ($d)) {
         return utf8_encode($d);
     }
     return $d;
 }

 $datos = json_encode(utf8ize($stmt->fetchAll()));
 echo $datos;
?>
