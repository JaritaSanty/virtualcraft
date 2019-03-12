<?php
$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;

require_once 'db_config.php';
$stmtAlumnosClase = $DBcon->prepare("SELECT a.alu_id, CONCAT(u.usu_apellido, ' ', u.usu_nombre) AS alucla_nombre
FROM alumnos AS a
INNER JOIN usuarios AS u ON u.usu_id = a.usu_id
WHERE a.alu_id NOT IN (SELECT alu_id FROM alumnosclases WHERE cla_id = ".$cla_id." AND alucla_estado = 1)");

try
 {
     $stmtAlumnosClase->execute();
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

 $datosAlumnosClase = json_encode(utf8ize($stmtAlumnosClase->fetchAll()));
 echo $datosAlumnosClase;
?>
