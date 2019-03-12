<?php
$obj1 = json_decode($_POST["datosCurso"]);
$cla_id = $obj1->cla_id;
$obj2 = json_decode($_POST["datosUsuario"]);
$alu_id = $obj2->alu_id;

require_once 'db_config.php';

$stmtAlumnosClase = $DBcon->prepare("SELECT ace.aluclaequ_id, ac.alu_id, ac.cla_id,
                                            CONCAT(u.usu_apellido, ' ', u.usu_nombre) AS aluclaequ_nombre,
                                            ace.rolniv_id, r.rol_id, (CASE
                                                                          WHEN u.usu_genero = 'Masculino' THEN r.rol_nombre_masculino
                                                                          WHEN u.usu_genero = 'Femenino' THEN r.rol_nombre_femenino
                                                                          ELSE 'Sense Assignar'
                                                                          END) AS rol_nombre,
                                            (CASE
                                                  WHEN u.usu_genero = 'Masculino' THEN irolm.img_ruta
                                                  WHEN u.usu_genero = 'Femenino' THEN irolf.img_ruta
                                                  ELSE 'No Avatar'
                                                  END) AS rol_avatar, n.niv_id, n.niv_nombre
                                      FROM alumnosclasesequipos AS ace
                                      INNER JOIN rolesniveles AS rn ON rn.rolniv_id = ace.rolniv_id
                                      INNER JOIN roles AS r ON r.rol_id = rn.rol_id
                                      INNER JOIN niveles AS n ON n.niv_id = rn.niv_id
                                      INNER JOIN alumnosclases AS ac ON ac.alucla_id = ace.alucla_id
                                      INNER JOIN alumnos AS a ON a.alu_id = ac.alu_id
                                      INNER JOIN usuarios AS u ON u.usu_id = a.usu_id
                                      INNER JOIN imagenes AS irolm ON irolm.img_id = rn.rolniv_avatar_masculino
                                      INNER JOIN imagenes AS irolf ON irolf.img_id = rn.rolniv_avatar_masculino
                                      WHERE ace.equ_id = (SELECT acee.equ_id
                                      FROM alumnosclasesequipos AS acee
                                      INNER JOIN alumnosclases AS acc ON acc.alucla_id = acee.alucla_id
                                      WHERE acc.alu_id = :alu_id AND acc.cla_id = :cla_id)
                                            AND ace.aluclaequ_id <> (SELECT acee.aluclaequ_id
                                                                      FROM alumnosclasesequipos AS acee
                                                                      INNER JOIN alumnosclases AS acc ON acc.alucla_id = acee.alucla_id
                                                                      WHERE acc.alu_id = :alu_id AND acc.cla_id = :cla_id)");

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
