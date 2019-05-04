<?php header("content-type: text/plain; charset=utf-8"); ?>
<?php
require_once 'db_config.php';
include ('main.php');

$firstname = strstr($_GET["user"], ' ', true);
$lastname = strstr($_GET["user"], ' ', false);
$type = $_GET["type"];
$FO = $_GET["fo"];
$usu_username = $_GET["user"];

switch ($type) {
  case 0:
    echo insertLogMV($DBcon, $usu_username);
    break;
  case 1:
    echo updateAlumnoMV_01($DBcon, $firstname, $lastname, $FO);
    break;
}

?>
