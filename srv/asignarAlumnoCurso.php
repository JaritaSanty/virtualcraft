<?php
$obj = json_decode($_POST["datosCurso"]);
$cla_id = $obj->cla_id;

require_once 'db_config.php';

$stmtSelect = $DBcon->prepare("SELECT *
                                FROM alumnosclases
                                WHERE alucla_estado = 0 AND cla_id = ".$cla_id." AND alu_id = ".$_POST['alu_id']);

$stmtInsert = $DBcon->prepare("INSERT INTO alumnosclases (alu_id, cla_id, alucla_estado)
                                VALUES(:alu_id, :cla_id, 1)");

$stmtUpdate = $DBcon->prepare("UPDATE alumnosclases
                                SET alucla_estado = 1
                                WHERE cla_id = :cla_id AND alu_id = :alu_id ");

$stmtInsert->bindParam(':alu_id', $_POST['alu_id'], PDO::PARAM_STR);
$stmtInsert->bindParam(':cla_id', $cla_id, PDO::PARAM_INT);

$stmtUpdate->bindParam(':alu_id', $_POST['alu_id'], PDO::PARAM_STR);
$stmtUpdate->bindParam(':cla_id', $cla_id, PDO::PARAM_INT);

try
 {
     $stmtSelect->execute();
 }
 catch(PDOException $e)
 {
     echo "ERROR : ".$e->getMessage();
 }

 $row = $stmtSelect->rowCount();

 if ($row > 0){
   if ($stmtUpdate->execute()) {
     echo "true";
   } else {
     echo "false";
   }
 }else{
   if ($stmtInsert->execute()) {
     echo "true";
   } else {
     echo "false";
   }
 }

?>
