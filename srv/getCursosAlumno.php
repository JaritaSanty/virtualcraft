<?php
$obj = json_decode($_POST["datosUsuario"]);
$alu_id = $obj->alu_id;

require_once 'db_config.php';
$stmtClases = $DBcon->prepare("SELECT DISTINCT c.cla_id, c.cla_nombre, c.cla_descripcion, i.img_ruta AS cla_fondo, ie.img_ruta AS equ_fondo, iee.img_ruta AS equ_escudo
                                  FROM clases as c
                                  INNER JOIN imagenes AS i ON i.img_id = c.cla_fondo
                                  INNER JOIN alumnosclases AS ac ON ac.cla_id = c.cla_id
                                  INNER JOIN alumnosclasesequipos AS ace ON ace.alucla_id = ac.alucla_id
                                  INNER JOIN equipos AS e ON e.equ_id = ace.equ_id
                                  INNER JOIN imagenes AS ie ON ie.img_id = e.equ_fondo
                                  INNER JOIN imagenes AS iee ON iee.img_id = e.equ_escudo
                                  WHERE c.cla_estado = 1 AND ac.alu_id = ".$alu_id);

try
 {
     $stmtClases->execute();
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

 $datosClases = json_encode(utf8ize($stmtClases->fetchAll()));
 echo $datosClases;
?>
