<?php header("content-type: text/plain; charset=utf-8"); ?>
<?php
require_once 'db_config.php';
include ('main.php');

$firstname = strstr($_GET["user"], ' ', true);
$lastname = strstr($_GET["user"], ' ', false);
$type = $_GET["type"];

switch ($type) {
  case 0:
    echo selectAlumnoMV_00($DBcon, $firstname, $lastname);
    break;
  case 1:
    echo selectAlumnoMV_01($DBcon, $firstname, $lastname);
    break;
}

?>
