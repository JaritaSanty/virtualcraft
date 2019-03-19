<?php
require_once 'db_config.php';
include ('main.php');

$log_descripcion = utf8_decode ($_POST['log_descripcion']);
$log_tipo = 'puntosalumno';
$aluclaequ_id = $_POST['aluclaequ_id'];

$stmt1 = sumarPuntosAlumno($DBcon, $_POST['aluclaequ_aluPV'], $_POST['aluclaequ_aluPD'], $_POST['aluclaequ_aluPO'], $_POST['aluclaequ_aluPP'], $_POST['aluclaequ_aluFO'], $_POST['aluclaequ_id']);
$stmt2 = insertLogProfesor($DBcon, $aluclaequ_id, $log_tipo, $_POST['aluclaequ_aluPV'], $_POST['aluclaequ_aluPD'], $_POST['aluclaequ_aluPO'], $_POST['aluclaequ_aluPP'], $_POST['aluclaequ_aluFO'], $log_descripcion);

if ($stmt1 == "true" && $stmt2 == "true") {
  $obj = json_decode(selectInfoAlumno($DBcon, $aluclaequ_id));
  $PO = $obj[0]->aluclaequ_PO_acc;
  $PV = $obj[0]->aluclaequ_PV;
  $stmt3 = updatePP($DBcon, FLOOR($PO/500), $_POST['aluclaequ_id']);

  $obj = json_decode(selectInfoAlumno($DBcon, $aluclaequ_id));
  $PP = $obj[0]->aluclaequ_PP;
  $niv = json_decode(selectNivelPP($DBcon, $PP));
  $stmt4 = updateNivelAlumno($DBcon, $_POST['aluclaequ_id'], $obj[0]->rol_id, $niv[0]->niv_nombre);

  if($_POST['aluclaequ_aluPO']>0){
    if($stmt3 == "true" && $stmt4 == "true"){
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
