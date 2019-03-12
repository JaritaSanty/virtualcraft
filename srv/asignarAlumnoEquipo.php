<?php
$obj = json_decode($_POST["datosEquipo"]);
$equ_id = $obj->equ_id;

require_once 'db_config.php';

$stmtSelect = $DBcon->prepare("SELECT *
                                FROM alumnosclasesequipos
                                WHERE aluclaequ_estado = 0 AND equ_id = ".$equ_id." AND alucla_id = ".$_POST['alucla_id']);

$stmtInsert = $DBcon->prepare("INSERT INTO alumnosclasesequipos (alucla_id, equ_id, aluclaequ_estado)
                                VALUES(:alucla_id, :equ_id, 1)");

$stmtUpdate = $DBcon->prepare("UPDATE alumnosclasesequipos
                                SET aluclaequ_estado = 1
                                WHERE alucla_id = :alucla_id AND equ_id = :equ_id ");

$stmtInsert->bindParam(':alucla_id', $_POST['alucla_id'], PDO::PARAM_STR);
$stmtInsert->bindParam(':equ_id', $equ_id, PDO::PARAM_INT);

$stmtUpdate->bindParam(':alucla_id', $_POST['alucla_id'], PDO::PARAM_STR);
$stmtUpdate->bindParam(':equ_id', $equ_id, PDO::PARAM_INT);

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
