<md-dialog style="width: 80%">
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
                    <div class="col-xs-12 col-md-12">
                        <label style="font-family:Cooperplate Gothic Light;">Títol:</label>
                        <input class="form-control" ng-model="trabajo.trasig_titulo_trabajo" style="font-family:Cooperplate Gothic Light;" required autofocus/>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <label style="font-family:Cooperplate Gothic Light;">Desenvolupament:</label>
                        <textarea class="form-control" ng-model="trabajo.trasig_texto_trabajo" rows="6" style="font-family:Cooperplate Gothic Light;" required></textarea>
                    </div>
                </div>
                <br/>
                <div class="row text-right">
                  <button ng-click="answer('guardar',trabajo);" class="btn btn-success" ng-disabled="myForm.$invalid">Guardar</button>
                </div>
            </div>
        </md-dialog-content>
    </form>
</md-dialog>
