<?php
/*
  Developer:  Santiago Jara Moya
  Site:       UAM
  File:       index.php
*/
?>
<md-dialog style="width: 80%">
    <form ng-cloak name="myForm" method="post" ng-controller="PrivilegiosCursoController">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2 style="font-family:Cooperplate Gothic Light;">Edita Privilegis</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="cancel()">
                    <md-icon md-svg-src="img/icons/ic_close_24px.svg" aria-label="Close dialog"></md-icon>
                </md-button>
            </div>
        </md-toolbar>

        <md-dialog-content class="container-fluid">
            <div class="md-dialog-content">
              <h2 class="text-center" style="font-family:Cooperplate Gothic Light;">{{privilegio.pri_rol + " - Nivel " + privilegio.niv_nombre}}</h2><br/>
                <div class="row">
                    <div class="col-xs-6 col-md-6">
                        <img class="img-responsive pull-right" ng-src="{{privilegio.pri_imagen}}" style="width:150px; height:150px;"/>
                    </div>
                    <div class="col-xs-6 col-md-6">
                        <h3 class="pull-left" style="font-family:Cooperplate Gothic Light;">{{privilegio.pri_nombre}}</h3>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-xs-6 col-md-6">
                      <label style="font-family:Cooperplate Gothic Light;">DESCRIPCIÓN: </label>
                      <textarea class="form-control" ng-model="privilegio.pri_descripcion" rows="4" style="font-family:Cooperplate Gothic Light;" required></textarea>
                    </div>
                    <div class="col-xs-6 col-md-6">
                      <label style="font-family:Cooperplate Gothic Light;">COSTO DEL PRIVILEGIO: </label>
                      <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">PO (Alumno):</label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <input class="form-control" string-to-number ng-model="privilegio.pri_aluPO" type="number" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">PO (Equipo):</label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <input class="form-control" string-to-number ng-model="privilegio.pri_equPV" type="number" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">PO (Equipo):</label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <input class="form-control" string-to-number ng-model="privilegio.pri_equFO" type="number" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                      </div>
                    </div>
                </div>
                <br/>
                <div class="row text-right">
                  <button ng-click="answer('editar',privilegio);" class="btn btn-success" ng-disabled="myForm.$invalid">Guardar</button>
                </div>
            </div>
        </md-dialog-content>
    </form>
</md-dialog>
