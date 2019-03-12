<?php
// Inicializar la sesión.
// Si está usando session_name("algo"), ¡no lo olvide ahora!
session_start();

// Destruir todas las variables de sesión.
$_SESSION = array();

// Si se desea destruir la sesión completamente, borre también la cookie de sesión.
// Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión.
session_unset();
session_destroy();
header("Location: ../index.html");

$obj = json_decode($_POST["datosUsuario"]);
$usu_id = $obj[0]->usu_id;
$log_operacion = "Logout";
$log_aplicacion = "Web";
$log_dispositivo = $_SERVER['HTTP_USER_AGENT'];
$log_extra = "";
$log_descripcion = "";

require_once 'db_config.php';

$stmtLog = $DBcon->prepare("INSERT INTO log (usu_id, log_operacion, log_dispositivo, log_extra, log_descripcion)
                            VALUES(:usu_id, :log_operacion, :log_dispositivo, :log_extra, :log_descripcion);");

$stmtLog->bindParam(':usu_id', $usu_id, PDO::PARAM_INT);
$stmtLog->bindParam(':log_operacion', $log_operacion, PDO::PARAM_STR);
$stmtLog->bindParam(':log_dispositivo', $log_dispositivo, PDO::PARAM_STR);
$stmtLog->bindParam(':log_extra', $log_extra, PDO::PARAM_STR);
$stmtLog->bindParam(':log_descripcion', $log_descripcion, PDO::PARAM_STR);

if ($stmtLog->execute()) {
  echo "true";
} else {
  echo "false";
}
?>
