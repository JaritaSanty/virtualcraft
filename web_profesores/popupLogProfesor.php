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
                <h2 style="font-family:Cooperplate Gothic Light;">Log</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="cancel()">
                    <md-icon md-svg-src="img/icons/ic_close_24px.svg" aria-label="Close dialog"></md-icon>
                </md-button>
            </div>
        </md-toolbar>

        <md-dialog-content class="container-fluid">
          <div class="md-dialog-content">
            <uib-tabset class="nav nav-pills nav-justified container" active="activeJustified" justified="true" style="font-family:Cooperplate Gothic Light;">
              <uib-tab index="0" heading="Privilegis" ng-click="CargarTablaLog('0')">
                <br/>
                <div class="row">
                    <div class="col-xs-4 col-md-4"></div>
                    <div class="col-xs-4 col-md-4">
                        <div class="form-group input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                            <input class="form-control" type="text" ng-model="buscarPrivilegio" placeholder="Buscar" style="font-family:Cooperplate Gothic Light;">
                        </div>
                    </div>
                    <div class="col-xs-4 col-md-4"></div>
                </div>
                <div class="col-lg-12">
                  <div class="container" style="background-color:#F5F5F5;">
                    <h1 class="text-center" style="font-family:Cooperplate Gothic Light;"><b>Log de Privilegis</b></h1>
                    <table class="table table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th><a href="" ng-click="sortBy('prieje_alumno')">Alumne</a></th>
                          <th><a href="" ng-click="sortBy('rol_nombre')">Rol</a></th>
                          <th><a href="" ng-click="sortBy('niv_nombre')">Nivell</a></th>
                          <th><a href="" ng-click="sortBy('equ_nombre')">Equip</a></th>
                          <th><a href="" ng-click="sortBy('pri_nombre')">Privilegi</a></th>
                          <th><a href="" ng-click="sortBy('prieje_tipo')">Acció</a></th>
                          <th><a href="" ng-click="sortBy('prieje_fecha')">Data</a></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="privilegioLog in privilegiosLog | orderBy:propertyName:reverse | filter:buscarPrivilegio">
                          <td>{{privilegioLog.prieje_alumno}}</td>
                          <td>{{privilegioLog.rol_nombre}}</td>
                          <td>{{privilegioLog.niv_nombre}}</td>
                          <td>{{privilegioLog.equ_nombre}}</td>
                          <td>{{privilegioLog.pri_nombre}}</td>
                          <td>{{privilegioLog.prieje_tipo}}</td>
                          <td>{{privilegioLog.prieje_fecha}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </uib-tab>
              <uib-tab index="1" heading="Premis" ng-click="CargarTablaLog('1')">
                <br/>
                <div class="row">
                    <div class="col-xs-4 col-md-4"></div>
                    <div class="col-xs-4 col-md-4">
                        <div class="form-group input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                            <input class="form-control" type="text" ng-model="buscarPremio" placeholder="Buscar" style="font-family:Cooperplate Gothic Light;">
                        </div>
                    </div>
                    <div class="col-xs-4 col-md-4"></div>
                </div>
                <div class="col-lg-12">
                  <div class="container" style="background-color:#F5F5F5;">
                    <h1 class="text-center" style="font-family:Cooperplate Gothic Light;"><b>Log de Premis</b></h1>
                    <table class="table table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th><a href="" ng-click="sortBy('acteje_alumno')">Alumne</a></th>
                          <th><a href="" ng-click="sortBy('rol_nombre')">Rol</a></th>
                          <th><a href="" ng-click="sortBy('niv_nombre')">Nivell</a></th>
                          <th><a href="" ng-click="sortBy('equ_nombre')">Equip</a></th>
                          <th><a href="" ng-click="sortBy('act_nombre')">Premi</a></th>
                          <th><a href="" ng-click="sortBy('acteje_fecha_insert')">Data</a></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="premioLog in premiosLog | orderBy:propertyName:reverse | filter:buscarPremio">
                          <td>{{premioLog.acteje_alumno}}</td>
                          <td>{{premioLog.rol_nombre}}</td>
                          <td>{{premioLog.niv_nombre}}</td>
                          <td>{{premioLog.equ_nombre}}</td>
                          <td>{{premioLog.act_nombre}}</td>
                          <td>{{premioLog.acteje_fecha_insert}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </uib-tab>
              <uib-tab index="2" heading="Càstigs" ng-click="CargarTablaLog('2')">
                <br/>
                <div class="row">
                    <div class="col-xs-4 col-md-4"></div>
                    <div class="col-xs-4 col-md-4">
                        <div class="form-group input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                            <input class="form-control" type="text" ng-model="buscarCastigo" placeholder="Buscar" style="font-family:Cooperplate Gothic Light;">
                        </div>
                    </div>
                    <div class="col-xs-4 col-md-4"></div>
                </div>
                <div class="col-lg-12">
                  <div class="container" style="background-color:#F5F5F5;">
                    <h1 class="text-center" style="font-family:Cooperplate Gothic Light;"><b>Log de Càstigs</b></h1>
                    <table class="table table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th><a href="" ng-click="sortBy('acteje_alumno')">Alumne</a></th>
                          <th><a href="" ng-click="sortBy('rol_nombre')">Rol</a></th>
                          <th><a href="" ng-click="sortBy('niv_nombre')">Nivell</a></th>
                          <th><a href="" ng-click="sortBy('equ_nombre')">Equip</a></th>
                          <th><a href="" ng-click="sortBy('act_nombre')">Càstig</a></th>
                          <th><a href="" ng-click="sortBy('acteje_fecha_insert')">Data</a></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="castigoLog in castigosLog | orderBy:propertyName:reverse | filter:buscarCastigo">
                          <td>{{castigoLog.acteje_alumno}}</td>
                          <td>{{castigoLog.rol_nombre}}</td>
                          <td>{{castigoLog.niv_nombre}}</td>
                          <td>{{castigoLog.equ_nombre}}</td>
                          <td>{{castigoLog.act_nombre}}</td>
                          <td>{{castigoLog.acteje_fecha_insert}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </uib-tab>
              <uib-tab index="3" heading="Treballs" ng-click="CargarTablaLog('3')">
                <br/>
                <div class="row">
                    <div class="col-xs-4 col-md-4"></div>
                    <div class="col-xs-4 col-md-4">
                        <div class="form-group input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                            <input class="form-control" type="text" ng-model="buscarTrabajo" placeholder="Buscar" style="font-family:Cooperplate Gothic Light;">
                        </div>
                    </div>
                    <div class="col-xs-4 col-md-4"></div>
                </div>
                <div class="col-lg-12">
                  <div class="container" style="background-color:#F5F5F5;">
                    <h1 class="text-center" style="font-family:Cooperplate Gothic Light;"><b>Log de Treballs</b></h1>
                    <table class="table table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th><a href="" ng-click="sortBy('trasig_alumno')">Alumne</a></th>
                          <th><a href="" ng-click="sortBy('rol_nombre')">Rol</a></th>
                          <th><a href="" ng-click="sortBy('niv_nombre')">Nivell</a></th>
                          <th><a href="" ng-click="sortBy('equ_nombre')">Equip</a></th>
                          <th><a href="" ng-click="sortBy('tra_nombre')">Càstig</a></th>
                          <th><a href="" ng-click="sortBy('trasig_fecha_insert')">Data d'Asignacion</a></th>
                          <th><a href="" ng-click="sortBy('trasig_aprobado_trabajo')">Estat</a></th>
                          <th><a href="" ng-click="sortBy('trasig_fecha_update')">Data de Presentació o Aprovació</a></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="trabajoLog in trabajosLog | orderBy:propertyName:reverse | filter:buscarTrabajo">
                          <td>{{trabajoLog.trasig_alumno}}</td>
                          <td>{{trabajoLog.rol_nombre}}</td>
                          <td>{{trabajoLog.niv_nombre}}</td>
                          <td>{{trabajoLog.equ_nombre}}</td>
                          <td>{{trabajoLog.tra_nombre}}</td>
                          <td>{{trabajoLog.trasig_fecha_insert}}</td>
                          <td>{{trabajoLog.trasig_aprobado_trabajo}}</td>
                          <td>{{trabajoLog.trasig_fecha_update}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </uib-tab>
              <uib-tab index="4" heading="Altres" ng-click="CargarTablaLog('4')">
                <br/>
                <div class="row">
                    <div class="col-xs-4 col-md-4"></div>
                    <div class="col-xs-4 col-md-4">
                        <div class="form-group input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                            <input class="form-control" type="text" ng-model="buscarOtros" placeholder="Buscar" style="font-family:Cooperplate Gothic Light;">
                        </div>
                    </div>
                    <div class="col-xs-4 col-md-4"></div>
                </div>
                <div class="col-lg-12">
                  <div class="container" style="background-color:#F5F5F5;">
                    <h1 class="text-center" style="font-family:Cooperplate Gothic Light;"><b>Altres Log</b></h1>
                    <table class="table table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th><a href="" ng-click="sortBy('log_alumno')">Alumne</a></th>
                          <th><a href="" ng-click="sortBy('rol_nombre')">Rol</a></th>
                          <th><a href="" ng-click="sortBy('niv_nombre')">Nivell</a></th>
                          <th><a href="" ng-click="sortBy('equ_nombre')">Equip</a></th>
                          <th><a href="" ng-click="sortBy('log_nombre')">Càstig</a></th>
                          <th><a href="" ng-click="sortBy('log_PV')">PV</a></th>
                          <th><a href="" ng-click="sortBy('log_PD')">PD</a></th>
                          <th><a href="" ng-click="sortBy('log_PO')">PO</a></th>
                          <th><a href="" ng-click="sortBy('log_PP')">PP</a></th>
                          <th><a href="" ng-click="sortBy('log_FO')">FO</a></th>
                          <th><a href="" ng-click="sortBy('log_fecha')">Data d'Asignacion</a></th>
                          <th><a href="" ng-click="sortBy('log_descripcion')">Descripció</a></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="otroLog in otrosLog | orderBy:propertyName:reverse | filter:buscarOtros">
                          <td>{{otroLog.log_alumno}}</td>
                          <td>{{otroLog.rol_nombre}}</td>
                          <td>{{otroLog.niv_nombre}}</td>
                          <td>{{otroLog.equ_nombre}}</td>
                          <td>{{otroLog.log_nombre}}</td>
                          <td>{{otroLog.log_PV}}</td>
                          <td>{{otroLog.log_PD}}</td>
                          <td>{{otroLog.log_PO}}</td>
                          <td>{{otroLog.log_PP}}</td>
                          <td>{{otroLog.log_FO}}</td>
                          <td>{{otroLog.log_fecha}}</td>
                          <td>{{otroLog.log_descripcion}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </uib-tab>
            </uib-tabset>
          </div>
        </md-dialog-content>
    </form>
</md-dialog>
