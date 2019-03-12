<?php
$obj1 = json_decode($_POST["datosCurso"]);
$cla_id = $obj1->cla_id;

$obj2 = json_decode($_POST["datosEquipo"]);
$equ_id = $obj2->equ_id;

require_once 'db_config.php';
$stmt = $DBcon->prepare("SELECT ac.alucla_id, a.alu_id, CONCAT(u.usu_apellido, ' ', u.usu_nombre) AS alucla_nombre
FROM alumnosclases AS ac
INNER JOIN alumnos AS a ON a.alu_id = ac.alu_id
INNER JOIN usuarios AS u ON u.usu_id = a.usu_id
WHERE (ac.alucla_id IN (SELECT alucla_id FROM alumnosclases WHERE alucla_estado = 1 AND cla_id = ".$cla_id.")) AND (ac.alucla_id NOT IN (SELECT alucla_id FROM alumnosclasesequipos WHERE aluclaequ_estado = 1 AND cla_id = ".$cla_id."))");

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
