<?php

$usu_id = utf8_decode ($_POST['usu_id']);
$usu_nombre = utf8_decode ($_POST['usu_nombre']);
$usu_apellido = utf8_decode ($_POST['usu_apellido']);
$usu_genero = utf8_decode ($_POST['usu_genero']);
$usu_password = utf8_decode ($_POST['usu_password']);

require_once 'db_config.php';

$stmtUsuario = $DBcon->prepare("UPDATE usuarios
                                SET usu_nombre = :usu_nombre, usu_apellido = :usu_apellido,
                                    usu_genero = :usu_genero, usu_password = :usu_password
                                WHERE usu_id = :usu_id");

$stmtUsuario->bindParam(':usu_id', $usu_id, PDO::PARAM_INT);
$stmtUsuario->bindParam(':usu_nombre', $usu_nombre, PDO::PARAM_STR);
$stmtUsuario->bindParam(':usu_apellido', $usu_apellido, PDO::PARAM_STR);
$stmtUsuario->bindParam(':usu_genero', $usu_genero, PDO::PARAM_STR);
$stmtUsuario->bindParam(':usu_password', $usu_password, PDO::PARAM_STR);

if($stmtUsuario->execute() ){
  echo "true";
}else{
  echo "false";
}
?>
