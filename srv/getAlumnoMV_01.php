<?php header("content-type: text/plain; charset=utf-8"); ?>
<?php
$nombre = strstr($_GET["ua"], ' ', true);
$apellido = strstr($_GET["ua"], ' ', false);

require_once 'db_config.php';
$stmt = $DBcon->prepare("SELECT DISTINCT CONCAT(u.usu_nombre, ' ', u.usu_apellido) AS aluclaequ_alumno,
                          e.equ_nombre, (CASE WHEN u.usu_genero = 'Masculino' THEN r.rol_nombre_masculino
                                              WHEN u.usu_genero = 'Femenino' THEN r.rol_nombre_femenino
                                              ELSE 'Sense Assignar' END) AS rol_nombre,
                          n.niv_nombre, ace.aluclaequ_PV, ace.aluclaequ_PD, ace.aluclaequ_PO, ace.aluclaequ_PP,
                          ace.aluclaequ_FO
                          FROM alumnosclasesequipos AS ace
                          INNER JOIN alumnosclases AS ac ON ac.alucla_id = ace.alucla_id
                          INNER JOIN alumnos AS a ON a.alu_id = ac.alu_id
                          INNER JOIN usuarios AS u ON u.usu_id = a.usu_id
                          INNER JOIN equipos AS e ON e.equ_id = ace.equ_id
                          INNER JOIN rolesniveles AS rn ON rn.rolniv_id = ace.rolniv_id
                          INNER JOIN roles AS r ON r.rol_id = rn.rol_id
                          INNER JOIN niveles AS n ON n.niv_id = rn.niv_id
                          WHERE ace.aluclaequ_estado = 1 AND u.usu_nombre = LOWER(LTRIM(RTRIM(:usu_nombre))) AND u.usu_apellido = LOWER(LTRIM(RTRIM(:usu_apellido)))");

$stmt->bindParam(':usu_nombre',$nombre, PDO::PARAM_STR);
$stmt->bindParam(':usu_apellido',$apellido, PDO::PARAM_STR);

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
