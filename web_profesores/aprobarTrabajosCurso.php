<div class="container" style="background-color:#F5F5F5;">
    <div class="col-xs-12 col-md-12">
      <h3 style="font-family:Cooperplate Gothic Light;"><b>Treballs de la Classe: </b><a href="" ng-click="goCursoProfesor(curso)">{{curso.cla_nombre}}</a></h3>
    </div>
</div>
<div class="container">
  <div class="row" style="background-color:#F5F5F5;">
    <br/>
    <uib-tabset class="nav nav-pills nav-justified container" active="activeJustified" justified="true" style="font-family:Cooperplate Gothic Light;">
      <uib-tab index="0" heading="Sense Aprovar" ng-click="CargarTablaTrabajosAsignados('0')">
        <br/>
        <div class="row">
            <div class="col-xs-4 col-md-4"></div>
            <div class="col-xs-4 col-md-4">
                <div class="form-group input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                    <input class="form-control" type="text" ng-model="buscarNoAprobados" placeholder="Buscar" style="font-family:Cooperplate Gothic Light;">
                </div>
            </div>
            <div class="col-xs-4 col-md-4"></div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered table-responsive" style="font-family:Cooperplate Gothic Light;">
              <thead>
                <tr>
                  <th><a href="" ng-click="sortBy('aluclaequ_nombre')">Treball</a></th>
                  <th><a href="" ng-click="sortBy('equ_nombre')">Estudiant</a></th>
                  <th><a href="" ng-click="sortBy('rol_nombre')">Equip</a></th>
                  <th style="text-align:center;"><a href="">Accioni</a></th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="stasignado in stasignados | orderBy:propertyName:reverse | filter:buscarNoAprobados">
                  <td>{{stasignado.tra_nombre}}</td>
                  <td>{{stasignado.aluclaequ_nombre}}</td>
                  <td>{{stasignado.equ_nombre}}</td>
                  <td class="text-center">
                    <button ng-click="showTrabajosClase(ev, stasignado);" class="btn btn-success" ng-hide="stasignado.trasig_aprobado_trabajo">Qualificar</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </uib-tab>
      <uib-tab index="1" heading="Aprovats" ng-click="CargarTablaTrabajosAsignados('1')">
        <br/>
        <div class="row">
            <div class="col-xs-4 col-md-4"></div>
            <div class="col-xs-4 col-md-4">
                <div class="form-group input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                    <input class="form-control" type="text" ng-model="buscarAprobados" placeholder="Buscar" style="font-family:Cooperplate Gothic Light;">
                </div>
            </div>
            <div class="col-xs-4 col-md-4"></div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered table-responsive" style="font-family:Cooperplate Gothic Light;">
              <thead>
                <tr>
                  <th><a href="" ng-click="sortBy('aluclaequ_nombre')">Treball</a></th>
                  <th><a href="" ng-click="sortBy('equ_nombre')">Estudiant</a></th>
                  <th><a href="" ng-click="sortBy('rol_nombre')">Equip</a></th>
                  <th style="text-align:center;"><a href="">Accioni</a></th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="atasignado in atasignados | orderBy:propertyName:reverse | filter:buscarAprobados">
                  <td>{{atasignado.tra_nombre}}</td>
                  <td>{{atasignado.aluclaequ_nombre}}</td>
                  <td>{{atasignado.equ_nombre}}</td>
                  <td class="text-center">
                    <button ng-click="showTrabajosClase(ev, atasignado);" class="btn btn-success">Veure</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </uib-tab>
    </uib-tabset>
  </div>
</div>
