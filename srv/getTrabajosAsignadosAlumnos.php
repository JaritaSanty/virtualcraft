<?php
$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;

require_once 'db_config.php';
$stmt = $DBcon->prepare("SELECT ta.trasig_id, ta.tra_id, t.tra_nombre, ta.aluclaequ_id,
                          CONCAT(u.usu_apellido, ' ', u.usu_nombre) AS aluclaequ_nombre, e.equ_nombre,
                          ta.trasig_titulo_trabajo, ta.trasig_texto_trabajo, ta.trasig_aprobado_trabajo,
                          ta.trasig_calificacion, ta.trasig_comentario, ta.trasig_fecha_insert,
                          ta.trasig_fecha_update, ta.trasig_descripcion
                          FROM trabajosasignados AS ta
                          INNER JOIN trabajos AS t ON t.tra_id = ta.tra_id
                          INNER JOIN alumnosclasesequipos AS ace ON ace.aluclaequ_id = ta.aluclaequ_id
                          INNER JOIN equipos AS e ON e.equ_id = ace.equ_id
                          INNER JOIN alumnosclases AS ac ON ac.alucla_id = ace.alucla_id
                          INNER JOIN alumnos AS al ON al.alu_id = ac.alu_id
                          INNER JOIN usuarios AS u ON u.usu_id = al.usu_id
                          WHERE ta.trasig_aprobado_trabajo = ".$_POST["trasig_aprobado_trabajo"]." AND t.tra_estado = 1 AND ac.cla_id = ".$cla_id);

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
