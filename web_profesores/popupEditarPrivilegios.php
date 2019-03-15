<?php
/*
  Developer:  Santiago Jara Moya
  Site:       UAM
  File:       index.php
*/
?>
<md-dialog style="width: 80%">
    <form ng-cloak name="myForm" method="post" ng-controller="PrivilegiosCursoController">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2 style="font-family:Cooperplate Gothic Light;">Edita Privilegis</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="cancel()">
                    <md-icon md-svg-src="img/icons/ic_close_24px.svg" aria-label="Close dialog"></md-icon>
                </md-button>
            </div>
        </md-toolbar>

        <md-dialog-content class="container-fluid">
            <div class="md-dialog-content">
              <h2 class="text-center" style="font-family:Cooperplate Gothic Light;">{{privilegio.pri_rol + " - Nivell " + privilegio.niv_nombre}}</h2>
              <h3 class="text-center" style="font-family:Cooperplate Gothic Light;">{{privilegio.pri_nombre}}</h3><br/>
                <div class="row">
                    <div class="col-xs-6 col-md-6">

                      <img class="img-responsive pull-right" ng-src="../{{privilegio.pri_imagen}}" style="width:150px; height:150px;"/>
                    </div>
                    <div class="col-xs-6 col-md-6">
                      <label style="font-family:Cooperplate Gothic Light;">DESCRIPCIÓ: </label>
                      <textarea class="form-control" ng-model="privilegio.pri_descripcion" rows="4" style="font-family:Cooperplate Gothic Light;" required></textarea>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-xs-4 col-md-4">
                      <label style="font-family:Cooperplate Gothic Light;">COST DEL PRIVILEGI:</label>
                      <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">PV:</label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <input class="form-control" string-to-number ng-model="privilegio.pri_costPV" ng-disabled="privilegio.pri_costPV === '0' ? true : false" type="number" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">PD:</label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <input class="form-control" string-to-number ng-model="privilegio.pri_costPD" ng-disabled="privilegio.pri_costPD === '0' ? true : false" type="number" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">PO:</label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <input class="form-control" string-to-number ng-model="privilegio.pri_costPO" ng-disabled="privilegio.pri_costPO === '0' ? true : false" type="number" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">PP:</label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <input class="form-control" string-to-number ng-model="privilegio.pri_costPP" ng-disabled="privilegio.pri_costPP === '0' ? true : false" type="number" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">FO:</label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <input class="form-control" string-to-number ng-model="privilegio.pri_costFO" ng-disabled="privilegio.pri_costFO === '0' ? true : false" type="number" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-4 col-md-4">
                      <label style="font-family:Cooperplate Gothic Light;">PUNTS D' UTILITZACIÓ PER A L'ALUMNE</label>
                      <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">PV:</label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <input class="form-control" string-to-number ng-model="privilegio.pri_aluPV" ng-disabled="privilegio.pri_aluPV === '0' ? true : false" type="number" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">PD:</label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <input class="form-control" string-to-number ng-model="privilegio.pri_aluPD" ng-disabled="privilegio.pri_aluPD === '0' ? true : false" type="number" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">PO:</label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <input class="form-control" string-to-number ng-model="privilegio.pri_aluPO" ng-disabled="privilegio.pri_aluPO === '0' ? true : false" type="number" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">PP:</label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <input class="form-control" string-to-number ng-model="privilegio.pri_aluPP" ng-disabled="privilegio.pri_aluPP === '0' ? true : false" type="number" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">FO:</label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <input class="form-control" string-to-number ng-model="privilegio.pri_aluFO" ng-disabled="privilegio.pri_aluFO === '0' ? true : false" type="number" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-4 col-md-4">
                      <label style="font-family:Cooperplate Gothic Light;">PUNTS PER A L'EQUIP</label>
                      <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">PV:</label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <input class="form-control" string-to-number ng-model="privilegio.pri_equPV" ng-disabled="privilegio.pri_equPV === '0' ? true : false" type="number" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">PD:</label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <input class="form-control" string-to-number ng-model="privilegio.pri_equPD" ng-disabled="privilegio.pri_equPD === '0' ? true : false" type="number" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">PO:</label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <input class="form-control" string-to-number ng-model="privilegio.pri_equPO" ng-disabled="privilegio.pri_equPO === '0' ? true : false" type="number" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">PP:</label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <input class="form-control" string-to-number ng-model="privilegio.pri_equPP" ng-disabled="privilegio.pri_equPP === '0' ? true : false" type="number" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <label style="font-family:Cooperplate Gothic Light;">FO:</label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <input class="form-control" string-to-number ng-model="privilegio.pri_equFO" ng-disabled="privilegio.pri_equFO === '0' ? true : false" type="number" style="font-family:Cooperplate Gothic Light;" required/>
                        </div>
                      </div>
                    </div>
                </div>
                <br/>
                <div class="row text-right">
                  <button ng-click="answer('editar',privilegio);" class="btn btn-success" ng-disabled="myForm.$invalid">Guardar</button>
                </div>
            </div>
        </md-dialog-content>
    </form>
</md-dialog>
