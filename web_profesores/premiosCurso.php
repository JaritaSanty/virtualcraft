<div class="col-lg-12">
  <div class="container" style="background-color:#F5F5F5;">
    <h1 class="text-center" style="font-family:Cooperplate Gothic Light;"><b>Premis de la Classe {{curso.cla_nombre}}</b></h1>
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
    <table id="tablePremios" class="table table-bordered table-responsive" style="font-family:Cooperplate Gothic Light;">
      <thead>
        <tr>
          <th><a href="" ng-click="sortBy('act_nombre')">Premis</a></th>
          <th><a href="" ng-click="sortBy('act_descripcion')">Descripció</a></th>
          <th><a href="" ng-click="sortBy('act_PV')">PV</a></th>
          <th><a href="" ng-click="sortBy('act_PD')">PD</a></th>
          <th><a href="" ng-click="sortBy('act_PO')">PO</a></th>
          <th><a href="" ng-click="sortBy('act_PP')">PP</a></th>
          <th><a href="" ng-click="sortBy('act_FO')">FO</a></th>
          <th><a href="" ng-click="sortBy('act_estado')">Estat</a></th>
          <th class="text-center"><a title="Nou" ng-href="" ng-click="showNuevoPremio();"><i class="glyphicon glyphicon-plus-sign"></i></a></th>
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
          <td style="text-align: center"><input type="checkbox"  ng-model="premio.act_estado" ng-change="CambiarEstado(premio);"></td>
          <td class="text-center">
              <a title="Edita" ng-href="" ng-click="showEditarPremio(ev,premio);"><i class="glyphicon glyphicon-pencil"></i></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
