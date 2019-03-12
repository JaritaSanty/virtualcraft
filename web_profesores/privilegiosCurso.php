<uib-tabset class="nav nav-pills nav-justified container" active="activeJustified" justified="true" style="font-family:Cooperplate Gothic Light;">
  <uib-tab index="0" heading="Abat / Abadessa" ng-click="CargarTabla('0')">
    <br/>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="form-group input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                <input class="form-control" type="text" ng-model="buscarAbad" placeholder="Buscar" style="font-family:Cooperplate Gothic Light;">
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
    <div class="col-lg-12">
      <div class="container" style="background-color:#F5F5F5;">
        <h1 class="text-center" style="font-family:Cooperplate Gothic Light;"><b>Privilegis Abat/Abadessa de la Classe {{curso.cla_nombre}}</b></h1>
        <table id="tableAbadAbadesa" class="table table-bordered table-responsive">
          <thead>
            <tr>
              <th><a href="" ng-click="sortBy('niv_nombre')">Imatge</a></th>
              <th><a href="" ng-click="sortBy('niv_nombre')">Nombre</a></th>
              <th><a href="" ng-click="sortBy('pri_nombre')">Privilegi</a></th>
              <th><a href="" ng-click="sortBy('pri_descripcion')">Descripció</a></th>
              <th><a href="" ng-click="sortBy('niv_nombre')">Nivell</a></th>
              <th><a href="" ng-click="sortBy('pri_aluPO')">PO (Alumne)</a></th>
              <th><a href="" ng-click="sortBy('pri_equPV')">PV (Equip)</a></th>
              <th><a href="" ng-click="sortBy('pri_equFO')">FO (Equip)</a></th>
              <th><a href="" ng-click="sortBy('pri_necesario1')">Requeriment</a></th>
              <th><a href="">Edita</a></th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="privilegioAbad in privilegiosAbad | orderBy:propertyName:reverse | filter:buscarAbad">
              <td style="width:5%"><img class="img-responsive center-block" ng-src="../{{privilegioAbad.pri_imagen}}"/></td>
              <td>{{privilegioAbad.pri_numero}}</td>
              <td>{{privilegioAbad.pri_nombre}}</td>
              <td>{{privilegioAbad.pri_descripcion}}</td>
              <td>{{privilegioAbad.niv_nombre}}</td>
              <td>{{privilegioAbad.pri_aluPO}}</td>
              <td>{{privilegioAbad.pri_equPV}}</td>
              <td>{{privilegioAbad.pri_equFO}}</td>
              <td>Privilegis: {{privilegioAbad.pri_necesario1 == 0 ? '' : privilegioAbad.pri_necesario1}} {{privilegioAbad.pri_necesario2 == 0 ? '' : ' y ' + privilegioAbad.pri_necesario2}}</td>
              <td class="text-center">
                  <a title="Edita" ng-href="" ng-click="showEditarPrivilegios(ev,privilegioAbad);"><i class="glyphicon glyphicon-pencil"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </uib-tab>
  <uib-tab index="1" heading="Cavaller / Amazona" ng-click="CargarTabla('1')">
    <br/>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="form-group input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                <input class="form-control" type="text" ng-model="buscarCaballero" placeholder="Buscar" style="font-family:Cooperplate Gothic Light;">
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
    <div class="col-lg-12">
      <div class="container" style="background-color:#F5F5F5;">
        <h1 class="text-center" style="font-family:Cooperplate Gothic Light;"><b>Privilegis Caballer/Amazona de la Classe {{curso.cla_nombre}}</b></h1>
        <table id="tablePrivilegiosCaballeroAmazona" class="table table-bordered table-responsive">
          <thead>
            <tr>
              <th><a href="" ng-click="sortBy('niv_nombre')">Imatge</a></th>
              <th><a href="" ng-click="sortBy('niv_nombre')">Nombre</a></th>
              <th><a href="" ng-click="sortBy('pri_nombre')">Privilegi</a></th>
              <th><a href="" ng-click="sortBy('pri_descripcion')">Descripció</a></th>
              <th><a href="" ng-click="sortBy('niv_nombre')">Nivell</a></th>
              <th><a href="" ng-click="sortBy('pri_aluPO')">PO (Alumne)</a></th>
              <th><a href="" ng-click="sortBy('pri_equPV')">PV (Equip)</a></th>
              <th><a href="" ng-click="sortBy('pri_equFO')">FO (Equip)</a></th>
              <th><a href="" ng-click="sortBy('pri_necesario1')">Requeriment</a></th>
              <th><a href="">Edita</a></th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="privilegioCaballero in privilegiosCaballero | orderBy:propertyName:reverse | filter:buscarCaballero">
              <td style="width:5%"><img class="img-responsive center-block" ng-src="../{{privilegioCaballero.pri_imagen}}"/></td>
              <td>{{privilegioCaballero.pri_numero}}</td>
              <td>{{privilegioCaballero.pri_nombre}}</td>
              <td>{{privilegioCaballero.pri_descripcion}}</td>
              <td>{{privilegioCaballero.niv_nombre}}</td>
              <td>{{privilegioCaballero.pri_aluPO}}</td>
              <td>{{privilegioCaballero.pri_equPV}}</td>
              <td>{{privilegioCaballero.pri_equFO}}</td>
              <td>Privilegis: {{privilegioCaballero.pri_necesario1 == 0 ? '' : privilegioCaballero.pri_necesario1}} {{privilegioCaballero.pri_necesario2 == 0 ? '' : ' y ' + privilegioCaballero.pri_necesario2}}</td>
              <td class="text-center">
                  <a title="Edita" ng-href="" ng-click="showEditarPrivilegios(ev,privilegioCaballero);"><i class="glyphicon glyphicon-pencil"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </uib-tab>
  <uib-tab index="2" heading="Comte / Comtessa" ng-click="CargarTabla('2')">
    <br/>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="form-group input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                <input class="form-control" type="text" ng-model="buscarConde" placeholder="Buscar" style="font-family:Cooperplate Gothic Light;">
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
    <div class="col-lg-12">
      <div class="container" style="background-color:#F5F5F5;">
        <h1 class="text-center" style="font-family:Cooperplate Gothic Light;"><b>Privilegis Comte/Comtessa de la Classe {{curso.cla_nombre}}</b></h1>
        <table id="tablePrivilegiosCondeCondesa" class="table table-bordered table-responsive">
          <thead>
            <tr>
              <th><a href="" ng-click="sortBy('niv_nombre')">Imatge</a></th>
              <th><a href="" ng-click="sortBy('niv_nombre')">Nombre</a></th>
              <th><a href="" ng-click="sortBy('pri_nombre')">Privilegi</a></th>
              <th><a href="" ng-click="sortBy('pri_descripcion')">Descripció</a></th>
              <th><a href="" ng-click="sortBy('niv_nombre')">Nivell</a></th>
              <th><a href="" ng-click="sortBy('pri_aluPO')">PO (Alumne)</a></th>
              <th><a href="" ng-click="sortBy('pri_equPV')">PV (Equip)</a></th>
              <th><a href="" ng-click="sortBy('pri_equFO')">FO (Equip)</a></th>
              <th><a href="" ng-click="sortBy('pri_necesario1')">Requeriment</a></th>
              <th><a href="">Edita</a></th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="privilegioConde in privilegiosConde | orderBy:propertyName:reverse | filter:buscarConde">
              <td style="width:5%"><img class="img-responsive center-block" ng-src="../{{privilegioConde.pri_imagen}}"/></td>
              <td>{{privilegioConde.pri_numero}}</td>
              <td>{{privilegioConde.pri_nombre}}</td>
              <td>{{privilegioConde.pri_descripcion}}</td>
              <td>{{privilegioConde.niv_nombre}}</td>
              <td>{{privilegioConde.pri_aluPO}}</td>
              <td>{{privilegioConde.pri_equPV}}</td>
              <td>{{privilegioConde.pri_equFO}}</td>
              <td>Privilegis: {{privilegioConde.pri_necesario1 == 0 ? '' : privilegioConde.pri_necesario1}} {{privilegioConde.pri_necesario2 == 0 ? '' : ' y ' + privilegioConde.pri_necesario2}}</td>
              <td class="text-center">
                  <a title="Edita" ng-href="" ng-click="showEditarPrivilegios(ev,privilegioConde);"><i class="glyphicon glyphicon-pencil"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </uib-tab>
</uib-tabset>
