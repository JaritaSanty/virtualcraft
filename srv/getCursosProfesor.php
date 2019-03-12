<?php
$obj = json_decode($_POST["datosUsuario"]);
$pro_id = $obj->pro_id;

require_once 'db_config.php';
$stmtClasesProfesor = $DBcon->prepare("SELECT DISTINCT c.cla_id, c.cla_nombre, c.cla_descripcion, (SELECT COUNT(*) FROM alumnosclases WHERE alucla_estado = 1 AND cla_id = c.cla_id) AS cla_alumno, i.img_ruta AS cla_fondo
                                  FROM clases as c
                                  INNER JOIN imagenes AS i ON i.img_id = c.cla_fondo
                                  WHERE c.cla_estado = 1 AND c.pro_id = ".$pro_id);

try
 {
     $stmtClasesProfesor->execute();
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

 $datosClasesProfesor = json_encode(utf8ize($stmtClasesProfesor->fetchAll()));
 echo $datosClasesProfesor;
?>
