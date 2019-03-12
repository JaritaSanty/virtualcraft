<div class="col-xs-4 col-md-4">
  <img class="img-responsive" ng-src="../{{alumno.rol_avatar}}" alt="Logo" width="75%"/>
</div>
<div class="col-xs-8 col-md-8">
  <div class="row">
    <div class="col-xs-4 col-md-4" ng-repeat="avatar in avatares">
      <img class="img-responsive" ng-src="../{{avatar.rol_avatar}}" alt="Logo" width="50%"/>
    </div>
  </div>
</div>
