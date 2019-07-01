<?php
/*
  Developer:  Santiago Jara Moya
  Site:       UAM
  File:       index.php
*/
?>
<md-dialog style="width: 80%">
    <form ng-cloak name="myForm" method="post" ng-controller="CastigosCursoController">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2 style="font-family:Cooperplate Gothic Light;">Edita Càstigs</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="cancel()">
                    <md-icon md-svg-src="img/icons/ic_close_24px.svg" aria-label="Close dialog"></md-icon>
                </md-button>
            </div>
        </md-toolbar>

        <md-dialog-content class="container-fluid">
            <div class="md-dialog-content">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <label style="font-family:Cooperplate Gothic Light;">Càstig:</label>
                        <input class="form-control" ng-model="castigo.act_nombre" style="font-family:Cooperplate Gothic Light;" autofocus required/>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <label style="font-family:Cooperplate Gothic Light;">Descripció:</label>
                        <textarea class="form-control" ng-model="castigo.act_descripcion" rows="3" style="font-family:Cooperplate Gothic Light;" required></textarea>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-xs-2 col-md-2">
                      <label style="font-family:Cooperplate Gothic Light;">PV:</label>
                        <input class="form-control" string-to-number ng-model="castigo.act_PV" type="number" placeholder="PV" style="font-family:Cooperplate Gothic Light;" required/>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <label style="font-family:Cooperplate Gothic Light;">PD:</label>
                      <input class="form-control" string-to-number ng-model="castigo.act_PD" type="number" placeholder="PD" style="font-family:Cooperplate Gothic Light;" required/>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <label style="font-family:Cooperplate Gothic Light;">PO:</label>
                      <input class="form-control" string-to-number ng-model="castigo.act_PO" type="number" placeholder="PO" style="font-family:Cooperplate Gothic Light;" required/>
                    </div>
                    <div class="col-xs-2 col-md-2" ng-hide="true">
                      <label style="font-family:Cooperplate Gothic Light;">PP:</label>
                      <input class="form-control" string-to-number ng-model="castigo.act_PP" type="number" placeholder="PP" style="font-family:Cooperplate Gothic Light;" required/>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <label style="font-family:Cooperplate Gothic Light;">FO:</label>
                      <input class="form-control" string-to-number ng-model="castigo.act_FO" type="number" placeholder="FO" style="font-family:Cooperplate Gothic Light;" required/>
                    </div>
                </div>
                <br/>
                <div class="row text-right">
                  <button ng-click="answer('editar',castigo);" class="btn btn-success" ng-disabled="myForm.$invalid">Guardar</button>
                </div>
            </div>
        </md-dialog-content>
    </form>
</md-dialog>
