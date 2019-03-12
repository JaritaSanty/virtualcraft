<?php
/*
  Developer:  Santiago Jara Moya
  Site:       UAM
  File:       index.php
*/
?>
<md-dialog style="width: 60%" aria-label="Close dialog">
    <form ng-cloak name="myForm" method="post" ng-controller="EquiposCursoController">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2 style="font-family:Cooperplate Gothic Light;">Actualitzar Escut de l'Equip</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="cancel()">
                    <md-icon md-svg-src="img/icons/ic_close_24px.svg" aria-label="Close dialog"></md-icon>
                </md-button>
            </div>
        </md-toolbar>

        <md-dialog-content class="container-fluid text-center">
            <div class="md-dialog-content">
                <div class="row">
                  <div class="col-xs-6 col-md-16">
                    <br/>
                    <h3 style="font-family:Cooperplate Gothic Light;">Escut Actual</h3>
                  </div>
                  <div class="col-xs-6 col-md-16">
                    <img class="img-responsive center-block" ng-src="../{{equipo.equ_escudo}}" style="width:150px; height:150px;"/>
                  </div>
                </div>
                <hr/>
                <p style="font-family:Cooperplate Gothic Light;">Per canviar l'escut de l'equip dóna click al que desitgis:</p>
                <br/>
                <div class="row center-block">
                  <div class="col-xs-3 col-md-3" ng-repeat="imagen in imagenes">
                    <button ng-click="answer('actescudo', equipo, imagen);"  class="thumbnail">
                      <img class="img-responsive" ng-src="../{{imagen.img_ruta}}" style="width:50px; height:50px"/>
                    </button>
                  </div>
                </div>
            </div>
        </md-dialog-content>
    </form>
</md-dialog>
