<br/>
<div class="container" ng-init="posts()">
  <div class="row">
    <div class="col-xs-12 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading text-center">
          <h4 style="font-family:Cooperplate Gothic Light;">
            <b>ELS MEUS TREBALLS</b>
          </h4>
        </div>
        <table class="table table-fixed" style="font-family:Cooperplate Gothic Light;">
          <thead>
            <tr>
              <th class="col-xs-4">TREBALL</th>
              <th class="col-xs-4">DATA</th>
              <th class="col-xs-2">APROVAT</th>
              <th class="col-xs-2">ACCIÓ</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="trabajo in trabajos">
              <td class="col-xs-4">{{trabajo.tra_nombre}}</td>
              <td class="col-xs-4">{{trabajo.trasig_fecha_insert}}</td>
              <td class="col-xs-2"><i class="glyphicon glyphicon-ok" ng-show="trabajo.btnAprobado"></i><i class="glyphicon glyphicon-remove" ng-hide="trabajo.btnAprobado"></i></td>
              <td class="col-xs-2 text-center">
                <a title="Indicacions" ng-href="" ng-click="showDescripcionTrabajo(ev,trabajo);"><i class="glyphicon glyphicon-list"></i></a>
                <a title="Fer Feina" ng-href="" ng-click="showDesarrollarTrabajo(ev,trabajo);" ng-hide="trabajo.btnAprobado"><i class="glyphicon glyphicon-pencil"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
