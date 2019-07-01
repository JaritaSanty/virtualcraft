<?php

$usu_nombre = utf8_decode ($_POST['usu_nombre']);
$usu_apellido = utf8_decode ($_POST['usu_apellido']);
$usu_genero = utf8_decode ($_POST['usu_genero']);
$usu_password = utf8_decode ($_POST['usu_password']);

require_once 'db_config.php';

$stmtUsuario = $DBcon->prepare("INSERT INTO usuarios (usu_nombre, usu_apellido, usu_genero, usu_password)
                                      VALUES(:usu_nombre, :usu_apellido, :usu_genero, :usu_password)");

$stmtUsuario->bindParam(':usu_nombre', $usu_nombre, PDO::PARAM_STR);
$stmtUsuario->bindParam(':usu_apellido', $usu_apellido, PDO::PARAM_STR);
$stmtUsuario->bindParam(':usu_genero', $usu_genero, PDO::PARAM_STR);
$stmtUsuario->bindParam(':usu_password', $usu_password, PDO::PARAM_STR);

if ($stmtUsuario->execute()) {
  $stmtAlumno = $DBcon->prepare("INSERT INTO alumnos (usu_id)
                                  SELECT MAX(usu_id)
                                  FROM usuarios");

  if($stmtAlumno->execute() ){
    echo "true";
  }else{
    echo "false";
  }
} else {
  echo "false";
}
?>
