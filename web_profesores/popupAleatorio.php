<?php
/*
  Developer:  Santiago Jara Moya
  Site:       UAM
  File:       index.php
*/
?>
<md-dialog style="width: 60%" aria-label="Close dialog">
    <form ng-cloak name="myForm" method="post" ng-controller="ProfesorCursoController">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2 style="font-family:Cooperplate Gothic Light;">Aleatorio</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="cancel()">
                    <md-icon md-svg-src="img/icons/ic_close_24px.svg" aria-label="Close dialog"></md-icon>
                </md-button>
            </div>
        </md-toolbar>

        <md-dialog-content class="container-fluid">
            <div class="md-dialog-content">
              <div class="row" ng-hide="preghide">
                <div class="col col-xs-12 col-md-12">
                  <h1 style="font-family:Cooperplate Gothic Light;">¿Quieres un alumno o equipo aleatorio?</h1>
                </div>
              </div>
              <div class="row" ng-hide="equipohide">
                <div class="col col-xs-4 col-md-4">
                  <img class="img-responsive" src="../{{equipoAleatorio.img_ruta}}" alt="Logo" width="75%">
                </div>
                <div class="col col-xs-8 col-md-8">
                  <h1 style="font-family:Cooperplate Gothic Light;">{{equipoAleatorio.equ_nombre}}</h1>
                </div>
              </div>
              <div class="row" ng-hide="alumnohide">
                <div class="col col-xs-4 col-md-4">
                  <img class="img-responsive" src="../{{alumnoAleatorio.img_ruta}}" alt="Logo" width="100%">
                </div>
                <div class="col col-xs-8 col-md-8">
                  <h1 style="font-family:Cooperplate Gothic Light;">{{alumnoAleatorio.alucla_nombre | uppercase}}</h1>
                </div>
              </div>
            </div>
        </md-dialog-content>
        <md-dialog-actions layout="row">
            <button ng-click="generarEquipoAleatorio();" class="btn btn-info">Equipo</button>&nbsp;&nbsp;
            <button ng-click="generarAlumnoAleatorio();" class="btn btn-warning">Alumno</button>
        </md-dialog-actions>
    </form>
</md-dialog>
