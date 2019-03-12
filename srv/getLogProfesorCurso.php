<?php
$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;

require_once 'db_config.php';
$stmt = $DBcon->prepare("SELECT l.log_id, CONCAT(u.usu_apellido, ' ', u.usu_nombre) AS log_alumno,
                            		(CASE
                                     	WHEN u.usu_genero = 'Masculino' THEN r.rol_nombre_masculino
                                        WHEN u.usu_genero = 'Femenino' THEN r.rol_nombre_femenino
                                        ELSE 'Sense Assignar' END) AS rol_nombre,
                                    n.niv_nombre, e.equ_nombre,
                                    (CASE
                                     	WHEN l.log_tipo = 'puntosalumno' THEN 'Pujar/Baixar Punts a l\'Alumne'
                                        WHEN l.log_tipo = 'puntosequipo' THEN 'Pujar / Baixar Punts a l\'Equip'
                                        ELSE 'Log Sense Assignar' END) AS log_nombre, l.log_fecha, l.log_PV, l.log_PD, l.log_PO, l.log_PP, l.log_FO, l.log_descripcion
                            FROM logprofesor AS l
                            INNER JOIN alumnosclasesequipos AS ace ON ace.aluclaequ_id = l.aluclaequ_id
                            INNER JOIN equipos AS e ON e.equ_id = ace.equ_id
                            INNER JOIN rolesniveles AS rn ON rn.rolniv_id = ace.rolniv_id
                            INNER JOIN roles AS r ON r.rol_id = rn.rol_id
                            INNER JOIN niveles AS n ON n.niv_id = rn.niv_id
                            INNER JOIN alumnosclases AS ac ON ac.alucla_id = ace.alucla_id
                            INNER JOIN alumnos AS al ON al.alu_id = ac.alu_id
                            INNER JOIN usuarios AS u ON u.usu_id = al.usu_id
                            WHERE ac.cla_id = ".$cla_id." ORDER BY l.log_fecha DESC");

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
