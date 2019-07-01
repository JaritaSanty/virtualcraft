<div class="container-fluid">
    <h2 class="text-center"><b>Profesores</b></h2>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="form-group input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                <input class="form-control" type="text" ng-model="buscar" placeholder="Buscar">
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
    <div class="table-responsive col-lg-12">
        <table class="table table-condensed">
            <thead>
                    <th><a href="#profesores" ng-click="sortBy('pro_id')">#</a></th>
                    <th><a href="#profesores" ng-click="sortBy('usu_nombre')">Nombre</a></th>
                    <th><a href="#profesores" ng-click="sortBy('usu_apellido')">Apellido</a></th>
                    <th><a href="#profesores" ng-click="sortBy('usu_genero')">Género</a></th>
                    <th style="text-align: center;"><a title="Nuevo" ng-href="" ng-click="showNewProfesor(ev)"><i class="glyphicon glyphicon-plus-sign"></i></a></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="profesor in profesores | orderBy:propertyName:reverse | filter:buscar">
                    <td>{{$index+1}}</td>
                    <td>{{profesor.usu_nombre}}</td>
                    <td>{{profesor.usu_apellido}}</td>
                    <td>{{profesor.usu_genero}}</td>
                    <td style="text-align: center;">
                        <a title="Editar" ng-href="" ng-click="showEditProfesor(ev,profesor)"><i class="glyphicon glyphicon-pencil"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
