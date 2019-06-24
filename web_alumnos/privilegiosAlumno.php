<br/>
<div class="container">
  <div class="row">
    <div class="col-xs-2 col-xs-2 privnivel">
      <p style="font-family:Cooperplate Gothic Light; font-size:10px;"><b>NIVELL I</b></p>
    </div>
    <div class="col-xs-2 col-xs-2 privnivel">
      <p style="font-family:Cooperplate Gothic Light; font-size:10px;"><b>NIVELL II</b></p>
    </div>
    <div class="col-xs-2 col-xs-2 privnivel">
      <p style="font-family:Cooperplate Gothic Light; font-size:10px;"><b>NIVELL III</b></p>
    </div>
    <div class="col-xs-2 col-xs-2 privnivel">
      <p style="font-family:Cooperplate Gothic Light; font-size:10px;"><b>NIVELL IV</b></p>
    </div>
    <div class="col-xs-2 col-xs-2 privnivel">
      <p style="font-family:Cooperplate Gothic Light; font-size:10px;"><b>NIVELL V</b></p>
    </div>
    <div class="col-xs-2 col-xs-2 privnivel">
      <p style="font-family:Cooperplate Gothic Light; font-size:10px;"><b>NIVELL VI</b></p>
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-xs-2 col-xs-2 {{privilegios[0].btnPrivilegio}}">
      <a href="" style="color: white" ng-click="showDescripcionPrivilegio(ev, privilegios[0])">
        <div class="row">
          <img class="img-responsive equipo" ng-src="../{{privilegios[0].img_ruta}}" alt="Escudo de {{privilegios[0].pri_nombre}}" style="width:75%">
          <p style="font-family:Cooperplate Gothic Light; font-size:10px;">{{privilegios[0].pri_nombre}}</p>
        </div>
      </a>
    </div>
    <div class="col-xs-2 col-xs-2 {{privilegios[2].btnPrivilegio}}">
      <a href="" style="color: white" ng-click="showDescripcionPrivilegio(ev, privilegios[2])">
        <div class="row">
          <img class="img-responsive equipo" ng-src="../{{privilegios[2].img_ruta}}" alt="Escudo de {{privilegios[2].pri_nombre}}" style="width:75%">
          <p style="font-family:Cooperplate Gothic Light; font-size:10px;">{{privilegios[2].pri_nombre}}</p>
        </div>
      </a>
    </div>
    <div class="col-xs-2 col-xs-2 {{privilegios[4].btnPrivilegio}}">
      <a href="" style="color: white" ng-click="showDescripcionPrivilegio(ev, privilegios[4])">
        <div class="row">
          <img class="img-responsive equipo" ng-src="../{{privilegios[4].img_ruta}}" alt="Escudo de {{privilegios[4].pri_nombre}}" style="width:75%">
          <p style="font-family:Cooperplate Gothic Light; font-size:10px;">{{privilegios[4].pri_nombre}}</p>
        </div>
      </a>
    </div>
    <div class="col-xs-2 col-xs-2 {{privilegios[6].btnPrivilegio}}">
      <a href="" style="color: white" ng-click="showDescripcionPrivilegio(ev, privilegios[6])">
        <div class="row">
          <img class="img-responsive equipo" ng-src="../{{privilegios[6].img_ruta}}" alt="Escudo de {{privilegios[6].pri_nombre}}" style="width:75%">
          <p style="font-family:Cooperplate Gothic Light; font-size:10px;">{{privilegios[6].pri_nombre}}</p>
        </div>
      </a>
    </div>
    <div class="col-xs-2 col-xs-2 {{privilegios[8].btnPrivilegio}}">
      <a href="" style="color: white" ng-click="showDescripcionPrivilegio(ev, privilegios[8])">
        <div class="row">
          <img class="img-responsive equipo" ng-src="../{{privilegios[8].img_ruta}}" alt="Escudo de {{privilegios[8].pri_nombre}}" style="width:75%">
          <p style="font-family:Cooperplate Gothic Light; font-size:10px;">{{privilegios[8].pri_nombre}}</p>
        </div>
      </a>
    </div>
    <div class="col-xs-2 col-xs-2 {{privilegios[10].btnPrivilegio}}">
      <a href="" style="color: white" ng-click="showDescripcionPrivilegio(ev, privilegios[10])">
        <div class="row">
          <img class="img-responsive equipo" ng-src="../{{privilegios[10].img_ruta}}" alt="Escudo de {{privilegios[10].pri_nombre}}" style="width:75%">
          <p style="font-family:Cooperplate Gothic Light; font-size:10px;">{{privilegios[10].pri_nombre}}</p>
        </div>
      </a>
    </div>
  </div>
  <br/>
  <div class="row privnivel">
    <p style="font-family:Cooperplate Gothic Light; font-size:10px;"><b>{{alumno.rol_nombre | uppercase}}</b></p>
  </div>
  <br/>
  <div class="row">
    <div class="col-xs-2 col-xs-2 {{privilegios[1].btnPrivilegio}}">
      <a href="" style="color: white" ng-click="showDescripcionPrivilegio(ev, privilegios[1])">
        <div class="row">
          <img class="img-responsive equipo" ng-src="../{{privilegios[1].img_ruta}}" alt="Escudo de {{privilegios[1].pri_nombre}}" style="width:75%">
          <p style="font-family:Cooperplate Gothic Light; font-size:10px;">{{privilegios[1].pri_nombre}}</p>
        </div>
      </a>
    </div>
    <div class="col-xs-2 col-xs-2 {{privilegios[3].btnPrivilegio}}">
      <a href="" style="color: white" ng-click="showDescripcionPrivilegio(ev, privilegios[3])">
        <div class="row">
          <img class="img-responsive equipo" ng-src="../{{privilegios[3].img_ruta}}" alt="Escudo de {{privilegios[3].pri_nombre}}" style="width:75%">
          <p style="font-family:Cooperplate Gothic Light; font-size:10px;">{{privilegios[3].pri_nombre}}</p>
        </div>
      </a>
    </div>
    <div class="col-xs-2 col-xs-2 {{privilegios[5].btnPrivilegio}}">
      <a href="" style="color: white" ng-click="showDescripcionPrivilegio(ev, privilegios[5])">
        <div class="row">
          <img class="img-responsive equipo" ng-src="../{{privilegios[5].img_ruta}}" alt="Escudo de {{privilegios[5].pri_nombre}}" style="width:75%">
          <p style="font-family:Cooperplate Gothic Light; font-size:10px;">{{privilegios[5].pri_nombre}}</p>
        </div>
      </a>
    </div>
    <div class="col-xs-2 col-xs-2 {{privilegios[7].btnPrivilegio}}">
      <a href="" style="color: white" ng-click="showDescripcionPrivilegio(ev, privilegios[7])">
        <div class="row">
          <img class="img-responsive equipo" ng-src="../{{privilegios[7].img_ruta}}" alt="Escudo de {{privilegios[7].pri_nombre}}" style="width:75%">
          <p style="font-family:Cooperplate Gothic Light; font-size:10px;">{{privilegios[7].pri_nombre}}</p>
        </div>
      </a>
    </div>
    <div class="col-xs-2 col-xs-2 {{privilegios[9].btnPrivilegio}}">
      <a href="" style="color: white" ng-click="showDescripcionPrivilegio(ev, privilegios[9])">
        <div class="row">
          <img class="img-responsive equipo" ng-src="../{{privilegios[9].img_ruta}}" alt="Escudo de {{privilegios[9].pri_nombre}}" style="width:75%">
          <p style="font-family:Cooperplate Gothic Light; font-size:10px;">{{privilegios[9].pri_nombre}}</p>
        </div>
      </a>
    </div>
    <div class="col-xs-2 col-xs-2 {{privilegios[11].btnPrivilegio}}">
      <a href="" style="color: white" ng-click="showDescripcionPrivilegio(ev, privilegios[11])">
        <div class="row">
          <img class="img-responsive equipo" ng-src="../{{privilegios[11].img_ruta}}" alt="Escudo de {{privilegios[11].pri_nombre}}" style="width:75%">
          <p style="font-family:Cooperplate Gothic Light; font-size:10px;">{{privilegios[11].pri_nombre}}</p>
        </div>
      </a>
    </div>
  </div>
  <br/>
</div>
