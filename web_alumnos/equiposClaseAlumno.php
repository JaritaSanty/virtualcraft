
<br/>
<div class="container">
  <div class="row block-center">
    <div class="col-xs-5 col-md-3 equipo" ng-repeat="equipo in equipos">
      <a href="" style="color: white">
        <div class="row">
          <div class="col-xs-6 col-md-6">
            <p style="font-family:Cooperplate Gothic Light; font-size:12px;"><b>EQUIP</b></p>
            <p style="font-family:Cooperplate Gothic Light; font-size:12px;">{{equipo.equ_nombre}}</p>
          </div>
          <div class="col-xs-6 col-md-6">
            <img class="img-responsive equipo" ng-src="../{{equipo.equ_escudo}}" alt="Escudo de {{equipo.equ_nombre}}" style="width:65px; height:65px">
          </div>
        </div>
      </a>
    </div>
  </div>
</div>
<br/>
