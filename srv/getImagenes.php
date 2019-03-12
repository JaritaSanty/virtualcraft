<?php

require_once 'db_config.php';
$stmt = $DBcon->prepare("SELECT img_id, img_ruta, img_tipo, img_estado, img_descripcion
                          FROM imagenes
                          WHERE img_estado = 1 AND img_tipo = '".$_POST['img_tipo']."'");

try
 {
     $stmt->execute();
 }
 catch(PDOException $e)
 {
     echo "ERROR : ".$e->getMessage();
 }

 $datos = json_encode($stmt->fetchAll());
 echo $datos;
?>
