<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$obj = json_decode($_POST["datosUsuario"]);
$usu_id = $obj[0]->usu_id;
$log_operacion = utf8_decode ($_POST['log_operacion']);
$log_so = getPlatform($user_agent);
$log_dispositivo = $user_agent;
$log_navegador = getBrowser($user_agent);
$log_ubicacion = ip_info(get_client_ip(), "Country");
$log_ip = get_client_ip();
$log_aplicacion = utf8_decode ($_POST['log_aplicacion']);
$log_extra = "";
$log_descripcion = "";

require_once 'db_config.php';

//Obtiene la IP del usuario
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

//Obtiene la info de la IP del cliente desde geoplugin
function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}

//Obtener Navegador del Usuario
function getBrowser($user_agent){
if(strpos($user_agent, 'MSIE') !== FALSE)
   return 'Internet explorer';
 elseif(strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
   return 'Microsoft Edge';
 elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
    return 'Internet explorer';
 elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
   return "Opera Mini";
 elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
   return "Opera";
 elseif(strpos($user_agent, 'Firefox') !== FALSE)
   return 'Mozilla Firefox';
 elseif(strpos($user_agent, 'Chrome') !== FALSE)
   return 'Google Chrome';
 elseif(strpos($user_agent, 'Safari') !== FALSE)
   return "Safari";
 else
   return 'No Identificado';
}

//Obtener Sistema Operativo
function getPlatform($user_agent) {
  if(strpos($user_agent, 'Windows NT 10.0+') !== FALSE)
     return 'Windows 10';
   elseif(strpos($user_agent, 'Windows NT 6.3+') !== FALSE) //Microsoft Edge
     return 'Windows 8.1';
   elseif(strpos($user_agent, 'Windows NT 6.2+') !== FALSE) //IE 11
      return 'Windows 8';
   elseif(strpos($user_agent, 'Windows NT 6.1+') !== FALSE)
     return "Windows 7";
   elseif(strpos($user_agent, 'Windows NT 6.0+') !== FALSE)
     return "Windows Vista";
   elseif(strpos($user_agent, 'Windows NT 5.1+') !== FALSE)
     return 'Windows XP';
   elseif(strpos($user_agent, 'Windows NT 5.2+') !== FALSE)
     return 'Windows 2003';
   elseif(strpos($user_agent, 'Windows otros') !== FALSE)
     return 'Windows';
   elseif(strpos($user_agent, 'iPhone') !== FALSE)
     return "iOS";
   elseif(strpos($user_agent, 'iPad') !== FALSE)
     return "iOS";
   elseif(strpos($user_agent, '(Mac OS X+)|(CFNetwork+)') !== FALSE)
     return "Mac OS X";
   elseif(strpos($user_agent, 'Macintosh') !== FALSE)
     return "Mac OS X";
   elseif(strpos($user_agent, 'Android') !== FALSE)
     return "Android";
   elseif(strpos($user_agent, 'BlackBerry') !== FALSE)
     return "BlackBerry";
   elseif(strpos($user_agent, 'Linux') !== FALSE)
     return "Linux";
   else
     return 'No Identificado';
}

$stmtLog = $DBcon->prepare("INSERT INTO log (usu_id, log_operacion, log_so, log_dispositivo, log_navegador, log_ubicacion, log_ip, log_aplicacion, log_extra, log_descripcion)
                            VALUES(:usu_id, :log_operacion, :log_so, :log_dispositivo, :log_navegador, :log_ubicacion, :log_ip, :log_aplicacion, :log_extra, :log_descripcion);");

$stmtLog->bindParam(':usu_id', $usu_id, PDO::PARAM_INT);
$stmtLog->bindParam(':log_operacion', $log_operacion, PDO::PARAM_STR);
$stmtLog->bindParam(':log_so', $log_so, PDO::PARAM_STR);
$stmtLog->bindParam(':log_dispositivo', $log_dispositivo, PDO::PARAM_STR);
$stmtLog->bindParam(':log_navegador', $log_navegador, PDO::PARAM_STR);
$stmtLog->bindParam(':log_ubicacion', $log_ubicacion, PDO::PARAM_STR);
$stmtLog->bindParam(':log_ip', $log_ip, PDO::PARAM_STR);
$stmtLog->bindParam(':log_aplicacion', $log_aplicacion, PDO::PARAM_STR);
$stmtLog->bindParam(':log_extra', $log_extra, PDO::PARAM_STR);
$stmtLog->bindParam(':log_descripcion', $log_descripcion, PDO::PARAM_STR);

if ($stmtLog->execute()) {
  echo "true";
} else {
  echo "false";
}
?>
