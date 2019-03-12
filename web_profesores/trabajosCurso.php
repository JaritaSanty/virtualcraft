<div class="col-lg-12">
  <div class="container" style="background-color:#F5F5F5;">
    <h1 class="text-center" style="font-family:Cooperplate Gothic Light;"><b>Treballs de la Classe {{curso.cla_nombre}}</b></h1>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="form-group input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                <input class="form-control" type="text" ng-model="buscar" placeholder="Buscar" style="font-family:Cooperplate Gothic Light;">
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
    <table id="tableTrabajos" class="table table-bordered table-responsive" style="font-family:Cooperplate Gothic Light;">
      <thead>
        <tr>
          <th><a href="" ng-click="sortBy('tra_nombre')">Treball</a></th>
          <th><a href="" ng-click="sortBy('tra_descripcion')">Descripció</a></th>
          <th><a href="" ng-click="sortBy('tra_PV')">PV</a></th>
          <th><a href="" ng-click="sortBy('tra_PD')">PD</a></th>
          <th><a href="" ng-click="sortBy('tra_PO')">PO</a></th>
          <th><a href="" ng-click="sortBy('tra_PP')">PP</a></th>
          <th><a href="" ng-click="sortBy('tra_FO')">FO</a></th>
          <th><a href="" ng-click="sortBy('tra_estado')">Estat</a></th>
          <th class="text-center"><a title="Nou" ng-href="" ng-click="showNuevoTrabajo();"><i class="glyphicon glyphicon-plus-sign"></i></a></th>
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
          <td style="text-align: center"><input type="checkbox"  ng-model="trabajo.tra_estado" ng-change="CambiarEstado(trabajo);"></td>
          <td class="text-center">
              <a title="Edita" ng-href="" ng-click="showEditarTrabajo(ev,trabajo);"><i class="glyphicon glyphicon-pencil"></i></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
