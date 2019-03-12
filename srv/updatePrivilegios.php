<?php
$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;
$pri_descripcion = utf8_decode ($_POST['pri_descripcion']);

require_once 'db_config.php';
$stmt = $DBcon->prepare("UPDATE privilegios
                          SET pri_descripcion = :pri_descripcion, pri_aluPO = :pri_aluPO, pri_equPV = :pri_equPV, pri_equFO = :pri_equFO
                          WHERE pri_id = :pri_id AND cla_id = :cla_id ");

                          $stmt->bindParam(':pri_id', $_POST['pri_id'], PDO::PARAM_INT);
                          $stmt->bindParam(':cla_id', $cla_id, PDO::PARAM_INT);
                          $stmt->bindParam(':pri_descripcion', $pri_descripcion, PDO::PARAM_STR);
                          $stmt->bindParam(':pri_aluPO', $_POST['pri_aluPO'], PDO::PARAM_INT);
                          $stmt->bindParam(':pri_equPV', $_POST['pri_equPV'], PDO::PARAM_INT);
                          $stmt->bindParam(':pri_equFO', $_POST['pri_equFO'], PDO::PARAM_INT);

if ($stmt->execute()) {
  echo "true";
} else {
  echo "false";
}
?>
