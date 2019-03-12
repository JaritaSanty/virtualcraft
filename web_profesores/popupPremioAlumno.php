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
                <h2 style="font-family:Cooperplate Gothic Light;">Premiar a l'Alumne</h2>
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
                  <table id="tablePremios" class="table table-bordered table-responsive" style="font-family:Cooperplate Gothic Light;">
                    <thead>
                      <tr>
                        <th><a href="" ng-click="sortBy('act_nombre')">Premi</a></th>
                        <th><a href="" ng-click="sortBy('act_descripcion')">Descripció</a></th>
                        <th><a href="" ng-click="sortBy('act_PV')">PV</a></th>
                        <th><a href="" ng-click="sortBy('act_PD')">PD</a></th>
                        <th><a href="" ng-click="sortBy('act_PO')">PO</a></th>
                        <th><a href=""ng-click="sortBy('act_PP')">PP</a></th>
                        <th><a href="" ng-click="sortBy('act_FO')">FO</a></th>
                        <th><a href="">Accions</a></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr ng-repeat="premio in premios | orderBy:propertyName:reverse | filter:buscar">
                        <td>{{premio.act_nombre}}</td>
                        <td>{{premio.act_descripcion}}</td>
                        <td>{{premio.act_PV}}</td>
                        <td>{{premio.act_PD}}</td>
                        <td>{{premio.act_PO}}</td>
                        <td>{{premio.act_PP}}</td>
                        <td>{{premio.act_FO}}</td>
                        <td class="text-center">
                          <button ng-click="answer('premio',alumno, premio);" class="btn btn-success">Premiar</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
            </div>
        </md-dialog-content>
    </form>
</md-dialog>
