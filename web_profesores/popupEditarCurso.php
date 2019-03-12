<?php
/*
  Developer:  Santiago Jara Moya
  Site:       UAM
  File:       index.php
*/
?>
<md-dialog style="width: 60%">
    <form ng-cloak name="myForm" method="post" ng-controller="ProfesoresController">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2 style="font-family:Cooperplate Gothic Light;">Edita Classe</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="cancel()">
                    <md-icon md-svg-src="img/icons/ic_close_24px.svg" aria-label="Close dialog"></md-icon>
                </md-button>
            </div>
        </md-toolbar>

        <md-dialog-content class="container-fluid">
            <div class="md-dialog-content">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <label style="font-family:Cooperplate Gothic Light;">Nom:</label>
                        <input class="form-control" ng-model="curso.cla_nombre" style="font-family:Cooperplate Gothic Light;" required autofocus/>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <label style="font-family:Cooperplate Gothic Light;">Descripció:</label>
                        <textarea class="form-control" ng-model="curso.cla_descripcion" rows="3" style="font-family:Cooperplate Gothic Light;" required></textarea>
                    </div>
                </div>
                <br/>
                <div class="row text-right">
                  <button ng-click="answer('editar',curso);" class="btn btn-success" ng-disabled="myForm.$invalid">Guardar</button>
                </div>
            </div>
        </md-dialog-content>
    </form>
</md-dialog>
