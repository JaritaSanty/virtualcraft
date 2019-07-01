<?php
$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;

require_once 'db_config.php';

$query_filas = $DBcon->prepare("SELECT * FROM equipos WHERE cla_id = ".$cla_id);
$query_filas->execute();
$fila = $query_filas->rowCount();
$aleatorio = rand(0, $fila-1);



$stmt = $DBcon->prepare("SELECT e.equ_id, e.equ_nombre, e.equ_descripcion, i.img_ruta 
                          FROM equipos AS e
                          INNER JOIN imagenes AS i ON i.img_id = e.equ_escudo
                          WHERE e.equ_estado = 1 AND e.cla_id = ".$cla_id." LIMIT ".$aleatorio.", 1");

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

$stmt->execute();
$datos = json_encode(utf8ize($stmt->fetchAll()));
echo $datos;
?>
