<?php
/*
  Developer:  Santiago Jara Moya
  Site:       UAM
  File:       index.php
*/
?>
<style>
.row{
  margin-top:40px;
  padding: 0 10px;
}

.clickable{
  cursor: pointer;
}

.panel-heading span {
margin-top: -20px;
font-size: 15px;
}
</style>

<md-dialog style="width: 80%" aria-label="Close dialog">
    <form ng-cloak name="myForm" method="post" ng-controller="AprobarTrabajosCursoController">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2 style="font-family:Cooperplate Gothic Light;">Revisió de Treballs</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="cancel()">
                    <md-icon md-svg-src="img/icons/ic_close_24px.svg" aria-label="Close dialog"></md-icon>
                </md-button>
            </div>
        </md-toolbar>

        <md-dialog-content class="container-fluid">
          <div class="md-dialog-content">
            <div class="row">
              <h3 style="font-family:Cooperplate Gothic Light;"><b>Treball:</b> {{stasignado.tra_nombre}}<br><b>Estudiant:</b> {{stasignado.aluclaequ_nombre}}<br><b>Títol:</b> {{stasignado.trasig_titulo_trabajo}}</h3>
              <p class="text-justify" style="font-family:Cooperplate Gothic Light;">{{stasignado.trasig_texto_trabajo}}</p>
            </div>
            <div class="row">
              <div class="col-xs-4 col-md-4">
                  <label style="font-family:Cooperplate Gothic Light;">Qualificació:</label>
                  <input class="form-control" string-to-number ng-model="stasignado.trasig_calificacion" type="number" style="font-family:Cooperplate Gothic Light;" required ng-disabled="stasignado.trasig_aprobado_trabajo"/><br/>
                  <button ng-click="answer('aprobar',stasignado);" class="btn btn-success" ng-disabled="myForm.$invalid" ng-hide="stasignado.trasig_aprobado_trabajo">Aprovat</button>
              </div>
              <div class="col-xs-8 col-md-8">
                <label style="font-family:Cooperplate Gothic Light;">Comentari:</label>
                <textarea class="form-control" ng-model="stasignado.trasig_comentario" rows="4" style="font-family:Cooperplate Gothic Light;" required ng-disabled="stasignado.trasig_aprobado_trabajo"></textarea>
              </div>
            </div>
          </div>
        </md-dialog-content>
    </form>
</md-dialog>
