<?php
require_once 'db_config.php';
include ('main.php');

$log_descripcion = utf8_decode($_POST['log_descripcion']);
$equ_id = $_POST['equ_id'];

$array = selectAlumnosEquipo($DBcon, $equ_id);

$resultado = "false";

for($i=0; $i<count($array); $i++){
  $aluclaequ_id = $array[$i][0];
  $stmt5 = insertLogHistorialPuntos($DBcon, $aluclaequ_id);
  $stmt1 = sumarPuntosAlumno($DBcon, $_POST['aluclaequ_equPV'], $_POST['aluclaequ_equPD'], $_POST['aluclaequ_equPO'], $_POST['aluclaequ_equPP'], $_POST['aluclaequ_equFO'], $aluclaequ_id);
  $stmt2 = insertLogProfesor($DBcon, $aluclaequ_id, 'puntosequipo', $_POST['aluclaequ_equPV'], $_POST['aluclaequ_equPD'], $_POST['aluclaequ_equPO'], $_POST['aluclaequ_equPP'], $_POST['aluclaequ_equFO'], $log_descripcion);

  if ($stmt1 == "true" && $stmt2 == "true" && $stmt5 == "true") {
    $obj = json_decode(selectInfoAlumno($DBcon, $aluclaequ_id));
    $PV = $obj[0]->aluclaequ_PV;
    if($_POST['aluclaequ_equPO']>0){
      $PO = $obj[0]->aluclaequ_PO_acc;

      $stmt3 = updatePP($DBcon, FLOOR($PO/500), $aluclaequ_id);

      $obj = json_decode(selectInfoAlumno($DBcon, $aluclaequ_id));
      $PP = $obj[0]->aluclaequ_PP;
      $niv = json_decode(selectNivelPP($DBcon, $PP));
      $stmt4 = updateNivelAlumno($DBcon, $aluclaequ_id, $obj[0]->rol_id, $niv[0]->niv_nombre);

      if($stmt3 == "true" && $stmt4 == "true"){
        $resultado = "true";
      }else{
        $resultado = "false";
      }
    }else if(($_POST['aluclaequ_equPV']>0 || $_POST['aluclaequ_equPV']<0) && $PV <= 0){
      $stmt6 = sumarPuntosEquipo($DBcon, -10, 0, 0, 0, 0, $_POST['equ_id']);
      $stmt7 = insertLogProfesorEquipo($DBcon, 'puntosequipo', -10, 0, 0, 0, 0, utf8_decode ('compañero en la mazmorra'), $_POST['equ_id']);

      if($stmt6 == "true" && $stmt7 == "true"){
        $resultado = "true";
      }else{
        $resultado = "false";
      }
    }else{
      $resultado = "true";
    }
  } else {
    $resultado = "false";
  }
}
echo $resultado;
?>
