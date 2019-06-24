<md-dialog style="width: 60%" aria-label="Close dialog">
    <form ng-cloak name="myForm" method="post" ng-controller="PrivilegiosAlumnoController">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2 style="font-family:Cooperplate Gothic Light;">{{privilegio.pri_nombre}}</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="cancel()">
                    <md-icon md-svg-src="img/icons/ic_close_24px.svg" aria-label="Close dialog"></md-icon>
                </md-button>
            </div>
        </md-toolbar>

        <md-dialog-content class="container-fluid">
          <div class="md-dialog-content">
            <div class="row">
              <h4 style="font-family:Cooperplate Gothic Light;"><b>Descripció:</b></h4>
              <p class="text-justify" style="font-family:Cooperplate Gothic Light;">{{privilegio.pri_descripcion}}</p>
              <h4 style="font-family:Cooperplate Gothic Light;"><b>Requeriments:</b></h4>
              <p class="text-justify" style="font-family:Cooperplate Gothic Light;"><b>Guanyar:</b> {{privilegio.pri_costPV}} PV / {{privilegio.pri_costPD}} PD / {{privilegio.pri_costPO}} PO / {{privilegio.pri_costPP}} PP / {{privilegio.pri_costFO}} FO</p>
              <p class="text-justify" style="font-family:Cooperplate Gothic Light;"><b>Comprar:</b> Alumne -> {{privilegio.pri_aluPV}} PV / {{privilegio.pri_aluPD}} PD / {{privilegio.pri_aluPO}} PO / {{privilegio.pri_aluPP}} PP / {{privilegio.pri_aluFO}} FO --- Equip -> {{privilegio.pri_equPV}} PV / {{privilegio.pri_equPD}} PD / {{privilegio.pri_equPO}} PO / {{privilegio.pri_equPP}} PP / {{privilegio.pri_equFO}} FO</p>
            </div>
            <br/>
            <div class="row text-right">
              <div ng-show="privilegio.btnDescripcion">
                <span class="label label-warning" ng-show="privilegio.btnEjecutar"><b>Aviso:</b> No compleixes amb els requeriments per comprar el privilegi.</span>
                <button ng-click="answer('comprar',privilegio);" class="btn btn-primary" ng-disabled="privilegio.btnEjecutar">Comprar</button>
              </div>
              <div ng-hide="privilegio.btnDescripcion">
                <span class="label label-warning" ng-show="privilegio.btnComprar"><b>Aviso:</b> No compleixes amb els requeriments per guanyar el privilegi.</span>
                <button ng-click="answer('ganar',privilegio);" class="btn btn-success" ng-disabled="privilegio.btnComprar">Guanyar</button>
              </div>
            </div>
          </div>
        </md-dialog-content>
    </form>
</md-dialog>
