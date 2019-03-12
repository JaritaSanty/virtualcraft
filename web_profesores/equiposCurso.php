<div class="container" style="background-color:#F5F5F5;">
  <div class="row">
    <div class="col-xs-12 col-md-12">
      <h1 class="text-center" style="font-family:Cooperplate Gothic Light;"><b>Equips de la Classe {{curso.cla_nombre}}</b></h1>
      <h3 class="text-center"><a href="" ng-click="showNuevoEquipo()" title="Nou Equip" style="font-family:Cooperplate Gothic Light;">+ Nou Equip</a></h3>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6 col-md-3 text-center" ng-repeat="equipo in equipos">
      <div class="thumbnail">
        <img class="img-responsive" ng-src="../{{equipo.equ_escudo}}" alt="Escudo de {{equipo.equ_nombre}}" style="width:100px; height:100px">
        <div class="caption">
          <h3 style="font-family:Cooperplate Gothic Light;">{{equipo.equ_nombre}}</h3>
          <p style="font-family:Cooperplate Gothic Light;"><i>Conté <b>{{equipo.equ_alumno}}</b> alumnes</i></p>
          <p>
            <button  title="Seleccionar" class="btn btn-primary" ng-click="goCursoProfesor(curso,equipo);">Seleccionar</button>
          </p>
          <p>
            <button title="Edita" ng-click="showEditarEquipo(ev,equipo)" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></button>
            <button title="Escuts" ng-click="showSeleccionarEscudo(ev,equipo)" class="btn btn-default"><span class="glyphicon glyphicon-tower"></span></button>
            <button title="Fons" ng-click="showSeleccionarFondo(ev,equipo)" class="btn btn-default"><span class="glyphicon glyphicon-picture"></span></button>
            <button title="Assignar Alumnes" ng-click="goAlumnosEquipo(equipo);" class="btn btn-default"><span class="glyphicon glyphicon-user"></span></button>
          </p>
        </div>
      </div>
    </div>
  </div>
  <br/>
</div>
