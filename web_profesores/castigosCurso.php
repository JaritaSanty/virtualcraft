<div class="col-lg-12">
  <div class="container" style="background-color:#F5F5F5;">
    <h1 class="text-center" style="font-family:Cooperplate Gothic Light;"><b>Càstigs de la Classe {{curso.cla_nombre}}</b></h1>
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
    <table id="tableCastigos" class="table table-bordered table-responsive" style="font-family:Cooperplate Gothic Light;">
      <thead>
        <tr>
          <th><a href="" ng-click="sortBy('act_nombre')">Cástig</a></th>
          <th><a href="" ng-click="sortBy('act_descripcion')">Descripció</a></th>
          <th><a href="" ng-click="sortBy('act_PV')">PV</a></th>
          <th><a href="" ng-click="sortBy('act_PD')">PD</a></th>
          <th><a href="" ng-click="sortBy('act_PO')">PO</a></th>
          <th><a href="" ng-click="sortBy('act_PP')">PP</a></th>
          <th><a href="" ng-click="sortBy('act_FO')">FO</a></th>
          <th><a href="" ng-click="sortBy('act_estado')">Estat</a></th>
          <th class="text-center"><a title="Nou" ng-href="" ng-click="showNuevoCastigo();"><i class="glyphicon glyphicon-plus-sign"></i></a></th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="castigo in castigos | orderBy:propertyName:reverse | filter:buscar">
          <td>{{castigo.act_nombre}}</td>
          <td>{{castigo.act_descripcion}}</td>
          <td>{{castigo.act_PV}}</td>
          <td>{{castigo.act_PD}}</td>
          <td>{{castigo.act_PO}}</td>
          <td>{{castigo.act_PP}}</td>
          <td>{{castigo.act_FO}}</td>
          <td style="text-align: center"><input type="checkbox"  ng-model="castigo.act_estado" ng-change="CambiarEstado(castigo);"></td>
          <td class="text-center">
              <a title="Edita" ng-href="" ng-click="showEditarCastigo(ev,castigo);"><i class="glyphicon glyphicon-pencil"></i></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
