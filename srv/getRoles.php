<?php
$obj = json_decode($_POST["datosUsuario"]);
$pro_id = $obj[0]->pro_id;

require_once 'db_config.php';
$stmt = $DBcon->prepare("SELECT rol_id, CONCAT(rol_nombre_masculino, ' / ', rol_nombre_femenino) AS rol_nombre FROM roles");

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
