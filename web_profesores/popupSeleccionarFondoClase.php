<?php
/*
  Developer:  Santiago Jara Moya
  Site:       UAM
  File:       index.php
*/
?>
<md-dialog style="width: 60%" aria-label="Close dialog">
    <form ng-cloak name="myForm" method="post" ng-controller="ProfesoresController">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2 style="font-family:Cooperplate Gothic Light;">Actualitzar Fons de la Classe</h2>
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
                    <h3 style="font-family:Cooperplate Gothic Light;">Fons Actual</h3>
                  </div>
                  <div class="col-xs-6 col-md-6">
                    <img class="img-responsive center-block" ng-src="../{{curso.cla_fondo}}" style="width:150px; height:150px;"/>
                  </div>
                </div>
                <hr/>
                <h4 style="font-family:Cooperplate Gothic Light;">Per canviar el fons de la classe dóna clic en el que vulguis:</h4>
                <br/>
                <div class="row center-block">
                  <div class="col-xs-6 col-md-4" ng-repeat="imagen in imagenes">
                    <button ng-click="answer('actfondo', curso, imagen);"  class="thumbnail">
                      <img class="img-responsive" ng-src="../{{imagen.img_ruta}}" style="width:150px; height:150px"/>
                    </button>
                  </div>
                </div>
            </div>
        </md-dialog-content>
    </form>
</md-dialog>
