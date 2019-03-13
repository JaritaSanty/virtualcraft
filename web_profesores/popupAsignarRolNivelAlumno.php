<?php
/*
  Developer:  Santiago Jara Moya
  Site:       UAM
  File:       index.php
*/
?>
<md-dialog style="width: 60%">
    <form ng-cloak name="myForm" method="post" ng-controller="ProfesorCursoController">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2 style="font-family:Cooperplate Gothic Light;">Assignar Rol i Nivell</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="cancel()">
                    <md-icon md-svg-src="img/icons/ic_close_24px.svg" aria-label="Close dialog"></md-icon>
                </md-button>
            </div>
        </md-toolbar>

        <md-dialog-content class="container-fluid">
            <div class="md-dialog-content">
              <h2 class="text-center" style="font-family:Cooperplate Gothic Light;">{{alumno.aluclaequ_nombre}}</h2>
              <h3 style="font-family:Cooperplate Gothic Light;"><b>Equip: </b>{{alumno.equ_nombre}}</h3><br/>
                <div class="row">
                    <div class="col-xs-6 col-md-6">
                        <label style="font-family:Cooperplate Gothic Light;">Rol:</label>
                        <select class="form-control" ng-model="alumno.rol_id" ng-options="value.rol_id as value.rol_nombre for (key, value) in roles" style="font-family:Cooperplate Gothic Light;" required></select>
                    </div>
                    <div class="col-xs-6 col-md-6">
                        <label>Nivell:</label>
                        <select class="form-control"  ng-model="alumno.niv_id" ng-options="value.niv_id as value.niv_nombre for (key, value) in niveles" style="font-family:Cooperplate Gothic Light;" required></select>
                    </div>
                </div>
            </div>
        </md-dialog-content>
        <md-dialog-actions layout="row">
            <button ng-click="answer('editar',alumno);" class="btn btn-success" ng-disabled="myForm.$invalid">Guardar</button>
        </md-dialog-actions>
    </form>
</md-dialog>
