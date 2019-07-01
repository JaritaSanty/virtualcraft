<?php
/*
  Developer:  Santiago Jara Moya
  Site:       UAM
  File:       index.php
*/
?>
<md-dialog style="width: 80%">
    <form ng-cloak name="myForm" method="post" ng-controller="ProfesorCursoController">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2 style="font-family:Cooperplate Gothic Light;">Pujar / Baixar Punts a l'Alumne</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="cancel()">
                    <md-icon md-svg-src="img/icons/ic_close_24px.svg" aria-label="Close dialog"></md-icon>
                </md-button>
            </div>
        </md-toolbar>

        <md-dialog-content class="container-fluid">
            <div class="md-dialog-content">
                <div class="row">
                  <h2 class="text-center" style="font-family:Cooperplate Gothic Light;">{{alumno.aluclaequ_nombre}}</h2>
                  <h3 style="font-family:Cooperplate Gothic Light;"><b>Equip: </b>{{alumno.equ_nombre}}</h3><br/>
                </div>
                <br/>
                <div class="row">
                  <div class="col-xs-6 col-md-6">
                    <div class="row">
                        <div class="col-xs-4 col-md-4">
                          <label style="font-family:Cooperplate Gothic Light;">PV:</label>
                          <input class="form-control" string-to-number ng-model="alumno.aluclaequ_aluPV" type="number" placeholder="PV" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                        <div class="col-xs-4 col-md-4">
                          <label style="font-family:Cooperplate Gothic Light;">PD:</label>
                          <input class="form-control" string-to-number ng-model="alumno.aluclaequ_aluPD" type="number" placeholder="PD" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                        <div class="col-xs-4 col-md-4">
                          <label style="font-family:Cooperplate Gothic Light;">PO:</label>
                          <input class="form-control" string-to-number ng-model="alumno.aluclaequ_aluPO" type="number" placeholder="PO" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                        <div class="col-xs-4 col-md-4" ng-hide="true">
                          <label style="font-family:Cooperplate Gothic Light;">PP:</label>
                          <input class="form-control" string-to-number ng-model="alumno.aluclaequ_aluPP" type="number" placeholder="PP" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                        <div class="col-xs-4 col-md-4">
                          <label style="font-family:Cooperplate Gothic Light;">FO:</label>
                          <input class="form-control" string-to-number ng-model="alumno.aluclaequ_aluFO" type="number" placeholder="FO" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                    </div>
                  </div>
                  <div class="col-xs-6 col-md-6">
                    <label style="font-family:Cooperplate Gothic Light;">Descripció:</label>
                    <textarea class="form-control" ng-model="alumno.log_descripcion" rows="4" style="font-family:Cooperplate Gothic Light;" required></textarea>
                  </div>
                </div>
                <br/>
                <div class="row text-right">
                  <button ng-click="answer('editar',alumno);" class="btn btn-success" ng-disabled="myForm.$invalid">Guardar</button>
                </div>
            </div>
        </md-dialog-content>
    </form>
</md-dialog>
