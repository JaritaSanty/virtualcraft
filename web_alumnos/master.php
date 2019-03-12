<?php
/*
  Developer:  Santiago Jara Moya
  Site:       UAM
  File:       index.php
*/
?>
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
    <link href="../css/style_alumno.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
      .footer {
       background:transparent;
       filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#3C000000,endColorstr=#3C000000);
       zoom: 1;
      }
    </style>
  </head>
  <body ng-controller="PanelAlumnoController" ng-init="posts()" ng-style="{'background': 'url(../'+alumno.equ_fondo+') no-repeat center center fixed', '-webkit-background-size': 'cover', '-moz-background-size': 'cover', '-o-background-size': 'cover', 'background-size': 'cover'}">
    <div class="row">
      <div class="col-xs-6 col-md-4">
        <div class="menualu">
          <div class="tituloUsuario"><b>{{usuario.usu_nombre | Capitalize}} {{usuario.usu_apellido | Capitalize}}</b></div>
          <div class="titulo"><b>{{alumno.cla_nombre}}</b></div>
          <div class="titulo"><b>{{alumno.equ_nombre}}</b></div>
          <div class="row">
            <div class="col-xs-3 col-md-6">
              <div class="tituloPV"><b>PV</b></div>
            </div>
            <div class="col-xs-3 col-md-6">
              <div class="puntosPV"><b>{{alumno.aluclaequ_PV}}</b></div>
            </div>
            <div class="col-xs-3 col-md-6">
              <div class="tituloPD"><b>PD</b></div>
            </div>
            <div class="col-xs-3 col-md-6">
              <div class="puntosPD"><b>{{alumno.aluclaequ_PD}}</b></div>
            </div>
            <div class="col-xs-3 col-md-6">
              <div class="tituloPO"><b>PO</b></div>
            </div>
            <div class="col-xs-3 col-md-6">
              <div class="puntosPO"><b>{{alumno.aluclaequ_PO}}</b></div>
            </div>
            <div class="col-xs-3 col-md-6">
              <div class="tituloPP"><b>PP</b></div>
            </div>
            <div class="col-xs-3 col-md-6">
              <div class="puntosPP"><b>{{alumno.aluclaequ_PP}}</b></div>
            </div>
            <div class="col-xs-3 col-md-6">
              <div class="tituloFO"><b>FO</b></div>
            </div>
            <div class="col-xs-3 col-md-6">
              <div class="puntosFO"><b>{{alumno.aluclaequ_FO}}</b></div>
            </div>
            <div class="col-xs-6 col-md-12">
              <div class="nivel"><b>NIVEL {{alumno.niv_nombre}}</b></div>
            </div>
          </div>
          <br/>
          <div class="row">
            <div class="col-xs-3 col-md-6">
              <a href="#/trabajos">
                <img class="img-responsive" src="../images/scriptorium.png" alt="Scriptorium">
              </a>
            </div>
            <div class="col-xs-3 col-md-6">
              <a href="#/">
                <img class="img-responsive" src="../images/privilegis.png" alt="Privilegis">
              </a>
            </div>
            <div class="col-xs-3 col-md-3">
              <a href="javascript:history.back()">
                <img class="img-responsive" src="../images/volver.png" alt="Volver">
              </a>
            </div>
            <div class="col-xs-3 col-md-3">
              <a href="../srv/logout.php">
                <img class="img-responsive" src="../images/desconectar.png" alt="Desconectar">
              </a>
            </div>
            <div class="col-xs-11 col-md-6">
              <a href="#/equipos">
                <div class="titulo"><b>EQUIPS</b></div>
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xs-6 col-md-8">
        <div class="row">
          <div class="col-xs-6 col-md-5">
              <img class="img-responsive equipo" ng-src="../{{alumno.equ_escudo}}" alt="Logo" width="40%"/>
          </div>
          <div class="col-xs-0 col-md-2">
          </div>
          <div class="col-xs-6 col-md-5">
            <a href="../web_alumnos/alumnos.php">
              <img class="img-responsive" ng-src="../images/logo.png" alt="Logo">
            </a>
          </div>
        </div>
        <div class="row" ng-view>
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
