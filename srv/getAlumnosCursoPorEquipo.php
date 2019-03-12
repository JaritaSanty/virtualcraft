<?php
$objClase = json_decode($_POST["datosCurso"]);
$cla_id = $objClase->cla_id;
$objEquipo = json_decode($_POST["datosEquipo"]);
$equ_id = $objEquipo->equ_id;

require_once 'db_config.php';
$stmtAlumnosClase = $DBcon->prepare("SELECT ace.aluclaequ_id, ac.alucla_id, a.alu_id,
                                      CONCAT(u.usu_apellido, ' ', u.usu_nombre) AS aluclaequ_nombre,
                                      ace.equ_id, e.equ_nombre, ace.rolniv_id, r.rol_id,
                                      (CASE
                                        WHEN u.usu_genero = 'Masculino' THEN r.rol_nombre_masculino
                                        WHEN u.usu_genero = 'Femenino' THEN r.rol_nombre_femenino
                                        ELSE 'Sense Assignar'
                                        END) AS rol_nombre,
                                      n.niv_id, n.niv_nombre, ace.aluclaequ_PV, ace.aluclaequ_PD, ace.aluclaequ_PO,
                                      ace.aluclaequ_PP, ace.aluclaequ_PP, ace.aluclaequ_FO,
                                      IFNULL((SELECT p.pri_nombre
                                        FROM privilegiosejecutados AS pe
                                        INNER JOIN privilegios AS p ON p.pri_id = pe.pri_id
                                        WHERE pe.prieje_tipo = 'comprado' AND pe.aluclaequ_id = ace.aluclaequ_id ORDER BY pe.prieje_fecha DESC LIMIT 1), 'Cap') AS aluclaequ_privilegio
                                      FROM alumnosclasesequipos AS ace
                                      INNER JOIN alumnosclases AS ac ON ac.alucla_id = ace.alucla_id
                                      INNER JOIN alumnos AS a ON a.alu_id = ac.alu_id
                                      INNER JOIN usuarios AS u ON u.usu_id = a.usu_id
                                      INNER JOIN equipos AS e ON e.equ_id = ace.equ_id
                                      INNER JOIN rolesniveles AS rn ON rn.rolniv_id = ace.rolniv_id
                                      INNER JOIN roles AS r ON r.rol_id = rn.rol_id
                                      INNER JOIN niveles AS n ON n.niv_id = rn.niv_id
                                      WHERE ace.aluclaequ_estado = 1 AND ace.equ_id = :equ_id AND ace.alucla_id IN (SELECT alucla_id FROM alumnosclases WHERE cla_id = :cla_id)");

$stmtAlumnosClase->bindParam(':cla_id', $cla_id, PDO::PARAM_STR);
$stmtAlumnosClase->bindParam(':equ_id', $equ_id, PDO::PARAM_STR);

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
