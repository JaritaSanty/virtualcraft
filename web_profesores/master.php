<?php
/*
  Developer:  Santiago Jara Moya
  Site:       UAM
  File:       index.php
*/
?>
<!DOCTYPE html>
<html lang="ca" ng-app="AppProfesores">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="noindex">
    <title>VIRTUAL CRAFT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href="../css/bootstrap-theme.css" rel="stylesheet" />
    <link href="../css/angular-material.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
      .footer {
       background:transparent;
       filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#3C000000,endColorstr=#3C000000);
       zoom: 1;
      }
    </style>
  </head>
  <body ng-controller="ProfesoresController" style="background-color:#ed7a15;" background="../images/fondo.jpg" backgroun-repeat: repeat; width=100%; height=100%;>
    <div class="container" style="background-color:#F5F5F5;">
      <div class="col-xs-3 col-md-3">
        <a href="#/">
          <img class="img-responsive" src="../images/logo.png" alt="Logo" width="50%">
        </a>
      </div>
      <div class="col-xs-5 col-md-5">
        <h2 class="text-center" style="font-family:Cooperplate Gothic Light;color:#991309;"><b>VIRTUAL CRAFT</b></h2>
      </div>
      <div class="col-xs-4 col-md-4">
        <p class="navbar-text pull-right"><a href="javascript:history.back()"><< Tornar Enrere</a> <br/>Registrat com: <br/><b>{{usuario.usu_nombre + ' ' + usuario.usu_apellido}}</b> <br/><a href="../srv/logout.php">Tancar Sessió</a></p> <br/>
      </div>
    </div>
    <hr/>
    <div class="container" style="background-color:#F5F5F5;" ng-view>

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
    <script src="../js/app_profesores.js" type="text/javascript"></script>
    <script src="../js/ui-bootstrap-tpls-2.4.0.min.js" type="text/javascript"></script>
  </body>
</html>
