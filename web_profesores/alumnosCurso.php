<div class="container text-center">
  <div class="row">
    <div class="col-xs-4 col-md-4">
      <h3 class="text-center" style="font-family:Cooperplate Gothic Light;"><b>Alumnes de l'Institut</b></h3>
      <div class="form-group input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
        <input class="form-control" type="text" ng-model="buscarNoAlumnos" placeholder="Buscar">
      </div>
      <select size="20" class="form-control" ng-model="selectNoAlumnos" ng-options="value.alu_id as value.alucla_nombre for (key, value) in noalumnos | orderBy:propertyName:reverse | filter:buscarNoAlumnos" style="font-family:Cooperplate Gothic Light; font-size:16px; background-color: #F6F6F6" multiple></select>
    </div>
    <div class="col-xs-4 col-md-4">
      <br/><br/><br/><br/><br/><br/>
      <div class="row text-center">
        <button class="btn btn-success row" ng-click="asignarAlumno(ev,selectNoAlumnos);" ng-disabled="btnAsignar">Assignar >></button>
      </div>
      <br/>
      <div class="row text-center">
        <button class="btn btn-danger row" ng-click="quitarAlumno(ev,selectAlumnos);"><< Treure</button>
      </div>
    </div>
    <div class="col-xs-4 col-md-4">
      <h3 class="text-center" style="font-family:Cooperplate Gothic Light;"><b>Alumnes Classe {{curso.cla_nombre}}</b></h3>
      <div class="form-group input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
        <input class="form-control" type="text" ng-model="buscarAlumnos" placeholder="Buscar">
      </div>
      <select size="20" class="form-control" ng-model="selectAlumnos" ng-options="value.alucla_id as value.alucla_nombre for (key, value) in alumnos | orderBy:propertyName:reverse | filter:buscarAlumnos" style="font-family:Cooperplate Gothic Light; font-size:16px; background-color: #F6F6F6" multiple></select>
    </div>
  </div>
</div>
