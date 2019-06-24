<br/>
<div class="col-xs-4 col-md-4">
  <img class="img-responsive" ng-src="../{{alumno.rol_avatar}}" alt="Logo" width="75%"/>
  <h4 class="text-center"><b>{{alumno.aluclaequ_nombre | uppercase}}</b></h4>
</div>
<div class="col-xs-8 col-md-8">
  <div class="row">
    <div class="col-xs-4 col-md-4" ng-repeat="avatar in avatares">
      <img class="img-responsive" ng-src="../{{avatar.rol_avatar}}" alt="Logo" width="50%"/>
      <p><b>{{avatar.aluclaequ_nombre | uppercase}}</b></p>
    </div>
  </div>
</div>
