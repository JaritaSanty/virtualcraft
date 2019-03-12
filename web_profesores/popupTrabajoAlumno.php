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
                <h2 style="font-family:Cooperplate Gothic Light;">Assignar Treball a l'Alumne</h2>
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
                  <table id="tableTrabajos" class="table table-bordered table-responsive" style="font-family:Cooperplate Gothic Light;">
                    <thead>
                      <tr>
                        <th><a href="" ng-click="sortBy('tra_nombre')">Treball</a></th>
                        <th><a href="" ng-click="sortBy('tra_descripcion')">Descripció</a></th>
                        <th><a href="" ng-click="sortBy('tra_PV')">PV</a></th>
                        <th><a href="" ng-click="sortBy('tra_PD')">PD</a></th>
                        <th><a href="" ng-click="sortBy('tra_PO')">PO</a></th>
                        <th><a href=""ng-click="sortBy('tra_PP')">PP</a></th>
                        <th><a href="" ng-click="sortBy('tra_FO')">FO</a></th>
                        <th><a href="">Accions</a></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr ng-repeat="trabajo in trabajos | orderBy:propertyName:reverse | filter:buscar">
                        <td>{{trabajo.tra_nombre}}</td>
                        <td>{{trabajo.tra_descripcion}}</td>
                        <td>{{trabajo.tra_PV}}</td>
                        <td>{{trabajo.tra_PD}}</td>
                        <td>{{trabajo.tra_PO}}</td>
                        <td>{{trabajo.tra_PP}}</td>
                        <td>{{trabajo.tra_FO}}</td>
                        <td class="text-center" style="width:30%">
                          <button ng-click="answer('talumno',alumno, trabajo);" class="btn btn-success" ng-show="trabajo.btnAlumno">Alumne</button>
                          <button ng-click="answer('tequipo',alumno, trabajo);" class="btn btn-success" ng-show="trabajo.btnEquipo">Equip</button>
                          <button ng-click="answer('tcurso',alumno, trabajo);" class="btn btn-success" ng-show="trabajo.btnClase">Classe</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
            </div>
        </md-dialog-content>
    </form>
</md-dialog>
