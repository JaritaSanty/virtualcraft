<?php
/*
Developer:  Santiago Jara Moya
Site:       UAM
File:       login.php
*/

if(!isset($_SESSION))
{
  session_start();
}
//include database connection file
require_once 'db_config.php';


// verifying user from database using PDO
$stmtProfesor = $DBcon->prepare("SELECT p.pro_id, u.usu_id, u.usu_nombre, u.usu_apellido, u.usu_password
                                  FROM usuarios AS u
                                  INNER JOIN profesores AS p ON p.usu_id = u.usu_id
                                  WHERE u.usu_nombre='".$_POST['usu_nombre']."' && u.usu_apellido='".$_POST['usu_apellido']."' && u.usu_password='".$_POST['usu_password']."'");
$stmtAlumno = $DBcon->prepare("SELECT a.alu_id, u.usu_id, u.usu_nombre, u.usu_apellido, u.usu_password
                                  FROM usuarios AS u
                                  INNER JOIN alumnos AS a ON a.usu_id = u.usu_id
                                  WHERE u.usu_nombre='".$_POST['usu_nombre']."' && u.usu_apellido='".$_POST['usu_apellido']."' && u.usu_password='".$_POST['usu_password']."'");
try
 {
     $stmtProfesor->execute();
     $stmtAlumno->execute();
 }
 catch(PDOException $e)
 {
     echo "ERROR : ".$e->getMessage();
 }

$rowProfesor = $stmtProfesor->rowCount();
$rowAlumno = $stmtAlumno->rowCount();
$datosProfesor = json_encode($stmtProfesor->fetchAll());
$datosAlumno = json_encode($stmtAlumno->fetchAll());
if ($rowProfesor > 0 && $rowAlumno > 0){
  echo "ProfesorAlumno";
} else if ($rowProfesor > 0){
  setcookie("datosUsuario",$datosProfesor);
  echo $datosProfesor;
} else if ($rowAlumno > 0){
  setcookie("datosUsuario",$datosAlumno);
  echo $datosAlumno;
}else{
  echo 'Invalido';
}


?>
