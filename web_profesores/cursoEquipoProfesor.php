<div class="container" style="background-color:#F5F5F5;">
    <div class="col-xs-6 col-md-6">
      <h3 style="font-family:Cooperplate Gothic Light;"><b>Classe: </b>{{curso.cla_nombre}}<br/><b>Equip: </b>{{equipo.equ_nombre}}</h3>
    </div>
    <div class="col-xs-6 col-md-6">
      <p style="font-family:Cooperplate Gothic Light;">
        <div class="btn-group pull-right">
          <button type="button" class="btn btn-primary">Opcions</button>
          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
          	<span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="" ng-click="showLog();">Log</a></li>
            <li><a href="" ng-click="showAleatorio();">Alumne / Equip - Aleatori</a></li>
            <li><a href="" ng-click="showCronometro();">Cronòmetre</a></li>
            <li><a href="" ng-click="goAprobarTrabajos();">Treballs</a></li>
          </ul>
        </div>
      </p>
    </div>
</div>
<div class="container">
  <div class="row" style="background-color:#F5F5F5;">
    <br/>
    <div class="row">
      <div class="col-xs-4 col-md-4"></div>
      <div class="col-xs-4 col-md-4">
        <div class="form-group input-group">
          <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
          <input class="form-control" type="text" ng-model="buscar" placeholder="Buscar">
        </div>
      </div>
      <div class="col-xs-4 col-md-4"></div>
    </div>
    <div class="col-xs-12 col-md-12">
      <table id="tableAlumnos" class="table table-bordered table-responsive" style="font-family:Cooperplate Gothic Light;">
        <thead>
          <tr>
            <th><a href="" ng-click="sortBy('aluclaequ_nombre')">Estudiant</a></th>
            <th><a href="" ng-click="sortBy('equ_nombre')">Equip <a style="float:right" title="Edita Equip" ng-href="" ng-click="goEquiposCurso(curso);"><i class="glyphicon glyphicon-pencil"></i></a></a></th>
            <th><a href="" ng-click="sortBy('rol_nombre')">Rol</a></th>
            <th><a href="" ng-click="sortBy('niv_nombre')">Nivell</a></th>
            <th><a href="" ng-click="sortBy('aluclaequ_PV')">PV</a></th>
            <th><a href="" ng-click="sortBy('aluclaequ_PD')">PD</a></th>
            <th><a href="" ng-click="sortBy('aluclaequ_PO')">PO</a></th>
            <th><a href="" ng-click="sortBy('aluclaequ_PO_acc')">PO Acum</a></th>
            <th><a href=""ng-click="sortBy('aluclaequ_PP')">PP</a></th>
            <th><a href="" ng-click="sortBy('aluclaequ_FO')">FO</a></th>
            <th><a href="" ng-click="sortBy('aluclaequ_privilegio')">Privilegi Utilizat</a></th>
            <th style="text-align:center;"><a href="">Accioni</a></th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="alumno in alumnos | orderBy:propertyName:reverse | filter:buscar">
            <td>{{alumno.aluclaequ_nombre}}</td>
            <td>{{alumno.equ_nombre}} <a style="float:right" title="Pujar / Baixar Punts a l'Equip" ng-href="" ng-click="showSubirBajarPuntosEquipo(ev,alumno);"><i class="glyphicon glyphicon-sort"></i></a></td>
            <td>{{alumno.rol_nombre}}</td>
            <td>{{alumno.niv_nombre}}</td>
            <td>{{alumno.aluclaequ_PV}}</td>
            <td>{{alumno.aluclaequ_PD}}</td>
            <td>{{alumno.aluclaequ_PO}}</td>
            <td>{{alumno.aluclaequ_PO_acc}}</td>
            <td>{{alumno.aluclaequ_PP}}</td>
            <td>{{alumno.aluclaequ_FO}}</td>
            <td>{{alumno.aluclaequ_privilegio}}</td>
            <td class="text-center">
              <a title="Assignar Treball" ng-href="" ng-click="showTrabajoAlumno(ev,alumno);"><i class="glyphicon glyphicon-file"></i></a>
              <a title="Premiar Alumne" ng-href="" ng-click="showPremioAlumno(ev,alumno);"><i class="glyphicon glyphicon-ok-circle"></i></a>
              <a title="Castigar Alumne" ng-href="" ng-click="showCastigoAlumno(ev,alumno);"><i class="glyphicon glyphicon-remove-circle"></i></a>
              <a title="Pujar/Baixar Punts a l'Alumne" ng-href="" ng-click="showSubirBajarPuntosAlumno(ev,alumno);"><i class="glyphicon glyphicon-sort"></i></a>
              <a title="Assignar Rol/Nivell" ng-href="" ng-click="showAsignarRolNivelAlumno(ev,alumno);"><i class="glyphicon glyphicon-log-in"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
