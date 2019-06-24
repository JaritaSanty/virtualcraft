<md-dialog style="width: 80%" aria-label="Close dialog">
    <form ng-cloak name="myForm" method="post" ng-controller="TrabajosAlumnoController">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2 style="font-family:Cooperplate Gothic Light;">{{trabajo.tra_nombre}}</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="cancel()">
                    <md-icon md-svg-src="img/icons/ic_close_24px.svg" aria-label="Close dialog"></md-icon>
                </md-button>
            </div>
        </md-toolbar>

        <md-dialog-content class="container-fluid">
          <div class="md-dialog-content">
            <div class="row">
              <h3 style="font-family:Cooperplate Gothic Light;"><b>Indicacions:</b></h3>
              <p class="text-justify" style="font-family:Cooperplate Gothic Light;">{{trabajo.tra_descripcion}}</p>
            </div>
            <div class="row">
              <div class="col-xs-4 col-md-4">
                  <label style="font-family:Cooperplate Gothic Light;">Qualificació:</label>
                  <input class="form-control" ng-model="trabajo.trasig_calificacion" style="font-family:Cooperplate Gothic Light;" required ng-disabled="trabajo.trasig_aprobado_trabajo"/><br/>
                  <button ng-click="answer('aprobar',trabajo);" class="btn btn-success" ng-disabled="myForm.$invalid" ng-hide="trabajo.trasig_aprobado_trabajo">Aprovat</button>
              </div>
              <div class="col-xs-8 col-md-8">
                <label style="font-family:Cooperplate Gothic Light;">Comentari:</label>
                <textarea class="form-control" ng-model="trabajo.trasig_comentario" rows="4" style="font-family:Cooperplate Gothic Light;" required ng-disabled="trabajo.trasig_aprobado_trabajo"></textarea>
              </div>
            </div>
          </div>
        </md-dialog-content>
    </form>
</md-dialog>
