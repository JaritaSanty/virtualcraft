<?php
$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;

require_once 'db_config.php';
$stmt = $DBcon->prepare("SELECT p.pri_id, p.rolniv_id, CONCAT(r.rol_nombre_masculino, ' / ', r.rol_nombre_femenino) AS pri_rol, n.niv_nombre, p.pri_nombre, p.pri_numero, p.pri_estado, i.img_ruta AS pri_imagen, p.pri_aluPV, p.pri_aluPD, p.pri_aluPO, p.pri_aluPP, p.pri_aluFO, p.pri_equPV, p.pri_equPD, p.pri_equPO, p.pri_equPP, p.pri_equFO, p.pri_costPV, p.pri_costPD, p.pri_costPO, p.pri_costPP, p.pri_costFO, p.pri_necesario1, p.pri_necesario2, p.pri_descripcion
                          FROM privilegios AS p
                          INNER JOIN rolesniveles AS rn ON rn.rolniv_id = p.rolniv_id
                          INNER JOIN roles AS r ON r.rol_id = rn.rol_id
                          INNER JOIN niveles AS n ON n.niv_id = rn.niv_id
                          INNER JOIN imagenes AS i ON i.img_id = p.pri_imagen
                          WHERE (r.rol_nombre_masculino = 'Cavaller' OR r.rol_nombre_femenino = 'Amazona')
                          AND p.pri_estado = 1 AND p.cla_id = ".$cla_id." ORDER BY p.pri_numero ASC ");

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
