<!DOCTYPE html>
<html lang="en" ng-app="AppAlumnos">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="noindex">
    <title>Virtual Craft VTouch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href="../css/bootstrap-theme.css" rel="stylesheet" />
    <link href="../css/angular-material.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../css/style.css" type="text/css" media="all">
  </head>
  <body ng-controller="AlumnosController" style="background-color:#ed7a15;" background="../images/fondo.jpg" backgroun-repeat: repeat; width=100%; height=100%;>
    <div class="container">
      <div class="col-xs-4 col-md-4">
        <a href="#/">
          <img class="img-responsive" src="../images/logo.png" alt="Logo">
        </a>
      </div>
      <div class="col-xs-8 col-md-8">
        <h1 class="text-center" style="font-family:Cooperplate Gothic Light; color:#991309; font-size:40px;"><b>¡Hola {{usuario.usu_nombre + ' ' + usuario.usu_apellido}}!</b></h1>
        <h2 class="text-center" style="font-family:Cooperplate Gothic Light;color:#991309; font-size:28px;"><b>¡Benvingut/a a Virtual Craft VTouch!</b></h2>      </div>
    </div>
    <h3 class="container" style="font-family:Cooperplate Gothic Light;color:#991309; font-size:20px;">Selecciona la classe en què vols jugar: </h3>
    <br/>
    <div class="container">
      <div class="row">
        <div class="col-xs-4 col-md-3 text-center" ng-repeat="curso in cursos">
          <a href="" ng-click="goPanelAlumno(curso);">
            <div class="thumbnail">
              <img class="img-responsive" ng-src="../{{curso.equ_escudo}}" alt="Fondo de {{curso.cla_nombre}}" style="width:100%">
              <div class="caption">
                <h3 style="font-family:Cooperplate Gothic Light; font-size:28px;">{{curso.cla_nombre}}</h3>
                <p style="font-family:Cooperplate Gothic Light;">{{curso.cla_descripcion}}</p>
              </div>
            </div>
          </a>
          <br/>
        </div>
      </div>
    </div>
    <script src="../js/jquery-1.9.1.js" type="text/javascript"></script>
    <script src="../js/bootstrap.js" type="text/javascript"></script>
    <script src="../js/angular.js" type="text/javascript"></script>
    <script src="../js/angular-route.js" type="text/javascript"></script>
    <script src="../js/angular-cookies.js" type="text/javascript"></script>
    <script src="../js/angular-messages.js" type="text/javascript"></script>
    <script src="../js/angular-animate.js" type="text/javascript"></script>
    <script src="../js/angular-aria.min.js" type="text/javascript"></script>
    <script src="../js/angular-material.js" type="text/javascript"></script>
    <script src="../js/svg-assets-cache.js" type="text/javascript"></script>
    <script src="../js/app_alumnos.js" type="text/javascript"></script>
    <script src="../js/ui-bootstrap-tpls-2.4.0.min.js" type="text/javascript"></script>
  </body>
</html>
