<?php
require_once 'db_config.php';
include ('main.php');

$trasig_id = $_POST['trasig_id'];
$trasig_titulo_trabajo = utf8_decode ($_POST['trasig_titulo_trabajo']);
$trasig_texto_trabajo = utf8_decode ($_POST['trasig_texto_trabajo']);

$stmt1 = updateGuardarTrabajo($DBcon, $trasig_id, $trasig_titulo_trabajo, $trasig_texto_trabajo);

if ($stmt1 == "true") {
 echo "true";
} else {
 echo "false";
}
?>
