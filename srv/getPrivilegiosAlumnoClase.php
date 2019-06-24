<?php
$obj1 = json_decode($_POST["datosCurso"]);
$cla_id = $obj1->cla_id;
$obj2 = json_decode($_POST["datosAlumno"]);
$rol_id = $obj2->rol_id;
$aluclaequ_id = $obj2->aluclaequ_id;

require_once 'db_config.php';

$stmt = $DBcon->prepare("SELECT p.pri_id, p.rolniv_id, p.cla_id, p.pri_nombre, p.pri_numero,
                                (CASE
                                  WHEN p.pri_id IN (SELECT pri_id FROM privilegiosejecutados WHERE prieje_tipo = 'ganado' AND aluclaequ_id = :aluclaequ_id)
                                  THEN '1'
                                  ELSE '0'
                                  END) AS pri_comprado,
                                (CASE
                                  WHEN p.pri_id NOT IN (SELECT pri_id FROM privilegiosejecutados WHERE prieje_tipo = 'ganado' AND aluclaequ_id = :aluclaequ_id)
                                  AND ((SELECT aluclaequ_PV FROM alumnosclasesequipos WHERE aluclaequ_id = :aluclaequ_id) + p.pri_costPV) >= 0
                                  AND ((SELECT aluclaequ_PD FROM alumnosclasesequipos WHERE aluclaequ_id = :aluclaequ_id) + p.pri_costPD) >= 0
                                  AND ((SELECT aluclaequ_PO FROM alumnosclasesequipos WHERE aluclaequ_id = :aluclaequ_id) + p.pri_costPO) >= 0
                                  AND ((SELECT aluclaequ_PP FROM alumnosclasesequipos WHERE aluclaequ_id = :aluclaequ_id) + p.pri_costPP) >= 0
                                  AND ((SELECT aluclaequ_FO FROM alumnosclasesequipos WHERE aluclaequ_id = :aluclaequ_id) + p.pri_costFO) >= 0
                                  AND ((p.pri_necesario1 = 0) OR (p.pri_necesario1 IN (SELECT pri_numero FROM privilegiosejecutados NATURAL JOIN privilegios WHERE prieje_tipo = 'ganado' AND aluclaequ_id = :aluclaequ_id)))
                                  AND ((p.pri_necesario2 = 0) OR (p.pri_necesario2 IN (SELECT pri_numero FROM privilegiosejecutados NATURAL JOIN privilegios WHERE prieje_tipo = 'ganado' AND aluclaequ_id = :aluclaequ_id)))
                                  THEN '1'
                                  ELSE '0'
                                  END) AS pri_comprar,
                                (CASE
                                  WHEN p.pri_id IN (SELECT pri_id FROM privilegiosejecutados WHERE prieje_tipo = 'ganado' AND aluclaequ_id = :aluclaequ_id)
                                  AND ((SELECT aluclaequ_PV FROM alumnosclasesequipos WHERE aluclaequ_id = :aluclaequ_id) + p.pri_aluPV) >= 0
                                  AND ((SELECT aluclaequ_PD FROM alumnosclasesequipos WHERE aluclaequ_id = :aluclaequ_id) + p.pri_aluPD) >= 0
                                  AND ((SELECT aluclaequ_PO FROM alumnosclasesequipos WHERE aluclaequ_id = :aluclaequ_id) + p.pri_aluPO) >= 0
                                  AND ((SELECT aluclaequ_PP FROM alumnosclasesequipos WHERE aluclaequ_id = :aluclaequ_id) + p.pri_aluPP) >= 0
                                  AND ((SELECT aluclaequ_FO FROM alumnosclasesequipos WHERE aluclaequ_id = :aluclaequ_id) + p.pri_aluFO) >= 0
                                  THEN '1'
                                  ELSE '0'
                                  END) AS pri_ejecutar,
                                  p.pri_imagen, i.img_ruta, p.pri_costPD , p.pri_costPV,
                                  p.pri_costPO, p.pri_costPP, p.pri_costFO, p.pri_aluPD,
                                  p.pri_aluPV, p.pri_aluPO, p.pri_aluPP, p.pri_aluFO, p.pri_equPD,
                                  p.pri_equPV, p.pri_equPO, p.pri_equPP, p.pri_equFO,
                                  p.pri_necesario1, p.pri_necesario2, p.pri_descripcion
                        FROM privilegios AS p
                        INNER JOIN imagenes AS i ON i.img_id = p.pri_imagen
                        WHERE p.pri_estado = 1 AND p.cla_id = :cla_id AND p.rolniv_id IN (SELECT rolniv_id FROM rolesniveles WHERE rol_id = :rol_id)
                        ORDER BY p.pri_numero ASC");

$stmt->bindParam(':cla_id', $cla_id, PDO::PARAM_INT);
$stmt->bindParam(':rol_id', $rol_id, PDO::PARAM_INT);
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
