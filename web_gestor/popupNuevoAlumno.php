<?php
/*
  Developer:  Santiago Jara Moya
  Site:       UAM
  File:       index.php
*/
?>
<md-dialog style="width: 60%">
    <form ng-cloak name="myForm" method="post" ng-controller="AlumnosController">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2 style="font-family:Cooperplate Gothic Light;">Nova Alumne</h2>
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
                      <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">Nombre:</label>
                          <input class="form-control" ng-model="alumno.usu_nombre" style="font-family:Cooperplate Gothic Light;" required autofocus/>
                      </div>
                      <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">Apellido:</label>
                          <input class="form-control" ng-model="alumno.usu_apellido" style="font-family:Cooperplate Gothic Light;" required autofocus/>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-12">
                      <div class="col-xs-6 col-md-6">
                          <label>Género:</label>
                          <select class="form-control"  ng-model="alumno.usu_genero">
                              <option value="Masculino">Masculino</option>
                              <option value="Femenino">Femenino</option>
                          </select>
                      </div>
                      <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">Password:</label>
                          <input class="form-control" ng-model="alumno.usu_password" style="font-family:Cooperplate Gothic Light;" required autofocus/>
                      </div>
                    </div>
                </div>
                <br/>
                <div class="row text-right">
                  <button ng-click="answer('nuevo',alumno);" class="btn btn-success" ng-disabled="myForm.$invalid">Guardar</button>
                </div>
            </div>
        </md-dialog-content>
    </form>
</md-dialog>
