<?php
/*
  Developer:  Santiago Jara Moya
  Site:       UAM
  File:       index.php
*/
?>
<md-dialog style="width: 60%">
    <form ng-cloak name="myForm" method="post" ng-controller="ProfesorCursoController">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2 style="font-family:Cooperplate Gothic Light;">Cronómetro</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="cancel()">
                    <md-icon md-svg-src="img/icons/ic_close_24px.svg" aria-label="Close dialog"></md-icon>
                </md-button>
            </div>
        </md-toolbar>

        <md-dialog-content class="container-fluid">
            <div class="md-dialog-content" style="font-family:Cooperplate Gothic Light;">
              <div class="row">
                <div class="col col-xs-4 col-md-4">
                  <img class="img-responsive" src="../images/cronometro.gif" alt="Logo" width="100%">
                </div>
                <div class="col col-xs-8 col-md-8 text-center">
                  <stop-watch class="stopWatch" style="font-family:Cooperplate Gothic Light;"></stop-watch>
                </div>
              </div>
            </div>
        </md-dialog-content>
    </form>
</md-dialog>
