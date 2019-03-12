<div class="container">
  <div class="row">
    <div class="col-xs-11 col-xs-11">
      <div class="panel panel-primary">
        <div class="panel-heading text-center">
          <h4 style="font-family:Cooperplate Gothic Light;">
            <b>ELS MEUS TREBALLS</b>
          </h4>
        </div>
        <table class="table table-fixed table-hover" style="font-family:Cooperplate Gothic Light;">
          <thead>
            <tr>
              <th class="col-xs-4">TREBALL</th>
              <th class="col-xs-4">DATA</th>
              <th class="col-xs-2">ENVIAT</th>
              <th class="col-xs-2">ACCIÓ</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="trabajo in trabajos">
              <td class="col-xs-4">{{trabajo.tra_nombre}}</td>
              <td class="col-xs-4">{{trabajo.trasig_fecha_insert}}</td>
              <td class="col-xs-2">{{trabajo.trasig_aprobado_trabajo}}</td>
              <td class="col-xs-2">{{trabajo.trasig_aprobado_trabajo}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
