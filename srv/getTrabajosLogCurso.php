<?php
$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;

require_once 'db_config.php';
$stmt = $DBcon->prepare("SELECT ta.trasig_id, CONCAT(u.usu_apellido, ' ', u.usu_nombre) AS trasig_alumno,
                            		(CASE
                                     	WHEN u.usu_genero = 'Masculino' THEN r.rol_nombre_masculino
                                        WHEN u.usu_genero = 'Femenino' THEN r.rol_nombre_femenino
                                        ELSE 'Sense Assignar' END) AS rol_nombre,
                                    n.niv_nombre, e.equ_nombre, t.tra_nombre,  ta.trasig_fecha_insert,
                                    (CASE
                                     	WHEN ta.trasig_aprobado_trabajo = 0 THEN 'Assignat'
                                        WHEN ta.trasig_aprobado_trabajo = 1 THEN 'Aprobat' END) AS trasig_aprobado_trabajo, ta.trasig_fecha_update
                            FROM trabajosasignados AS ta
                            INNER JOIN trabajos AS t ON t.tra_id = ta.tra_id
                            INNER JOIN alumnosclasesequipos AS ace ON ace.aluclaequ_id = ta.aluclaequ_id
                            INNER JOIN equipos AS e ON e.equ_id = ace.equ_id
                            INNER JOIN rolesniveles AS rn ON rn.rolniv_id = ace.rolniv_id
                            INNER JOIN roles AS r ON r.rol_id = rn.rol_id
                            INNER JOIN niveles AS n ON n.niv_id = rn.niv_id
                            INNER JOIN alumnosclases AS ac ON ac.alucla_id = ace.alucla_id
                            INNER JOIN alumnos AS al ON al.alu_id = ac.alu_id
                            INNER JOIN usuarios AS u ON u.usu_id = al.usu_id
                            WHERE t.tra_estado = 1 AND t.cla_id = ".$cla_id." ORDER BY ta.trasig_fecha_insert DESC");

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
