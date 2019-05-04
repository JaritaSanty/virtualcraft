<?php
require_once 'db_config.php';
include ('main.php');

$log_descripcion = utf8_decode($_POST['log_descripcion']);
$log_tipo = $_POST['aluclaequ_tipo'];
$aluclaequ_id = $_POST['aluclaequ_id'];

$stmt5 = insertLogHistorialPuntos($DBcon, $aluclaequ_id);
$stmt1 = sumarPuntosAlumno($DBcon, $_POST['aluclaequ_aluPV'], $_POST['aluclaequ_aluPD'], $_POST['aluclaequ_aluPO'], $_POST['aluclaequ_aluPP'], $_POST['aluclaequ_aluFO'], $_POST['aluclaequ_id']);
$stmt2 = insertLogProfesor($DBcon, $aluclaequ_id, $log_tipo, $_POST['aluclaequ_aluPV'], $_POST['aluclaequ_aluPD'], $_POST['aluclaequ_aluPO'], $_POST['aluclaequ_aluPP'], $_POST['aluclaequ_aluFO'], $log_descripcion);

if ($stmt1 == "true" && $stmt2 == "true" && $stmt5 == "true") {
  $obj = json_decode(selectInfoAlumno($DBcon, $aluclaequ_id));
  $PV = $obj[0]->aluclaequ_PV;
  if($_POST['aluclaequ_aluPO']>0){
    $PO = $obj[0]->aluclaequ_PO_acc;

    $stmt3 = updatePP($DBcon, FLOOR($PO/500), $_POST['aluclaequ_id']);

    $obj = json_decode(selectInfoAlumno($DBcon, $aluclaequ_id));
    $PP = $obj[0]->aluclaequ_PP;
    $niv = json_decode(selectNivelPP($DBcon, $PP));
    $stmt4 = updateNivelAlumno($DBcon, $_POST['aluclaequ_id'], $obj[0]->rol_id, $niv[0]->niv_nombre);

    if($stmt3 == "true" && $stmt4 == "true"){
      echo "true";
    }else{
      echo "false";
    }
  }else if(($_POST['aluclaequ_aluPV']>0 || $_POST['aluclaequ_aluPV']<0) && $PV <= 0){
    $stmt6 = sumarPuntosEquipo($DBcon, -10, 0, 0, 0, 0, $_POST['equ_id']);
    $stmt7 = insertLogProfesorEquipo($DBcon, 'puntosequipo', -10, 0, 0, 0, 0, utf8_decode ('compañero en la mazmorra'), $_POST['equ_id']);

    if($stmt6 == "true" && $stmt7 == "true"){
      echo "true";
    }else{
      echo "false";
    }
  }else{
    echo "true";
  }


} else {
  echo "false";
}
?>
