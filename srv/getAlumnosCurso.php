<?php
$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;

require_once 'db_config.php';
$stmtAlumnosClase = $DBcon->prepare("SELECT ac.alucla_id, ac.alu_id, CONCAT(u.usu_apellido, ' ', u.usu_nombre) AS alucla_nombre, ac.cla_id, c.cla_nombre, ac.alucla_estado, ac.alucla_descripcion
                                      FROM alumnos AS a
                                      INNER JOIN alumnosclases AS ac ON ac.alu_id = a.alu_id
                                      INNER JOIN usuarios AS u ON u.usu_id = a.usu_id
                                      INNER JOIN clases AS c ON c.cla_id = ac.cla_id
                                      WHERE ac.alucla_estado = 1 AND ac.cla_id = ".$cla_id);

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
