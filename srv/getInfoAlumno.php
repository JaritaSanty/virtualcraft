<?php
$obj1 = json_decode($_POST["datosCurso"]);
$cla_id = $obj1->cla_id;
$obj2 = json_decode($_POST["datosUsuario"]);
$alu_id = $obj2->alu_id;

require_once 'db_config.php';

$stmtAlumnosClase = $DBcon->prepare("SELECT ace.aluclaequ_id, ac.alucla_id, c.cla_id, c.cla_nombre, a.alu_id,
                                      CONCAT(u.usu_apellido, ' ', u.usu_nombre) AS aluclaequ_nombre,
                                      ace.equ_id, e.equ_nombre, ifequ.img_ruta AS equ_fondo, ieequ.img_ruta AS equ_escudo, ace.rolniv_id, r.rol_id,
                                      (CASE
                                        WHEN u.usu_genero = 'Masculino' THEN r.rol_nombre_masculino
                                        WHEN u.usu_genero = 'Femenino' THEN r.rol_nombre_femenino
                                        ELSE 'Sense Assignar'
                                        END) AS rol_nombre, (CASE
                                        WHEN u.usu_genero = 'Masculino' THEN irolm.img_ruta
                                        WHEN u.usu_genero = 'Femenino' THEN irolf.img_ruta
                                        ELSE 'No Avatar'
                                        END) AS rol_avatar,
                                      n.niv_id, n.niv_nombre, ace.aluclaequ_PV, ace.aluclaequ_PD, ace.aluclaequ_PO,
                                      ace.aluclaequ_PP, ace.aluclaequ_PP, ace.aluclaequ_FO
                                      FROM alumnosclasesequipos AS ace
                                      INNER JOIN alumnosclases AS ac ON ac.alucla_id = ace.alucla_id
                                      INNER JOIN clases AS c ON c.cla_id = ac.cla_id
                                      INNER JOIN alumnos AS a ON a.alu_id = ac.alu_id
                                      INNER JOIN usuarios AS u ON u.usu_id = a.usu_id
                                      INNER JOIN equipos AS e ON e.equ_id = ace.equ_id
                                      INNER JOIN rolesniveles AS rn ON rn.rolniv_id = ace.rolniv_id
                                      INNER JOIN roles AS r ON r.rol_id = rn.rol_id
                                      INNER JOIN niveles AS n ON n.niv_id = rn.niv_id
                                      INNER JOIN imagenes AS ifequ ON ifequ.img_id = e.equ_fondo
                                      INNER JOIN imagenes AS ieequ ON ieequ.img_id = e.equ_escudo
                                      INNER JOIN imagenes AS irolm ON irolm.img_id = rn.rolniv_avatar_masculino
                                      INNER JOIN imagenes AS irolf ON irolf.img_id = rn.rolniv_avatar_masculino
                                      WHERE ace.aluclaequ_estado = 1 AND a.alu_id = :alu_id AND ac.cla_id = :cla_id");

$stmtAlumnosClase->bindParam(':cla_id', $cla_id, PDO::PARAM_INT);
$stmtAlumnosClase->bindParam(':alu_id', $alu_id, PDO::PARAM_INT);

try
 {
     $stmtAlumnosClase->execute();
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

 $datosAlumnosClase = json_encode(utf8ize($stmtAlumnosClase->fetchAll()));
 echo $datosAlumnosClase;
?>
