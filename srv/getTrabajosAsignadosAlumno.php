<?php
$obj = json_decode($_POST["datosAlumno"]);
$aluclaequ_id = $obj->aluclaequ_id;

require_once 'db_config.php';
$stmt = $DBcon->prepare("SELECT ta.trasig_id, ta.tra_id, t.tra_nombre, ta.aluclaequ_id,
                          ta.trasig_titulo_trabajo, ta.trasig_texto_trabajo, ta.trasig_aprobado_trabajo,
                          ta.trasig_fecha_insert, ta.trasig_fecha_update, ta.trasig_descripcion
                          FROM trabajosasignados AS ta
                          INNER JOIN trabajos AS t ON t.tra_id = ta.tra_id
                          INNER JOIN alumnosclasesequipos AS ace ON ace.aluclaequ_id = ta.aluclaequ_id
                          INNER JOIN alumnosclases AS ac ON ac.alucla_id = ace.alucla_id
                          INNER JOIN alumnos AS al ON al.alu_id = ac.alu_id
                          INNER JOIN usuarios AS u ON u.usu_id = al.usu_id
                          WHERE t.tra_estado = 1 AND ta.aluclaequ_id = ".$aluclaequ_id);

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
