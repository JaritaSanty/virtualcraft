<?php
$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;
$pri_descripcion = utf8_decode ($_POST['pri_descripcion']);

require_once 'db_config.php';
$stmt = $DBcon->prepare("UPDATE privilegios
                          SET pri_descripcion = :pri_descripcion, pri_aluPV = :pri_aluPV, pri_aluPD = :pri_aluPD, pri_aluPO = :pri_aluPO, pri_aluPP = :pri_aluPP, pri_aluFO = :pri_aluFO, pri_equPV = :pri_equPV, pri_equPD = :pri_equPD, pri_equPO = :pri_equPO, pri_equPP = :pri_equPP, pri_equFO = :pri_equFO, pri_costPV = :pri_costPV, pri_costPD = :pri_costPD, pri_costPO = :pri_costPO, pri_costPP = :pri_costPP, pri_costFO = :pri_costFO
                          WHERE pri_id = :pri_id AND cla_id = :cla_id ");

                          $stmt->bindParam(':pri_id', $_POST['pri_id'], PDO::PARAM_INT);
                          $stmt->bindParam(':cla_id', $cla_id, PDO::PARAM_INT);
                          $stmt->bindParam(':pri_descripcion', $pri_descripcion, PDO::PARAM_STR);
                          $stmt->bindParam(':pri_aluPV', $_POST['pri_aluPV'], PDO::PARAM_INT);
                          $stmt->bindParam(':pri_aluPD', $_POST['pri_aluPD'], PDO::PARAM_INT);
                          $stmt->bindParam(':pri_aluPO', $_POST['pri_aluPO'], PDO::PARAM_INT);
                          $stmt->bindParam(':pri_aluPP', $_POST['pri_aluPP'], PDO::PARAM_INT);
                          $stmt->bindParam(':pri_aluFO', $_POST['pri_aluFO'], PDO::PARAM_INT);
                          $stmt->bindParam(':pri_equPV', $_POST['pri_equPV'], PDO::PARAM_INT);
                          $stmt->bindParam(':pri_equPD', $_POST['pri_equPD'], PDO::PARAM_INT);
                          $stmt->bindParam(':pri_equPO', $_POST['pri_equPO'], PDO::PARAM_INT);
                          $stmt->bindParam(':pri_equPP', $_POST['pri_equPP'], PDO::PARAM_INT);
                          $stmt->bindParam(':pri_equFO', $_POST['pri_equFO'], PDO::PARAM_INT);
                          $stmt->bindParam(':pri_costPV', $_POST['pri_costPV'], PDO::PARAM_INT);
                          $stmt->bindParam(':pri_costPD', $_POST['pri_costPD'], PDO::PARAM_INT);
                          $stmt->bindParam(':pri_costPO', $_POST['pri_costPO'], PDO::PARAM_INT);
                          $stmt->bindParam(':pri_costPP', $_POST['pri_costPP'], PDO::PARAM_INT);
                          $stmt->bindParam(':pri_costFO', $_POST['pri_costFO'], PDO::PARAM_INT);

if ($stmt->execute()) {
  echo "true";
} else {
  echo "false";
}
?>
