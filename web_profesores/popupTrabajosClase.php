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
    <form ng-cloak name="myForm" method="post" ng-controller="ProfesorCursoController">
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
            <uib-tabset class="nav nav-pills nav-justified container" active="activeJustified" justified="true" style="font-family:Cooperplate Gothic Light;">
              <uib-tab index="0" heading="Sense Aprovats" ng-click="CargarTablaTrabajosAsignados('0')">
                <br/>
                <div class="row">
                    <div class="col-xs-4 col-md-4"></div>
                    <div class="col-xs-4 col-md-4">
                        <div class="form-group input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                            <input class="form-control" type="text" ng-model="buscarNoAprobados" placeholder="Buscar" style="font-family:Cooperplate Gothic Light;">
                        </div>
                    </div>
                    <div class="col-xs-4 col-md-4"></div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-xs-6 col-md-6" ng-repeat="stasignado in stasignados | orderBy:propertyName:reverse | filter:buscarNoAprobados">
                      <div class="panel panel-primary">
                        <div class="panel-heading">
                          <h3 class="panel-title" style="font-family:Cooperplate Gothic Light;"><b class="text-center">{{stasignado.tra_nombre}}</b> <br/>{{stasignado.aluclaequ_nombre}} --> {{stasignado.equ_nombre}} </h3>
                          <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                        </div>
                        <div class="panel-body">
                          <h2 class="text-center" style="font-family:Cooperplate Gothic Light;">{{stasignado.trasig_titulo_trabajo}}</h2>
                          <p class="text-justify" style="font-family:Cooperplate Gothic Light;">{{stasignado.trasig_texto_trabajo}}</p>
                          <button ng-click="answer('aprobar',stasignado);" class="btn btn-success pull-right" ng-hide="stasignado.trasig_aprobado_trabajo">Aprovar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </uib-tab>
              <uib-tab index="1" heading="Aprovats" ng-click="CargarTablaTrabajosAsignados('1')">
                <div class="row">
                    <div class="col-xs-4 col-md-4"></div>
                    <div class="col-xs-4 col-md-4">
                        <div class="form-group input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                            <input class="form-control" type="text" ng-model="buscarAprobados" placeholder="Buscar" style="font-family:Cooperplate Gothic Light;">
                        </div>
                    </div>
                    <div class="col-xs-4 col-md-4"></div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-xs-6 col-md-6" ng-repeat="atasignado in atasignados | orderBy:propertyName:reverse | filter:buscarAprobados">
                      <div class="panel panel-primary">
                        <div class="panel-heading">
                          <h3 class="panel-title" style="font-family:Cooperplate Gothic Light;"><b class="text-center">{{atasignado.tra_nombre}}</b> <br/>{{atasignado.aluclaequ_nombre}} --> {{atasignado.equ_nombre}} </h3>
                          <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                        </div>
                        <div class="panel-body">
                          <h2 class="text-center" style="font-family:Cooperplate Gothic Light;">{{atasignado.trasig_titulo_trabajo}}</h2>
                          <p class="text-justify" style="font-family:Cooperplate Gothic Light;">{{atasignado.trasig_texto_trabajo}}</p>
                          <button ng-click="answer('aprobar',atasignado);" class="btn btn-success pull-right" ng-hide="atasignado.trasig_aprobado_trabajo">Aprovar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </uib-tab>
            </uib-tabset>
          </div>
        </md-dialog-content>
    </form>
</md-dialog>

<script>
$(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
	if(!$this.hasClass('panel-collapsed')) {
		$this.parents('.panel').find('.panel-body').slideUp();
		$this.addClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
	} else {
		$this.parents('.panel').find('.panel-body').slideDown();
		$this.removeClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
	}
})
</script>
