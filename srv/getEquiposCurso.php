<?php
$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;

require_once 'db_config.php';
$stmt = $DBcon->prepare("SELECT e.equ_id, e.equ_nombre, e.cla_id, c.cla_nombre, ies.img_ruta AS equ_escudo, ifo.img_ruta AS equ_fondo, e.equ_estado, e.equ_descripcion,(SELECT COUNT(*) FROM alumnosclasesequipos WHERE aluclaequ_estado = 1 AND alucla_id IN (SELECT alucla_id FROM alumnosclases WHERE alucla_estado = 1 AND cla_id = ".$cla_id.") AND equ_id = e.equ_id) AS equ_alumno
                          FROM equipos AS e
                          INNER JOIN clases AS c ON c.cla_id = e.cla_id
                          INNER JOIN imagenes AS ies ON ies.img_id = e.equ_escudo
                          INNER JOIN imagenes AS ifo ON ifo.img_id = e.equ_fondo
                          WHERE e.equ_estado = 1 AND e.cla_id = ".$cla_id);

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
