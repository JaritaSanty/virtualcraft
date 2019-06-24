<div class="container">
  <div class="row">
    <div class="col-xs-12 col-md-12">
      <h1 class="text-center" style="font-family:Cooperplate Gothic Light;"><b>Les Meves Classes</b></h1>
      <h3 class="text-center"><a href="" ng-click="showNuevoCurso()" title="Nova Classe" style="font-family:Cooperplate Gothic Light;">+ Nova Classe</a></h3>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6 col-md-3 text-center" ng-repeat="curso in cursos">
      <div class="thumbnail">
        <img class="img-responsive" ng-src="../{{curso.cla_fondo}}" alt="Fondo de {{curso.cla_nombre}}" style="width:100px; height:100px">
        <div class="caption">
          <h3 style="font-family:Cooperplate Gothic Light;">{{curso.cla_nombre}}</h3>
          <p style="font-family:Cooperplate Gothic Light;"><i>Conté <b>{{curso.cla_alumno}}</b> alumnes</i></p>
          <p>
            <button  title="Seleccionar" class="btn btn-primary" ng-click="goCursoProfesor(curso);">Seleccionar</button>
          </p>
          <p>
            <button title="Edita" ng-click="showEditarCurso(ev,curso)" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></button>
            <button title="Fons" ng-click="showSeleccionarFondo(ev,curso)" class="btn btn-default"><span class="glyphicon glyphicon-picture"></span></button>
            <button title="Assignar Alumnes" ng-click="goAlumnosCurso(curso);" class="btn btn-default"><span class="glyphicon glyphicon-user"></span></button>
            <button title="Equips" ng-click="goEquiposCurso(curso);" class="btn btn-default"><span class="glyphicon glyphicon-th"></span></button>
          </p>
          <p>
            <button title="Treballs" ng-click="goTrabajosCurso(curso)" class="btn btn-default"><span class="glyphicon glyphicon-file"></span></button>
            <button title="Premis" ng-click="goPremiosCurso(curso)" class="btn btn-default"><span class="glyphicon glyphicon-ok-circle"></span></button>
            <button title="Càstigs" ng-click="goCastigosCurso(curso)" class="btn btn-default"><span class="glyphicon glyphicon-remove-circle"></span></button>
            <button title="Privilegis" ng-click="goPrivilegiosCurso(curso)" class="btn btn-default"><span class="glyphicon glyphicon-heart"></span></button>
          </p>
        </div>
      </div>
      <br/>
    </div>
  </div>
</div>
