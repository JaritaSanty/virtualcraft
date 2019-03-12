<?php
$obj = json_decode($_POST["datosUsuario"]);
$pro_id = $obj[0]->pro_id;

$cla_nombre = utf8_decode ($_POST['cla_nombre']);
$cla_descripcion = utf8_decode ($_POST['cla_descripcion']);

require_once 'db_config.php';
$stmtInsertClase = $DBcon->prepare("INSERT INTO clases (cla_nombre, cla_descripcion, pro_id, cla_fondo)
                                      VALUES(:cla_nombre, :cla_descripcion, :pro_id, 36)");

$stmtInsertClase->bindParam(':cla_nombre', $cla_nombre, PDO::PARAM_STR);
$stmtInsertClase->bindParam(':cla_descripcion', $cla_descripcion, PDO::PARAM_STR);
$stmtInsertClase->bindParam(':pro_id', $pro_id, PDO::PARAM_INT);

if ($stmtInsertClase->execute()) {
  $stmtInsertActuaciones = $DBcon->prepare("INSERT INTO actuaciones (act_nombre, act_estado, act_tipo, act_PV, act_PD, act_PO, act_PP, act_FO, act_descripcion, cla_id)
    SELECT act_nombre, act_estado, act_tipo, act_PV, act_PD, act_PO, act_PP, act_FO, act_descripcion, (SELECT MAX(cla_id) FROM clases)
    FROM actuaciones_defecto WHERE act_estado = 1");

  $stmtInsertPrivilegios = $DBcon->prepare("INSERT INTO privilegios (rolniv_id, pri_nombre, pri_numero, pri_estado, pri_imagen, pri_aluPO, pri_equPV, pri_equFO, pri_necesario1, pri_necesario2, pri_descripcion, cla_id)
    SELECT rolniv_id, pri_nombre, pri_numero, pri_estado, pri_imagen, pri_aluPO, pri_equPV, pri_equFO, pri_necesario1, pri_necesario2, pri_descripcion, (SELECT MAX(cla_id) FROM clases)
    FROM privilegios_defecto WHERE pri_estado = 1");

  if($stmtInsertActuaciones->execute() && $stmtInsertPrivilegios->execute()){
    echo "true";
  }
} else {
  echo "false";
}
?>
